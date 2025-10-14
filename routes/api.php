<?php

use App\Http\Controllers\api\BlogController;
use App\Http\Controllers\api\BookingController;
use App\Http\Controllers\api\ContactController;
use App\Http\Controllers\api\FleetController;
use App\Http\Controllers\api\ServiceController;
use App\Http\Controllers\api\SliderController;
use App\Http\Controllers\api\UserAccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/fleets', [FleetController::class, 'fleet']);
Route::get('/slider', [SliderController::class, 'slider']);
Route::get('/specific-fleet/{id}', [FleetController::class, 'fleetSpecific']);
Route::get('/services', [ServiceController::class, 'service']);
Route::get('/specific-services/{id}', [ServiceController::class, 'serviceSpecific']);
Route::get('/blog', [BlogController::class, 'blog']);
Route::get('/specific-blog/{id}', [BlogController::class, 'blogSpecific']);
Route::post('/booking-store', [BookingController::class, 'store']);

Route::post('/contact-store', [ContactController::class, 'storeContact']);



Route::post('/login', [UserAccountController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/my-bookings', [BookingController::class, 'myBookings']);
});
