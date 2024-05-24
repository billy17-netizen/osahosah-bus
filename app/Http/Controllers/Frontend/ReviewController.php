<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Log;

class ReviewController extends Controller
{
    public function index($id)
    {
        $booking = Booking::with('bookingDetails')->find($id);

        //Check if the user has a review for this booking
        $review = Review::where('user_id', auth()->id())
            ->where('booking_id', $id)
            ->first();

        if ($review) {
            return redirect()->route('my-tickets')->with('error', 'You have already submitted a review for this booking');
        }

        return view('frontend.review.index', compact('booking'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'booking_id' => 'required|exists:bookings,id',
                'punctuality' => 'required|integer|between:1,5',
                'services' => 'required|integer|between:1,5',
                'cleanliness' => 'required|integer|between:1,5',
                'comfort' => 'required|integer|between:1,5',
                'comment' => 'nullable|string',
            ]);

            // Check if the user has already submitted a review for the booking
            $review = Review::where('user_id', auth()->id())
                ->where('booking_id', $request->booking_id)
                ->first();

            if ($review) {
                return response()->json(['message' => 'You have already submitted a review for this booking'], 422);
            }

            Review::create([
                'user_id' => auth()->id(),
                'booking_id' => $request->booking_id,
                'bus_id' => $request->bus_id,
                'punctuality_rating' => $request->punctuality,
                'services_staff_rating' => $request->services,
                'cleanliness_rating' => $request->cleanliness,
                'comfort_rating' => $request->comfort,
                'comment' => $request->comment,
            ]);

            return response()->json(['message' => 'Review submitted successfully']);
        } catch (Exception $e) {
            // Handle the exception
            Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
