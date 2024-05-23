<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use Log;
use Random\RandomException;

class TicketController extends Controller
{
    public function myTicket()
    {
        $bookings = Booking::with('bookingDetails.busRoute.pickupService')
            ->where('user_id', auth()->id())
            ->get();

        foreach ($bookings as $booking) {
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
                        "pickup_service_id" => $detail->pickup_service_id,
                        "travel_date" => $detail->travel_date,
                        "created_at" => $detail->created_at,
                        "updated_at" => $detail->updated_at,
                        "bus_route" => $detail->busRoute,
                        "pickup_service" => $detail->busRoute->pickupService,
                        "bus" => $detail->bus,
                        // Initialize seat_number and ticket_number as arrays
                        "seat_number" => [],
                        "ticket_number" => [],
                    ];
                }

                // Add the different data for seat_number and ticket_number
                $mergedDetails["seat_number"][] = $detail->seat_number;
                $mergedDetails["ticket_number"][] = $detail->ticket_number;
            }

            // Convert seat_number and ticket_number arrays to strings
            $mergedDetails["seat_number"] = implode(", ", $mergedDetails["seat_number"]);
            $mergedDetails["ticket_number"] = implode(", ", $mergedDetails["ticket_number"]);

            $booking->mergedDetails = $mergedDetails;
        }

        return view('frontend.ticket.index', compact('bookings'));
    }

    public function changeTicketStatusExpired(Request $request): JsonResponse
    {
        try {
            $booking = Booking::where('user_id', auth()->id())
                ->where('id', $request->booking_id)
                ->first();

            if (!$booking) {
                return response()->json(['error' => 'Booking not found'], 404);
            }

            //update the ticket status
            $bookingDetails = $booking->bookingDetails;
            $totalSeats = 0;

            foreach ($bookingDetails as $detail) {
                if ($detail->ticket_status === 'unused') {
                    $detail->ticket_status = 'expired';
                    $detail->save();
                }
                if ($detail->ticket_status === 'expired') {
                    //get back a seat code
                    $bus = $detail->bus;
                    $bus->seatConfiguration()->where('code', $detail->seat_number)->update(['status' => 'available']);
                    $bus->save();

                    $totalSeats += 1; // Increment total seats by 1 for each expired ticket
                }
            }

            // Update the available seats
            $busAvailability = $bookingDetails->first()->bus->busAvailability->where('bus_route_id', $bookingDetails->first()->bus_route_id)->first();
            if (!$busAvailability) {
                return response()->json(['error' => 'Bus availability not found'], 400);
            }

            $busAvailability->available_seats += $totalSeats;
            $busAvailability->save();

            activity()
                ->performedOn($booking)
                ->causedBy(auth()->user())
                ->withProperties([
                    'customEvent' => 'System has been changed the ticket status to expired',
                    'Ticket Status Before' => '<span class="badge bg-soft-warning text-warning">UN-USED</span>',
                    'Ticket Status After' => '<span class="badge bg-soft-danger text-danger">EXPIRED</span>',
                ])
                ->log('Ticket status has been changed to expired');
            return response()->json(['message' => "Your payment has been expired and the ticket has been canceled try booking again"]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred while canceling the ticket'], 500);
        }
    }

    public function checkPaymentStatus(Request $request): JsonResponse
    {
        $bookingId = $request->booking_id;
        $serverKey = env('MIDTRANS_SERVER_KEY');

        // Prepare the Authorization header
        $authHeader = 'Basic ' . base64_encode($serverKey . ':');

        // Create a new Guzzle client
        $client = new Client();

        try {
            // Send a GET request to the Midtrans API
            $response = $client->request('GET', 'https://api.sandbox.midtrans.com/v2/' . $bookingId . '/status', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => $authHeader
                ]
            ]);

            // Get the response body and decode the JSON
            $responseData = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);

            return response()->json($responseData);
        } catch (GuzzleException $e) {
            // Log the exception message
            Log::error($e->getMessage());
            // Return a generic error message
            return response()->json(['error' => 'An error occurred while checking the payment status'], 500);
        } catch (JsonException $e) {
            // Log the JSON error
            Log::error('JSON error: ' . $e->getMessage());
            // Return a generic error message
            return response()->json(['error' => 'An error occurred while checking the payment status'], 500);
        }
    }

    public function donePayment(Request $request): JsonResponse
    {
        try {
            $booking = Booking::where('user_id', auth()->id())
                ->where('id', $request->booking_id)
                ->first();

            if (!$booking) {
                return response()->json(['error' => 'Booking not found'], 404);
            }

            $booking->status = 'approved';
            $booking->save();

            //update the payment status
            $payment = $booking->payment;
            $payment->payment_status = 'settlement';
            $payment->save();

            //add the ticket number and ticket status
            $bookingDetails = $booking->bookingDetails;

            foreach ($bookingDetails as $detail) {
                $detail->ticket_number = $this->generationUniqueTicketNumber();
                $detail->ticket_status = 'unused';
                $detail->save();
            }
            activity()
                ->performedOn($booking)
                ->causedBy(auth()->user())
                ->withProperties([
                    'customEvent' => 'System has been changed the booking status to approved and payment status to settlement',
                    'Booking Status Before' => '<span class="badge bg-soft-warning text-warning">Pending</span>',
                    'Booking Status After' => '<span class="badge bg-soft-success text-success">Approved</span>',
                    'Payment Status Before' => '<span class="badge bg-soft-warning text-warning">Pending</span>',
                    'Payment Status After' => '<span class="badge bg-soft-success text-success">Settlement</span>',

                ])
                ->log('Payment has been successfully processed');
            return response()->json(['message' => 'Payment successfully']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred while processing the payment'], 500);
        }
    }

    /**
     * @throws RandomException
     */
    private function generationUniqueTicketNumber(): string
    {
        return 'TICKET' . date('YmdHis') . random_int(1000, 999999);
    }

    public function expireTicket(Request $request): JsonResponse
    {
        try {
            $booking = Booking::where('user_id', auth()->id())
                ->where('id', $request->booking_id)
                ->first();

            if (!$booking) {
                return response()->json(['error' => 'Booking not found'], 404);
            }

            $booking->status = 'expired';
            $booking->save();

            //update the payment status
            $payment = $booking->payment;
            $payment->payment_status = 'expire';
            $payment->save();

            //add the ticket number and ticket status
            $bookingDetails = $booking->bookingDetails;

            foreach ($bookingDetails as $detail) {
                $detail->ticket_status = 'expired';
                $detail->save();
                //get back a seat code
                $bus = $detail->bus;
                $bus->seatConfiguration()->where('code', $detail->seat_number)->update(['status' => 'available']);
                $bus->save();

                $bookingDetails = $booking->bookingDetails;
                $totalSeats = $bookingDetails->first()->total_seats; // Get the total_seats value of the first BookingDetail

                // Check if the total_seats value is the same for all BookingDetail instances
                $sameTotalSeats = $bookingDetails->every(function ($detail) use ($totalSeats) {
                    return $detail->total_seats == $totalSeats;
                });

                if ($sameTotalSeats) {
                    // If the total_seats value is the same, increment the available_seats by this value only once
                    $busAvailability = $bookingDetails->first()->bus->busAvailability->where('bus_route_id', $bookingDetails->first()->bus_route_id)->first();
                    if (!$busAvailability) {
                        return response()->json(['error' => 'Bus availability not found'], 400);
                    }

                    $busAvailability->available_seats += $totalSeats;
                    $busAvailability->save();
                } else {
                    return response()->json(['error' => 'Total seats are not the same for all booking details'], 400);
                }
            }
            activity()
                ->performedOn($booking)
                ->causedBy(auth()->user())
                ->withProperties([
                    'customEvent' => 'System has been changed the booking status to expired and payment status to expire',
                    'Ticket Status Before' => '<span class="badge bg-soft-warning text-warning">UN-USED</span>',
                    'Ticket Status After' => '<span class="badge bg-soft-danger text-danger">EXPIRED</span>',
                    'Payment Status Before' => '<span class="badge bg-soft-success text-success">Settlement</span>',
                    'Payment Status After' => '<span class="badge bg-soft-danger text-danger">Expire</span>',
                    'Booking Status Before' => '<span class="badge bg-soft-success text-success">Approved</span>',
                    'Booking Status After' => '<span class="badge bg-soft-danger text-success">Expired</span>',
                ])
                ->log('Ticket status has been changed to expired');
            return response()->json(['message' => "Your payment has been expired and the ticket has been canceled try booking again"]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred while canceling the ticket'], 500);
        }
    }
}
