@extends('layouts.front.common')
@section('meta')
<title>Home</title>
<style>
   .image-box {
        position: relative;
        display: inline-block;
        cursor: none;
    }
     .cursor {
        position: absolute;
        top: 0;
        left: 0;
        width: 80px;
        height: 80px;
        color: black;
        font-size: 60px;
        font-weight: 800;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        transform: translate(-50%, -50%);
        pointer-events: none;
        transition: transform 0.15s ease-out;
        opacity: 0;
        z-index: 999;
        text-transform: uppercase;
        color: #f9a126;
    }
    .cursor.active {
        opacity: 1;
    }
</style>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.css">
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAli6rCJivgzTbWznnkqFtT_btPww6WBYs&libraries=places"></script>
    <script>
        flatpickr(".datePicker-search", {
            inline: false,
            dateFormat: "d-m-Y",
            minDate: "today",
        });
        $(document).ready(function () {
            google.maps.event.addDomListener(window, 'load', initialize);
        });
        function initialize() 
        {
            var input = document.getElementById('location-search');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry || !place.address_components) {
                    console.log("Place details not found");
                    return;
                }
                var city = '';
                var country = '';
                var state = '';
                for (var i = 0; i < place.address_components.length; i++) {
                    var component = place.address_components[i];
                    if (component.types.includes('locality')) {
                        city = component.long_name;
                    }
                    if (component.types.includes('administrative_area_level_1')) {
                        state = component.long_name;
                    }
                    if (component.types.includes('country')) {
                        country = component.long_name;
                    }
                }
                if (city && country && state) {
                    input.value = city + ', ' + state + ', '+ country;
                }
                if(city==state)
                {
                    input.value = city + ', ' + country;
                }
                $('#search-filter-fom').submit();
            });
        }
    </script>
@endsection
@section('content')
<!-- Banner Section -->
<section class="home_banner_section">
    <div class="banner_text">
        <h1>{{ __('home.banner')}}<span class="banner_text_style">...</span><br>{{ __('home.bannet-text')}} <span
                class="banner_text_style">{{ __('home.bannet1')}}.</span></h1>
    </div>
</section>
<div class="banner_form">
    <div class="container-fluid">
        <form action="{{ route('search') }}" method="get">
            <div class="row">
                <div class="col location_col">
                    <label>{{ __('home.search-area')}}</label>
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>

                        <input type="text" class="form-control" name="location" id="location-search" placeholder="Ibiza, Croatia, Sardinia...">

                    </div>
                </div>
                <div class="col date_col">
                    <label>{{ __('home.starting-date')}}</label>
                    <div class="mb-4 form-group">
                        <div class="datepicker date input-group">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                            </div>
                            <input type="text" placeholder="DD/MM/YYYY" name="startdate" class="form-control datePicker-search" id="fecha1">
                        </div>
                    </div>
                </div>
                <div class="col date_col">
                    <label>{{ __('home.ending-date')}}</label>
                    <div class="mb-4 form-group">
                        <div class="datepicker date input-group">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                            </div>
                            <input type="text" placeholder="DD/MM/YYYY" name="enddate" class="form-control datePicker-search" id="fecha1">
                        </div>
                    </div>
                </div>
                <div class="col location_col">
                    <label>{{ __('home.boat-type')}}</label>
                    <div class="boat_select">
                        <span><i class="fa-solid fa-sailboat"></i></span>
                        <select name="cars" id="cars">
                            <option value="">Sailboat, motorboat,...</option>
                            <option value="saab">Sailboat</option>
                            <option value="opel">Motorboat</option>
                            <option value="audi">Catamaran</option>
                            <option value="audi">Sailing yacht</option>
                            <option value="audi">Fishing boat</option>
                            <option value="audi">Monohull</option>
                            <option value="audi">Jet skis</option>
                            <option value="audi">Rib</option>
                            <option value="audi">Yacht</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <button type="submit" class="search_btn">{{ __('home.search')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /Banner Section -->
<!-- Featured boats Section -->
<section class="featured_boats_section">
    <div class="container-fluid">
        <div class="featured_boat_heading">
            <h2>{{ __('home.featured-boats')}}</h2>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="featured_board_boxes">
                    <a href="#">
                        <img src="{{ asset('app-assets/site_assets/img/feature-img-1.jpg') }}" alt="featured-img">
                        <div class="featured_box_text">
                            <p>Luxury boats</p>
                            <h3>Cranchi 43</h3>
                        </div>
                        <p class="featured_price">11 Guests | Price from €1690</p>
                    </a>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="featured_board_boxes">
                    <a href="#">
                        <img src="{{ asset('app-assets/site_assets/img/feature-img-2.jpg') }}" alt="featured-img">
                        <div class="featured_box_text">
                            <p>Luxury boats</p>
                            <h3>Chaparral 250</h3>
                        </div>
                        <p class="featured_price">11 Guests | Price from €1690</p>
                    </a>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="featured_board_boxes">
                    <a href="#">
                        <img src="{{ asset('app-assets/site_assets/img/feature-img-3.jpg') }}" alt="featured-img">
                        <div class="featured_box_text">
                            <p>Luxury boats</p>
                            <h3>Maiora 99</h3>
                        </div>
                        <p class="featured_price">11 Guests | Price from €1690</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Featured boats Section -->
<!-- Boat renter owner Section -->
<section class="boat_reanter_owner_section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="boat_renter_box box-one">
                    <h2>Boat renter</h2>
                    <div class="boat_renter_text">
                        <p>See all of our listings via the search engine. Find a motorboat or a sailboat for rent near
                            me or in your desired destination, at the best price. Take advantage of our all inclusive
                            insurance so you can rent and navigate peacefully and in complete security.</p>
                        <img src="{{ asset('app-assets/site_assets/img/main-icon-1.png') }}">
                    </div>
                    <div class="boat_renter_text">
                        <p>Contact yacht owners free of charge and ask them all your practical questions about the
                            yacht, its equipment and its availability via our integrated Click&Boat messenger.</p>
                        <img src="{{ asset('app-assets/site_assets/img/main-icon-2.png') }}">
                    </div>
                    <div class="boat_renter_text">
                        <p>Book directly and safely online in just a few clicks and charter the yacht of your dreams.
                            You will only be charged if your charter request is accepted by the owner of the yacht. 100%
                            secured payment. Click&Boat is your trustworthy third party.</p>
                        <img src="{{ asset('app-assets/site_assets/img/main-icon-3.png') }}">
                    </div>
                    <div class="find_boat_btn">
                        <a href="">Find a boat</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="boat_renter_box box-two">
                    <h2>Boat owner</h2>
                    <div class="boat_renter_text">
                        <p>Create a free listing to make your boat available for charter to other people. Yachts,
                            sailboats, RIBs, motorboats, catamarans - all are welcome on Click&Boat!</p>
                        <img src="{{ asset('app-assets/site_assets/img/main-icon-4.png') }}">
                    </div>
                    <div class="boat_renter_text">
                        <p>Charter to whoever you want, whenever you want and at the price you want. Click&Boat allows
                            you to monetise your yacht and to help cover the costs related to its maintenance and use.
                        </p>
                        <img src="{{ asset('app-assets/site_assets/img/main-icon-5.png') }}">
                    </div>
                    <div class="boat_renter_text">
                        <p>Optional comprehensive insurance plan covering up to 8 million euros and a security deposit.
                            Entrust the chartering of your yacht, sailboat, motorboat or catamaran to us.</p>
                        <img src="{{ asset('app-assets/site_assets/img/main-icon-6.png') }}">
                    </div>
                    <div class="estimate_btn">
                        <a href="">Estimate your earnings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Boat renter owner Section -->
<!-- Boat Types Section -->
<section class="boat_type_section_slider">
    <div class="boat_type_sec">
        <h2>Boat Types</h2>
        <div class="row boat_type_slider">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="boat_type_box">
                    <img src="{{ asset('app-assets/site_assets/img/boat-type-1.jpg') }}" alt="boat-img">
                    <div class="boat_type_text">
                        <h3>Motorboat</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="boat_type_box">
                    <img src="{{ asset('app-assets/site_assets/img/boat-type-2.jpg') }}" alt="boat-img">
                    <div class="boat_type_text">
                        <h3>RIBS</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="boat_type_box">
                    <img src="{{ asset('app-assets/site_assets/img/boat-type-2.jpg') }}" alt="boat-img">
                    <div class="boat_type_text">
                        <h3>RIBS</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Boat Types Section -->
<!-- Boats by location Section -->
<section class="boat_by_location_section">
    <h2>boats by location</h2>
    <div class="boat_by_location">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="boat_by_location_box">
                        <h3>marina santa eulalia</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="boat_by_location_box">
                        <h3>puerto sant antoni</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="boat_by_location_box">
                        <h3>marina ibiza</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="boat_by_location_box">
                        <h3>marina botafoch</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="boat_by_location_box">
                        <h3>ibiza magna</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="boat_by_location_box">
                        <h3>club nautico</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Boats by location Section -->
<!-- Follow sailer Section -->
<section class="follow_sailer_section">
    <div class="container-fluid">
        <h2>Fellow sailors share<br>
            their amazing experiences</h2>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="follow_sailer_box">
                    <div class="custmer_revie">
                        <div class="custmer_img">
                            <img src="{{ asset('app-assets/site_assets/img/testimonial-img.png') }}">
                        </div>
                        <div class="custmer_text">
                            <div class="follow_rating">
                                <h5>Thomas</h5>
                                <ul>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                </ul>
                            </div>
                            <p>Jan 2025 Rent a boat in RANIERI Soverato in Port d'Alcúdia</p>
                        </div>
                    </div>
                    <p class="follow_main_text">This is by far the best boat rental experience we’ve had!! The team is
                        so welcoming and friendly - we can’t wait to </p>
                    <a href="#">Read More</a>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="follow_sailer_box">
                    <div class="custmer_revie">
                        <div class="custmer_img">
                            <img src="{{ asset('app-assets/site_assets/img/testimonial-img.png') }}">
                        </div>
                        <div class="custmer_text">
                            <div class="follow_rating">
                                <h5>Thomas</h5>
                                <ul>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                </ul>
                            </div>
                            <p>Jan 2025 Rent a boat in RANIERI Soverato in Port d'Alcúdia</p>
                        </div>
                    </div>
                    <p class="follow_main_text">This is by far the best boat rental experience we’ve had!! The team is
                        so welcoming and friendly - we can’t wait to </p>
                    <a href="#">Read More</a>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="follow_sailer_box">
                    <div class="custmer_revie">
                        <div class="custmer_img">
                            <img src="{{ asset('app-assets/site_assets/img/testimonial-img.png') }}">
                        </div>
                        <div class="custmer_text">
                            <div class="follow_rating">
                                <h5>Thomas</h5>
                                <ul>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                </ul>
                            </div>
                            <p>Jan 2025 Rent a boat in RANIERI Soverato in Port d'Alcúdia</p>
                        </div>
                    </div>
                    <p class="follow_main_text">This is by far the best boat rental experience we’ve had!! The team is
                        so welcoming and friendly - we can’t wait to </p>
                    <a href="#">Read More</a>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="follow_sailer_box">
                    <div class="custmer_revie">
                        <div class="custmer_img">
                            <img src="{{ asset('app-assets/site_assets/img/testimonial-img.png') }}">
                        </div>
                        <div class="custmer_text">
                            <div class="follow_rating">
                                <h5>Thomas</h5>
                                <ul>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                </ul>
                            </div>
                            <p>Jan 2025 Rent a boat in RANIERI Soverato in Port d'Alcúdia</p>
                        </div>
                    </div>
                    <p class="follow_main_text">This is by far the best boat rental experience we’ve had!! The team is
                        so welcoming and friendly - we can’t wait to </p>
                    <a href="#">Read More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Follow sailer Section -->
<!-- Home page slider Section -->
<section class="home_page_slider">
    <div class="home_page_slider_Sec">
        <div class="row location_slider">
            <div class="location_slide">
                <div class="home_page_slider_box image-box">
                    <img src="{{ asset('app-assets/site_assets/img/location-slider-1.jpg') }}" class="image">
                    <div class="cursor"></div>
                    <div class="home_page_box_text">
                        <h3>LUXURY boats</h3>
                        <h2>Es vedre</h2>
                        <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed
                            odio tortor, hendrerit ut arcu vitae, efficitur convallis eros.</p>
                    </div>
                </div>
            </div>
            <div class="location_slide">
                <div class="home_page_slider_box image-box">
                    <img src="{{ asset('app-assets/site_assets/img/location-slider-1.jpg') }}" class="image">
                    <div class="cursor"></div>
                    <div class="home_page_box_text">
                        <h3>LUXURY boats</h3>
                        <h2>Es vedre</h2>
                        <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed
                            odio tortor, hendrerit ut arcu vitae, efficitur convallis eros.</p>
                    </div>
                </div>
            </div>
            <div class="location_slide">
                <div class="home_page_slider_box image-box">
                    <img src="{{ asset('app-assets/site_assets/img/location-slider-1.jpg') }}" class="image">
                    <div class="cursor"></div>
                    <div class="home_page_box_text">
                        <h3>LUXURY boats</h3>
                        <h2>Es vedre</h2>
                        <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed
                            odio tortor, hendrerit ut arcu vitae, efficitur convallis eros.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Home page slider Section -->
<!-- unique slider Section -->
<!-- <section class="unique_slider">
    <h2>WHAT MAKES US UNIQUE</h2>
    <div class="row">
        <div class="unique_sliders col-md-12">
            <div class="unique_slide col-md-4">
                <div class="unique_slider_box ">
                    <img src="{{ asset('app-assets/site_assets/img/service-icon-1.png') }}">
                    <h3>Inboat Service</h3>
                    <p>Sed tempor aliquet fermentum. Nulla in nibh risus. Nam eget commodo ligula. Vestibulum a quam
                        sagittis,</p>
                </div>
            </div>
            <div class="unique_slide col-md-4">
                <div class="unique_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/service-icon-1.png') }}">
                    <h3>Inboat Service</h3>
                    <p>Sed tempor aliquet fermentum. Nulla in nibh risus. Nam eget commodo ligula. Vestibulum a quam
                        sagittis,</p>
                </div>
            </div>
            <div class="unique_slide col-md-4">
                <div class="unique_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/service-icon-1.png') }}">
                    <h3>Inboat Service</h3>
                    <p>Sed tempor aliquet fermentum. Nulla in nibh risus. Nam eget commodo ligula. Vestibulum a quam
                        sagittis,</p>
                </div>
            </div>
            <div class="unique_slide col-md-4">
                <div class="unique_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/service-icon-1.png') }}">
                    <h3>Inboat Service</h3>
                    <p>Sed tempor aliquet fermentum. Nulla in nibh risus. Nam eget commodo ligula. Vestibulum a quam
                        sagittis,</p>
                </div>
            </div>
            <div class="unique_slide col-md-4">
                <div class="unique_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/service-icon-1.png') }}">
                    <h3>Inboat Service</h3>
                    <p>Sed tempor aliquet fermentum. Nulla in nibh risus. Nam eget commodo ligula. Vestibulum a quam
                        sagittis,</p>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- /unique slider Section -->
<!-- next trip Section -->
<section class="next_trip_section">
    <h2>Get inspiration<br>
        for your next trip</h2>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="next_trip_box">
                    <img src="{{ asset('app-assets/site_assets/img/blog-img-1.jpg') }}">
                    <div class="next_trip_text">
                        <h3>Sailing events to look out for in 2025</h3>
                        <p>Every year, the boating world surprises and delights sailing fans around the world with
                            events, races and regattas. We’ve put together a short list of sailing events we’ll be
                            looking…</p>
                        <div class="trip_date_text">
                            <span><a href="">View Post</a></span>
                            <span>January 11, 2025</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="next_trip_box">
                    <img src="{{ asset('app-assets/site_assets/img/blog-img-2.jpg') }}">
                    <div class="next_trip_text">
                        <h3>Sailing events to look out for in 2025</h3>
                        <p>Every year, the boating world surprises and delights sailing fans around the world with
                            events, races and regattas. We’ve put together a short list of sailing events we’ll be
                            looking…</p>
                        <div class="trip_date_text">
                            <span><a href="">View Post</a></span>
                            <span>January 11, 2025</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="next_trip_box">
                    <img src="{{ asset('app-assets/site_assets/img/blog-img-3.jpg') }}">
                    <div class="next_trip_text">
                        <h3>Sailing events to look out for in 2025</h3>
                        <p>Every year, the boating world surprises and delights sailing fans around the world with
                            events, races and regattas. We’ve put together a short list of sailing events we’ll be
                            looking…</p>
                        <div class="trip_date_text">
                            <span><a href="">View Post</a></span>
                            <span>January 11, 2025</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
    const cursor = $('.cursor');
    // Mousemove event to update cursor position
    $(document).mousemove(function(event) {
        cursor.css({
            left: event.clientX + 'px',
            top: event.clientY + 'px'
        });
    });
    // Hover event for location_slide to activate cursor
    $(".location_slide").each(function () {
            let $this = $(this);

            // Add active class when the slide is active
            $this.hover(
                function () {
                    $this.find(".cursor").addClass("active");
                    $this.find(".cursor").text("Explore");
                },
                function () {
                    $this.find(".cursor").text("");
                    $this.find(".cursor").removeClass("active");
                }
            );
        });

    $('.image-box').mouseleave(function() {
        cursor.removeClass('active').text('');
    });
});
</script>
<!-- /next trip Section -->

@endsection