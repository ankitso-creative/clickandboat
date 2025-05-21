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
        $description = App\Models\EmailTemplate::where('slug', 'boat-added-on-favotite-email')->value('description');
        $from = array('{{name}}', '{{url}}');
        $to = array(route('boatowner.message', ['receiver_id' => $customer->id, 'slug' => $listing->slug]));
        $html = str_replace($listing->user->name,$from,$to, $description);
    @endphp
    {!! $html !!}
</body>
</html>