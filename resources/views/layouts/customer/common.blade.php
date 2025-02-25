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
    <link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/style.css') }}"> 
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
        <header class="header-dashboard p-3">
            <div class="container-fluid">
            	<div class="row">
            		<div class="col-lg-3 my-auto">
            			<a href="#" class="dashboard-logo">
            				<img src="{{ logoURL() }}" class="img-fluid" alt="logo">
            			</a>
            		</div>
            		<div class="col-lg-9 my-auto">
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
            						<li><a href="{{ route('customer.booking.index') }}">Bookings</a></li>
            						<li><a href="{{ route('logout') }}">Logout</a></li>
            					</ul>
            				</div>
            			</div>
            		</div>
            	</div>
            </div>
        </header>
       	<section class="main-dashboard-container container-fluid p-0">
            <div class="row account-overview">
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
                            <li class="{{ $active=='dashboard' ? 'active':'' }}"><a href="{{ route('customer.dashboard') }}"><i class="fas fa-th"></i> Dashboard</a></li>
                            <li class="{{ $active=='profile' ? 'active':'' }}"><a href="{{ route('customer.profile') }}"><i class="fas fa-user-circle"></i> Profile</a></li>
                            <li class="{{ $active=='booking' ? 'active':'' }}"><a href="{{ route('customer.booking.index') }}"><i class="fas fa-clipboard-list"></i> Bookings</a></li>
                            <li class="{{ $active=='favourite' ? 'active':'' }}"><a href="{{ route('customer.favourite')}}"><i class="fas fa-heart"></i> Favourites</a></li>
                            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </aside>
                </div>
                @yield('content')
            </div>
        </section>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-section">
                            <a class="footer__logo" href="index.html"><img class="img-fluid" src="assets/img/logo-light.png" alt="Logo"></a>
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
                            <h3 class="footer-section__title">Boat Services</h3>
                            <ul class="footer-list list-unstyled">
                                <li><a href="#">Wedding Facility</a></li>
                                <li><a href="#">Cruise and Marina</a></li>
                                <li><a href="#">Yacht Party Event</a></li>
                                <li><a href="#">Corporate Event</a></li>
                                <li><a href="#">Fishing Cruiser</a></li>
                                <li><a href="#">Overnight Stay</a></li>
                                <li><a href="#">Birthday Party Yacht</a></li>
                                <li><a href="#">Boar Rentals</a></li>
                            </ul>
                        </section>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <section class="footer-section footer-section_link">
                            <h3 class="footer-section__title">About Nevica</h3>
                            <ul class="footer-list list-unstyled">
                                <li><a href="#"> Home</a></li>
                                <li><a href="#">Services</a></li>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Boat Fleet</a></li>
                                <li><a href="#">Parts Shop </a></li>
                                <li><a href="#">Contact us</a></li>
                                <li><a href="#">Buy or Sell Boats</a></li>
                                <li><a href="#">Featured Vehicles</a></li>
                            </ul>
                        </section>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <section class="footer-section">
                            <h3 class="footer-section__title">Get In Touch</h3>
                            <div class="footer-contacts">
                                <div class="footer-contacts__item"><i class="ic icon-location-pin"></i>Fairview Ave, El Monte, CA 91732</div>
                                <div class="footer-contacts__item"><i class="ic icon-envelope"></i><a href="mailto:support@domain.com">support@domain.com</a></div>
                                <div class="footer-contacts__item"><i class="ic icon-earphones-alt"></i> Phone: <a class="footer-contacts__phone" href="tel:+17553028549">+1 755 302 8549</a> </div>
                            </div>
                            <ul class="footer-soc list-unstyled">
                                <li class="footer-soc__item"><a class="footer-soc__link" href="#" target="_blank"><i class="ic fab fa-twitter"></i></a></li>
                                <li class="footer-soc__item"><a class="footer-soc__link" href="#" target="_blank"><i class="ic fab fa-behance"></i></a></li>
                                <li class="footer-soc__item"><a class="footer-soc__link" href="#" target="_blank"><i class="ic fab fa-facebook-f"></i></a></li>
                                <li class="footer-soc__item"><a class="footer-soc__link" href="#" target="_blank"><i class="ic fab fa-instagram"></i></a></li>
                                <li class="footer-soc__item"><a class="footer-soc__link" href="#" target="_blank"><i class="ic fab fa-youtube"></i></a></li>
                            </ul><a class="btn btn-white" href="#">confirm booking</a>
                        </section>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">(c) 2022 Nevica - Boat Rentals . All rights reserved.</div>
            </div>
        </footer>
        <!-- .footer-->
    </div>
    <!-- end layout-theme-->


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
