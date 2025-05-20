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
        $symbol = priceSymbol($listing->currency);
        $transaction = $booking->transaction->last();
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
        $pending_amount = $total - $security;
       
    @endphp
    <p>Dear {{ $listing->user->name }},</p>
    <p>We’re pleased to inform you that the customer has completed the pending payment for the boat booking.</p>
    <p><strong> Customer Name:</strong> {{  $customer->name }}</p>
    <p><strong> Paid Amount:</strong> {{  $symbol.$pending_amount }}</p>
    <p><strong> Total Booking Amount:</strong> {{  $symbol.$total }}</p>
    <p>Best regards,</p>
    <p>The Boat Booker Team</p>
</body>
</html>
