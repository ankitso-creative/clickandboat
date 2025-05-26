<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click And Boat</title>
</head>
<body>
    {{-- {{name}} {{email}} {{created_at}} --}}
    <h1>Dear Admin,</h1>
    <p>A new user has registered on the platform. Please find the registration details below for your review and approval:</p>
    <p>
        <b>Name:</b> {{ $user->name }} <br>
        <b>Email:</b> {{ $user->email }}<br>
        <b>Registration Date:</b> {{ $user->created_at }}</p>
    <p>
        Best regards, <br>
        My Boat Booker
    </p>
</body>
</html>