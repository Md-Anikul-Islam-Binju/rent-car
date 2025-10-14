<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Successful</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f8f9fa; padding: 30px;">
<div style="background: white; padding: 20px; border-radius: 8px;">
    <h2 style="color: #28a745;">✅ Payment Successful!</h2>
    <p>Dear {{ $booking->name }},</p>

    <p>We’ve received your payment for <strong>Booking ID #{{ $booking->id }}</strong>.</p>

    <p><strong>Total Amount:</strong> ${{ number_format($booking->total_amount, 2) }}</p>

    <p>You can view and print your invoice using the link below:</p>

    <p>
        <a href="{{ $invoiceUrl }}" style="background-color:#007bff; color:white; padding:10px 15px; border-radius:5px; text-decoration:none;">
            View Invoice
        </a>
    </p>

    <p>Thank you for choosing us!</p>

    <hr>
    <small>If you have any questions, feel free to reply to this email.</small>
</div>
</body>
</html>
