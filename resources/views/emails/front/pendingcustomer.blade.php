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
        $description = App\Models\EmailTemplate::where('slug', 'pending-customer-email')->value('description');
        $html = str_replace('{{customer}}',$customer, $description);
    @endphp
    {!! $html !!}
</body>
</html>
