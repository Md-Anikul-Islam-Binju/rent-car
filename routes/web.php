<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\BookingHistoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\FleetController;
use App\Http\Controllers\admin\ServiceController;
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

    Route::get('/booking-history', [BookingHistoryController::class, 'bookingHistory'])->name('booking.history');

    Route::get('/bookings/calendar', [BookingHistoryController::class, 'calendarData'])->name('bookings.calendar');
});
require __DIR__.'/auth.php';
