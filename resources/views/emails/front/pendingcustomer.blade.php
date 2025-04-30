<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
</head>
<body>
    @php 
        $booking = $emailData->order;
        $customer = App\Models\User::where('id', $emailData->order->user_id)->value('name');
        $symbol = priceSymbol($booking->currency);
    @endphp
    <h2>Booking Confirmation</h2>

    <p>Dear {{ $customer }},</p>

    <p>Thank you for paying your pending amount.</p>
    <p>If you have any questions or need to make changes, feel free to contact us.</p>

    <p>We look forward to seeing you!</p>

    <br>

    <p>Best regards,</p>
    <p><strong>My Boat Booker Team</strong></p>
</body>
</html>
