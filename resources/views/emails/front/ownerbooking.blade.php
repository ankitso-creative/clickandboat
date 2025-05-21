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
        
        $request['checkindate'] = $booking->check_in;
        $request['checkoutdate'] = $booking->check_out;
        $request['id'] = $booking->listing_id;
        $price = bookingPrice($request,$listing->currency);
        $security = $listing->security->amount;
        if($booking->days == 'half_day'):
            $total = $price['oneHalfDayPrice'];
        else:
            $total = $price['totalAmount'];
        endif;
        if($booking->discount):
            $totalWD = $total * $booking->discount / 100;
            $total = $total - $totalWD;
        endif;
        $pendingAmount = 0;
        $amountPaid =  $total;
        if($booking->pending_amount):
            $pendingAmount = $total - $security;
            $amountPaid = $security;
        endif;
    @endphp
    {{-- {{name}} {{email}} {{payment_intent_id}} {{check_in}} {{amountPaid}} {{pendingAmount}} {{total}} --}}
    <p>Dear {{ $listing->user->name }},</p>

    <p>A new booking has just been made. Here are the details:</p>

    <ul>
        <li><strong>Customer Name:</strong> {{ $customer->name }}</li>
        <li><strong>Email:</strong> {{ $customer->email }}</li>
        <li><strong>Transaction ID:</strong> {{ $booking->payment_intent_id }}</li>
        <li><strong>Check In Date:</strong> {{ $booking->check_in }}</li>
        <li><strong>Amount Paid:</strong> {{ $symbol.$amountPaid }}</li>
        <li><strong>Pending Paid:</strong> {{ $symbol.$pendingAmount }}</li>
        <li><strong>Total Amount:</strong> {{ $symbol.$total }}</li>
    </ul>

    <p>Please make the necessary preparations or follow-up as needed.</p>

    <br>

    <p>Best regards,</p>
    <p>The Boat Booker Team</p>
</body>
</html>
