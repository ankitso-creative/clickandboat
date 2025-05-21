<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click And Boat</title>
</head>
<body>
   
    @php 
        $listing = App\Models\Admin\listing::where('id', $emailData->favorite->listing_id)->first();
        $customer = App\Models\User::where('id', $emailData->favorite->user_id)->first();
    @endphp
    {{-- {{name}} {{url}} --}}
    <h1>Dear {{ $listing->user->name  }},</h1>
    <h3>A boat was added to favorites.</h3>
    <p><a href="{{ route('boatowner.message', ['receiver_id' => $customer->id, 'slug' => $listing->slug]) }}">Click here</a> To chat with customer</p>
    
</body>
</html>