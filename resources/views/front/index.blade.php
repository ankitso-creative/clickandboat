@extends('layouts.front.common')
@section('meta')
<title>Home</title>
<style>
.custom-div {
  position: relative;
  display: inline-block;
  /* background-color: #d9d9d9; */
  /* width: calc(100vw / 3 - 2px);
  height: 100vh; */
  padding: 0;
  margin: -2px;
  overflow: visible;
  outline: 1px white solid;
  cursor: none;
}
.custom-div .text {
    position: absolute;
    left: 0;
    top: 0;
    transform: translate(-50%, -50%);
    white-space: nowrap;
    background-color: transparent;
    font-size: 60px;
    font-weight: 800;
    display: none;
    pointer-events: none;
    text-transform: uppercase;
    color: #f9a126;
    font-family: 'GT America Trial Cn Bd';
}

.text {
  z-index: 999;
}

.custom-div:nth-child(odd) {
  /* background-color: #d9d9d9; */
}

</style>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.css">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAli6rCJivgzTbWznnkqFtT_btPww6WBYs&libraries=places"></script>
<script>
flatpickr(".datePicker-search", {
    inline: false,
    dateFormat: "d-m-Y",
    minDate: "today",
});
$(document).ready(function() {
    google.maps.event.addDomListener(window, 'load', initialize);
});

function initialize() {
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
            input.value = city + ', ' + state + ', ' + country;
        }
        if (city == state) {
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
                        <select name="location" class="loaction-search" placeholder="Search Loaction">
                            <option value="">Select the Locations</option>
                            <option value="IGY Ibiza Marina">IGY Ibiza Marina</option>
                            <option value="Marina Botafoch">Marina Botafoch</option>
                            <option value="Marina Formentera Mar S.A.">Marina Formentera Mar S.A.</option>
                            <option value="Marina Ibiza">Marina Ibiza</option>
                            <option value="Marina Port Ibiza">Marina Port Ibiza</option>
                            <option value="Marina Santa Eulalia">Marina Santa Eulalia</option>
                            <option value="San Antonio Marina">San Antonio Marina </option>
                        </select>
                        <!-- <input type="text" class="form-control" name="location" id="location-search"
                            placeholder="Ibiza, Croatia, Sardinia..."> -->

                    </div>
                </div>
                <div class="col date_col">
                    <label>{{ __('home.starting-date')}}</label>
                    <div class="mb-4 form-group">
                        <div class="datepicker date input-group">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                            </div>
                            <input type="text" placeholder="DD/MM/YYYY" name="startdate"
                                class="form-control datePicker-search" id="fecha1">
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
                            <input type="text" placeholder="DD/MM/YYYY" name="enddate"
                                class="form-control datePicker-search" id="fecha1">
                        </div>
                    </div>
                </div>
                <div class="col location_col">
                    <label>{{ __('home.boat-type')}}</label>
                    <div class="boat_select">
                        <span><i class="fa-solid fa-sailboat"></i></span>
                        <select name="type" id="cars">
                            <option value="">Sailboat, motorboat,...</option>
                            {!! selectOption('categories','name','name',request()->get('type'),array('status' , '1')) !!} 
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
                        <img src="{{ asset('app-assets/site_assets/img/image00065.jpg') }}" alt="featured-img">
                        <div class="featured_box_text">
                            <p>Luxury boats</p>
                            <h3>Cranchi 43</h3>
                        </div>
                    </a>
                </div>
                <p class="featured_price">11 Guests | Price from €1690</p>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="featured_board_boxes">
                    <a href="#">
                        <img src="{{ asset('app-assets/site_assets/img/image00076.jpg') }}" alt="featured-img">
                        <div class="featured_box_text">
                            <p>Luxury boats</p>
                            <h3>Chaparral 250</h3>
                        </div>
                    </a>
                </div>
                <p class="featured_price">11 Guests | Price from €1690</p>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="featured_board_boxes">
                    <a href="#">
                        <img src="{{ asset('app-assets/site_assets/img/image00092.jpg') }}" alt="featured-img">
                        <div class="featured_box_text">
                            <p>Luxury boats</p>
                            <h3>Maiora 99</h3>
                        </div>
                    </a>
                </div>
                <p class="featured_price">11 Guests | Price from €1690</p>
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
                        <p>Browse all our listings using the search tool. Whether you're looking to rent a motorboat or a sailboat near you or at your dream destination, find the best deals available. Enjoy peace of mind with MyBoatBooker, ensuring a safe and worry-free boating experience</p>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <div class="boat_renter_text">
                        <p>Reach out to yacht owners at no cost and get answers to all your questions about the boat, its equipment, and availability through our built-in messaging system.</p>
                        <i class="fa-solid fa-message"></i>
                    </div>
                    <div class="boat_renter_text">
                        <p>Securely book the yacht of your dreams online in just a few clicks. You’ll only be charged once the owner approves your charter request. With 100% secure payment, MyBoatBooker acts as your trusted third party every step of the way.</p>
                        <i class="fa-solid fa-thumbs-up"></i>
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
                        <p>List your boat for free and share it with others looking to charter. Whether it's a yacht, sailboat, RIB, motorboat, or catamaran.</p>
                      <i class="fa-solid fa-sailboat"></i>
                    </div>
                    <div class="boat_renter_text">
                        <p>Charter your boat on your own terms, to whoever you choose, whenever it suits you, and at the price you set. MyBoatBooker helps you earn income from your yacht and offset maintenance and operating costs</p>
                        <i class="fa-solid fa-location-crosshairs"></i>
                    </div>
                    <div class="boat_renter_text">
                        <p>Why register your boat with MyBoatBooker? By listing your boat with us, you open up opportunities to earn income, increase your boat’s visibility, and make it available to a wide range of potential charterers. Enjoy a hassle-free experience with trusted bookings, secure payments, and the peace of mind that comes with our reliable platform.</p>
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="estimate_btn">
                        <a href="">Register your boat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Boat renter owner Section -->
<!-- Boat Types Section -->
@if(count($categories))
    <section class="boat_type_section_slider">
        <div class="boat_type_sec">
            <h2>Boat Types</h2>
            <div class="row boat_type_slider">
                @foreach($categories as $category)
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <a href="{{ route('locationcategry',$category->slug) }}">
                            <div class="boat_type_box">
                                <img src="{{ $category->getFirstMediaUrl('category_image') }}" alt="boat-img">
                                <div class="boat_type_text">
                                    <h3>{{ $category->name }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
<!-- /Boat Types Section -->
<!-- Boats by location Section -->
<section class="boat_by_location_section">
    <h2>Boats by Marinas</h2>
    <div class="boat_by_location">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <a href="{{ route('locationlisting','Ibiza') }}">
                        <div class="boat_by_location_box">
                            <div class="boat_by_location_text">
                                <h3>Marina Santa Eulalia</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <a href="{{ route('locationlisting','Guadeloupe') }}">
                        <div class="boat_by_location_box">
                            <div class="boat_by_location_text">
                                <h3>Puerto Sant Antoni </h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <a href="{{ route('locationlisting','Italy') }}">
                        <div class="boat_by_location_box">
                            <div class="boat_by_location_text">
                                <h3>Marina Ibiza</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <a href="{{ route('locationlisting','Dubai') }}">
                        <div class="boat_by_location_box">
                            <div class="boat_by_location_text">
                                <h3>Marina Botafoch</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <a href="{{ route('locationlisting','Croatia') }}">
                        <div class="boat_by_location_box">
                            <div class="boat_by_location_text">
                                <h3> Ibiza Magna</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <a href="{{ route('locationlisting','Greece') }}">
                        <div class="boat_by_location_box">
                            <div class="boat_by_location_text">
                                <h3>Club Nautico</h3>
                            </div>
                        </div>
                    </a>
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
                <a href="{{ route('location') }}">
                    <div class="home_page_slider_box">
                        <img src="{{ asset('app-assets/site_assets/img/location-slider-1.jpg') }}" class="image">
                        <div class="home_page_box_text">
                            <h3>LUXURY boats</h3>
                            <h2>Es Vedrà</h2>
                            <p>*Es Vedrà is a small, uninhabited rocky island off the southwest coast of Ibiza, Spain. Rising dramatically from the sea at about 400 meters (1,312 feet) high, it is one of Ibiza’s most iconic and mystical landmarks.* (this paragraph to be on front slide)</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="location_slide">
              <a href="{{ route('location') }}">
                <div class="home_page_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/location-slider-1.jpg') }}" class="image">
                    <div class="home_page_box_text">
                        <h3>LUXURY boats</h3>
                        <h2>Cala Jondal</h2>
                        <p>*Cala Jondal is one of Ibiza’s most exclusive and stylish beaches, located on the island’s south coast, just a short distance from Ibiza Town. Surrounded by pine-covered cliffs and crystal-clear turquoise waters, this cove is famous for its upscale beach clubs, fine dining, and celebrity visitors.* (front slide)</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="location_slide">
                <a href="{{ route('location') }}">
                    <div class="home_page_slider_box">
                        <img src="{{ asset('app-assets/site_assets/img/location-slider-1.jpg') }}" class="image">
                        <div class="home_page_box_text">
                            <h3>LUXURY boats</h3>
                            <h2>Cala Codolar & The Smugglers’ Cav</h2>
                            <p>*Cala Codolar is a peaceful and secluded beach on Ibiza’s west coast, offering crystal-clear waters, golden sand, and a relaxed atmosphere. But beyond its natural beauty, it hides a secret gem—the Smugglers’ Cave, a mysterious spot filled with history and adventure.* (front slide)</p>
                        </div>
                    </div>
                </a>
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
    <h2>GET INSPIRED<br>
        BY OUR IBIZA BLOG</h2>
    <div class="container-fluid">
        <div class="row">
            @if(count($blogs))
                @foreach($blogs as $blog)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="next_trip_box">
                            <img src="{{ $blog->getFirstMediaUrl('blog_image') }}">
                            <div class="next_trip_text">
                                <h3>{{ $blog->title }}</h3>
                                <p>{{ substr(strip_tags($blog->description),0,170) }}...</p>
                                <div class="trip_date_text">
                                    <span><a href="{{ route('single-blog',$blog->slug) }}">View Post</a></span>
                                    <span>{{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="text-center all_blog_button">
            <a href="">View All Blogs</a>
        </div>
    </div>
</section>
<!-- <script>
function moveText(event) {
    var div = event.currentTarget;
    var text = div.querySelector(".text");

    if (!text) return;

    var rect = div.getBoundingClientRect();
    var offsetX = event.clientX - rect.left;
    var offsetY = event.clientY - rect.top;

    text.style.transform = `translate(${offsetX}px, ${offsetY}px)`;
    text.style.display = "block";
}

function hideText(event) {
    var text = event.currentTarget.querySelector(".text");
    if (text) {
        text.style.display = "none";
    }
}
</script> -->
<!-- /next trip Section -->
 <script>
    $(window).scroll(function(){
      if ($(this).scrollTop() > 120) {
          $('.header').addClass('fixed');
      } else {
          $('.header').removeClass('fixed');
      }
});
 </script>

@endsection