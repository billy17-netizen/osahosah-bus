<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BusAvailability;
use App\Models\BusRoute;
use App\Service\SessionService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;

class DetailsBusRouteController extends Controller
{
    public function busRouteDetails($id)
    {
        session()->forget('pickup_point');
        session()->forget('dropping_point');
//        dd(session('pickup_point') . ' ' . session('dropping_point'));
        $busAvailDetail = BusAvailability::with(['busRoute', 'bus'])->find($id);


        //get all the pickup services for the bus route
        $pickUpService = BusRoute::where([
            'origin' => $busAvailDetail->busRoute->origin,
            'destination' => $busAvailDetail->busRoute->destination
        ])->with('pickupService')->get();


        return view('frontend.bus-route-details', compact('busAvailDetail', 'pickUpService'));
    }

    public function storePickupPoint(Request $request): JsonResponse
    {
        $request->validate([
            'pickup_point' => 'required|string',
        ]);

        $sessionService = new SessionService();
        $sessionService->store('pickup_point', $request->pickup_point);

        try {
            return response()->json([
                'success' => __('messages.pickup_point_stored'),
                'pickup_point' => $request->pickup_point,
            ]);
        } catch (Exception $e) {
            // Handle the exception here
            return response()->json([
                'error' => 'An error occurred while storing the pickup point.',
            ], 500);
        }
    }

    public function storeDroppingPoint(Request $request): JsonResponse
    {
        $request->validate([
            'dropping_point' => 'required|string',
        ]);

        $sessionService = new SessionService();
        $sessionService->store('dropping_point', $request->dropping_point);

        try {
            return response()->json([
                'success' => __('messages.dropping_point_stored'),
                'dropping_point' => $request->dropping_point,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error occurred while storing the dropping point.',
            ], 500);
        }
    }

    public function bookBusRoute(Request $request, $id)
    {
        try {
            session()->forget(['selected_seats', 'total_amount']);

            if (!session()->has(['pickup_point', 'dropping_point'])) {
                return back()->with('error', 'Please select Boarding and Dropping points in the Pick Up menu.');
            }

            $busAvailDetail = BusAvailability::with(['busRoute', 'bus'])->find($id);

            // Check if seatConfiguration data exists
            if ($busAvailDetail->bus->seatConfiguration->isEmpty()) {
                return redirect()->route('bus-route-details', $id)->with('error', 'Admin has not set the seat for this bus. Please try again later.');
            }
            $seatConfig = $busAvailDetail->bus->seatConfiguration;


            return view('frontend.book-bus-route', compact('busAvailDetail', 'seatConfig'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function storeSelectedSeatsAndTotalAmount(Request $request): JsonResponse
    {
        $request->validate([
            'selected_seats' => 'required|array',
            'total_amount' => 'required|numeric',
            'bus_avail_id' => 'required|exists:bus_availabilities,id',
        ]);

        $selectedSeats = $request->input('selected_seats');
        $totalAmount = $request->input('total_amount'); // s for string as total amount should be numeric

        // Get the price per seat from the database using Eloquent relationship instead of multiple queries
        $busAvailDetail = BusAvailability::with('bus')->find($request->bus_avail_id);
        $pricePerSeat = $busAvailDetail->bus->price_per_seat;

        // Recalculate the total amount using count() function instead of array length attribute.
        // This also provides a performance boost as it does not have to traverse the entire array.
        $recalculatedTotalAmount = count($selectedSeats) * $pricePerSeat;

        if ($recalculatedTotalAmount != $totalAmount) {
            // The total amount was manipulated on the client-side
            return response()->json([
                'error' => 'The total amount was manipulated on the client-side.',
            ], 400);
        }

        $sessionService = new SessionService();
        $sessionService->store('selected_seats', $selectedSeats);
        $sessionService->store('total_amount', $totalAmount);

        return response()->json([
            'success' => 'Selected seats and total amount stored successfully.',
            'redirect_url' => route('bus-payment', $request->bus_avail_id)
        ]);
    }
}
