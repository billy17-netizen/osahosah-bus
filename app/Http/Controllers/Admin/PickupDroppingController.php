<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PickupDroppingStoreRequest;
use App\Http\Requests\Admin\PickupDroppingUpdateRequest;
use App\Models\PickupService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Log;

class PickupDroppingController extends Controller
{
    public function index()
    {
        $pickupDroppings = PickupService::all();
        return view('admin.bus.pickup-dropping.index', compact('pickupDroppings'));
    }

    public function store(PickupDroppingStoreRequest $request): ?RedirectResponse
    {
        try {
            $data = $request->validated();
            PickupService::create($data);
            return redirect()->route('admin.pickup-dropping.index')->with('success',
                'Pickup Dropping created successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.bus.pickup-dropping.create');
    }

    public function edit($id)
    {
        $pickupDropping = PickupService::find($id);
        return view('admin.bus.pickup-dropping.edit', compact('pickupDropping'));
    }

    public function update(PickupDroppingUpdateRequest $request, $id): ?RedirectResponse
    {
        try {
            $data = $request->validated();
            $pickupDropping = PickupService::find($id);
            $pickupDropping->update($data);
            return redirect()->route('admin.pickup-dropping.index')->with('success',
                'Pickup Dropping updated successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id): ?JsonResponse
    {
        try {
            PickupService::destroy($id);
            return response()->json(['message' => 'Pickup Dropping deleted successfully.']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
