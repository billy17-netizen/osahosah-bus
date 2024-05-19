<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ListBusDetailStoreRequest;
use App\Http\Requests\Admin\ListBusStoreRequest;
use App\Http\Requests\Admin\ListBusUpdateRequest;
use App\Http\Requests\ListBusDetailUpdateRequest;
use App\Imports\SeatConfigImport;
use App\Models\Bus;
use App\Models\BusDetail;
use App\Models\GalleryBus;
use App\Models\SeatConfig;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Log;
use Maatwebsite\Excel\Facades\Excel;

class ListBusController extends Controller
{
    public function index()
    {
        $listBuses = Bus::with('busDetail')->get();
        return view('admin.bus.index', compact('listBuses'));
    }


    public function store(ListBusStoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $listBusDetailRequest = app(ListBusDetailStoreRequest::class);

            $dataDetail = $listBusDetailRequest->validated();

            if ($request->hasFile('image_url')) {
                $image = $request->file('image_url');
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('uploads/bus'), $imageName);

                $data['image_url'] = $imageName;
            }

            $bus = Bus::create($data);
            $bus_id = $bus->id;
            $dataDetail['bus_id'] = $bus_id;
            BusDetail::create($dataDetail);
            return redirect()->route('admin.bus.index')->with('success', 'Bus created successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.bus.create');
    }

    public function show($id)
    {
        $bus = Bus::with('busDetail')->find($id);
        return view('admin.bus.show', compact('bus'));
    }

    public function edit($id)
    {
        $bus = Bus::with('busDetail')->find($id);
        return view('admin.bus.edit', compact('bus'));
    }

    public function destroy($id): ?JsonResponse
    {
        try {
            $bus = Bus::find($id);
            $busDetails = BusDetail::where('bus_id', $id)->get();
            @unlink(public_path('uploads/bus/'.$bus->image_url));

            foreach ($busDetails as $busDetail) {
                $busDetail->delete();
            }

            $bus->delete();

            return response()->json(['message' => 'Bus deleted successfully.']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function gallery($id)
    {
        $bus = Bus::with(['busDetail', 'galleryBus'])->find($id);
        $uploadedImages = GalleryBus::where('bus_id', $id)->get();
        return view('admin.bus.gallery.index', compact('bus', 'uploadedImages'));
    }

    public function uploadGallery(Request $request)
    {
        if ($request->hasFile('filepond')) {
            $file = $request->file('filepond');
            $filename = $file->getClientOriginalName();
            $folder = 'uploads/bus/gallery';
            $image = $file->move(public_path($folder), $filename);
            $gallery = GalleryBus::create([
                'bus_id' => $request->bus_id,
                'file_path' => $filename,
            ]);
            return $gallery->id;
        }
        return response()->json(['message' => 'No files uploaded.']);
    }

    public function showGallery($path): \Illuminate\Http\Response
    {
        $filePath = public_path('uploads/bus/gallery/'.$path);
        if (!File::exists($filePath)) {
            abort(404);
        }

        $file = File::get($filePath);
        $type = File::mimeType($filePath);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function deleteGallery(Request $request, $id): ?JsonResponse
    {
        try {
            $imageId = $request->id;
            $gallery = GalleryBus::where('id', $imageId)->first();
            $gallery->delete();
            @unlink(public_path('uploads/bus/gallery/'.$gallery->file_path));
            return response()->json(['message' => 'Gallery deleted successfully.']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function seatConfiguration($id)
    {
        $bus = Bus::with(['busDetail', 'seatConfiguration', 'busAvailability'])->find($id);
//        dd($bus->seatConfiguration[0]->status); // Example of accessing seat configuration status: [0 = Available, 1 = Booked, 2 = Blocked
        $seatConfigs = SeatConfig::with('bus')->where('bus_id', $id)->get();
        $seatConfigCount = $seatConfigs->count(); // Count of seat configurations

        return view('admin.bus.seat-configuration', compact('bus', 'seatConfigs', 'seatConfigCount'));
    }

    public function storeSeatConfiguration(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'bus_id' => 'required|exists:buses,id',
                'code' => 'required',
                'status' => 'required',
            ]);

            $bus = Bus::with('busAvailability')->find($request->bus_id);
            $seatConfigCount = SeatConfig::where('bus_id', $request->bus_id)->count();

            if ($bus->busAvailability[0]->available_seats <= $seatConfigCount) {
                return back()->with('error', 'All seats for this bus are already configured.');
            }

            SeatConfig::create([
                'bus_id' => $request->bus_id,
                'code' => $request->code,
                'status' => $request->status,
            ]);

            return back()->with('success', 'Seat configuration added successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function importSeatConfig(Request $request): JsonResponse
    {
        try {
            Excel::import(new SeatConfigImport, $request->file('your_excel_file'));
            return response()->json(['message' => 'Seat configurations imported successfully.']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'There was an error importing the file: '.$e->getMessage()]);
        }
    }

    public function changeSeatStatus(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'seatId' => 'required|exists:seat_configs,id',
                'status' => 'required',
            ]);

            $seat = SeatConfig::find($request->seatId);
            $seat->update([
                'status' => $request->status,
            ]);

            return response()->json(['message' => 'Seat status updated successfully.']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(ListBusUpdateRequest $request, $id): RedirectResponse
    {
        try {
            $data = $request->validated();
            $listBusDetailRequest = app(ListBusDetailUpdateRequest::class);

            $dataDetail = $listBusDetailRequest->validated();

            $bus = Bus::find($id);

            if ($request->hasFile('image_url')) {
                // Delete the old image
                if ($bus->image_url) {
                    $oldImagePath = public_path('uploads/bus/'.$bus->image_url);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Upload the new image
                $image = $request->file('image_url');
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('uploads/bus'), $imageName);

                $data['image_url'] = $imageName;
            }

            $bus->update($data);

            $busDetail = BusDetail::where('bus_id', $id)->first();
            $busDetail->update($dataDetail);

            return redirect()->route('admin.bus.index')->with('success', 'Bus updated successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function deleteSeatConfig($id): ?JsonResponse
    {
        try {
            $seatConfig = SeatConfig::find($id);
            $seatConfig->delete();
            return response()->json(['message' => 'Seat configuration deleted successfully.']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
