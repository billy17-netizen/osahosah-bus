<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Customer;
use App\Models\Payment;
use Exception;
use Illuminate\Http\JsonResponse;
use Log;

class BookingController extends Controller
{
    public function index()
    {
        $allBookings = Booking::with('payment', 'user')->get();
        return view('admin.booking.index', compact('allBookings'));
    }

    public function show($id)
    {
        $booking = Booking::with(['payment', 'user', 'bookingDetails' => function ($query) use ($id) {
            $query->where('booking_id', $id);
        }])->find($id);

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
                    "bus" => $detail->bus,
                    "pickup_service" => $detail->busRoute->pickupService,
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
                'address' => $customer->address,
                'seat_number' => $seatNumber,
                'ticket_number' => $ticketNumber,
                'ticket_status' => $ticketStatuses[$index] ?? 'N/A',
            ];
        }

        return view('admin.booking.show', compact('booking', 'mergedDetails', 'customerDetails'));
    }


    public function destroy($id): JsonResponse
    {
        try {
            $booking = Booking::find($id);
            $customer = Customer::where('booking_id', $booking->id)->get();
            foreach ($customer as $c) {
                $c = Customer::find($c->id);
                if ($c) {
                    $c->delete();
                } else {
                    return response()->json(['error' => 'Customer not found'], 400);
                }
            }
            //get back an available seat and matching with the capacity of the bus
            $bookingDetails = $booking->bookingDetails;
            $totalSeats = $bookingDetails->first()->total_seats; // Get the total_seats value of the first BookingDetail

            // Check if the total_seats value is the same for all BookingDetail instances
            $sameTotalSeats = $bookingDetails->every(function ($detail) use ($totalSeats) {
                return $detail->total_seats == $totalSeats;
            });

            if ($sameTotalSeats) {
                // If the total_seats value is the same, increment the available_seats by this value only once
                $busAvailability = $bookingDetails->first()->bus->busAvailability->where('bus_route_id', $bookingDetails->first()->bus_route_id)->first();
                if ($busAvailability) {
                    $busAvailability->available_seats += $totalSeats;
                    $busAvailability->save();
                } else {
                    return response()->json(['error' => 'Bus availability not found'], 400);
                }
            } else {
                return response()->json(['error' => 'Total seats are not the same for all booking details'], 400);
            }

            //get back the status of a seat code
            $seatCodes = $booking->bookingDetails->pluck('seat_number')->toArray();
            $bus = $booking->bookingDetails->first()->bus;
            $bus->seatConfiguration()->whereIn('code', $seatCodes)->update(['status' => 'available']);

            $bookingDetails = BookingDetail::where('booking_id', $id)->get();
            foreach ($bookingDetails as $detail) {
                $detail->delete();
            }
            $booking->delete();
            $payment = Payment::find($booking->payment_id);
            $payment->delete();
            return response()->json(['message' => 'Booking deleted successfully']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
