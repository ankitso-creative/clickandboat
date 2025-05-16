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
    @endphp
    
    <p>Dear {{ $customer }},</p>
    <p>We regret to inform you that your booking  has been cancelled.</p>
    <p>If you have any questions or need further assistance, please don’t hesitate to <a href="mailto:shubham@so-creative.co.uk">contact us.</a></p>
    <p>We apologize for any inconvenience this may have caused and hope to serve you again in the future.</p>
    <br>

    <p>Best regards,</p>
    <p>The Boat Booker Team</p>
    
</body>
</html>