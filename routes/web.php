<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Frontend\DetailsBusRouteController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Admin Auth Routes
Route::group(['middleware' => 'guest'], function () {
    Route::get('admin/login', [AdminAuthController::class, 'index'])->name('admin.login');
});
require __DIR__ . '/auth.php';

Route::get('/', [FrontendController::class, 'landing'])->name('landing');
Route::get('/get-started', [FrontendController::class, 'getStarted'])->name('get-started');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('home', [FrontendController::class, 'index'])->name('home');

    //Search Bus Route
    Route::post('list-bus-routes', [FrontendController::class, 'listBusRoutes'])->name('list-bus-routes');

    //Details of Bus Route
    Route::get('bus-route/{id}', [DetailsBusRouteController::class, 'busRouteDetails'])->name('bus-route-details');
    //store pickup into session
    Route::post('/storePickupPoint', [DetailsBusRouteController::class, 'storePickupPoint'])->name('storePickupPoint');
    Route::post('/storeDroppingPoint',
        [DetailsBusRouteController::class, 'storeDroppingPoint'])->name('storeDroppingPoint');

    //book bus route
    Route::post('book-bus-route/{id}', [DetailsBusRouteController::class, 'bookBusRoute'])->name('book-bus-route');

    // store selected seats and total amount
    Route::post('/storeSelectedSeatsAndTotalAmount', [
        DetailsBusRouteController::class, 'storeSelectedSeatsAndTotalAmount'
    ])->name('storeSelectedSeatsAndTotalAmount');

    //payment page
    Route::get('bus-payment/{id}', [PaymentController::class, 'busPayment'])->name('bus-payment');
    Route::post('bus-payment', [PaymentController::class, 'paymentStore'])->name('payment.store');
    //update payment status
    Route::post('update-payment-status', [PaymentController::class, 'updatePaymentStatus'])->name('update.payment.status');
    //Your Ticket
    Route::get('your-ticket/{id}', [PaymentController::class, 'yourTicket'])->name('your-ticket');


    //My All Bookings or My Tickets
    Route::get('my-tickets', [TicketController::class, 'myTicket'])->name('my-tickets');
    Route::post('/check-payment-status',
        [TicketController::class, 'checkPaymentStatus'])->name('check-payment-status');
    Route::post('/done-payment', [TicketController::class, 'donePayment'])->name('done.payment');

    //Profile
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile.index');
    Route::put('profile/update', [ProfileController::class, 'updateProfile'])->name('profiles.update');
});
