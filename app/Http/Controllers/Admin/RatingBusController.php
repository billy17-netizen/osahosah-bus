<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;

class RatingBusController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['bus', 'user', 'booking'])->get();
        return view('admin.rating.index', compact('reviews'));
    }

    public function rejectedRating(Request $request)
    {

        try {
            $request->validate([
                'rejected_at' => 'required|date',
                'rejected_reason' => 'required|string',
            ]);

            $review = Review::findOrFail($request->review_id);
            $review->update([
                'is_approved' => '0', // 0: rejected, 1: approved, 2: pending
                'rejected_at' => $request->rejected_at,
                'rejected_reason' => $request->rejected_reason,
            ]);
            return redirect()->back()->with('success', 'Review has been rejected successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function approvedRating($id)
    {
        try {
            $review = Review::findOrFail($id);
            $review->update([
                'is_approved' => '1', // 0: rejected, 1: approved, 2: pending
                'approved_at' => now(),
            ]);
            return redirect()->back()->with('success', 'Review has been approved successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $review = Review::findOrFail($id);
            $review->delete();
            return response()->json(['message' => 'Review has been deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
