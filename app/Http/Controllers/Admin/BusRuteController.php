<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BusRouteStoreRequest;
use App\Http\Requests\Admin\BusRouteUpdateRequest;
use App\Models\BusRoute;
use App\Models\PickupService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Log;

class BusRuteController extends Controller
{
    public function index()
    {
        $listBusRoutes = BusRoute::with('pickupService')->get();
        return view('admin.bus.bus-rute.index', compact('listBusRoutes'));
    }

    public function store(BusRouteStoreRequest $request): ?RedirectResponse
    {
        try {
            BusRoute::create($request->validated());
            return redirect()->route('admin.bus-rute.index')->with('success', 'Bus route created successfully.');
        } catch (Exception $e) {
            // Handle the exception
            // You can log the exception message or return it back to the view
            Log::error($e->getMessage());
            return back()->withErrors(['error' => 'There was a problem creating the bus route. Please try again.']);
        }
    }

    public function create()
    {
        $pickupService = PickupService::where('status', 1)->get();
        return view('admin.bus.bus-rute.create', compact('pickupService'));
    }

    public function edit($id)
    {
        $busRoute = BusRoute::with('pickupService')->findOrFail($id);
        $pickupService = PickupService::where('status', 1)->get();
        return view('admin.bus.bus-rute.edit', compact('busRoute', 'pickupService'));
    }

    public function update(BusRouteUpdateRequest $request, $id): ?RedirectResponse
    {
        try {
            $busRoute = BusRoute::findOrFail($id);
            $busRoute->update($request->validated());
            return redirect()->route('admin.bus-rute.index')->with('success', 'Bus route updated successfully.');
        } catch (Exception $e) {
            // Handle the exception
            // You can log the exception message or return it back to the view
            Log::error($e->getMessage());
            return back()->withErrors(['error' => 'There was a problem updating the bus route. Please try again.']);
        }
    }

    public function destroy($id): ?JsonResponse
    {
        try {
            BusRoute::destroy($id);
            return response()->json(['message' => 'Bus route deleted successfully.']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
