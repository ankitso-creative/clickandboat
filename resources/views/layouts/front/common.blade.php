<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Click And Boat</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="telephone=no" name="format-detection">
    <meta name="HandheldFriendly" content="true">
    @yield('meta')
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/bootstrap.min.css') }}">   
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/mdbootstrap.css') }}">   
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/silck-theme.css') }}">   
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/silck.css') }}">   
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/style.css') }}">   
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="{{ asset('app-assets/site_assets/libs/jquery-3.3.1.min.js') }}"></script>

    @yield('css')
</head>

<body class="page">
    <header class="header header-slider">
            
    </header>
    @yield('content')
    <footer class="footer">
        <div class="footer-copyright">
            <div class="container">Copyright © <?php echo date('Y',time());?> Click & boat. All rights reserved.</div>
        </div>
    </footer>
    <!-- .footer-->
    <!-- ++++++++++++-->
    <!-- MAIN SCRIPTS-->
    <!-- ++++++++++++-->
    
    <script src="{{ asset('app-assets/site_assets/js/bootstrap.mim.js') }}"></script>
    <script src="{{ asset('app-assets/site_assets/js/map.js') }}"></script>
    <script src="{{ asset('app-assets/site_assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('app-assets/site_assets/js/script.js') }}"></script>
   @yield('js')

</body>

</html>
