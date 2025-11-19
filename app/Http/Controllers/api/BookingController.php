<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\BookingAccountMail;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BookingController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
            'fleet_id' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'pickup_location' => 'required',
            'drop_location' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'no_of_adults' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if user exists
        $user = User::where('email', $request->email)->first();
        $plainPassword = null;

        if (!$user) {
            $plainPassword = Str::random(8);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($plainPassword),
                'role' => 'user',
            ]);
        }

        // Create booking
        $booking = Booking::create([
            'user_id' => $user->id,
            'service_id' => $request->service_id,
            'fleet_id' => $request->fleet_id,
            'date' => $request->date,
            'time' => $request->time,
            'no_of_adults' => $request->no_of_adults,
            'baby_seat' => $request->baby_seat ?? 0,
            'booster_seat' => $request->booster_seat ?? 0,
            'pickup_location' => $request->pickup_location,
            'drop_location' => $request->drop_location,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'notes' => $request->notes,
            'total_kilometers' => $request->total_kilometers,
            'is_duration_trip' => $request->is_duration_trip ?? 0,

            'round_trip_pickup' => $request->round_trip_pickup ?? null,
            'round_trip_dropup' => $request->round_trip_dropup ?? null,
            'round_trip_date' => $request->round_trip_date ?? null,
            'round_trip_time' => $request->round_trip_time ?? null,






            'is_round_trip' => $request->is_round_trip ?? 0,
            'total_amount' => $request->total_amount,

            'flight_arrival_time' => $request->flight_arrival_time ?? null,
            'flight_number' => $request->flight_number ?? null,
            'flight_departure' => $request->flight_departure ?? null,
            'duration' => $request->duration ?? null,


        ]);

        // Send mail (with password if new account)
        Mail::to($user->email)->send(new BookingAccountMail($user, $booking, $plainPassword));

        return response()->json([
            'status' => 'success',
            'booking' => $booking,
            'user' => $user
        ], 201);
    }


    public function myBookings(Request $request)
    {
        $user = $request->user(); // auth user

        $bookings = Booking::with(['service', 'fleet']) // eager load relations
        ->where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'bookings' => $bookings
        ], 200);
    }


}
