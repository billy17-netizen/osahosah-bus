<?php

namespace App\Service;

use App\Models\Booking;
use App\Models\Customer;
use Carbon\Carbon;
use Exception;
use Log;
use Random\RandomException;
use RuntimeException;

class BusBookingService
{
    public function createBooking(array $data): array
    {
        try {
            // Validate input data
            if (!isset($data['total_amount'], $data['passenger_names'])) {
                throw new RuntimeException('Invalid input data');
            }

            $bookings = [];

            // Create booking for the user
            $busBook = new Booking();
            $busBook->id = $data['booking_id'];
            $busBook->user_id = auth()->id();
            $busBook->transaction_id = null;
            $busBook->booking_date = Carbon::now();
            $busBook->total_amount = (int)str_replace('.', '', $data['total_amount']);
            $busBook->payment_id = null;
            $busBook->status = 'pending';
            $busBook->save();

            // Validate passenger data
            foreach ($data['passenger_names'] as $i => $name) {
                if (!$name || !$data['passenger_mobile_numbers'][$i] || !$data['passenger_addresses'][$i]) {
                    throw new RuntimeException("Invalid passenger data for index $i");
                }
            }
            $seatsNumberArray = explode(',', $data['seatsNumber']);

            // Create bus booking details for each customer with the same booking id
            foreach ($data['passenger_names'] as $i => $name) {
                $customer = new Customer();
                $customer->user_id = auth()->id();
                $customer->booking_id = $busBook->id;
                $customer->name = $name;
                $customer->mobile_number = $data['passenger_mobile_numbers'][$i];
                $customer->address = $data['passenger_addresses'][$i];

                $customer->save();

                $bookingDetail = $busBook->bookingDetails()->create([
                    'booking_id' => $busBook->id,
                    'bus_route_id' => $data['busRouteId'],
                    'bus_id' => $data['busId'],
                    'seat_number' => $seatsNumberArray[$i],
                    'total_seats' => $data['seatsCount'],
                    'pickup_service_id' => $data['pickupServiceId'],
                    'ticket_number' => null,
                    'ticket_status' => null,
                    'travel_date' => $data['travelDate'],
                ]);

                $bookings[] = ['booking' => $busBook, 'bookingDetail' => $bookingDetail];
            }

            return $bookings;
        } catch (Exception $e) {
            // Handle the exception here
            Log::error($e->getMessage());
            return [
                'error' => 'An error occurred while creating the booking.',
            ];
        }
    }

    /**
     * @throws RandomException
     */
    public function generateUniqueID(): int
    {
        return (int)(date('YmdHi') . random_int(1000, 9999));
    }
}
