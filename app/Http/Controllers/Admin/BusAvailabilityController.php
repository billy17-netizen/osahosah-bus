<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BusAvailabilityStoreRequest;
use App\Http\Requests\Admin\BusAvailabilityUpdateRequest;
use App\Models\Bus;
use App\Models\BusAvailability;
use App\Models\BusRoute;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Log;

class BusAvailabilityController extends Controller
{
    public function index()
    {
        $availabilityBuses = BusAvailability::with(['bus', 'busRoute'])->get();
        return view('admin.bus.availability.index', compact('availabilityBuses'));
    }

    public function store(BusAvailabilityStoreRequest $request): ?RedirectResponse
    {
        try {
            BusAvailability::create($request->validated());
            return redirect()->route('admin.bus-availability.index')->with('success',
                'Bus Availability created successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        $busRoutes = BusRoute::with('pickupService')->get();
        $buses = Bus::where('status', 1)->get();
        return view('admin.bus.availability.create', compact('busRoutes', 'buses'));
    }

    public function edit($id)
    {
        $busAvailability = BusAvailability::with(['bus', 'busRoute'])->find($id);
        $busRoutes = BusRoute::with('pickupService')->get();
        $buses = Bus::where('status', 1)->get();
        return view('admin.bus.availability.edit', compact('busAvailability', 'busRoutes', 'buses'));
    }

    public function update(BusAvailabilityUpdateRequest $request, $id): ?RedirectResponse
    {
        try {
            $busAvailability = BusAvailability::findOrFail($id);
            $busAvailability->update($request->validated());
            return redirect()->route('admin.bus-availability.index')->with('success',
                'Bus Availability updated successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id): ?JsonResponse
    {
        try {
            BusAvailability::destroy($id);
            return response()->json(['message' => 'Bus Availability deleted successfully']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
