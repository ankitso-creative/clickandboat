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

.banner_text_style {
    position: absolute;
    width: 840px;
    left: 50%;
    margin-left: -360px;
    height: 40px;
    top: 50%;
    margin-top: -20px;
}

.banner_text_style p {
    display: inline-block;
    vertical-align: top;
    margin: 0;
    font-size: 72px;
    color: #fff;
    font-weight: 600;
    text-shadow: 0px 2px 0px #0000004d, 0 0 2em #0000008a, 0 0 1.2em #0000008a;
    font-family: 'GT America Trial Cn Bd';
}

.banner_text_style .word {
    position: absolute;
    opacity: 0;
    margin-left: 15px;
}

.banner_text_style .letter {
    display: inline-block;
    position: relative;
    float: left;
    transform: translateZ(25px);
    transform-origin: 50% 50% 25px;
}

.banner_text_style .letter.out {
    transform: rotateX(90deg);
    transition: transform 0.32s cubic-bezier(0.55, 0.055, 0.675, 0.19);
}

.banner_text_style .letter.behind {
    transform: rotateX(-90deg);
}

.banner_text_style .letter.in {
    transform: rotateX(0deg);
    transition: transform 0.38s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.banner_text_style .wisteria {
    color: #f9a126;
}

.banner_text_style .belize {
    color: #f9a126;
}

.banner_text_style .pomegranate {
    color: #f9a126;
}

.banner_text_style .green {
    color: #f9a126;
}

.banner_text_style .midnight {
    color: #f9a126;
}

.search-bar {
    align-items: center;
    background: #ffffff57;
    border-radius: 80px;
    padding: 23px 30px;
    color: #fff;
    width: 100%;
    position: relative;
    margin: 0px auto;
}
.dot {
    font-size: 1.2rem;
}

.search-button {
    background: none;
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    cursor: pointer;
    color: white;
    font-size: 1.1rem;
    position: absolute;
    right: 10px;
    top: 20px;
}
.banner_form_mobile p {
    font-size: 22px;
    padding-bottom: 5px;
    text-transform: uppercase;
    font-weight: 600;
}
.search-options span {
    color: #fff;
    font-size: 17px;
    font-family: 'Montserrat';
    text-transform: uppercase;
}
.banner_form_mobile .modal-dialog {
    width: 95% !important;
    max-width: 95%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) !important;
    margin: 0px !important;
}
.banner_form_mobile .modal-content {
    padding-bottom: 30px;
    border-radius: 40px !important;
}
.modal-open .modal {
    background: #000000b3 !important;
}
</style>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.css">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
<script>
flatpickr(".datePicker-search", {
    inline: false,
    dateFormat: "d-m-Y",
    minDate: "today",
});
</script>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    var words = document.getElementsByClassName('word');
    var wordArray = [];
    var currentWord = 0;

    words[currentWord].style.opacity = 1;
    for (var i = 0; i < words.length; i++) {
        splitLetters(words[i]);
    }

    function changeWord() {
        var cw = wordArray[currentWord];
        var nw = currentWord == words.length - 1 ? wordArray[0] : wordArray[currentWord + 1];
        for (var i = 0; i < cw.length; i++) {
            animateLetterOut(cw, i);
        }

        for (var i = 0; i < nw.length; i++) {
            nw[i].className = 'letter behind';
            nw[0].parentElement.style.opacity = 1;
            animateLetterIn(nw, i);
        }

        currentWord = (currentWord == wordArray.length - 1) ? 0 : currentWord + 1;
    }

    function animateLetterOut(cw, i) {
        setTimeout(function() {
            cw[i].className = 'letter out';
        }, i * 80);
    }

    function animateLetterIn(nw, i) {
        setTimeout(function() {
            nw[i].className = 'letter in';
        }, 340 + (i * 80));
    }

    function splitLetters(word) {
        var content = word.innerHTML;
        word.innerHTML = '';
        var letters = [];
        for (var i = 0; i < content.length; i++) {
            var letter = document.createElement('span');
            letter.className = 'letter';
            letter.innerHTML = content.charAt(i);
            word.appendChild(letter);
            letters.push(letter);
        }

        wordArray.push(letters);
    }

    changeWord();
    setInterval(changeWord, 3000);
});
</script>
@endsection
@section('content')
<!-- Banner Section -->
<section class="home_banner_section">
    <div class="banner_text">
        <!-- <h1>{{ __('home.banner')}}<span class="banner_text_style">...</span><br>{{ __('home.bannet-text')}} <span
                class="banner_text_style">{{ __('home.bannet1')}}.</span></h1> -->
        <div class="banner_text_style">
            <p>IBIZA BOAT</p>
            <p>
                <span class="word wisteria">BOOKING.</span>
                <span class="word belize">RENTALS.</span>
                <span class="word pomegranate">DAYS.</span>
                <span class="word pomegranate">HIRE.</span>
                <span class="word pomegranate">TRIPS.</span>
            </p>
        </div>
    </div>
    <div class="banner_form_mobile">
        <div class="container">
            <!-- Button trigger modal -->
            <div class="search-bar" data-toggle="modal" data-target="#searchmobilefilter">
                <p>Book a Boat</p>
                <div class="search-options">
                    <span>Marina</span>
                    <span class="dot">|</span>
                    <span>Date</span>
                    <span class="dot">|</span>
                    <span>Boat type</span>
                </div>
                <button class="search-button">
                <img src="{{ asset('app-assets/site_assets/img/search-arrow.png') }}">
                </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="searchmobilefilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body home_banner_mobile_filter">
                            <div class="banner_form">
                                <div class="container-fluid">
                                    <form action="{{ route('search') }}" method="get">
                                        <div class="row">
                                            <div class="col location_col">
                                                <label>{{ __('home.search-area')}}</label>
                                                <div class="form-group has-search">
                                                    <span class="fa fa-search form-control-feedback"></span>
                                                    <select name="location" class="loaction-search" placeholder="Search Loaction">
                                                        <option value="">All Marinas</option>
                                                        <option value="Marina Santa Eulalia">Marina Santa Eulalia</option>
                                                        <option value="Puerto Sant Antoni">Puerto Sant Antoni</option>
                                                        <option value="Marina Ibiza">Marina Ibiza</option>
                                                        <option value="Marina Botafoch">Marina Botafoch</option>
                                                        <option value="Ibiza Magna">Ibiza Magna</option>
                                                        <option value="Club Nautico">Club Nautico</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col date_col">
                                                <label>{{ __('home.starting-date')}}</label>
                                                <div class="mb-4 form-group">
                                                    <div class="datepicker date input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-calendar-days"></i></span>
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
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-calendar-days"></i></span>
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
                                                    <select name="type[]" id="cars">
                                                        <option value="">Sailboat, motorboat,...</option>
                                                        {!! selectOption('categories','name','name',request()->get('type'),array('status', '1')) !!}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="banner_form home_filter">
    <div class="container-fluid">
        <form action="{{ route('search') }}" method="get">
            <div class="row">
                <div class="col location_col">
                    <label>{{ __('home.search-area')}}</label>
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <select name="location" class="loaction-search" placeholder="Search Loaction">
                            <option value="">All Marinas</option>
                            <option value="Marina Santa Eulalia">Marina Santa Eulalia</option>
                            <option value="Puerto Sant Antoni">Puerto Sant Antoni</option>
                            <option value="Marina Ibiza">Marina Ibiza</option>
                            <option value="Marina Botafoch">Marina Botafoch</option>
                            <option value="Ibiza Magna">Ibiza Magna</option>
                            <option value="Club Nautico">Club Nautico</option>
                        </select>
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
                        <select name="type[]" id="cars">
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
        <div class="row feature_box_main">
            @if($featureds)
                @foreach($featureds as $featured)
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="featured_board_boxes">
                            <a href="{{ route('singleboat', ['city' => $featured->city, 'type' => $featured->type, 'slug' => $featured->slug]) }}">
                                <img src="{{ $featured->getFirstMediaUrl('cover_images') ? $featured->getFirstMediaUrl('cover_images') : 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png' }}" alt="featured-img">
                                <div class="featured_box_text">
                                    <p>Luxury boats</p>
                                    <h3>{{ ucfirst($featured->boat_name).' '.$featured->model }}</h3>
                                </div>
                            </a>
                        </div>
                        <p class="featured_price">{{ $featured->onboard_capacity }} Guests | Price from {{ getListingPrice($featured->slug) }}</p>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="text-center row featured_boat_section_mobile featured_boat_slider">
             @if($featureds)
                @foreach($featureds as $featured)
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="featured_boat_box">
                            <h3>{{ ucfirst($featured->boat_name).' '.$featured->model }}</h3>
                            <img src="{{ $featured->getFirstMediaUrl('cover_images') ? $featured->getFirstMediaUrl('cover_images') : 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png' }}" alt="featured-img">
                            <p class="featured_price_mobile">{{ $featured->onboard_capacity }} Guests | Price from {{ getListingPrice($featured->slug) }}</p>
                            <a class="book_now_btn" href="{{ route('singleboat', ['city' => $featured->city, 'type' => $featured->type, 'slug' => $featured->slug]) }}"><img src="{{ asset('app-assets/site_assets/img/arrow-icon01.png') }}" alt="featured-img"> Book Now</a>
                        </div>
                    </div>
                 @endforeach
            @endif
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
                        <p>Browse all our listings using the search tool. Enjoy complete peace of mind with
                            MyBoatBooker, providing you with a safe, secure, and worry-free boating experience. Whether
                            you're a seasoned sailor or a first-time boater, we ensure that every aspect of your journey
                            is well taken care of. With our reliable services, you can focus on enjoying the open water
                            while we handle the details, offering you the confidence and support you deserve throughout
                            your entire boating adventure.</p>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <div class="boat_renter_text">
                        <p>Reach out to yacht owners at no cost and get answers to all your questions about the boat, its equipment, and availability through our built-in messaging system.</p>
                        <i class="fa-solid fa-message"></i>
                    </div>
                    <div class="boat_renter_text">
                        <p>Securely book the yacht of your dreams online in just a few clicks. You’ll only be charged
                            once the owner approves your charter request. With 100% secure payment, MyBoatBooker acts as
                            your trusted third party every step of the way.</p>
                        <i class="fa-solid fa-thumbs-up"></i>
                    </div>
                    <div class="find_boat_btn">
                        <a href="{{ route('search') }}">Find a boat</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="boat_renter_box box-two">
                    <h2>Boat owner</h2>
                    <div class="boat_renter_text">
                        <p>List your boat for free and make it available to a wide range of people seeking the perfect
                            charter experience. Whether you own a luxurious yacht, a sleek sailboat, a versatile RIB, a
                            powerful motorboat, or a spacious catamaran, MyBoatBooker offers a seamless platform to
                            connect you with potential renters.</p>
                        <i class="fa-solid fa-sailboat"></i>
                    </div>
                    <div class="boat_renter_text">
                        <p>Charter your boat on your own terms, to whoever you choose, whenever it suits you, and at the
                            price you set. MyBoatBooker helps you earn income from your yacht and offset maintenance and
                            operating costs.</p>
                        <i class="fa-solid fa-location-crosshairs"></i>
                    </div>
                    <div class="boat_renter_text">
                        <p>Why register your boat with MyBoatBooker? By listing your boat with us, you open up
                            opportunities to earn income, increase your boat’s visibility, and make it available to a
                            wide range of potential charterers. Enjoy a hassle-free experience with trusted bookings,
                            secure payments, and the peace of mind that comes with our reliable platform.</p>
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="estimate_btn">
                        <a href="{{ route('boatlogin') }}">Register your boat</a>
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
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <a href="{{ route('locationlisting','Ibiza') }}">
                        <div class="boat_by_location_box">
                            <div class="boat_by_location_text">
                                <h3>Marina Santa Eulalia</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <a href="{{ route('locationlisting','Guadeloupe') }}">
                        <div class="boat_by_location_box">
                            <div class="boat_by_location_text">
                                <h3>Puerto Sant Antoni </h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <a href="{{ route('locationlisting','Italy') }}">
                        <div class="boat_by_location_box">
                            <div class="boat_by_location_text">
                                <h3>Marina Ibiza</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <a href="{{ route('locationlisting','Dubai') }}">
                        <div class="boat_by_location_box">
                            <div class="boat_by_location_text">
                                <h3>Marina Botafoch</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <a href="{{ route('locationlisting','Croatia') }}">
                        <div class="boat_by_location_box">
                            <div class="boat_by_location_text">
                                <h3> Ibiza Magna</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
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
        <h2>Amazing Tales Shared <br> by sailors</h2>
        <div class="row home_review_slider">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="follow_sailer_box">
                    <div class="custmer_revie">
                        <!-- <div class="custmer_img">
                            <img src="{{ asset('app-assets/site_assets/img/testimonial-img.png') }}">
                        </div> -->
                        <div class="custmer_text">
                            <div class="follow_rating">
                                <h5>Thomas</h5>
                                <ul>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                </ul>
                            </div>
                            <p>Jan 2025 Ibiza boat rental in Santa Eulalia, Ibiza.</p>
                        </div>
                    </div>
                    <p class="follow_main_text more">
                        We had a great boat trip to Formentera a couple of weeks ago. The boat itself was
                        immaculate—clean, spacious, and felt brand new, which made the experience even more enjoyable.
                        Jay was fantastic, making sure we felt completely at ease from the start. They were attentive,
                        offering drinks throughout the trip and ensuring we were comfortable. The captain was excellent,
                        providing a smooth and safe journey and stopping in great spots around the island of formentera.
                        Overall, it was a perfect day on the water, highly recommend Jay’s boat.
                    </p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="follow_sailer_box">
                    <div class="custmer_revie">
                        <!-- <div class="custmer_img">
                            <img src="{{ asset('app-assets/site_assets/img/testimonial-img.png') }}">
                        </div> -->
                        <div class="custmer_text">
                            <div class="follow_rating">
                                <h5>Chris</h5>
                                <ul>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                </ul>
                            </div>
                            <p>Jan 2025 Ibiza boat rental in San Anotnio, Ibiza.</p>
                        </div>
                    </div>
                    <p class="follow_main_text more">We recently rented Hugo's yacht for a day trip from Ibiza to
                        Formentera,
                        and it was an unforgettable experience! The yacht itself is stunning—sleek, modern, and
                        incredibly spacious, making it perfect for our large group. The staff was another highlight of
                        the trip. They were attentive, friendly, and went above and beyond to make sure we had
                        everything we needed. From drinks and snacks to local knowledge about the best spots to visit in
                        Formentera, they truly made the day special. I highly recommend renting this yacht for anyone
                        looking to explore the beautiful Balearic Islands in style and comfort!!</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="follow_sailer_box">
                    <div class="custmer_revie">
                        <!-- <div class="custmer_img">
                            <img src="{{ asset('app-assets/site_assets/img/testimonial-img.png') }}">
                        </div> -->
                        <div class="custmer_text">
                            <div class="follow_rating">
                                <h5>Helena</h5>
                                <ul>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                </ul>
                            </div>
                            <p>Jan 2025 Ibiza boat rental in Marina Botafoch, Ibiza.</p>
                        </div>
                    </div>
                    <p class="follow_main_text more">The Captain & Staff where fantastic. Excellent communication before
                        the
                        trip, helped organise the itinerary and communicated with the lunch restaurant. Stunning
                        location and great clean and spacious boat. Will be back and highly recommend</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="follow_sailer_box">
                    <div class="custmer_revie">
                        <!-- <div class="custmer_img">
                            <img src="{{ asset('app-assets/site_assets/img/testimonial-img.png') }}">
                        </div> -->
                        <div class="custmer_text">
                            <div class="follow_rating">
                                <h5>Paul</h5>
                                <ul>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                </ul>
                            </div>
                            <p>Jan 2025 Ibiza boat rental in Marina Ibiza, Ibiza.</p>
                        </div>
                    </div>
                    <p class="follow_main_text more">Most amazing day on the water. The girls found us on the port and
                        walked
                        us to the right boat. Alfonso assisted us with anything we needed while on the water. We went to
                        the most beautiful spots and there were no restrictions with what we could do on board.
                        Everything we needed was provided for us. 10/10 experience</p>
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
            @if($locations)
            @foreach($locations as $locations)
            <div class="location_slide">
                <a href="{{ route('area', $locations->slug) }}">
                    <div class="home_page_slider_box">
                        <img src="{{ $locations->getFirstMediaUrl('location_image') }}" class="image">
                        <div class="home_page_box_text">
                            <h2>{{ $locations->name }}</h2>
                            <p>{{ $locations->description_for_home_pape }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            @endif
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
            <a href="{{ route('blogs') }}">View All Blogs</a>
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
$(window).scroll(function() {
    if ($(this).scrollTop() > 120) {
        $('.header').addClass('fixed');
    } else {
        $('.header').removeClass('fixed');
    }
});
</script>

@endsection