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
    <p>Dear {{ $customer }},</p>

    <p>Thank you for your booking! We’re happy to confirm the details below:</p>

    <ul>
        <li><strong>Transaction ID:</strong> {{ $booking->payment_intent_id }}</li>
        <li><strong>Check In Date:</strong> {{ $booking->check_in }}</li>
        <li><strong>Amount Paid:</strong> {{ $symbol.$booking->amount_paid }}</li>
        <li><strong>Pending Paid:</strong> {{ $symbol.$booking->pending_amount }}</li>
        <li><strong>Total Amount:</strong> {{ $symbol.$booking->total }}</li>
    </ul>

    <p>If you have any questions or need to make changes, feel free to <a href="mailto:shubham@so-creative.co.uk">contact us.</a></p>

    <p>We look forward to seeing you!</p>

    <br>

    <p>Best regards,</p>
    <p>The Boat Booker Team</p>
</body>
</html>
