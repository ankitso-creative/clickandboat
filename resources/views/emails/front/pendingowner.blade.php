<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Paid Pending Amount</title>
</head>
<body>
    @php 
        $booking = $emailData->order;
        $customer = App\Models\User::where('id', $emailData->order->user_id)->first();
        $listing = App\Models\Admin\Listing::where('id', $emailData->order->listing_id)->with('user')->first();
        $symbol = priceSymbol($booking->currency);
        $transaction = $booking->transaction->first();
    @endphp
    <p>Dear {{ $listing->user->name }},</p>
    <p>We’re pleased to inform you that the customer has completed the pending payment for the boat booking.</p>
    <p><strong> Customer Name:</strong> {{  $customer->name }}</p>
    <p><strong> Paid Amount:</strong> {{  $symbol.$transaction->amount_paid }}</p>
    <p><strong> Total Booking Amount:</strong> {{  $symbol.$booking->total }}</p>
    <p>Best regards,</p>
    <p>The Boat Booker Team</p>
</body>
</html>
