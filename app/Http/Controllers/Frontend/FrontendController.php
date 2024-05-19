<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BusAvailability;
use App\Models\BusRoute;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class FrontendController extends Controller
{
    public function landing()
    {
        if (Auth::check() || Cookie::get('hasVisited')) {
            // The user is logged in or has visited before, redirect them to the home page
            return redirect()->route('home');
        }

        // Set the cookie to indicate the user has visited
        Cookie::queue('hasVisited', true, 60 * 24 * 365); // This cookie will last for one year

        return view('frontend.landing');
    }

    public function getStarted()
    {
        if (Auth::check() || Cookie::get('hasVisitedGetStarted')) {
            // The user is logged in or has visited before, redirect them to the home page
            return redirect()->route('home');
        }

        // Set the cookie to indicate the user has visited
        Cookie::queue('hasVisitedGetStarted', true, 60 * 24 * 365); // This cookie will last for one year

        return view('frontend.get-started');
    }


    public function index()
    {
        $busRoutes = BusRoute::all()
            ->groupBy(function ($busRoute) {
                return $busRoute->origin . '-' . $busRoute->destination;
            })
            ->map(function ($group) {
                return $group->first();
            });
        return view('frontend.home.index', compact('busRoutes'));
    }

    public function listBusRoutes(Request $request)
    {
        session()->forget(['pickup_point', 'dropping_point']);
        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'travel_date' => 'required',
        ]);

        // Initialize $availableBuses as an empty array
        $availableBuses = [];

        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $travelDate = $request->input('travel_date');

        // Check if the travel date is a past date
        if (Carbon::parse($travelDate)->lt(Carbon::today())) {
            // If the travel date is a past date, return an error message
            return back()->withErrors(['travel_date' => 'Travel date cannot be a past date.']);
        }

        //Check if the origin and destination are the same
        if ($origin === $destination) {
            // If the origin and destination are the same, return an error message
            return back()->withErrors(['destination' => 'Destination cannot be the same as origin.']);
        }


        $availableRoutes = BusRoute::where('origin', $origin)
            ->where('destination', $destination)
            ->get();

        foreach ($availableRoutes as $route) {
            $availabilities = BusAvailability::where('bus_route_id', $route->id)
                ->whereDate('travel_date', $travelDate)
                ->get();

            if (!$availabilities->isEmpty()) {
                // Add a check to ensure the route is available on the specified travel date
                foreach ($availabilities as $availability) {
                    $availableBuses[] = $availability;
                }
            }
        }

        return view('frontend.home.list-bus-search', compact('availableBuses', 'travelDate', 'origin', 'destination'));
    }

}
