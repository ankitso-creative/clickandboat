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
        $listing = App\Models\Admin\Listing::where('id',$order->listing_id)->first();
    @endphp
    <p>Hi {{$customer}},</p>
    <p>Thank you for choosing {{ $listing->type }} {{ $listing->manufacturer }} {{ $listing->model }} We hope you’re enjoying it.</p>

    <p>We’d love to hear your thoughts — your feedback helps us improve and helps others make confident decisions.</p>

    <p>It only takes a minute: <a href="{{ route('customer.addreview',$listing->slug) }}">Leave a Review</a></p>

    <p>Thanks again for being a valued customer!</p>

    <p>
        Best regards, <br>
        The MyBoatBooker Team
    </p> 

</body>
</html>