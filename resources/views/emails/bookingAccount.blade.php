<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
<h2>Hello {{ $user->name }},</h2>

<p>✅ Your booking is confirmed!</p>

<ul>
    <li><strong>Pickup:</strong> {{ $booking->pickup_location }}</li>
    <li><strong>Drop:</strong> {{ $booking->drop_location }}</li>
    <li><strong>Date:</strong> {{ $booking->date }}</li>
    <li><strong>Time:</strong> {{ $booking->time }}</li>
    <li><strong>Adults:</strong> {{ $booking->no_of_adults }}</li>
</ul>

@if($plainPassword)
    <p><strong>Your new account has been created!</strong></p>
    <p>Email: {{ $user->email }}<br>
        Password: {{ $plainPassword }}</p>
@else
    <p>You already have an account linked to this booking.</p>
@endif

<p>You can log in to manage your bookings anytime.</p>
<br>
<p>Best regards,<br>Support Team</p>
</body>
</html>
