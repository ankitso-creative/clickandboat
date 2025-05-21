<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    @php
        $description = App\Models\Admin\listing::where('slug', 'listing-approve-email')->value('description');
        $html = str_replace('{{admin_login_url}}',route('admin.login'), $description);
    @endphp
    {!! $html !!}
</body>
</html>