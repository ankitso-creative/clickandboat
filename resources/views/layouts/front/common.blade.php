<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MyBoatBooker</title>
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
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/style.css') }}?ver=<?=time()?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="shortcut icon" href="{{ asset('app-assets/site_assets/img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('app-assets/site_assets/img/favicon.ico') }}" type="image/x-icon">
    <script src="{{ asset('app-assets/site_assets/js/jquery.js') }}"></script>

    @yield('css')
</head>

<body class="page">
    <input type="hidden" value="{{ url('/') }}" id="baseUrl">
    <header class="header header-slider">
        <div class="header_main">
            <nav class="navbar navbar-expand-lg navbar-light" id="nav-bar">
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ whiteLogoURL() }}"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle about_menu" href="{{ route('about-us') }}"
                                id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                About Us
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('about-us') }}">About Us</a>
                                <a class="dropdown-item" href="{{ route('location') }}">Explore Ibiza</a>
                                <a class="dropdown-item" href="{{ route('blogs') }}">Our Blog</a>
                                <a class="dropdown-item" href="#">Book a boat</a>
                                <a class="dropdown-item" href="{{ route('help') }}">Help</a>

                            </div>
                        </li> -->
                        <div class="dropdown my_account_btn about_btn">
                                <button class="dropbtn">About Us <i class="fa-solid fa-caret-down"></i></button>
                                <div class="dropdown-content">
                                <a class="dropdown-item" href="{{ route('about-us') }}">About Us</a>
                                <a class="dropdown-item" href="{{ route('location') }}">Explore Ibiza</a>
                                <a class="dropdown-item" href="{{ route('blogs') }}">Our Blog</a>
                                <a class="dropdown-item" href="#">Book a boat</a>
                                <a class="dropdown-item" href="{{ route('help') }}">Help</a>
                                </div>
                            </div>
                        <li class="nav-item">
                            <select class="select-language" id="language">
                                {!! selectOption('languages','name','code',session()->get('lang'),array('status' , '1')) !!}
                            </select>
                        </li>
                        <!-- <li><a class="nav-link gbp_btn" href="#">GBP: £</a></li> -->
                        <li class="nav-item">
                            <select name="currency" id="currency_name">
                                <option value="GBP">GBP: £ </option>
                                <option value="EUR">EUR €</option>
                                <option value="USD">USD $</option>
                            </select>
                        </li>
                        @if(!Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('userlogin') }}">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('boatlogin') }}">Register your boat </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-user"></i></a>
                        </li>
                        @endif
                        @if(Auth::check())
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout </a>
                        </li> -->
                            <div class="dropdown my_account_btn">
                                <button class="dropbtn">My account<i class="fa-solid fa-caret-down"></i></button>
                                <div class="dropdown-content">
                                <a class="dropdown-item" href="#">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout </a>
                                </div>
                            </div>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <ul class="nav-mobile">
        <li class="nav-item">
            <select class="select-language" id="language">
                {!! selectOption('languages','name','code',session()->get('lang'),array('status' , '1')) !!}
            </select>
        </li>
        <li class="nav-item mobile_language">
            <select name="currency" id="currency_name">
                <option value="GBP">GBP: £</option>
                <option value="EUR">EUR €</option>
                <option value="opel">USD $</option>
            </select>
        </li>
        <li><a href="{{ route('home') }}"><img src="{{ logoURL() }}"></a></li>
        <li class="menu-container">
            <input id="menu-toggle" type="checkbox">
            <label for="menu-toggle" class="menu-button">
                <svg class="icon-open" viewBox="0 0 24 24">
                    <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path>
                </svg>
                <svg class="icon-close" viewBox="0 0 100 100">
                    <path
                        d="M83.288 88.13c-2.114 2.112-5.575 2.112-7.69 0L53.66 66.188c-2.113-2.112-5.572-2.112-7.686 0l-21.72 21.72c-2.114 2.113-5.572 2.113-7.687 0l-4.693-4.692c-2.114-2.114-2.114-5.573 0-7.688l21.72-21.72c2.112-2.115 2.112-5.574 0-7.687L11.87 24.4c-2.114-2.113-2.114-5.57 0-7.686l4.842-4.842c2.113-2.114 5.57-2.114 7.686 0l21.72 21.72c2.114 2.113 5.572 2.113 7.688 0l21.72-21.72c2.115-2.114 5.574-2.114 7.688 0l4.695 4.695c2.112 2.113 2.112 5.57-.002 7.686l-21.72 21.72c-2.112 2.114-2.112 5.573 0 7.686L88.13 75.6c2.112 2.11 2.112 5.572 0 7.687l-4.842 4.84z" />
                </svg>
            </label>
            <ul class="menu-sidebar">

                <li>
                    <input type="checkbox" id="sub-one" class="submenu-toggle">
                    <label class="submenu-label" for="sub-one">About Us</label>
                    <div class="arrow right">&#8250;</div>
                    <ul class="menu-sub">
                        <li class="menu-sub-title">
                            <label class="submenu-label" for="sub-one">Back</label>
                            <div class="arrow left">&#8249;</div>
                        </li>
                        <li><a href="{{ route('location') }}">Explore Ibiza</a></li>
                        <li><a href="{{ route('blogs') }}">Our Blog</a></li>
                        <li><a href="{{ route('about-us') }}">About Us</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('userlogin') }}">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('boatlogin') }}">Register your boat </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-user"></i></a>
                </li>
                @if(Auth::check())

                <!-- <li class="nav-item mobile_menu_list">
                    <a class="nav-link" href="{{ route('logout') }}">Logout </a>
                </li> -->
                <li>
                    <input type="checkbox" id="sub-two" class="submenu-toggle">
                    <label class="submenu-label" for="sub-two">My Account</label>
                    <div class="arrow right">&#8250;</div>
                    <ul class="menu-sub">
                        <li class="menu-sub-title">
                            <label class="submenu-label" for="sub-two">Back</label>
                            <div class="arrow left">&#8249;</div>
                        </li>
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </li>
    </ul>
    @yield('content')
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="footer_newsletter">
                        <h3>Stay In The Know</h3>
                        <form>
                            <div class='email_box'>
                                <input class="emailpick" type="email" placeholder="Email Address" />
                                <Button class="email_sub_btn"><img
                                        src="{{ asset('app-assets/site_assets/img/sub-icon.png') }}"></Button>
                            </div>
                        </form>
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
                            <!-- <li><a href="{{ route('contact') }}">Contact </a></li> -->
                            <li><a href="{{ route('blogs') }}">Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 col-md-6 col-lg-3">
                    <div class="cal_mail_box">
                        <div class="call_box_sec">
                            <h5>Call Us</h5>
                            <p><a href="tel:{{ phoneWebsite() }}">{{ phoneWebsite() }}</a></p>
                        </div>
                        <div class="email_box_sec">
                            <h5>Email Us</h5>
                            <p><a href="mailto:{{ emailWebsite() }}">{{ emailWebsite() }}</a></p>
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
    <script src="{{ asset('app-assets/site_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/site_assets/js/popper.min.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/site_assets/js/map.js') }}"></script> --}}
    <script src="{{ asset('app-assets/site_assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('app-assets/site_assets/js/script.js') }}?ver=<?=time()?>"></script>

    @yield('js')

</body>

</html>