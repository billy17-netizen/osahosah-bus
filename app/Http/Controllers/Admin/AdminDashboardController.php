<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Bus;
use App\Models\Customer;
use Illuminate\Contracts\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        //get total earnings from colum total_amount for every booking
        $totalEarnings = Booking::where('status', 'approved')->sum('total_amount');
        //get total booking
        $totalBooking = Booking::count();
        //get total customers
        $totalCustomers = Customer::count();
        //get total bus
        $totalBus = Bus::count();

        // Fetch the booking data for each month
        $monthlyBookings = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->sortKeys()
            ->values();

        // Fetch the month names
        $monthlyBookingMonths = Booking::selectRaw('MONTHNAME(created_at) as month')
            ->groupBy('month')
            ->pluck('month')
            ->sort()
            ->values();

        //Fetch the total_amount for each month
        $monthlyEarnings = Booking::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total_amount')
            ->groupBy('month')
            ->pluck('total_amount', 'month')
            ->sortKeys()
            ->values();

        $approvedBookings = Booking::with('user')->where('status', 'approved')->get();
        $pendingBookings = Booking::with('user')->where('status', 'pending')->get();

        return view('admin.dashboard.index', compact('totalEarnings', 'totalBooking', 'totalCustomers', 'totalBus', 'monthlyBookings', 'monthlyBookingMonths', 'monthlyEarnings', 'approvedBookings', 'pendingBookings'));
    }
}
