<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;

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
}
