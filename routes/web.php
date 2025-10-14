<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\BookingHistoryController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\FleetController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\frontend\PaymentController;
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

Route::get('/', function () {
    return view('auth/login');
});
//payment
Route::get('/payment/{booking_id}', [PaymentController::class, 'payment'])->name('payment');
Route::post('/stripe-post', [PaymentController::class, 'stripePost'])->name('stripe.post');


//Admin
Route::middleware('auth')->group(callback: function () {
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Fleet
    Route::get('/fleet', [FleetController::class, 'index'])->name('fleet.index');
    Route::post('/fleet/store', [FleetController::class, 'store'])->name('fleet.store');
    Route::put('/fleet/update/{id}', [FleetController::class, 'update'])->name('fleet.update');
    Route::get('/fleet/delete/{id}', [FleetController::class, 'destroy'])->name('fleet.destroy');

    //Service
    Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
    Route::post('/service/store', [ServiceController::class, 'store'])->name('service.store');
    Route::put('/service/update/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::get('/service/delete/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');

    //Blog
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::put('/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('/blog/delete/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');

    //slider
    Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
    Route::post('/slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::put('/slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::get('/slider/delete/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');




    //contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/delete/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');



    Route::get('/booking-history', [BookingHistoryController::class, 'bookingHistory'])->name('booking.history');
    Route::get('/bookings/calendar', [BookingHistoryController::class, 'calendarData'])->name('bookings.calendar');
});
require __DIR__.'/auth.php';
