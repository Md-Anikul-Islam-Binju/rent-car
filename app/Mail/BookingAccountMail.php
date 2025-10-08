<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $booking;
    public $plainPassword;

    public function __construct(User $user, Booking $booking, $plainPassword = null)
    {
        $this->user = $user;
        $this->booking = $booking;
        $this->plainPassword = $plainPassword; // only sent if new account
    }

    public function build()
    {
        return $this->subject('Booking Confirmation & Account Details')
            ->view('emails.bookingAccount')
            ->with([
                'user' => $this->user,
                'booking' => $this->booking,
                'plainPassword' => $this->plainPassword,
            ]);
    }
}
