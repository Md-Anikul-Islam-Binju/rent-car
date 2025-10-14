<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $invoiceUrl;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
        $this->invoiceUrl = route('user.booking.invoice', $booking->id);
    }

    public function build()
    {
        return $this->subject('Payment Successful - Your Booking Invoice')
            ->view('emails.paymentSuccess')
            ->with([
                'booking' => $this->booking,
                'invoiceUrl' => $this->invoiceUrl,
            ]);
    }
}
