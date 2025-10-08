<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function payment($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);
        return view('frontend.payment', compact('booking_id', 'booking'));
    }


    public function stripePost(Request $request): RedirectResponse
    {

        try {
            $booking = Booking::findOrFail($request->booking_id);

            Stripe::setApiKey(env('STRIPE_SECRET'));

            $charge = Charge::create([
                "amount" => $booking->total_amount * 100, // convert to cents
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment for booking ID: " . $booking->id,
            ]);

            // Save to DB
            Payment::create([
                'booking_id'  => $booking->id,
                'name'        => $request->name,
                'amount'      => $booking->total_amount, // keep it as entered in Booking
                'currency'    => $charge->currency,
                'source'      => $charge->source->id,
                'description' => $charge->description,
            ]);

            // ✅ Update booking payment_status
            $booking->update([
                'payment_status' => 'paid',
            ]);

            return redirect()->back()->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
