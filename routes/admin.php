<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\BusAvailabilityController;
use App\Http\Controllers\Admin\BusRuteController;
use App\Http\Controllers\Admin\ListBusController;
use App\Http\Controllers\Admin\PickupDroppingController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'as' => 'admin.'], static function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    //Bus
    Route::resource('pickup-dropping', PickupDroppingController::class);
    Route::resource('bus', ListBusController::class);
    //Gallery-Bus
    Route::get('gallery-list-bus/{id}', [ListBusController::class, 'gallery'])
        ->name('list-bus.gallery');
    Route::post('upload/gallery-bus', [ListBusController::class, 'uploadGallery'])
        ->name('upload.gallery-bus');
    Route::get('show/gallery/{path}', [ListBusController::class, 'showGallery'])
        ->name('show.gallery');
    Route::delete('delete/gallery-bus/{id}', [ListBusController::class, 'deleteGallery'])
        ->name('delete.gallery-bus');
    //Seat-Bus-Configuration
    Route::get('seat-configuration/{id}', [ListBusController::class, 'seatConfiguration'])
        ->name('seat-configuration');
    Route::post('seat-configuration', [ListBusController::class, 'storeSeatConfiguration'])
        ->name('store-seat-configuration');
    Route::post('import-seat-configuration', [ListBusController::class, 'importSeatConfig'])
        ->name('import-seat-config');
    Route::post('change-seat-status', [ListBusController::class, 'changeSeatStatus'])
        ->name('change-seat-status');
    Route::delete('delete-seat-configuration/{id}', [ListBusController::class, 'deleteSeatConfig'])
        ->name('delete-seat-config');
    //List Bus-Rute
    Route::resource('bus-rute', BusRuteController::class);
    //List BusAvailability
    Route::resource('bus-availability', BusAvailabilityController::class);

    //Booking
    Route::resource('booking', BookingController::class);
});
