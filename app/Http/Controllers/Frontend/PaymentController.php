<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BusAvailability;
use App\Models\BusRoute;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Review;
use App\Service\BusBookingService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;
use Midtrans\Config;
use Midtrans\Snap;
use Random\RandomException;

class PaymentController extends Controller
{

    public function __construct()
    {
        // Set your Merchant Server Key
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        // Enable sanitization
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        // Enable 3D-Secure
        Config::$is3ds = env('MIDTRANS_IS_3D_SECURE');
    }

    public function busPayment($id)
    {
        $pickupPoint = session('pickup_point');
        $droppingPoint = session('dropping_point');

        $busRoutes = BusRoute::with('pickupService')->whereIn('pickup_service_id', [$pickupPoint, $droppingPoint])->get();
        $pickupPoint = $busRoutes->where('pickup_service_id', $pickupPoint)->first();
        $droppingPoint = $busRoutes->where('pickup_service_id', $droppingPoint)->first();
        $busAvailDetail = BusAvailability::with(['busRoute', 'bus'])->find($id);


        return view('frontend.payment', compact('busAvailDetail', 'pickupPoint', 'droppingPoint'));
    }


    /**
     * @throws Exception
     */
    public function paymentStore(Request $request, BusBookingService $busBookingService): JsonResponse
    {
        // Check if the user has any unused tickets
        $userId = auth()->id();
        // Define a constant for ticket statuses
        define('TICKET_STATUSES', ['unused', 'boarded']);

        $unusedTickets = Booking::where('user_id', $userId)->whereHas('bookingDetails', function ($query) {
            $query->whereIn('ticket_status', TICKET_STATUSES);
//            $query->where('travel_date', '>=', Carbon::now()->toDateString());
        })->count();
        if ($unusedTickets > 0) {
            // Inform the user that they cannot book a new ticket
            return response()->json([
                'success' => false,
                'message' => 'Please use your existing tickets before booking new ones & Wait for your any tickets to be dropped',
            ]);
        }
        //handle for the user if user in the payment page
        //but the date of travel date from bus availability is less than the current date
        $busAvailability = BusAvailability::find($request->bus_availability_id);
        if ($busAvailability->travel_date < Carbon::now()) {
            return response()->json([
                'success' => false,
                'message' => 'The travel date is less than the current date',
            ]);
        }
//        dd($busAvailability->travel_date < Carbon::now()->toDateString());
        // Create booking
//        dd($booking[0]['booking']->id);
        $transaction = [
            'transaction_details' => [
                'order_id' => $busBookingService->generateUniqueID(),
                'gross_amount' => (int)str_replace('.', '', $request->total_amount),
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'enabled_payments' => [
                'bca_va', 'bni_va', 'bri_va'
            ],
        ];
        $snapToken = Snap::getSnapToken($transaction);
        return response()->json([
            'success' => true,
            'snap_token' => $snapToken,
            'message' => 'Order and payment success',
        ]);
    }


    /**
     * @throws RandomException
     */
    public function updatePaymentStatus(Request $request, BusBookingService $busBookingService): JsonResponse
    {
        $data = $request->all();
        $data['booking_id'] = $request->booking_id;
        $busBookingService->createBooking($data);
        $booking = Booking::where('id', $request->booking_id)->firstOrFail();
        activity()
            ->performedOn($booking)
            ->causedBy(auth()->user())
            ->withProperties(['customEvent' => 'System has made your booking', 'Booking ID' => $booking->id])
            ->log('Booking has been created');

        $statuses = [
            'pending',
            'cancel',
            'expire',
            'failure',
            'settlement',
        ];

        if (!in_array($request->payment_status, $statuses, true)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid payment status',
            ]);
        }

        $payment = new Payment();
        $payment->payment_method = $request->payment_type . ' - ' . $request->bank;
        $payment->va_number = $request->va_number;
        $payment->payment_status = $request->payment_status;
        $payment->payment_date = $request->payment_approve_date;
        $payment->amount = $request->amount;
        $payment->save();

        activity()
            ->performedOn($booking)
            ->causedBy(auth()->user())
            ->withProperties([
                'customEvent' => 'System has made your payment ',
                'payment_data' => [
                    'Total Amount' => 'Rp ' . number_format($payment->amount, 0, ',', '.'),
                    'Payment Method' => ucwords(str_replace('_', ' ', substr($payment->payment_method, 0, strrpos($payment->payment_method, ' - ')))) . '-' . strtoupper(substr($payment->payment_method, strrpos($payment->payment_method, ' - ') + 3)),
                    'Payment Status' => '<span class="badge ' .
                        ($payment->payment_status === 'pending' ? 'bg-soft-warning text-warning' :
                            ($payment->payment_status === 'settlement' ? 'bg-soft-success text-success' :
                                'bg-soft-danger text-danger')) . '">' . ucwords($payment->payment_status) . '</span>',
                    'Payment Date' => Carbon::parse($payment->payment_date)->format('d M Y h:i A'),
                    'VA Number' => $payment->va_number
                ],])
            ->log('Payment has been created');


        $booking->transaction_id = $request->transaction_id;
        $booking->payment_id = $payment->id;

        if ($request->payment_status === 'settlement') {
            $booking->status = 'approved';

            Log::info('Updating bus availability and seat configuration status...');

            foreach ($booking->bookingDetails as $bookingDetail) {
                Log::info('Processing booking detail: ' . $bookingDetail->id);
                $bookingDetail->ticket_number = $this->generationUniqueTicketNumber();
                $bookingDetail->ticket_status = 'unused'; // unused, boarded, dropped
                $bookingDetail->save();

                $busAvailability = BusAvailability::where('bus_id', $bookingDetail->bus_id)->firstOrFail();
                if (!$busAvailability) {
                    Log::error('BusAvailability not found for id: ' . $bookingDetail->bus_id);
                    continue;
                }

                --$busAvailability->available_seats;
                $busAvailability->save();

                Log::info('Updated available seats for BusAvailability id: ' . $busAvailability->id);

                $bus = $busAvailability->bus;
                if (!$bus) {
                    Log::error('Bus not found for id: ' . $busAvailability->bus_id);
                    continue;
                }
                //update status for seat configuration
                $seatConfig = $bus->seatConfiguration()->where('code', $bookingDetail->seat_number)->first();
                if (!$seatConfig) {
                    Log::error('Seat configuration not found for code: ' . $bookingDetail->seat_number);
                    continue;
                }
                $seatConfig->status = 'sold_out';
                $seatConfig->save();
            }
            activity()
                ->performedOn($booking)
                ->causedBy(auth()->user())
                ->withProperties([
                    'customEvent' => 'System has updated your booking status',
                    'Booking Status' => '<span class="badge ' .
                        ($booking->status === 'pending' ? 'bg-soft-warning text-warning' :
                            ($booking->status === 'approved' ? 'bg-soft-success text-success' :
                                'bg-soft-danger text-danger')) . '">' . ucwords($booking->status) . '</span>',
                ])
                ->log('Booking has been approved');
        } elseif ($request->payment_status === 'pending') {
            $booking->status = 'pending';

            Log::info('Updating bus availability and seat configuration status...');

            foreach ($booking->bookingDetails as $bookingDetail) {
                Log::info('Processing booking detail: ' . $bookingDetail->id);


                $busAvailability = BusAvailability::where('bus_id', $bookingDetail->bus_id)->firstOrFail();
                if (!$busAvailability) {
                    Log::error('BusAvailability not found for id: ' . $bookingDetail->bus_id);
                    continue;
                }

                --$busAvailability->available_seats;
                $busAvailability->save();

                Log::info('Updated available seats for BusAvailability id: ' . $busAvailability->id);

                $bus = $busAvailability->bus;
                if (!$bus) {
                    Log::error('Bus not found for id: ' . $busAvailability->bus_id);
                    continue;
                }
                //update status for seat configuration
                $seatConfig = $bus->seatConfiguration()->where('code', $bookingDetail->seat_number)->first();
                if (!$seatConfig) {
                    Log::error('Seat configuration not found for code: ' . $bookingDetail->seat_number);
                    continue;
                }
                $seatConfig->status = 'sold_out';
                $seatConfig->save();
            }
            activity()
                ->performedOn($booking)
                ->causedBy(auth()->user())
                ->withProperties([
                    'customEvent' => 'System has updated your booking status',
                    'Booking Status' => '<span class="badge ' .
                        ($booking->status === 'pending' ? 'bg-soft-warning text-warning' :
                            ($booking->status === 'approved' ? 'bg-soft-success text-success' :
                                'bg-soft-danger text-danger')) . '">' . ucwords($booking->status) . '</span>',
                ])
                ->log('Booking has been pending');
        } elseif ($request->payment_status === 'expire') {
            $booking->status = 'expired';

            Log::info('Updating bus availability and seat configuration status...');

            foreach ($booking->bookingDetails as $bookingDetail) {
                Log::info('Processing booking detail: ' . $bookingDetail->id);

                $busAvailability = BusAvailability::where('bus_id', $bookingDetail->bus_id)->firstOrFail();
                if (!$busAvailability) {
                    Log::error('BusAvailability not found for id: ' . $bookingDetail->bus_id);
                    continue;
                }

                ++$busAvailability->available_seats;
                $busAvailability->save();

                Log::info('Updated available seats for BusAvailability id: ' . $busAvailability->id);

                $bus = $busAvailability->bus;
                if (!$bus) {
                    Log::error('Bus not found for id: ' . $busAvailability->bus_id);
                    continue;
                }
                //update status for seat configuration
                $seatConfig = $bus->seatConfiguration()->where('code', $bookingDetail->seat_number)->first();
                if (!$seatConfig) {
                    Log::error('Seat configuration not found for code: ' . $bookingDetail->seat_number);
                    continue;
                }
                $seatConfig->status = 'available';
                $seatConfig->save();
            }
            activity()
                ->performedOn($booking)
                ->causedBy(auth()->user())
                ->withProperties([
                    'customEvent' => 'System has updated your booking status',
                    'Booking Status' => '<span class="badge ' .
                        ($booking->status === 'pending' ? 'bg-soft-warning text-warning' :
                            ($booking->status === 'approved' ? 'bg-soft-success text-success' :
                                'bg-soft-danger text-danger')) . '">' . ucwords($booking->status) . '</span>',
                ])
                ->log('Booking has been expired');
        }

        $booking->save();
        activity()
            ->performedOn($booking)
            ->causedBy(auth()->user())
            ->withProperties([
                'customEvent' => 'System has updated your payment status',
                'Payment Status' => '<span class="badge ' .
                    ($payment->payment_status === 'pending' ? 'bg-soft-warning text-warning' :
                        ($payment->payment_status === 'settlement' ? 'bg-soft-success text-success' :
                            'bg-soft-danger text-danger')) . '">' . ucwords($payment->payment_status) . '</span>',

            ])
            ->log('Payment status has been updated');
        return response()->json([
            'success' => true,
            'ticket_url' => route('your-ticket', $booking->id),
            'message' => 'Payment status updated',
        ]);
    }

    /**
     * @throws RandomException
     */
    private function generationUniqueTicketNumber(): string
    {
        return 'TICKET' . date('YmdHis') . random_int(1000, 999999);
    }

    public function yourTicket($id)
    {
        $userId = auth()->id();
        $booking = Booking::with('payment', 'bookingDetails.busRoute')->where('id', $id)->where('user_id', $userId)->first();
        $review = Review::where('booking_id', $booking->id)->first();
        // Check if the booking exists and belongs to the authenticated user
        if (!$booking || $booking->user_id !== $userId) {
            // Redirect back with an error message
            return redirect()->route('my-tickets')->with('error', 'Ticket not found.');
        }
        $bookingDetails = $booking->bookingDetails;
        $mergedDetails = [];

        foreach ($bookingDetails as $detail) {
            if (empty($mergedDetails)) {
                // Set the similar data
                $mergedDetails = [
                    "id" => $detail->id,
                    "booking_id" => $detail->booking_id,
                    "bus_route_id" => $detail->bus_route_id,
                    "bus_id" => $detail->bus_id,
                    "total_seats" => $detail->total_seats,
                    "pickup_service" => $detail->pickupService,
                    "travel_date" => $detail->travel_date,
                    "created_at" => $detail->created_at,
                    "updated_at" => $detail->updated_at,
                    "bus_route" => $detail->busRoute,
                    // Initialize seat_number and ticket_number as arrays
                    "seat_number" => [],
                    "ticket_number" => [],
                    "ticket_status" => [],
                ];
            }

            // Add the different data for seat_number and ticket_number
            $mergedDetails["seat_number"][] = $detail->seat_number;
            $mergedDetails["ticket_number"][] = $detail->ticket_number;
            $mergedDetails["ticket_status"][] = $detail->ticket_status;
        }


        // Convert seat_number and ticket_number arrays to strings
        $mergedDetails["seat_number"] = implode(", ", $mergedDetails["seat_number"]);
        $mergedDetails["ticket_number"] = implode(", ", $mergedDetails["ticket_number"]);
        $mergedDetails["ticket_status"] = implode(", ", $mergedDetails["ticket_status"]);


        // Fetch the customer data related to the specific booking
        $customers = Customer::where('booking_id', $booking->id)->get();

        // Create a new array to hold the customer data along with their seat_number and ticket_number
        $customerDetails = [];

        $seatNumbers = explode(", ", $mergedDetails["seat_number"]);
        $ticketNumbers = explode(", ", $mergedDetails["ticket_number"]);
        $ticketStatuses = explode(", ", $mergedDetails["ticket_status"]);

        foreach ($customers as $index => $customer) {
            $seatNumber = $seatNumbers[$index] ?? 'N/A';
            $ticketNumber = $ticketNumbers[$index] ?? 'N/A';

            $customerDetails[] = [
                'name' => $customer->name,
                'mobile_number' => $customer->mobile_number,
                'seat_number' => $seatNumber,
                'ticket_number' => $ticketNumber,
                'ticket_status' => $ticketStatuses[$index] ?? 'N/A',
            ];
        }


        return view('frontend.your-ticket', compact('booking', 'mergedDetails', 'customerDetails', 'review'));
    }
}

