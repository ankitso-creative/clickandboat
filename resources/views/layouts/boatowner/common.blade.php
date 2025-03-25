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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('meta')
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/bootstrap.min.css') }}">   
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/mdbootstrap.css') }}">   
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/slick-theme.css') }}">   
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/slick.css') }}">   
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/style.css') }}?ver=<?=time()?>"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"  />  
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="{{ asset('app-assets/site_assets/js/jquery.js') }}"></script>
    @yield('css')
</head>

<body class="page">
    <!-- Loader-->
    <div id="page-preloader"><span class="spinner border-t_second_b border-t_prim_a"></span></div>
    <!-- Loader end-->
    <div class="l-theme animated-css" data-header="sticky" data-header-top="200" data-canvas="container">
        <header class="p-3 header-dashboard">
            <div class="container-fluid">
            	<div class="row">
            		<div class="my-auto col-lg-3">
            			<a href="" class="dashboard-logo">
            				<img src="{{ logoURL() }}" class="img-fluid" alt="logo">
            			</a>
            		</div>
            		<div class="my-auto col-lg-9">
            			<div class="menus-customer">
            				<div class="currency-menus">
            					{{-- <form class="" action="" method="">
            						<div class="form-group">
            							<select class="form-control">
            								<option value="English">English</option>
            								<option value="French">French</option>
            							</select>
            							<select class="form-control">
            								<option value="USD">USD</option>
            								<option value="EURO">EURO</option>
            							</select>
            						</div>
            					</form> --}}
            				</div>
            				<div class="menus-header">
            					<ul class="list-unstyled">
            						<li><a href="{{ route('boatowner.listing') }}">Listing</a></li>
            						<li><a href="{{ route('boatowner.booking.index') }}">Bookings</a></li>
            						<li><a href="{{ route('logout') }}">Logout</a></li>
                                    <li><a class="nav-link" href="{{ route('boatowner.profile') }}"><i class="fa-solid fa-user"></i></a></li>
            					</ul>
            				</div>
            			</div>
            		</div>
            	</div>
            </div>
        </header>
       	<section class="p-0 main-dashboard-container container-fluid">
            <div class="row account-overview">
                @if($active !='listing')
                    <div class="col-lg-3">
                        <aside class="sidebar">
                            <div class="user">
                            <div class="user-avatar">
                                <a href="#">
                                <img src="{{ userImage() }}" alt="dejodo">
                                </a>
                            </div>
                            <h3>{{ userName() }}</h3>
                            </div>
                            <ul>
                                <li class="{{ $active=='dashboard' ? 'active':'' }}"><a href="{{ route('boatowner.dashboard') }}"><i class="fas fa-th"></i> Dashboard</a></li>
                                <li class="{{ $active=='profile' ? 'active':'' }}"><a href="{{ route('boatowner.profile') }}"><i class="fas fa-user-circle"></i> Profile</a></li>
                                <li class="{{ $active=='listing' ? 'active':'' }}"><a href="{{ route('boatowner.listing') }}"><i class="fas fa-heart"></i> Listing</a></li>
                                <li class="{{ $active=='customers' ? 'active':'' }}"><a href="{{ route('boatowner.customers') }}"><i class="fas fa-heart"></i> Customers</a></li>
                                <li class="{{ $active=='booking' ? 'active':'' }}"><a href="{{ route('boatowner.booking.index') }}"><i class="fas fa-clipboard-list"></i> Bookings</a></li>
                                <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            </ul>
                        </aside>
                    </div>
                @endif
                @yield('content')
            </div>
        </section>
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
    </div>
    <!-- end layout-theme-->


    <!-- ++++++++++++-->
    <!-- MAIN SCRIPTS-->
    <!-- ++++++++++++-->
    <script src="{{ asset('app-assets/site_assets/js/bundle.min.js') }}"></script>
    <script src="{{ asset('app-assets/site_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/site_assets/js/popper.min.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/site_assets/js/map.js') }}"></script> --}}
    <script src="{{ asset('app-assets/site_assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('app-assets/site_assets/js/script.js') }}"></script>
    @yield('js')

</body>

</html>
