<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click And Boat</title>
</head>
<body>
    
    @php
        $description = App\Models\EmailTemplate::where('slug', 'account-registration-email')->value('description');
        $html = str_replace('{{name}}',$user->name, $description)
    @endphp
    {!! $html !!}
</body>
</html>