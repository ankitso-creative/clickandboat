<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click And Boat</title>
</head>
<body>
    @php 
        $details = $emailData->request;
    @endphp
    
    <p><strong>Name</strong>: {{ $details['name'] }}</p>
    <p><strong>email</strong>: {{ $details['email'] }}</p>
    <p><strong>Phone</strong>: {{ $details['phone'] }}</p>
    <p><strong>Message</strong>: {{ $details['form_message'] }}</p>
    
</body>
</html>