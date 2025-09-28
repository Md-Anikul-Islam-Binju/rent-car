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
}
