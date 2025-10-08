<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingHistoryController extends Controller
{
   public function bookingHistory()
   {
       $bookingHistory = Booking::with('service', 'fleet')->latest()->get();
       return view('admin.pages.bookingHistory.index', compact('bookingHistory'));
   }



    public function calendarData()
    {
        $bookings = Booking::with(['service', 'fleet'])->get();

        $events = $bookings->map(function ($booking) {
            return [
                'id'    => $booking->id,
                'title' => $booking->name . ' (' . $booking->service->name . ')',
                'start' => $booking->date . 'T' . $booking->time,
                'end'   => $booking->date . 'T' . $booking->time, // extend with duration if needed
                'color' => '#007bff', // blue background
                'textColor' => '#000000',// white text
                'extendedProps' => [
                    'pickup' => $booking->pickup_location,
                    'drop'   => $booking->drop_location,
                    'adults' => $booking->no_of_adults,
                    'fleet'  => $booking->fleet->name,
                    'phone'  => $booking->phone,
                ]
            ];
        });

        return response()->json($events);
    }

}
