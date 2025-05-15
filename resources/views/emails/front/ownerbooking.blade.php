<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Booking Received</title>
</head>
<body>
    @php 
        $booking = $emailData->order;
        $customer = App\Models\User::where('id', $emailData->order->user_id)->first();
        $listing = App\Models\Admin\Listing::where('id', $emailData->order->listing_id)->with('user')->first();
        $symbol = priceSymbol($listing->currency);
        $amountPaid = getAmountWithoutSymble($booking->amount_paid,$booking->currency,$listing->currency);
        $pendingAmount = getAmountWithoutSymble($booking->pending_amount,$booking->currency,$listing->currency);
        $total = getAmountWithoutSymble($booking->total,$booking->currency,$listing->currency);
    @endphp
    <p>Dear {{ $listing->user->name }},</p>

    <p>A new booking has just been made. Here are the details:</p>

    <ul>
        <li><strong>Customer Name:</strong> {{ $customer->name }}</li>
        <li><strong>Email:</strong> {{ $customer->email }}</li>
        <li><strong>Transaction ID:</strong> {{ $booking->payment_intent_id }}</li>
        <li><strong>Check In Date:</strong> {{ $booking->check_in }}</li>
        <li><strong>Amount Paid:</strong> {{ $symbol.round($amountPaid) }}</li>
        <li><strong>Pending Paid:</strong> {{ $symbol.round($pendingAmount) }}</li>
        <li><strong>Total Amount:</strong> {{ $symbol.round($total) }}</li>
    </ul>

    <p>Please make the necessary preparations or follow-up as needed.</p>

    <br>

    <p>Best regards,</p>
    <p><strong>My Boat Booker Team</strong></p>
</body>
</html>
