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
        $description = App\Models\EmailTemplate::where('slug', 'customer-booking-email')->value('description');
        $from = array('{{customer}}','{{payment_intent_id}}', '{{check_in}}',' {{amount_paid}}', '{{pending_amount}}' ,'{{total}}');
        $to = array($customer,$booking->payment_intent_id,$booking->check_in,$symbol.$booking->amount_paid,$symbol.$booking->pending_amount,$symbol.$booking->total);
        $html = str_replace($from,$to, $description);
    @endphp
    {!! $html !!}
</body>
</html>
