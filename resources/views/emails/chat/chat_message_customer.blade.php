<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click And Boat</title>
</head>
<body>
    @php
        $listing = App\Models\Admin\Listing::where('id',$messageData['listing_id'])->first();
        
    @endphp
    <h1>Dear {{ $messageData['receiver_name']}},</h1>

    <p>You have received a new message from {{ $messageData['sender_name'] }} regarding booking {{ ucfirst($listing->type) }} - {{ $listing->manufacturer }} {{ $listing->model }} in {{ $listing->city }}.</p>
    <p style="color: gray"><i>"{{ $messageData['message'] }}"</i></p>
   <p style="text-align: center;  margin: 30px auto;"><a href="{{ route('customer.support') }}" style="background: #f9a126;color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 3px; margin: 30px auto;">Reply to the message</a></p>
    <p>
        Best regards, <br>
        My Boat Booker
    </p>
    
</body>
</html>