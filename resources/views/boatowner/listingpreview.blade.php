@extends('layouts.front.common') @section('meta')
<title>Motorboat Quicksilver 675 Open 150hp</title>
@endsection @section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
@endsection @section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAli6rCJivgzTbWznnkqFtT_btPww6WBYs&callback=initMap" async defer></script>
    <script type="text/javascript">
        let map;
        let marker;
        function initMap() 
        {
            map = new google.maps.Map(document.getElementById("map"),{
                zoom: 12
            });
            marker = new google.maps.Marker({
                map: map,
                title: "City Location"
            });
            fetchCityCoordinates("{{ $listing->city }}"); 
        }
        function fetchCityCoordinates(cityName) 
        {
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({ address: cityName }, function(results, status) 
            {
                if (status === google.maps.GeocoderStatus.OK) 
                {
                    const cityLocation = results[0].geometry.location;
                    const lat = cityLocation.lat();
                    const lng = cityLocation.lng();
                    map.setCenter(cityLocation);
                    marker.setPosition(cityLocation);
                    marker.setTitle(cityName);
                } 
                else
                {
                    alert("City not found: " + status);
                }
            });
        }
        $(document).ready(function() 
        {
            $('.see-price').click(function(){
                if($('#price-list').hasClass('open'))
                {
                    $('#price-list').removeClass('open');
                }
                else
                {
                    $('#price-list').addClass('open');
                }
            });
            $('#closeMenu').click(function(){
                $('#price-list').removeClass('open');
            });
        });
        function formatDate(date) {
        const day = ("0" + date.getDate()).slice(-2);
        const month = ("0" + (date.getMonth() + 1)).slice(-2);
        const year = date.getFullYear();
        return `${day}-${month}-${year}`;
        }
        flatpickr("#inline-datepicker", {
            mode: "range",
            inline: true,
            dateFormat: "Y-m-d",
            multipleMonth: true,
            showMonths: 2,
            monthSelectorType: "static",
            minDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                if(selectedDates.length === 2) {
                    const checkIn = formatDate(selectedDates[0]);
                    const checkOut = formatDate(selectedDates[1]);
                    document.getElementById('checkin-date').value = checkIn;
                    document.getElementById('checkout-date').value = checkOut;
                    $.ajax({
                        url: '{{ route('getbookingprice') }}',
                        type: 'GET',
                        data: {checkindate: checkIn, checkoutdate: checkOut, id: {{ $listing->id }}},
                        success: function(response) {
                            if(response.status) {
                            $('#show-Price-sec').removeClass('d-none');
                            $('#days-val').val(response.days);
                            $('#total-days').html(response.days);
                            $('#charter-pice').html(response.price);
                            $('#charter-fee').html(response.servive_fee);
                            $('#charter-total').html(response.totalAmount);
                            }
                            else
                            {
                            $('#price_display').html('<p>Price not available.</p>');
                            }
                        },
                        error: function() {
                            $('#price_display').html('<p>Error fetching price.</p>');
                        }
                    });
                }
            }
        });
        flatpickr("#inline-datepicker-mobile", {
            mode: "range",
            inline: true,
            dateFormat: "Y-m-d",
            multipleMonth: true,
            showMonths: 1,
            monthSelectorType: "static",
            minDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                if(selectedDates.length === 2) {
                    const checkIn = formatDate(selectedDates[0]);
                    const checkOut = formatDate(selectedDates[1]);
                    document.getElementById('checkin-date').value = checkIn;
                    document.getElementById('checkout-date').value = checkOut;
                    $.ajax({
                        url: '{{ route('getbookingprice') }}',
                        type: 'GET',
                        data: {checkindate: checkIn, checkoutdate: checkOut, id: {{ $listing->id }}},
                        success: function(response) {
                            if(response.status) {
                            $('#show-Price-sec').removeClass('d-none');
                            $('#days-val').val(response.days);
                            $('#total-days').html(response.days);
                            $('#charter-pice').html(response.price);
                            $('#charter-fee').html(response.servive_fee);
                            $('#charter-total').html(response.totalAmount);
                            }
                            else
                            {
                            $('#price_display').html('<p>Price not available.</p>');
                            }
                        },
                        error: function() {
                            $('#price_display').html('<p>Error fetching price.</p>');
                        }
                    });
                }
            }
        });
        
        $(document).ready(function() {
        $(document).on('change','#checkin-date, #checkout-date',function(){
            var checkindate = $('#checkin-date').val();
            var checkoutdate = $('#checkout-date').val();
            $.ajax({
                url: '{{ route('getbookingprice') }}',
                type: 'GET',
                data: {checkindate: checkindate, checkoutdate: checkoutdate, id: {{ $listing->id }}},
                success: function(response) {
                    if (response.status) {
                    $('#show-Price-sec').removeClass('d-none');
                    $('#days-val').val(response.days);
                    $('#total-days').html(response.days);
                    $('#charter-pice').html(response.price);
                    $('#charter-fee').html(response.servive_fee);
                    $('#charter-total').html(response.totalAmount);
                    }
                    else
                    {
                    $('#price_display').html('<p>Price not available.</p>');
                    }
                },
                error: function() {
                    $('#price_display').html('<p>Error fetching price.</p>');
                }
            });
        })
        });
    </script>
@endsection @section('content')
<section class="single_boat_banner"></section>
<nav aria-label="Page breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Yacht hire > Hire a boat in Greece with or without a licence  > Skiathos</li>
    </ol>
</nav>
<!-- end .b-title-page-->
<div class="l-main-content">
    <section class="boat-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Yacht charter in {{ $listing->city }} · {{ $listing->model }} — {{ $listing->manufacturer }} Open (2023)</h1>
                </div>
            </div>
            <div class="row">
                <div class="text-center col-md-12">
                    <ul class="rating-menus">
                        <li>
                            <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M14.6666 6.66666C14.6666 4.99999 10.6666 2.66666 7.99998 2.66666C5.33331 2.66666 1.33331 4.99999 1.33331 6.66666C1.33331 7.56633 1.6247 8.466 2.20748 9.36568C4.13831 8.89966 6.06915 8.66666 7.99998 8.66666C9.89884 8.66666 11.7977 8.89201 13.6965 9.34271C14.3433 8.12733 14.6666 7.23531 14.6666 6.66666ZM7.99998 9.99999C9.77776 9.99999 11.5555 10.2222 13.3333 10.6667C12.2222 12.4444 10.4444 13.3333 7.99998 13.3333C5.55554 13.3333 3.77776 12.4444 2.66665 10.6667C4.44442 10.2222 6.2222 9.99999 7.99998 9.99999ZM7.99998 6.66666C8.55226 6.66666 8.99998 6.21894 8.99998 5.66666C8.99998 5.11437 8.55226 4.66666 7.99998 4.66666C7.44769 4.66666 6.99998 5.11437 6.99998 5.66666C6.99998 6.21894 7.44769 6.66666 7.99998 6.66666Z"
                                ></path>
                            </svg>
                            {{ $listing->skipper }}
                        </li>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_1028_12450" style="mask-type: alpha;" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                                    <rect width="16" height="16" fill="#D9D9D9"></rect>
                                </mask>
                                <g mask="url(#mask0_1028_12450)">
                                    <path
                                        d="M3.33333 12.5667C3.93333 11.9778 4.63056 11.5139 5.425 11.175C6.21944 10.8361 7.07778 10.6667 8 10.6667C8.92222 10.6667 9.78056 10.8361 10.575 11.175C11.3694 11.5139 12.0667 11.9778 12.6667 12.5667V4.00001H3.33333V12.5667ZM8 9.33334C7.35556 9.33334 6.80556 9.10557 6.35 8.65001C5.89444 8.19445 5.66667 7.64445 5.66667 7.00001C5.66667 6.35557 5.89444 5.80557 6.35 5.35001C6.80556 4.89445 7.35556 4.66668 8 4.66668C8.64444 4.66668 9.19445 4.89445 9.65 5.35001C10.1056 5.80557 10.3333 6.35557 10.3333 7.00001C10.3333 7.64445 10.1056 8.19445 9.65 8.65001C9.19445 9.10557 8.64444 9.33334 8 9.33334ZM3.33333 14.6667C2.96667 14.6667 2.65278 14.5361 2.39167 14.275C2.13056 14.0139 2 13.7 2 13.3333V4.00001C2 3.63334 2.13056 3.31945 2.39167 3.05834C2.65278 2.79723 2.96667 2.66668 3.33333 2.66668H4V1.33334H5.33333V2.66668H10.6667V1.33334H12V2.66668H12.6667C13.0333 2.66668 13.3472 2.79723 13.6083 3.05834C13.8694 3.31945 14 3.63334 14 4.00001V13.3333C14 13.7 13.8694 14.0139 13.6083 14.275C13.3472 14.5361 13.0333 14.6667 12.6667 14.6667H3.33333Z"
                                    ></path>
                                </g>
                            </svg>
                            Professional
                        </li>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M8.02606 3.57293L8.02601 3.57493L8.02454 3.57661L8.02285 3.57809L8.02085 3.57814L8.01885 3.57809L8.01717 3.57661L8.01569 3.57493L8.01565 3.57293L8.01569 3.57093L8.01717 3.56924L8.01885 3.56777L8.02085 3.56772L8.02285 3.56777L8.02454 3.56924L8.02601 3.57093L8.02606 3.57293ZM9.00002 5.32322C9.61228 4.97997 10.0261 4.32477 10.0261 3.57293C10.0261 2.46548 9.1283 1.56772 8.02085 1.56772C6.91341 1.56772 6.01565 2.46548 6.01565 3.57293C6.01565 4.30759 6.41073 4.94997 7.00002 5.2992V5.71355L5.35419 5.71355V7.71355H7.00002L7.00002 12.6487C6.77579 12.5955 6.55563 12.5244 6.34173 12.4358C5.81598 12.218 5.33828 11.8988 4.93589 11.4964C4.5335 11.094 4.21431 10.6163 3.99654 10.0906C3.77877 9.56485 3.66669 9.00136 3.66669 8.4323H1.66669C1.66669 9.26401 1.8305 10.0876 2.14878 10.856C2.46706 11.6244 2.93357 12.3225 3.52168 12.9106C4.10978 13.4987 4.80796 13.9653 5.57636 14.2835C6.34475 14.6018 7.16831 14.7656 8.00002 14.7656C8.83172 14.7656 9.65529 14.6018 10.4237 14.2835C11.1921 13.9653 11.8903 13.4988 12.4784 12.9106C13.0665 12.3225 13.533 11.6244 13.8513 10.856C14.1695 10.0876 14.3334 9.26401 14.3334 8.4323H12.3334C12.3334 9.00136 12.2213 9.56485 12.0035 10.0906C11.7857 10.6163 11.4665 11.094 11.0641 11.4964C10.6618 11.8988 10.1841 12.218 9.65831 12.4358C9.44441 12.5244 9.22426 12.5955 9.00002 12.6487L9.00002 7.71355H10.6875V5.71355L9.00002 5.71355V5.32322Z"
                                ></path>
                            </svg>
                            Zudika
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <ul class="share-menu">
                        <li>
                            <a href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor" d="M8 7L9.41 8.41L11 6.83V15H13V6.83L14.58 8.41L16 7L12 3L8 7ZM5 19L5 12H3L3 19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V12H19V19H5Z"></path>
                                </svg>
                                Share
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0V0z"></path>
                                    <path
                                        d="M19.66 3.99c-2.64-1.8-5.9-.96-7.66 1.1-1.76-2.06-5.02-2.91-7.66-1.1-1.4.96-2.28 2.58-2.34 4.29-.14 3.88 3.3 6.99 8.55 11.76l.1.09c.76.69 1.93.69 2.69-.01l.11-.1c5.25-4.76 8.68-7.87 8.55-11.75-.06-1.7-.94-3.32-2.34-4.28zM12.1 18.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z"
                                    ></path>
                                </svg>
                                Add to favorites
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="boat-banner-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    @php 
                        $gallery_images = $listing->getMedia('listing_gallery'); 
                        $image = $listing->getFirstMediaUrl('cover_images'); 
                        if(!$image) 
                        { 
                            $image ='https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png'; 
                        } 
                        $profileImage = $listing->user->getFirstMediaUrl('profile_image'); 
                    @endphp
                    <div class="banner-first-image">
                        <a href="#"><img src="{{ $image }}" alt="Image" class="img-fluid" /></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="banner-grid-image">
                        @if(count($gallery_images)) 
                            @foreach ($gallery_images as $gallery_image) 
                                @if ($loop->iteration >= 1 && $loop->iteration <= 4)
                                    <a href="#"><img src="{{ $gallery_image->getUrl() }}" alt="Image" class="img-fluid" /></a>
                                @endif 
                            @endforeach 
                        @else
                            <a href="#"><img src="{{ asset('app-assets/site_assets/img/feature-img-3.jpg') }}" alt="Image" class="img-fluid" /></a>
                            <a href="#"><img src="{{ asset('app-assets/site_assets/img/feature-img-3.jpg') }}" alt="Image" class="img-fluid" /></a>
                            <a href="#"><img src="{{ asset('app-assets/site_assets/img/feature-img-3.jpg') }}" alt="Image" class="img-fluid" /></a>
                            <a href="#"><img src="{{ asset('app-assets/site_assets/img/feature-img-3.jpg') }}" alt="Image" class="img-fluid" /></a>
                        @endif {{--
                        <div class="view-more-photos">
                            <a href="#"> View the photos (+10)</a>
                        </div>
                        --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="boat-content-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-8 boat-left-sec">
                    <div class="boat-card-content-sec">
                        <div class="specification-box">
                            <div class="specification-content">
                                <h3>{{ $listing->type }} owned by {{ $listing->user->name }}</h3>
                                <ul class="specification-menus">
                                    <li>{{ $listing->capacity }} people</li>
                                    <li>{{ $listing->otherListingSetting->horsepower ?? '' }} horsepower</li>
                                    <li>{{ $listing->length }} meters</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="boat-card-content-sec">
                        <div class="keyinfo-sec">
                            <div class="keyinfo-icon">
                                <svg width="32" height="32" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M24 30C29.3333 30 34.6667 30.6667 40 32C36.6667 37.3333 31.3333 40 24 40C16.6667 40 11.3333 37.3333 8 32C13.3333 30.6667 18.6667 30 24 30ZM24 32C19.8242 32 15.6471 32.4219 11.4669 33.2664C14.4031 36.4291 18.5331 38 24 38C29.3061 38 33.3528 36.5202 36.271 33.5413L36.5331 33.2664L35.5685 33.079C31.7103 32.3595 27.8546 32 24 32ZM24 8C32 8 44 17 44 20C44 22 42.6667 25.3333 40 30C34.6667 28.6667 29.3333 28 24 28C18.6667 28 13.3333 28.6667 8 30C5.33333 26.6667 4 23.3333 4 20C4 15 16 8 24 8ZM24 10C16.8548 10 6 16.445 6 20C6 22.5279 6.91745 25.1036 8.80456 27.7499C13.8663 26.5837 18.9323 26 24 26C28.9999 26 33.9982 26.5682 38.9923 27.7035L39.3855 26.9717C41.0294 23.8637 41.8931 21.5787 41.9907 20.2437L41.9985 20.0939L41.9646 20.0164C41.9245 19.932 41.8656 19.8274 41.7878 19.7067C41.5296 19.3063 41.1176 18.8121 40.577 18.2648C39.412 17.0852 37.7606 15.7663 35.9027 14.5471C31.6788 11.7752 27.1941 10 24 10ZM24 13C24.5128 13 24.9355 13.386 24.9933 13.8834L25 14V15H26C26.5128 15 26.9355 15.386 26.9933 15.8834L27 16C27 16.5128 26.614 16.9355 26.1166 16.9933L26 17H25V21C26.0544 21 26.9182 20.1841 26.9945 19.1493L27 19L27.0067 18.8834C27.0645 18.386 27.4872 18 28 18C28.5523 18 29 18.4477 29 19C29 21.1422 27.316 22.8911 25.1996 22.9951L25 23H23C20.7909 23 19 21.2091 19 19L19.0067 18.8834C19.0645 18.386 19.4872 18 20 18C20.5128 18 20.9355 18.386 20.9933 18.8834L21 19C21 20.1046 21.8954 21 23 21V17H22L21.8834 16.9933C21.386 16.9355 21 16.5128 21 16C21 15.4872 21.386 15.0645 21.8834 15.0067L22 15H23V14L23.0067 13.8834C23.0645 13.386 23.4872 13 24 13Z"
                                    ></path>
                                </svg>
                            </div>
                            <div class="keyinfo-texts">
                                <h4>{{ $listing->skipper }}</h4>
                                <p>A boating license is needed if you opt to sail without a skipper.</p>
                            </div>
                        </div>
                        <div class="keyinfo-sec">
                            <div class="keyinfo-icon">
                                <!-- <svg width="32" height="32" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M15 42L14.8834 41.9933C14.386 41.9355 14 41.5128 14 41C14 40.4872 14.386 40.0645 14.8834 40.0067L15 40H23L23.0002 31.9534C18.814 31.5609 15.3391 28.7326 14.3101 24.9778C8.76137 24.627 6 19.9758 6 12C6 10.9456 6.81588 10.0818 7.85074 10.0055L8 10H14V8C14 6.94564 14.8159 6.08183 15.8507 6.00549L16 6H32C33.0544 6 33.9182 6.81588 33.9945 7.85074L34 8V10H40C41.1046 10 42 10.8954 42 12C42 19.9758 39.2386 24.627 33.6911 24.9785C32.6609 28.7323 29.1866 31.5605 25.0008 31.9533L25 40H33C33.5523 40 34 40.4477 34 41C34 41.5523 33.5523 42 33 42H15ZM32 8H16V22.6667C16 26.7 19.6 30 24 30C28.3154 30 31.8612 26.8257 31.996 22.8985L32 22.6667V8ZM14 12H8L8.00215 12.3826C8.07654 18.9285 10.0771 22.4477 14.0038 22.94L14.004 22.9336L14 22.6667V12ZM40 12H34V22.6667C34 22.758 33.9986 22.849 33.9958 22.9396C37.9229 22.4477 39.9235 18.9285 39.9978 12.3826L40 12Z"
                                    ></path>
                                </svg> -->
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <div class="keyinfo-texts">
                                <h4>Super owner</h4>
                                <p>As a dedicated boat renter with great reviews, Mario ensures that they provide high quality services.</p>
                            </div>
                        </div>
                    </div>
                    <div class="boat-card-content-sec">
                        <div class="boat-description-sec">
                            <h3>Description of {{ $listing->user->name }}'s {{ $listing->type }}</h3>
                            <p class="boat_des_heading">{{ $listing->type }} {{ $listing->boat_name }} Open 705 {{ optional($listing->otherListingSetting)->horsepower }}hp</p>
                            <h6>{{ $listing->title }}</h6>
                            <p>
                                 {{ optional($listing->description[0] ?? null)->description }} 
                            </p>
                            {{-- <a href="">Read More</a> --}}
                        </div>
                    </div>
                    <div class="boat-card-content-sec">
                        <div class="equipment-sec">
                            <h3>Equipment available on the {{ $listing->type }}</h3>
                            <ul class="equip-menus">
                                <li>
                                    <svg width="28" height="28" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 7C10.4477 7 10 7.44771 10 8V40H12V8C12 7.44772 11.5523 7 11 7Z"></path>
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M37.6075 38.7258C41.0298 33.479 40.7404 25.2323 36.9999 18.5318C33.2144 11.7505 25.84 6.42244 14.9423 7.05292C14.5688 7.07452 14.2387 7.30272 14.0865 7.64442C13.9343 7.98612 13.9856 8.38417 14.2193 8.67618C17.7279 13.0591 19.8623 17.0614 20.1873 21.5192C20.5123 25.9777 19.0395 31.071 14.9427 37.6509C14.7815 37.9099 14.7473 38.2282 14.8498 38.5156C14.9523 38.8029 15.1804 39.0276 15.4692 39.126C19.0964 40.3618 22.0792 41 25.3902 41C28.6826 41 32.2421 40.3685 37.0175 39.1483C37.2601 39.0863 37.4707 38.9355 37.6075 38.7258ZM22.182 21.3738C21.8572 16.919 19.9333 12.9767 16.9967 9.00416C25.9999 9.11196 32.0409 13.7515 35.2536 19.5066C38.6537 25.5974 38.8362 32.817 36.1355 37.3088C31.6131 38.4493 28.3472 39 25.3902 39C22.7182 39 20.2538 38.5501 17.3013 37.6222C21.0329 31.3427 22.5298 26.1446 22.182 21.3738Z"
                                        ></path>
                                    </svg>
                                    Bimini
                                </li>
                                <li>
                                    <i class="fa-solid fa-shower"></i>
                                    Outdoor shower
                                </li>
                                <li>
                                <i class="fa-solid fa-table"></i>
                                    Cockpit table
                                </li>
                                <li>
                                    <svg width="28" height="28" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 7C10.4477 7 10 7.44771 10 8V40H12V8C12 7.44772 11.5523 7 11 7Z"></path>
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M37.6075 38.7258C41.0298 33.479 40.7404 25.2323 36.9999 18.5318C33.2144 11.7505 25.84 6.42244 14.9423 7.05292C14.5688 7.07452 14.2387 7.30272 14.0865 7.64442C13.9343 7.98612 13.9856 8.38417 14.2193 8.67618C17.7279 13.0591 19.8623 17.0614 20.1873 21.5192C20.5123 25.9777 19.0395 31.071 14.9427 37.6509C14.7815 37.9099 14.7473 38.2282 14.8498 38.5156C14.9523 38.8029 15.1804 39.0276 15.4692 39.126C19.0964 40.3618 22.0792 41 25.3902 41C28.6826 41 32.2421 40.3685 37.0175 39.1483C37.2601 39.0863 37.4707 38.9355 37.6075 38.7258ZM22.182 21.3738C21.8572 16.919 19.9333 12.9767 16.9967 9.00416C25.9999 9.11196 32.0409 13.7515 35.2536 19.5066C38.6537 25.5974 38.8362 32.817 36.1355 37.3088C31.6131 38.4493 28.3472 39 25.3902 39C22.7182 39 20.2538 38.5501 17.3013 37.6222C21.0329 31.3427 22.5298 26.1446 22.182 21.3738Z"
                                        ></path>
                                    </svg>
                                    Bow sundeck
                                </li>
                                <li>
                                    <svg width="28" height="28" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 7C10.4477 7 10 7.44771 10 8V40H12V8C12 7.44772 11.5523 7 11 7Z"></path>
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M37.6075 38.7258C41.0298 33.479 40.7404 25.2323 36.9999 18.5318C33.2144 11.7505 25.84 6.42244 14.9423 7.05292C14.5688 7.07452 14.2387 7.30272 14.0865 7.64442C13.9343 7.98612 13.9856 8.38417 14.2193 8.67618C17.7279 13.0591 19.8623 17.0614 20.1873 21.5192C20.5123 25.9777 19.0395 31.071 14.9427 37.6509C14.7815 37.9099 14.7473 38.2282 14.8498 38.5156C14.9523 38.8029 15.1804 39.0276 15.4692 39.126C19.0964 40.3618 22.0792 41 25.3902 41C28.6826 41 32.2421 40.3685 37.0175 39.1483C37.2601 39.0863 37.4707 38.9355 37.6075 38.7258ZM22.182 21.3738C21.8572 16.919 19.9333 12.9767 16.9967 9.00416C25.9999 9.11196 32.0409 13.7515 35.2536 19.5066C38.6537 25.5974 38.8362 32.817 36.1355 37.3088C31.6131 38.4493 28.3472 39 25.3902 39C22.7182 39 20.2538 38.5501 17.3013 37.6222C21.0329 31.3427 22.5298 26.1446 22.182 21.3738Z"
                                        ></path>
                                    </svg>
                                    External speakers
                                </li>
                            </ul>
                            <div class="equip-button-sec">
                                <a href="#" class="equip_btn" data-toggle="modal" data-target="#equipment-modal">View all equipment</a>
                            </div>
                        </div>
                    </div>
                    <div class="boat-card-content-sec">
                        <div class="equipment-sec">
                            <h3>Services provided by Mario</h3>
                            <ul class="equip-menus">
                                <li>
                                    <svg width="28" height="28" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M24 30C29.3333 30 34.6667 30.6667 40 32C36.6667 37.3333 31.3333 40 24 40C16.6667 40 11.3333 37.3333 8 32C13.3333 30.6667 18.6667 30 24 30ZM24 32C19.8242 32 15.6471 32.4219 11.4669 33.2664C14.4031 36.4291 18.5331 38 24 38C29.3061 38 33.3528 36.5202 36.271 33.5413L36.5331 33.2664L35.5685 33.079C31.7103 32.3595 27.8546 32 24 32ZM24 8C32 8 44 17 44 20C44 22 42.6667 25.3333 40 30C34.6667 28.6667 29.3333 28 24 28C18.6667 28 13.3333 28.6667 8 30C5.33333 26.6667 4 23.3333 4 20C4 15 16 8 24 8ZM24 10C16.8548 10 6 16.445 6 20C6 22.5279 6.91745 25.1036 8.80456 27.7499C13.8663 26.5837 18.9323 26 24 26C28.9999 26 33.9982 26.5682 38.9923 27.7035L39.3855 26.9717C41.0294 23.8637 41.8931 21.5787 41.9907 20.2437L41.9985 20.0939L41.9646 20.0164C41.9245 19.932 41.8656 19.8274 41.7878 19.7067C41.5296 19.3063 41.1176 18.8121 40.577 18.2648C39.412 17.0852 37.7606 15.7663 35.9027 14.5471C31.6788 11.7752 27.1941 10 24 10ZM24 13C24.5128 13 24.9355 13.386 24.9933 13.8834L25 14V15H26C26.5128 15 26.9355 15.386 26.9933 15.8834L27 16C27 16.5128 26.614 16.9355 26.1166 16.9933L26 17H25V21C26.0544 21 26.9182 20.1841 26.9945 19.1493L27 19L27.0067 18.8834C27.0645 18.386 27.4872 18 28 18C28.5523 18 29 18.4477 29 19C29 21.1422 27.316 22.8911 25.1996 22.9951L25 23H23C20.7909 23 19 21.2091 19 19L19.0067 18.8834C19.0645 18.386 19.4872 18 20 18C20.5128 18 20.9355 18.386 20.9933 18.8834L21 19C21 20.1046 21.8954 21 23 21V17H22L21.8834 16.9933C21.386 16.9355 21 16.5128 21 16C21 15.4872 21.386 15.0645 21.8834 15.0067L22 15H23V14L23.0067 13.8834C23.0645 13.386 23.4872 13 24 13Z"
                                        ></path>
                                    </svg>
                                    Skipper
                                </li>
                            </ul>
                            <div class="equip-button-sec">
                                <a href="#" class="equip_btn" data-toggle="modal" data-target="#services-modal">View all services</a>
                            </div>
                        </div>
                    </div>
                    <div class="boat-card-content-sec">
                        <div class="calendar-sec">
                            <h3>Calendar</h3>
                            <p>Add dates for prices</p>
                            <div class="calendar-btn-sec">
                                <a href="javascript:;" class="see-price"> See the price list</a>
                            </div>
                            <div class="datepicker-desktop">
                                <div id="inline-datepicker"></div>
                            </div>
                            <div class="datepicker-mobile">
                                <div id="inline-datepicker-mobile"></div>
                            </div>
                            <a href="#" class="delete_dates">Delete the dates</a>
                        </div>
                    </div>
                    <div class="boat-card-content-sec">
                        <div class="ideas-sec">
                            @php 
                                $image = $listing->user->getFirstMediaUrl('profile_image');
                                if(!$image):
                                    $image = 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
                                endif;
                                $join_date = \Carbon\Carbon::parse($listing->user->created_at)->format('F Y');
                                $textP = '';
                                if($listing->professional === 'Yes'):
                                    $textP = '<span> Professional owner</span>';
                                endif;
                            @endphp
                            <div class="idea_Sec_img">
                                <img src="{{ $image }}" />
                            </div>
                            <div class="idea_sec_text">
                                <h3>{{ $listing->user->name }}</h3>
                                <p>Joined in {{ $join_date }} {!!  $textP !!}</p>
                            </div>
                        </div>
                        <ul class="offered_rating">
                            <li><i class="fa-solid fa-star"></i> 4.8 (31 reviews)</li>
                            <li><i class="fa-solid fa-square-check"></i> Verified profile</li>
                        </ul>
                        <p class="about_heading">About me</p>
                        <p>{{ optional($listing->user->exprience)->description }}</p>
                        <a href="#" class="read_more-btn">Read More</a>
                        <div class="offere_language">
                            <p><i class="fa-solid fa-language"></i> Language spoken: <span class="offered_language_style">English</span></p>
                            <p><i class="fa-regular fa-clock"></i> Response time: within a few hours</p>
                        </div>
                        <div class="contact_own_btn">
                        <a href="#" class="contact_owner_btn">Contact Owner</a>
                        </div>
                    </div>
                    <div class="boat-card-content-sec">
                        <div class="location-sec">
                            <h3>Location</h3>
                            <p>Location of the motorboat: {{ $listing->city }}</p>
                            <div id="map"></div>
                        </div>
                    </div>
                    <div class="boat-card-content-sec">
                        <div class="feature-sec">
                            <h3>Features</h3>
                            <ul class="features-menus">
                                <li>
                                    Manufacturer: <strong><a href="#">{{ $listing->manufacturer }}</a></strong>
                                </li>
                                <li>Model: <strong>{{ $listing->model }} Open</strong></li>
                                <li>Engine power: <strong>150hp</strong></li>
                                <li>Length: <strong>{{ $listing->length }} </strong></li>
                                <li>Year: <strong>{{ $listing->construction_year }}</strong></li>
                                <li>Onboard capacity: <strong>{{ $listing->onboard_capacity }} people</strong></li>
                                <li>Number of cabins: <strong>{{ $listing->cabins }}</strong></li>
                                <li>Number of berths: <strong>{{ $listing->berths }}</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 boat-right-sec" id="calender_sec_form">
                    <div class="p-2 shadow-sm card">
                        <div class="text-center d-flex flex-column">
                            <h3>Add dates for prices</h3>
                        </div>
                        <!-- Rating -->
                        <div class="mb-3 text-center see_price_btn">
                            <a href="javascript:;" class="see-price"> See the price list</a>
                        </div>
                        <div class="dates_heading">
                            <p>Dates:</p>
                        </div>
                        <!-- Form for dates -->
                        <form>
                            @csrf
                            <div class="row sidebar_form">
                                <div class="p-0 col-md-6">
                                    <div class="form-group">
                                        <input type="date" disabled name="checkin_date" class="form-control" placeholder="Check-in" />
                                    </div>
                                </div>
                                <div class="p-0 col-md-6">
                                    <div class="form-group">
                                        <input type="date" disabled  class="form-control" name="checkout_date" placeholder="Check-out" />
                                        <input type="hidden"  disabled value="" name="days_val" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex flex-column">
                                <!-- <button class="mb-2 check_ava_btn">Check availability</button> -->
                                <span class="mt-2 mb-2 text-center d-block font-weight-bold">or</span>
                                <button class="btn book_btn" disabled>Book</button>
                                <div class="pt-3 text-center form_text">
                                    <p>You will only be charged if the request is accepted</p>
                                    <p>Pay in 3 or 4 installments without fees with</p>
                                </div>
                            </div>
                        </form>
                        <!-- Price List Link -->
                        <div class="mt-2 text-center">
                            <img src="{{ asset('app-assets/site_assets/img/klarna-logo.jpg') }}" />
                        </div>
                    </div>
                </div>
                <div class="boat-card-content-sec">
                    <div class="feature-sec">
                        <h3>Conditions</h3>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <ul class="features-menu">
                                    <li><strong>Check-in & check-out</strong></li>
                                    <li>Check-in: <strong>{{ optional($listing->booking)->check_in }}</strong></li>
                                    <li>Check-out: <strong>{{ optional($listing->booking)->check_out }}</strong></li>
                                </ul>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <ul class="features-menu">
                                    <li><strong>Rules for the boat</strong></li>
                                    <li>Fuel included in price: <strong>{{ optional($listing->booking)->fuel_cost }}</strong></li>
                                    <li>Boat licence required: <strong>Yes (if hired without a skipper)</strong></li>
                                    <li>Minimum rental age: <strong>18 years old</strong></li>
                                </ul>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <ul class="features-menu">
                                    <li><strong>Cancellation policy</strong></li>
                                    <li>99% refund up to 7 days before arrival, excluding expenses.</li>
                                    <li>Enter your travel dates to see the cancellation policy for this trip.</li>
                                    <li><i class="fa-regular fa-calendar"></i> <a href="#calender_sec_form">Enter dates</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php 
    $lowseason = $listing->price()->where('season_price_id', optional($listing->seasonPrice[0] ?? null)->id)->first();
    $midSeason = $listing->price()->where('season_price_id', optional($listing->seasonPrice[1] ?? null)->id)->first();
    $highSeason = $listing->price()->where('season_price_id', optional($listing->seasonPrice[2] ?? null)->id)->first();     
?>
<div class="offcanvas-right" id="price-list">
    <span class="close-btn" id="closeMenu">&times;</span>
    <h3 class="p-4">Price list</h3>
    <ul class="p-4 list-unstyled">
        @if(optional($listing->price ?? null)->price)
            <li>
                <div class="price_block">
                    <p class="price_block_date">Price </p>
                    <p class="price_block_price">{{ $listing->price->price }}</p>
                </div>
            </li>
        @endif
        @if($lowseason && isset($listing->seasonPrice[0]))
            <li>
                <div class="price_block">
                    <p class="price_block_date">Low Season Price </p>
                    <p class="price_block_date">{{ optional($listing->seasonPrice[0] ?? null)->from ?? '' }} - {{ optional($listing->seasonPrice[0] ?? null)->to ?? '' }} </p>
                    <p class="price_block_price">{{ minMaxPrice($lowseason,$listing->seasonPrice[0]->price) }}</p>
                </div>
            </li>
        @endif
        @if($midSeason && isset($listing->seasonPrice[1]))
            <li>
                <div class="price_block">
                    <p class="price_block_date">Mid Season Price</p>
                    <p class="price_block_date">{{ optional($listing->seasonPrice[1] ?? null)->from ?? '' }} - {{ optional($listing->seasonPrice[1] ?? null)->to ?? '' }} </p>
                    <p class="price_block_price">{{ minMaxPrice($midSeason,$listing->seasonPrice[1]->price) }}</p>
                </div>
            </li>
        @endif
        @if($highSeason && isset($listing->seasonPrice[2]))
            <li>
                <div class="price_block">
                    <p class="price_block_date">High Season Price </p>
                    <p class="price_block_date">{{ optional($listing->seasonPrice[2] ?? null)->from ?? '' }} - {{ optional($listing->seasonPrice[2] ?? null)->to ?? '' }} </p>
                    <p class="price_block_price">{{ minMaxPrice($highSeason,$listing->seasonPrice[2]->price) }}</p>
                </div>
            </li>
        @endif
    </ul>
</div>
<!-- Equipment Modal Start-->
<div class="modal fade equipment-modal" id="equipment-modal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
       <!-- Modal Header -->
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <div class="equipment-title-sec">
                <h4 class="modal-title">Equipment</h4>
                <p class="modal-subtitle">Discover all of the equipment on board this boat.</p>
          </div>
          <div class="equipment-content-sec">
                <h2>On board</h2>
                <div class="equipment-services-sec">
                    <h6>Outdoor equipment</h6>
                    <ul>
                        <li>
                            <svg name="icon-sunshield-48" width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.3578 30.0662L22.4706 30.1176L37.4706 38.1176C37.9579 38.3775 38.1423 38.9833 37.8824 39.4706C37.641 39.9231 37.1015 40.1144 36.6355 39.9313L36.5294 39.8824L22 32.133L7.4706 39.8824C7.0181 40.1237 6.46349 39.982 6.17848 39.5703L6.11766 39.4706C5.87633 39.0181 6.01805 38.4635 6.42969 38.1785L6.52943 38.1176L21.5294 30.1176C21.7868 29.9804 22.0892 29.9632 22.3578 30.0662ZM32 22C32.5523 22 33 22.4477 33 23V25C33 25.5523 32.5523 26 32 26C31.4477 26 31 25.5523 31 25V23C31 22.4477 31.4477 22 32 22ZM27.7574 20.2426C28.1479 20.6332 28.1479 21.2663 27.7574 21.6569L26.3432 23.0711C25.9526 23.4616 25.3195 23.4616 24.9289 23.0711C24.5384 22.6805 24.5384 22.0474 24.9289 21.6569L26.3432 20.2426C26.7337 19.8521 27.3668 19.8521 27.7574 20.2426ZM37.6569 20.2426L39.0711 21.6569C39.4616 22.0474 39.4616 22.6805 39.0711 23.0711C38.6806 23.4616 38.0474 23.4616 37.6569 23.0711L36.2427 21.6569C35.8521 21.2663 35.8521 20.6332 36.2427 20.2426C36.6332 19.8521 37.2663 19.8521 37.6569 20.2426ZM32 12C34.2092 12 36 13.7909 36 16C36 18.2091 34.2092 20 32 20C29.7909 20 28 18.2091 28 16C28 13.7909 29.7909 12 32 12ZM32 14C30.8954 14 30 14.8954 30 16C30 17.1046 30.8954 18 32 18C33.1046 18 34 17.1046 34 16C34 14.8954 33.1046 14 32 14ZM25 15C25.5523 15 26 15.4477 26 16C26 16.5523 25.5523 17 25 17H23C22.4477 17 22 16.5523 22 16C22 15.4477 22.4477 15 23 15H25ZM41 15C41.5523 15 42 15.4477 42 16C42 16.5523 41.5523 17 41 17H39C38.4477 17 38 16.5523 38 16C38 15.4477 38.4477 15 39 15H41ZM39.0711 8.92893C39.4616 9.31946 39.4616 9.95262 39.0711 10.3431L37.6569 11.7574C37.2663 12.1479 36.6332 12.1479 36.2427 11.7574C35.8521 11.3668 35.8521 10.7337 36.2427 10.3431L37.6569 8.92893C38.0474 8.53841 38.6806 8.53841 39.0711 8.92893ZM26.3432 8.92893L27.7574 10.3431C28.1479 10.7337 28.1479 11.3668 27.7574 11.7574C27.3668 12.1479 26.7337 12.1479 26.3432 11.7574L24.9289 10.3431C24.5384 9.95262 24.5384 9.31946 24.9289 8.92893C25.3195 8.53841 25.9526 8.53841 26.3432 8.92893ZM32 6C32.5523 6 33 6.44772 33 7V9C33 9.55228 32.5523 10 32 10C31.4477 10 31 9.55228 31 9V7C31 6.44772 31.4477 6 32 6Z"></path>
                            </svg>
                            Bimini
                        </li>
                        <li>
                            <svg name="icon-table-48" width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path d="M40 38H38V26H33V33H31V26H17V33H15V26H9.99998V38H7.99998V26H5.99998C4.21817 26 3.32584 23.8457 4.58577 22.5858L12.5858 14.5858C12.9608 14.2107 13.4695 14 14 14H34C34.5304 14 35.0391 14.2107 35.4142 14.5858L43.4142 22.5858C44.6741 23.8457 43.7818 26 42 26H40V38ZM34 16H14L5.99998 24H42L34 16Z"></path>
                            </svg>
                            Cockpit table
                        </li>
                        <li>
                            <svg name="icon-speaker-48" width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 8C20.2091 8 22 9.79086 22 12V32C22 34.2091 20.2091 36 18 36H14V40H18V42H8V40H12V36H8C5.79086 36 4 34.2091 4 32V12C4 9.79086 5.79086 8 8 8H18ZM34 36H30C27.7909 36 26 34.2091 26 32V12C26 9.79086 27.7909 8 30 8H40C42.2091 8 44 9.79086 44 12V32C44 34.2091 42.2091 36 40 36H36V40H40V42H30V40H34V36ZM18 10H8C6.94564 10 6.08183 10.8159 6.00549 11.8507L6 12V32C6 33.0544 6.81588 33.9182 7.85074 33.9945L8 34H18C19.0544 34 19.9182 33.1841 19.9945 32.1493L20 32V12C20 10.9456 19.1841 10.0818 18.1493 10.0055L18 10ZM40 10H30C28.9456 10 28.0818 10.8159 28.0055 11.8507L28 12V32C28 33.0544 28.8159 33.9182 29.8507 33.9945L30 34H40C41.0544 34 41.9182 33.1841 41.9945 32.1493L42 32V12C42 10.9456 41.1841 10.0818 40.1493 10.0055L40 10ZM13 21C15.7614 21 18 23.2386 18 26C18 28.7614 15.7614 31 13 31C10.2386 31 8 28.7614 8 26C8 23.2386 10.2386 21 13 21ZM35 21C37.7614 21 40 23.2386 40 26C40 28.7614 37.7614 31 35 31C32.2386 31 30 28.7614 30 26C30 23.2386 32.2386 21 35 21ZM13 23C11.3431 23 10 24.3431 10 26C10 27.6569 11.3431 29 13 29C14.6569 29 16 27.6569 16 26C16 24.3431 14.6569 23 13 23ZM35 23C33.3431 23 32 24.3431 32 26C32 27.6569 33.3431 29 35 29C36.6569 29 38 27.6569 38 26C38 24.3431 36.6569 23 35 23ZM13 25C13.5523 25 14 25.4477 14 26C14 26.5523 13.5523 27 13 27C12.4477 27 12 26.5523 12 26C12 25.4477 12.4477 25 13 25ZM35 25C35.5523 25 36 25.4477 36 26C36 26.5523 35.5523 27 35 27C34.4477 27 34 26.5523 34 26C34 25.4477 34.4477 25 35 25ZM13 13C14.6569 13 16 14.3431 16 16C16 17.6569 14.6569 19 13 19C11.3431 19 10 17.6569 10 16C10 14.3431 11.3431 13 13 13ZM35 13C36.6569 13 38 14.3431 38 16C38 17.6569 36.6569 19 35 19C33.3431 19 32 17.6569 32 16C32 14.3431 33.3431 13 35 13ZM13 15C12.4477 15 12 15.4477 12 16C12 16.5523 12.4477 17 13 17C13.5523 17 14 16.5523 14 16C14 15.4477 13.5523 15 13 15ZM35 15C34.4477 15 34 15.4477 34 16C34 16.5523 34.4477 17 35 17C35.5523 17 36 16.5523 36 16C36 15.4477 35.5523 15 35 15Z"></path>
                            </svg>
                            External speakers
                        </li>
                        <li>
                            <svg name="icon-sunbathFront-48" width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path d="M33 29V30C33 39.8047 26.2288 43.8378 9.06393 43.9952L8 44V42L8.99612 41.996C24.4009 41.8699 30.3852 38.7666 30.9545 31.2481L30.97 31H8V29H33ZM30 20C30.5523 20 31 20.4477 31 21V23C31 23.5523 30.5523 24 30 24C29.4477 24 29 23.5523 29 23V21C29 20.4477 29.4477 20 30 20ZM25.7574 18.2426C26.1479 18.6332 26.1479 19.2663 25.7574 19.6569L24.3431 21.0711C23.9526 21.4616 23.3195 21.4616 22.9289 21.0711C22.5384 20.6805 22.5384 20.0474 22.9289 19.6569L24.3431 18.2426C24.7337 17.8521 25.3668 17.8521 25.7574 18.2426ZM35.6569 18.2426L37.0711 19.6569C37.4616 20.0474 37.4616 20.6805 37.0711 21.0711C36.6805 21.4616 36.0474 21.4616 35.6569 21.0711L34.2426 19.6569C33.8521 19.2663 33.8521 18.6332 34.2426 18.2426C34.6332 17.8521 35.2663 17.8521 35.6569 18.2426ZM30 10C32.2091 10 34 11.7909 34 14C34 16.2091 32.2091 18 30 18C27.7909 18 26 16.2091 26 14C26 11.7909 27.7909 10 30 10ZM30 12C28.8954 12 28 12.8954 28 14C28 15.1046 28.8954 16 30 16C31.1046 16 32 15.1046 32 14C32 12.8954 31.1046 12 30 12ZM23 13C23.5523 13 24 13.4477 24 14C24 14.5523 23.5523 15 23 15H21C20.4477 15 20 14.5523 20 14C20 13.4477 20.4477 13 21 13H23ZM39 13C39.5523 13 40 13.4477 40 14C40 14.5523 39.5523 15 39 15H37C36.4477 15 36 14.5523 36 14C36 13.4477 36.4477 13 37 13H39ZM37.0711 6.92893C37.4616 7.31946 37.4616 7.95262 37.0711 8.34315L35.6569 9.75736C35.2663 10.1479 34.6332 10.1479 34.2426 9.75736C33.8521 9.36684 33.8521 8.73367 34.2426 8.34315L35.6569 6.92893C36.0474 6.53841 36.6805 6.53841 37.0711 6.92893ZM24.3431 6.92893L25.7574 8.34315C26.1479 8.73367 26.1479 9.36684 25.7574 9.75736C25.3668 10.1479 24.7337 10.1479 24.3431 9.75736L22.9289 8.34315C22.5384 7.95262 22.5384 7.31946 22.9289 6.92893C23.3195 6.53841 23.9526 6.53841 24.3431 6.92893ZM30 4C30.5523 4 31 4.44772 31 5V7C31 7.55228 30.5523 8 30 8C29.4477 8 29 7.55228 29 7V5C29 4.44772 29.4477 4 30 4Z"></path>
                            </svg>
                            Bow sundeck
                        </li>
                        <li>
                            <svg name="icon-ladder-48" width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M37.0002 36C37.513 36 37.9357 36.386 37.9934 36.8834L38.0002 37C38.0002 37.0934 38.0044 37.1858 38.0128 37.277L38.0311 37.4321L38.0507 37.551L38.0886 37.7261L38.11 37.8071L38.1451 37.9239L38.2066 38.0959L38.3058 38.3208L38.3673 38.4392L38.4396 38.5641L38.5326 38.7067L38.6397 38.8517L38.7517 38.9861L38.8711 39.1136C39.3693 39.6154 40.0437 39.9421 40.7938 39.993L41.1168 40.0067C41.6141 40.0645 42.0002 40.4872 42.0002 41C42.0002 41.5128 41.6141 41.9355 41.1168 41.9933L41.0002 42C40.397 42 39.8188 41.8932 39.2835 41.6975L38.9999 41.5838C38.8946 41.5378 38.7912 41.4883 38.6899 41.4354L38.4881 41.3241L38.2398 41.1696L37.9977 40.9985L37.7696 40.8164L37.6788 40.7375L37.5368 40.6063L37.3538 40.4211L37.1887 40.2363L36.9999 40.0002C36.0882 41.2145 34.6359 42 33.0002 42C31.3644 42 29.9122 41.2145 28.9999 40.0002C28.0882 41.2145 26.6359 42 25.0002 42C23.3644 42 21.9122 41.2145 20.9999 40.0002C20.0882 41.2145 18.6359 42 17.0002 42C15.3644 42 13.9122 41.2145 12.9999 40.0002L12.9849 40.0211C12.5486 40.5981 12.004 41.0582 11.3968 41.389C11.2752 41.4557 11.1506 41.5174 11.0232 41.5738L10.7924 41.6679C10.7326 41.6922 10.6717 41.7142 10.6102 41.7351L10.5945 41.7391C10.4649 41.784 10.3321 41.8227 10.1972 41.8558L9.98175 41.9037L9.75787 41.943L9.63916 41.9593L9.44769 41.9802L9.19399 41.9963L9.00017 42C8.21853 42.0016 7.42654 41.8187 6.69031 41.4346L6.50017 41.3301C6.02187 41.054 5.858 40.4424 6.13414 39.9641C6.39056 39.52 6.93622 39.347 7.39581 39.5456L7.50017 39.5981C7.97537 39.8724 8.49443 40.002 9.00628 40.0005C9.10661 40 9.21176 39.9945 9.31534 39.9836C9.72148 39.9403 10.1157 39.8149 10.4726 39.6143C10.5923 39.5468 10.707 39.4712 10.8159 39.3884L11.0169 39.2221L11.137 39.1068L11.2661 38.9662L11.3685 38.8417L11.4684 38.7057L11.5486 38.5829L11.618 38.4663C11.8266 38.0946 11.9584 37.6741 11.9918 37.2262L12.0069 36.8834C12.0647 36.386 12.4873 36 13.0002 36C13.513 36 13.9357 36.386 13.9934 36.8834L14.0002 37C14.0002 38.6569 15.3433 40 17.0002 40C18.657 40 20.0002 38.6569 20.0002 37L20.0069 36.8834C20.0647 36.386 20.4873 36 21.0002 36C21.513 36 21.9357 36.386 21.9934 36.8834L22.0002 37C22.0002 38.6569 23.3433 40 25.0002 40C26.657 40 28.0002 38.6569 28.0002 37L28.0069 36.8834C28.0647 36.386 28.4873 36 29.0002 36C29.513 36 29.9357 36.386 29.9934 36.8834L30.0002 37C30.0002 38.6569 31.3433 40 33.0002 40C34.657 40 36.0002 38.6569 36.0002 37L36.0069 36.8834C36.0647 36.386 36.4873 36 37.0002 36ZM28 6C31.2384 6 33.8776 8.56557 33.9959 11.7751L34 12V35C34 35.5523 33.5523 36 33 36C32.4872 36 32.0645 35.614 32.0067 35.1166L32 35V31H18V35C18 35.5523 17.5523 36 17 36C16.4872 36 16.0645 35.614 16.0067 35.1166L16 35V12C16 9.79086 14.2091 8 12 8C9.8578 8 8.10892 9.68397 8.0049 11.8004L8 12C8 12.5523 7.55228 13 7 13C6.44772 13 6 12.5523 6 12C6 8.68629 8.68629 6 12 6C15.2384 6 17.8776 8.56557 17.9959 11.7751L18 12V17H32V12C32 9.79086 30.2091 8 28 8C25.8578 8 24.1089 9.68397 24.0049 11.8004L24 12C24 12.5523 23.5523 13 23 13C22.4477 13 22 12.5523 22 12C22 8.68629 24.6863 6 28 6ZM32 25H18V29H32V25ZM32 19H18V23H32V19Z"></path>
                            </svg>
                            Bathing ladder
                        </li>
                    </ul>
                </div>
                <div class="equipment-services-sec">
                    <h6>Extra Comforts</h6>
                    <ul>
                        <li>
                            <svg name="icon-toilet-48" width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path d="M41 24.0012C42.3252 24.0012 43.2554 25.2535 42.9405 26.4885L42.9003 26.6256L42.8496 26.7621C40.5743 32.2931 34.1938 36 27 36L26.7192 35.9981L26.439 35.9925L26 35.975V40C26 41.0017 25.2637 41.8313 24.3028 41.9772L24.1493 41.9945L24 42H16C14.9456 42 14.0818 41.184 14.0055 40.1491L14 39.9999V30.979L13.777 30.7512C12.8381 29.7676 12.0669 28.6794 11.4906 27.514L11.3057 27.1226L11.1504 26.7621C10.6276 25.4913 11.5117 24.1007 12.8543 24.0063L12.9999 24.0012H41ZM41 26.0012H13C13.5841 27.4212 14.5086 28.7209 15.6979 29.8411L16.0006 30.1173L16 40H24L24.0001 33.7595C24.9686 33.9172 25.972 34 27 34C33.5444 34 39.0906 30.6428 41 26.0012ZM40 20C40.5523 20 41 20.4477 41 21C41 21.5523 40.5523 22 40 22H22C21.4477 22 21 21.5523 21 21C21 20.4477 21.4477 20 22 20H40ZM17 6C18.0544 6 18.9182 6.81588 18.9945 7.85074L19 8V20C19 21.0544 18.1841 21.9182 17.1493 21.9945L17 22H11C10.0766 22 9.2811 21.3695 9.06015 20.4871L9.02722 20.3288L7.02722 8.3288C6.83217 7.1585 7.69075 6.08895 8.85318 6.00526L9.00001 6H17ZM17 8H9.00001L11 20H17V8Z"></path>
                            </svg>
                            Electric toilet
                        </li>
                        <li>
                            <svg name="icon-usbmp3-48" width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.5 19.51V10.23C15.5008 9.97189 15.4603 9.71531 15.38 9.47L14.5 6.84V4.45C14.4912 3.9061 14.2726 3.38663 13.89 3L13.21 2.32C13.117 2.22627 13.0064 2.15188 12.8846 2.10111C12.7627 2.05034 12.632 2.0242 12.5 2.0242C12.368 2.0242 12.2373 2.05034 12.1154 2.10111C11.9936 2.15188 11.883 2.22627 11.79 2.32L11.11 3C10.7202 3.39406 10.501 3.92569 10.5 4.48V6.84L9.62 9.47C9.53973 9.71531 9.49921 9.97189 9.5 10.23V19.51C9.04217 19.8015 8.66489 20.2033 8.4028 20.6785C8.14071 21.1538 8.0022 21.6873 8 22.23V31.77C8 32.6266 8.3403 33.4482 8.94604 34.054C9.55179 34.6597 10.3734 35 11.23 35H11.5V45.94H13.5V35H13.77C14.6266 35 15.4482 34.6597 16.054 34.054C16.6597 33.4482 17 32.6266 17 31.77V22.23C16.9978 21.6873 16.8593 21.1538 16.5972 20.6785C16.3351 20.2033 15.9578 19.8015 15.5 19.51ZM11.5 10.23C11.4952 10.1868 11.4952 10.1432 11.5 10.1L12.43 7.32C12.468 7.21707 12.4915 7.10938 12.5 7C12.502 7.10845 12.5188 7.21611 12.55 7.32L13.48 10.1C13.4855 10.1432 13.4855 10.1868 13.48 10.23V13H11.48L11.5 10.23ZM11.5 15H13.5V19H11.5V15ZM15 31.77C15 32.0962 14.8704 32.4091 14.6397 32.6397C14.4091 32.8704 14.0962 33 13.77 33H11.23C11.0685 33 10.9085 32.9682 10.7593 32.9064C10.6101 32.8446 10.4745 32.754 10.3603 32.6397C10.246 32.5255 10.1554 32.3899 10.0936 32.2407C10.0318 32.0915 10 31.9315 10 31.77V22.23C10 22.0685 10.0318 21.9085 10.0936 21.7593C10.1554 21.6101 10.246 21.4745 10.3603 21.3603C10.4745 21.246 10.6101 21.1554 10.7593 21.0936C10.9085 21.0318 11.0685 21 11.23 21H13.77C14.0962 21 14.4091 21.1296 14.6397 21.3603C14.8704 21.5909 15 21.9038 15 22.23V31.77Z"></path>
                                <path d="M38 8V2H27V8H25V20.56C24.9968 22.1374 25.3026 23.7001 25.9 25.16L29.08 32H31.5V45.94H33.5V32H35.92L39.12 25.11C39.7062 23.6649 40.0051 22.1194 40 20.56V8H38ZM29 4H36V8H29V4ZM38 20.56C38.0012 21.8435 37.7603 23.1157 37.29 24.31L34.65 30H30.35L27.73 24.36C27.2481 23.151 27.0004 21.8615 27 20.56V10H38V20.56Z"></path>
                            </svg>
                            USB socket
                        </li>
                    </ul>
                </div>
                <div class="equipment-services-sec">
                    <h6>Kitchen</h6>
                    <ul>
                        <li>
                            <svg name="icon-cooler-48" width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 6C5.79086 6 4 7.79086 4 10V38C4 40.2091 5.79086 42 8 42H40C42.2091 42 44 40.2091 44 38V10C44 7.79086 42.2091 6 40 6H8ZM40 8H8C6.89543 8 6 8.89543 6 10V17H21V16C21 14.8954 21.8954 14 23 14H25C26.1046 14 27 14.8954 27 16V17H42V10C42 8.89543 41.1046 8 40 8ZM42 19H27V20C27 21.1046 26.1046 22 25 22H23C21.8954 22 21 21.1046 21 20V19H6V38C6 39.1046 6.89543 40 8 40H40C41.1046 40 42 39.1046 42 38V19ZM25 16H23V20H25V16Z"></path>
                            </svg>
                            Ice box
                        </li>
                    </ul>
                </div>
          </div>
      </div>
        
      </div>
    </div>
  </div>
</div>
<!-- Services Modal Start-->
<div class="modal fade services-modal" id="services-modal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
       <!-- Modal Header -->
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <div class="equipment-title-sec">
                <h4 class="modal-title">Services</h4>
                <p class="modal-subtitle">Discover all the services offered by the owner.</p>
          </div>
          <div class="equipment-content-sec">
                <h2>Mandatory Extras</h2>
                <div class="equipment-services-sec">
                    <h6>Crew</h6>
                    <ul>
                        <li>
                            <svg name="icon-captain-48" width="48" height="48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 30C29.3333 30 34.6667 30.6667 40 32C36.6667 37.3333 31.3333 40 24 40C16.6667 40 11.3333 37.3333 8 32C13.3333 30.6667 18.6667 30 24 30ZM24 32C19.8242 32 15.6471 32.4219 11.4669 33.2664C14.4031 36.4291 18.5331 38 24 38C29.3061 38 33.3528 36.5202 36.271 33.5413L36.5331 33.2664L35.5685 33.079C31.7103 32.3595 27.8546 32 24 32ZM24 8C32 8 44 17 44 20C44 22 42.6667 25.3333 40 30C34.6667 28.6667 29.3333 28 24 28C18.6667 28 13.3333 28.6667 8 30C5.33333 26.6667 4 23.3333 4 20C4 15 16 8 24 8ZM24 10C16.8548 10 6 16.445 6 20C6 22.5279 6.91745 25.1036 8.80456 27.7499C13.8663 26.5837 18.9323 26 24 26C28.9999 26 33.9982 26.5682 38.9923 27.7035L39.3855 26.9717C41.0294 23.8637 41.8931 21.5787 41.9907 20.2437L41.9985 20.0939L41.9646 20.0164C41.9245 19.932 41.8656 19.8274 41.7878 19.7067C41.5296 19.3063 41.1176 18.8121 40.577 18.2648C39.412 17.0852 37.7606 15.7663 35.9027 14.5471C31.6788 11.7752 27.1941 10 24 10ZM24 13C24.5128 13 24.9355 13.386 24.9933 13.8834L25 14V15H26C26.5128 15 26.9355 15.386 26.9933 15.8834L27 16C27 16.5128 26.614 16.9355 26.1166 16.9933L26 17H25V21C26.0544 21 26.9182 20.1841 26.9945 19.1493L27 19L27.0067 18.8834C27.0645 18.386 27.4872 18 28 18C28.5523 18 29 18.4477 29 19C29 21.1422 27.316 22.8911 25.1996 22.9951L25 23H23C20.7909 23 19 21.2091 19 19L19.0067 18.8834C19.0645 18.386 19.4872 18 20 18C20.5128 18 20.9355 18.386 20.9933 18.8834L21 19C21 20.1046 21.8954 21 23 21V17H22L21.8834 16.9933C21.386 16.9355 21 16.5128 21 16C21 15.4872 21.386 15.0645 21.8834 15.0067L22 15H23V14L23.0067 13.8834C23.0645 13.386 23.4872 13 24 13Z"></path>
                            </svg>
                            <div class="crew-info">
                                <span>Skipper</span>
                                <span>Offered</span>
                            </div>
                        </li>
                    </ul>
                </div>
          </div>
      </div>
        
      </div>
    </div>
  </div>
</div>
@endsection
