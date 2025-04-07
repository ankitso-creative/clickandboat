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
            $('#see-price').click(function(){
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
        flatpickr("#checkin-date", {
        inline: false,
        dateFormat: "d-m-Y",
        minDate: "today",
        });
        flatpickr("#checkout-date", {
        inline: false,
        dateFormat: "d-m-Y",
        minDate: "today",
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
                                <a href="#" class="equip_btn">View all equipment</a>
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
                                <a href="#" class="equip_btn">View all services</a>
                            </div>
                        </div>
                    </div>
                    <div class="bende-card-content-sec">
                        <div class="calendar-sec">
                            <h3>Calendar</h3>
                            <p>Add dates for prices</p>
                            <div class="calendar-btn-sec">
                                <a href="javascript:;" id="see-price"> See the price list</a>
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
                            <a href="javascript:;" id="see-price"> See the price list</a>
                        </div>
                        <div class="dates_heading">
                            <p>Dates:</p>
                        </div>
                        <!-- Form for dates -->
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <div class="row sidebar_form">
                                <div class="p-0 col-md-6">
                                    <div class="form-group">
                                        <input type="date" id="checkin-date" name="checkin_date" class="form-control" placeholder="Check-in" />
                                    </div>
                                </div>
                                <div class="p-0 col-md-6">
                                    <div class="form-group">
                                        <input type="date" id="checkout-date" class="form-control" name="checkout_date" placeholder="Check-out" />
                                        <input type="hidden" id="days-val" value="" name="days_val" />
                                    </div>
                                </div>
                            </div>
                            <div class="show-Price d-none" id="show-Price-sec">
                                <p>Days: <span id="total-days"></span></p>
                                <p>Charter Price: <span id="charter-pice"></span></p>
                                <p>Service Fee: <span id="charter-fee"></span></p>
                                <p>Total: <span id="charter-total"></span></p>
                            </div>
                            <div class="d-flex flex-column">
                                <!-- <button class="mb-2 check_ava_btn">Check availability</button> -->
                                <span class="mt-2 mb-2 text-center d-block font-weight-bold">or</span>
                                <button class="btn book_btn">Book</button>
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
                <div class="pt-3 boat-card-content-secs">
                    <div class="single_boat_faq_section">
                        <h3>Frequently asked questions</h3>
                        <div class="pt-3 row single_boat_faq">
                            <div class="col-md-6">
                                <div id="accordionExample" class="shadow accordion">
                                    <!-- Accordion item 1 -->
                                    <div class="card">
                                        <div id="headingEight" class="border-0 shadow-sm card-header">
                                            <h2 class="mb-0">
                                                <button
                                                    type="button"
                                                    data-toggle="collapse"
                                                    data-target="#collapseEight"
                                                    aria-expanded="false"
                                                    aria-controls="collapseEight"
                                                    class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link"
                                                >
                                                    Collapsible I am a boat owner
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseEight" aria-labelledby="headingEight" data-parent="#accordionExample" class="collapse">
                                            <div class="card-body">
                                                <p class="m-0">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="accordionExample" class="shadow accordion">
                                    <!-- Accordion item 1 -->
                                    <div class="card">
                                        <div id="headingNine" class="border-0 shadow-sm card-header">
                                            <h2 class="mb-0">
                                                <button
                                                    type="button"
                                                    data-toggle="collapse"
                                                    data-target="#collapseNine"
                                                    aria-expanded="false"
                                                    aria-controls="collapseNine"
                                                    class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link"
                                                >
                                                    Collapsible I am a boat owner
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseNine" aria-labelledby="headingNine" data-parent="#accordionExample" class="collapse">
                                            <div class="card-body">
                                                <p class="m-0">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="accordionExample" class="shadow accordion">
                                    <!-- Accordion item 1 -->
                                    <div class="card">
                                        <div id="headingTen" class="border-0 shadow-sm card-header">
                                            <h2 class="mb-0">
                                                <button
                                                    type="button"
                                                    data-toggle="collapse"
                                                    data-target="#collapseTen"
                                                    aria-expanded="false"
                                                    aria-controls="collapseTen"
                                                    class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link"
                                                >
                                                    Collapsible I am a boat owner
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseTen" aria-labelledby="headingTen" data-parent="#accordionExample" class="collapse">
                                            <div class="card-body">
                                                <p class="m-0">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="accordionExample" class="shadow accordion">
                                    <!-- Accordion item 1 -->
                                    <div class="card">
                                        <div id="headingeleven" class="border-0 shadow-sm card-header">
                                            <h2 class="mb-0">
                                                <button
                                                    type="button"
                                                    data-toggle="collapse"
                                                    data-target="#collapseeleven"
                                                    aria-expanded="false"
                                                    aria-controls="collapseeleven"
                                                    class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link"
                                                >
                                                    Collapsible I am a boat owner
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseeleven" aria-labelledby="headingeleven" data-parent="#accordionExample" class="collapse">
                                            <div class="card-body">
                                                <p class="m-0">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="pt-5 similar_boat_section oat-card-content-secs">
                    <div class="text-center">
                        <h3>Check availability of similar boats</h3>
                    </div>
                    <div class="pt-4 row">
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="location_inner_box">
                                <img src="{{ asset('app-assets/site_assets/img/feature-img-2.jpg') }}" />
                                <div class="wishlist_icon">
                                    <i class="fa-regular fa-heart"></i>
                                </div>
                                <div class="location_inner_main_box">
                                    <div class="location_inner_text">
                                        <h3>test</h3>
                                        <p class="location_pera">sport 30 (2023)</p>
                                        <p class="people_pera">people · 30 hp · 5 m</p>
                                        <h5 class="location_price">From <span class="price_style">€27</span> / day</h5>
                                        <div class="location_facility">
                                            <ul>
                                                <li>With Skipper</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="location_review_box">
                                        <span>Flexible cancellation</span>
                                        <span><i class="fa-solid fa-star"></i> NEW</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="location_inner_box">
                                <img src="{{ asset('app-assets/site_assets/img/feature-img-2.jpg') }}" />
                                <div class="wishlist_icon">
                                    <i class="fa-regular fa-heart"></i>
                                </div>
                                <div class="location_inner_main_box">
                                    <div class="location_inner_text">
                                        <h3>test</h3>
                                        <p class="location_pera">sport 30 (2023)</p>
                                        <p class="people_pera">people · 30 hp · 5 m</p>
                                        <h5 class="location_price">From <span class="price_style">€27</span> / day</h5>
                                        <div class="location_facility">
                                            <ul>
                                                <li>With Skipper</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="location_review_box">
                                        <span>Flexible cancellation</span>
                                        <span><i class="fa-solid fa-star"></i> NEW</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="location_inner_box">
                                <img src="{{ asset('app-assets/site_assets/img/feature-img-2.jpg') }}" />
                                <div class="wishlist_icon">
                                    <i class="fa-regular fa-heart"></i>
                                </div>
                                <div class="location_inner_main_box">
                                    <div class="location_inner_text">
                                        <h3>test</h3>
                                        <p class="location_pera">sport 30 (2023)</p>
                                        <p class="people_pera">people · 30 hp · 5 m</p>
                                        <h5 class="location_price">From <span class="price_style">€27</span> / day</h5>
                                        <div class="location_facility">
                                            <ul>
                                                <li>With Skipper</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="location_review_box">
                                        <span>Flexible cancellation</span>
                                        <span><i class="fa-solid fa-star"></i> NEW</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="view_more_boats">
                            <a href="">View More Boats</a>
                        </div>
                </div> -->
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
@endsection
