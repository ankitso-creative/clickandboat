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
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/master.css') }}">   
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="{{ asset('app-assets/site_assets/libs/jquery-3.3.1.min.js') }}"></script>

    @yield('css')
</head>

<body class="page">
    <!-- Loader-->
    <div id="page-preloader"><span class="spinner border-t_second_b border-t_prim_a"></span></div>
    <!-- Loader end-->
    <div class="l-theme animated-css" data-header="sticky" data-header-top="200" data-canvas="container">

        <!-- ==========================-->
        <!-- SEARCH MODAL-->
        <!-- ==========================-->
        <div class="header-search open-search">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 offset-sm-2 col-10 offset-1">
                        <div class="navbar-search">
                            <form class="search-global">
                                <input class="search-global__input" type="text" placeholder="Type to search" autocomplete="off" name="s" value="" />
                                <button class="search-global__btn"><i class="icon stroke icon-Search"></i></button>
                                <div class="search-global__note">Begin typing your search above and press return to search.</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <button class="search-close close" type="button"><i class="fa fa-times"></i></button>
        </div>

        <!-- ==========================-->
        <!-- MOBILE MENU-->
        <!-- ==========================-->
        <div data-off-canvas="mobile-slidebar left overlay">
            <ul class="navbar-nav">
                <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
                <li class="nav-item "><a class="nav-link" href="about.html">About</a></li>
                <li class="nav-item "><a class="nav-link" href="listing.html">Boats Listing</a></li>
                <li class="nav-item "><a class="nav-link" href="tours.html">Tours</a></li>
                <li class="nav-item "><a class="nav-link" href="blog.html">News</a></li>
                <li class="nav-item"><a class="nav-link" href="contacts.html">Contact</a></li>
            </ul>
        </div>
        <header class="header header-slider">
            <div class="top-bar">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto topbar_links">
                            <div class="top-bar__item"><i class="fas fa-phone-square"></i><a href="tel:755 302 8549"> 755 302 8549</a> </div>
                            <div class="top-bar__item"><i class="fas fa-envelope-square"></i><a href="mailto:support@example.com"> support@example.com</a></div>
                        </div>
                        <div class="col-auto top_header_btns">
                            <!-- <ul class="header-soc list-unstyled">
                                <li class="header-soc__item"><a class="header-soc__link" href="#" target="_blank"><i class="ic fab fa-twitter"></i></a></li>
                                <li class="header-soc__item"><a class="header-soc__link" href="#" target="_blank"><i class="ic fab fa-behance"></i></a></li>
                                <li class="header-soc__item"><a class="header-soc__link" href="#" target="_blank"><i class="ic fab fa-facebook-f"></i></a></li>
                                <li class="header-soc__item"><a class="header-soc__link" href="#" target="_blank"><i class="ic fab fa-instagram"></i></a></li>
                                <li class="header-soc__item"><a class="header-soc__link" href="#" target="_blank"><i class="ic fab fa-youtube"></i></a></li>
                            </ul> -->
                            @if(auth()->check())
                                    <a class="header-main__btn register-header-btn btn btn-secondary" href="{{ route('boatowner.dashboard') }}">Myaccount</a>
                                     <!-- <a class="header-main__btn register-header-btn btn btn-secondary" href="{{ route('boatowner.dashboard') }}">Logout</a> -->
                                @else
                                <a class="header-main__btn register-header-btn btn btn-secondary" href="{{ route('register-your-boat') }}"><i class="fas fa-sign-in-alt"></i> Register Your Boat</a>
                                <a class="header-main__btn register-header-btn btn btn-secondary" href="{{ route('register') }}"><i class="fas fa-sign-in-alt"></i> Register</a>
                                <a class="header-main__btn login-header-btn btn login_btn btn-secondary" href="{{ route('login') }}"><i class="fas fa-lock"></i> Login</a>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-main">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <a class="navbar-brand navbar-brand_light scroll" href="{{ route('home') }}"> <img class="normal-logo img-fluid" src="{{ whiteLogoURL() }}" alt="logo" /> </a>
                            <a class="navbar-brand navbar-brand_dark scroll" href="{{ route('home') }}"><img class="normal-logo img-fluid" src="{{ logoURL() }}" alt="logo" /></a>
                        </div>
                        <div class="col-auto d-xl-none">
                            <!-- Mobile Trigger Start-->
                            <button class="menu-mobile-button js-toggle-mobile-slidebar toggle-menu-button"><i class="toggle-menu-button-icon"><span></span><span></span><span></span><span></span><span></span><span></span></i></button>
                            <!-- Mobile Trigger End-->
                        </div>
                        <div class="col-xl d-none d-xl-block">
                            <nav class="navbar navbar-expand-lg justify-content-end" id="nav">
                                <ul class="yamm main-menu navbar-nav">
                                    <li class="nav-item "><a class="nav-link" href="{{ route('who-we-are') }}">About Us</a> </li>
                                    <li class="nav-item "><a class="nav-link" href="{{ route('ourwork') }}">Our Work</a> </li>
                                    <li class="nav-item "><a class="nav-link" href="{{ route('blog') }}">Blog</a> </li>
                                    <!-- <li class="nav-item "><a class="nav-link" href="about.html">About Us</a> </li>

                                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#">Our Fleet</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="listing.html">Boats Listing 1</a>
                                            <a class="dropdown-item" href="listing-sidebar.html">Boats Listing 2</a>
                                            <a class="dropdown-item" href="details.html">Boats Details</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="tours.html">Our Tours</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="tours.html">Tours Listing</a>
                                            <a class="dropdown-item" href="tour.html">Tour Details</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#">News</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="blog.html">Blog main</a>
                                            <a class="dropdown-item" href="blog-grid.html">Blog grid</a>
                                            <a class="dropdown-item" href="post.html">Blog post</a>
                                        </div>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="contacts.html">Contact</a></li> -->
                                <!-- </ul> <span class="header-main__link btn_header_search"><i class="ic icon-magnifier"></i></span> -->
                                
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        @yield('content')
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-section">
                            <a class="footer__logo" href="index.html"><img class="img-fluid" src="{{ whiteLogoURL() }}" alt="Logo"></a>
                            <div class="footer-info">Ceipisicing elit sed do eiusmod tempor laboe dolore magna aliqa Ut enim ad minim veniam quis nostrud exercitation ullam co laboris nis aliquip comsecd.</div>
                        </div>
                        <section class="footer-section">
                            <h3 class="footer-section__title footer-section__title_sm">Subscribe Newsletter</h3>
                            <form class="footer-form">
                                <div class="form-group">
                                    <input class="footer-form__input form-control" type="email" placeholder="your email"><i class="ic far fa-envelope-open"></i> </div>
                            </form>
                        </section>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <section class="footer-section footer-section_link pl-5">
                            <h3 class="footer-section__title">About Click&boat</h3>
                            <ul class="footer-list list-unstyled">
                                <li><a href="{{ route('home') }}"> Home</a></li>
                                <li><a href="{{ route('who-we-are') }}">About Us</a></li>
                                <li><a href="{{ route('ourwork') }}">Our Work</a></li>
                                <li><a href="{{ route('blog') }}">Blog</a></li>
                                <li><a href="{{ route('privacy-policy') }}">Privacy Policy </a></li>
                                <li><a href="{{ route('terms-condition') }}">Terms and conditions</a></li>
                            </ul>
                        </section>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <section class="footer-section footer-section_link">
                            <h3 class="footer-section__title">Get In Touch</h3>
                            <div class="footer-contacts">
                                <div class="footer-contacts__item"><i class="ic icon-location-pin"></i>Fairview Ave, El Monte, CA 91732</div>
                                <div class="footer-contacts__item"><i class="ic icon-envelope"></i><a href="mailto:support@domain.com">support@domain.com</a></div>
                                <div class="footer-contacts__item"><i class="ic icon-earphones-alt"></i> Phone: <a class="footer-contacts__phone" href="tel:+17553028549">+1 755 302 8549</a> </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <section class="footer-section social_media">
                            <h3 class="footer-section__title">Follow US</h3>
                            <ul class="footer-soc list-unstyled">
                                <li class="footer-soc__item"><a class="footer-soc__link" href="#" target="_blank"><i class="ic fab fa-facebook-f"></i></a></li>
                                <li class="footer-soc__item"><a class="footer-soc__link" href="#" target="_blank"><i class="ic fab fa-instagram"></i></a></li>
                                <li class="footer-soc__item"><a class="footer-soc__link" href="#" target="_blank"><i class="ic fab fa-youtube"></i></a></li>
                            </ul>
                            <a class="btn btn-white" href="#">confirm booking</a>
                        </section>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">Copyright © <?php echo date('Y',time());?> Click & boat. All rights reserved.</div>
            </div>
        </footer>
        <!-- .footer-->
    </div>
    <!-- end layout-theme-->


    <!-- ++++++++++++-->
    <!-- MAIN SCRIPTS-->
    <!-- ++++++++++++-->
    
    <script src="{{ asset('app-assets/site_assets/libs/jquery-migrate-1.4.1.min.js') }}"></script>
    <!-- Bootstrap-->
    <script src="{{ asset('app-assets/site_assets/plugins/popever/popper.min.js') }}"></script>
    <script src="{{ asset('app-assets/site_assets/libs/bootstrap-4.1.3/js/bootstrap.min.js') }}"></script>
    <!---->
    <!-- Color scheme-->
    <script src="{{ asset('app-assets/site_assets/plugins/switcher/js/dmss.js') }}"></script>
    <!-- Select customization & Color scheme-->
    <script src="{{ asset('app-assets/site_assets/libs/bootstrap-select.min.js') }}"></script>
    <!-- Pop-up window-->
    <script src="{{ asset('app-assets/site_assets/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <!-- Headers scripts-->
    <script src="{{ asset('app-assets/site_assets/plugins/headers/slidebar.js') }}"></script>
    <script src="{{ asset('app-assets/site_assets/plugins/headers/header.js') }}"></script>
    <!-- Mail scripts-->
    <script src="{{ asset('app-assets/site_assets/plugins/jqBootstrapValidation.js') }}"></script>
    <!-- Progress numbers-->
    <script src="{{ asset('app-assets/site_assets/plugins/rendro-easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('app-assets/site_assets/plugins/rendro-easy-pie-chart/jquery.waypoints.min.js') }}"></script>
    <!-- Animations-->
    <script src="{{ asset('app-assets/site_assets/plugins/scrollreveal/scrollreveal.min.js') }}"></script>
    <!-- Scale images-->
    <script src="{{ asset('app-assets/site_assets/plugins/ofi.min.js') }}"></script>
    <!-- User customization-->
    <script src="{{ asset('app-assets/site_assets/js/custom.js') }}"></script>


    <script src="{{ asset('app-assets/site_assets/plugins/slider-pro/jquery.sliderPro.min.js') }}"></script>
    <!-- Sliders-->
    <script src="{{ asset('app-assets/site_assets/plugins/slick/slick.js') }}"></script>
    <!-- Slider number-->
    <script src="{{ asset('app-assets/site_assets/plugins/noUiSlider/wNumb.js') }}"></script>
    <script src="{{ asset('app-assets/site_assets/plugins/noUiSlider/nouislider.min.js') }}"></script>

    <!-- User map-->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCreq2ZVp-3lJ-_KCZpeJVZ5RN3VJXk-9c"></script> -->
    <!-- Maps customization-->
    <!-- <script src="{{ asset('app-assets/site_assets/js/map-custom.js') }}"></script> -->
    @yield('js')

</body>

</html>
