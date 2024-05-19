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
}
