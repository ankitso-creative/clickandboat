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
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/slick-theme.css') }}">   
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/slick.css') }}">   
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/style.css') }}"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"  />  
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="{{ asset('app-assets/site_assets/js/jquery.js') }}"></script>

    @yield('css')
</head>

<body class="page">
    <input type="hidden" value="{{ url('/') }}" id="baseUrl">
    <header class="header header-slider">
            <div class="header_main">
            <nav class="navbar navbar-expand-lg navbar-light" id="nav-bar">
                <a class="navbar-brand" href="#"><img src="{{ whiteLogoURL() }}"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                      <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle about_menu" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            About Us
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                       </li>
                       <li class="nav-item">
                            <select class="select-language" id="language">
                                {{!! selectOption('languages','name','code',session()->get('lang'),array('status' , '1')) !!}}
                            <select>
                       </li>
                       <!-- <li><a class="nav-link gbp_btn" href="#">GBP: £</a></li> -->
                       <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle about_menu" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            GBP: £
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                       </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('boatlogin') }}">Register your boat  </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('userlogin') }}">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('help') }}" class="nav-link">Help</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"><i class="fa-solid fa-user"></i></a>
                        </li>
                    </ul>
                </div>
                </nav>
            </div>
    </header>
    @yield('content')
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="footer_newsletter">
                        <h3>Stay In The Know</h3>
                        <p>We Will Be Delighted To Assist</p>
                        <a href="#">Contact Us <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-md-12 col-md-6 col-lg-3">
                    <div class="footer_menu">
                        <h5>About Boat Daze</h5>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about-us') }}">About Us</a></li>
                            <li><a href="{{ route('location') }}">Locations</a></li>
                            <li><a href="{{ route('ourfleet') }}">Our Fleet</a></li>
                            <li><a href="{{ route('contact') }}">Contact </a></li>
                            <li><a href="{{ route('blogs') }}">Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 col-md-6 col-lg-3">
                    <div class="cal_mail_box">
                        <div class="call_box_sec">
                            <h5>Call Us</h5>
                            <p><a href="tel:+1 755 302 8549">+1 755 302 8549</a></p>
                        </div>
                        <div class="email_box_sec">
                            <h5>Email Us</h5>
                            <p><a href="mailto:support@domain.com">support@domain.com</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-md-6 col-lg-3">
                    <div class="footer_social_links">
                        <h5>Follow Us</h5>
                        <ul>
                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>© Boat Daze | All rights reserved</p>
        </div>
    </footer>





    <!-- .footer-->
    <!-- ++++++++++++-->
    <!-- MAIN SCRIPTS-->
    <!-- ++++++++++++-->
    <script src="{{ asset('app-assets/site_assets/js/bundle.min.js') }}"></script>
    <script src="{{ asset('app-assets/site_assets/js/bootstrap.mim.js') }}"></script>
    <script src="{{ asset('app-assets/site_assets/js/popper.mim.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/site_assets/js/map.js') }}"></script> --}}
    <script src="{{ asset('app-assets/site_assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('app-assets/site_assets/js/script.js') }}"></script>
   @yield('js')

</body>

</html>
