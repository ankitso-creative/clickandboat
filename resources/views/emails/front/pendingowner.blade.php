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

        $description = App\Models\EmailTemplate::where('slug', 'pending-owner-email')->value('description');
        $from = array('{{owner_name}}','{{customer_name}}','{{pending_amount}}' ,'{{total}}');
        $to = array($listing->user->name,$customer->name,$symbol.$pending_amount, $symbol.$total);
        $html = str_replace($from,$to, $description);
    @endphp
    {!! $html !!}
</body>
</html>
