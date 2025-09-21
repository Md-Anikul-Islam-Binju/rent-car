<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
            'fleet_id' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'no_of_adults' => 'required|integer|min:1',
            'no_of_children' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create booking
        $booking = Booking::create([
            'service_id' => $request->service_id,
            'fleet_id' => $request->fleet_id,
            'date' => $request->date,
            'no_of_adults' => $request->no_of_adults,
            'no_of_children' => $request->no_of_children ?? 0,
        ]);

        return response()->json([
            'status' => 'success',
            'booking' => $booking
        ], 201);
    }
}
