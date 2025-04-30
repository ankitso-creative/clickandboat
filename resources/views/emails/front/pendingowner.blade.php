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
    @endphp
    <p>Dear {{ $listing->user->name }},</p>
    <p>A customer has paid their pending amount.</p>
    <br>
    <p>Best regards,</p>
    <p><strong>My Boat Booker Team</strong></p>
</body>
</html>
