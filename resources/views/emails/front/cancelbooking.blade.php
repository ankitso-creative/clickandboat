<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click And Boat</title>
</head>
<body>
    @php 
        $order = $order->order;
        $customer = $order->user->name;
       
        $description = App\Models\EmailTemplate::where('slug', 'booking-cancel-email')->value('description');
        $html = str_replace('{{customer}}',$customer, $description);
    @endphp
    {!! $html !!}
    
    
</body>
</html>