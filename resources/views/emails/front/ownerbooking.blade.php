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
        $description = App\Models\EmailTemplate::where('slug', 'owner-booking-email')->value('description');
        $from = array('{{owner_name}}','{{name}}', '{{email}}','{{payment_intent_id}}', '{{check_in}}',' {{amountPaid}}', '{{pendingAmount}}' ,'{{total}}');
        $to = array($listing->user->name,$customer->name,$customer->email,$booking->payment_intent_id,$booking->check_in,$symbol.$amountPaid,$symbol.$pendingAmount,$symbol.$total);
        $html = str_replace($from,$to, $description);
    @endphp
    {!! $html !!}
</body>
</html>
