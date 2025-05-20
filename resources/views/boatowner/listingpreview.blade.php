@extends('layouts.front.common') @section('meta')
<title>Motorboat Quicksilver 675 Open 150hp</title>
@endsection @section('css')
    <style>
        .equip-menus li img, .equipment-services-sec li img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
            filter: brightness(0) saturate(100%) invert(68%) sepia(83%) saturate(1245%) hue-rotate(341deg) brightness(100%) contrast(95%);
        }
    </style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
@endsection @section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
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
        Fancybox.bind("[data-fancybox='gallery']");
    </script>
@endsection @section('content')
<section class="single_boat_banner"></section>
<nav aria-label="Page breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Ibiza boat rental > Hire a {{ $listing->type }} ibiza > Rent a boat {{ $listing->skipper }} > Ibiza</li>
    </ol>
</nav>
<!-- end .b-title-page-->
<div class="l-main-content">
    <section class="boat-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ ucfirst($listing->type) }} in {{ $listing->city }} - {{ $listing->manufacturer }} {{ $listing->model }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="text-center col-md-12">
                    <ul class="rating-menus">
                        @if($listing->skipper)
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
                        @endif
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
                        @if($listing->harbour)
                        <li>
                            <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M8.02606 3.57293L8.02601 3.57493L8.02454 3.57661L8.02285 3.57809L8.02085 3.57814L8.01885 3.57809L8.01717 3.57661L8.01569 3.57493L8.01565 3.57293L8.01569 3.57093L8.01717 3.56924L8.01885 3.56777L8.02085 3.56772L8.02285 3.56777L8.02454 3.56924L8.02601 3.57093L8.02606 3.57293ZM9.00002 5.32322C9.61228 4.97997 10.0261 4.32477 10.0261 3.57293C10.0261 2.46548 9.1283 1.56772 8.02085 1.56772C6.91341 1.56772 6.01565 2.46548 6.01565 3.57293C6.01565 4.30759 6.41073 4.94997 7.00002 5.2992V5.71355L5.35419 5.71355V7.71355H7.00002L7.00002 12.6487C6.77579 12.5955 6.55563 12.5244 6.34173 12.4358C5.81598 12.218 5.33828 11.8988 4.93589 11.4964C4.5335 11.094 4.21431 10.6163 3.99654 10.0906C3.77877 9.56485 3.66669 9.00136 3.66669 8.4323H1.66669C1.66669 9.26401 1.8305 10.0876 2.14878 10.856C2.46706 11.6244 2.93357 12.3225 3.52168 12.9106C4.10978 13.4987 4.80796 13.9653 5.57636 14.2835C6.34475 14.6018 7.16831 14.7656 8.00002 14.7656C8.83172 14.7656 9.65529 14.6018 10.4237 14.2835C11.1921 13.9653 11.8903 13.4988 12.4784 12.9106C13.0665 12.3225 13.533 11.6244 13.8513 10.856C14.1695 10.0876 14.3334 9.26401 14.3334 8.4323H12.3334C12.3334 9.00136 12.2213 9.56485 12.0035 10.0906C11.7857 10.6163 11.4665 11.094 11.0641 11.4964C10.6618 11.8988 10.1841 12.218 9.65831 12.4358C9.44441 12.5244 9.22426 12.5955 9.00002 12.6487L9.00002 7.71355H10.6875V5.71355L9.00002 5.71355V5.32322Z"
                                ></path>
                            </svg>
                            {{ $listing->harbour }}
                        </li>
                        @endif
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
                @if($isMobile)
                    @php
                        $galleryImages = $listing->getMedia('listing_gallery');
                        $imageUrls = $galleryImages->map(fn($media) => $media->getUrl())->toArray();

                        $imageCoverUrl = $listing->getFirstMediaUrl('cover_images');
                        $imageCover = $imageCoverUrl ? [$imageCoverUrl] : [];

                        $allImageUrls = array_filter(array_merge($imageCover, $imageUrls));

                        if (empty($allImageUrls)) {
                            $allImageUrls = ['https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png'];
                        }
                    @endphp
                    <div class="col-md-12 mobile-image-slides">
                        @foreach($allImageUrls as $allImageUrl)
                            <div class="mobile-image-slide">
                                <a data-fancybox="gallery" href="{{ $allImageUrl }}">
                                    <img src="{{ $allImageUrl }}" alt="Image" class="img-fluid" />
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="col-md-6">
                        @php
                            $gallery_images = $listing->getMedia('listing_gallery');
                            $image = $listing->getFirstMediaUrl('cover_images');
                            if (!$image) {
                                if(count($gallery_images))
                                {
                                    $image = $gallery_images['0']->getUrl();
                                    unset($gallery_images[0]);
                                }
                                else
                                {
                                    $image = 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png';
                                }
                            }
                            $profileImage = $listing->user->getFirstMediaUrl('profile_image');
                        @endphp
                        <div class="banner-first-image">
                            <a data-fancybox="gallery" href="{{ $image }}"><img src="{{ $image }}" alt="Image" class="img-fluid" /></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="banner-grid-image">
                            @if(count($gallery_images))
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($gallery_images as $gallery_image)
                                    @php
                                        $count++;
                                        $dNone = '';
                                        if($count > 4):
                                            $dNone = 'd-none';
                                        endif;
                                    @endphp
                                    <a data-fancybox="gallery" href="{{ $gallery_image->getUrl() }}" class="{{ $dNone }}">
                                        <img src="{{ $gallery_image->getUrl() }}" alt="Image" class="img-fluid" />
                                    </a>
                                @endforeach
                            @else
                                <a href="#"><img src="https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png" alt="Image" class="img-fluid" /></a>
                                <a href="#"><img src="https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png" alt="Image" class="img-fluid" /></a>
                                <a href="#"><img src="https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png" alt="Image" class="img-fluid" /></a>
                                <a href="#"><img src="https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png" alt="Image" class="img-fluid" /></a>
                            @endif 
                            @if($count > 4):
                                <div class="view-more-photos">
                                    <a data-fancybox="gallery" href="{{ $image }}"> View the photos (+{{ $count - 4 }})</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
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
                                    <li>{{ $listing->onboard_capacity }} people</li>
                                    <li>{{ $listing->length }} meters</li>
                                    <li>{{ $listing->construction_year }} </li>
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
                            @php
                                if($listing->skipper == 'With Skipper'):
                                    $skipperText = ' Boat is rented with skipper.';
                                elseif($listing->skipper == 'Without Skipper'):
                                    $skipperText = 'Boat is rented without skipper, proof of a boating license is required.';
                                else:
                                    $skipperText = 'With Skipper Or Without Skipper - Boat can be hired with both, if rented without, proof of boating license is required.';
                                endif
                            @endphp
                            <div class="keyinfo-texts">
                                <h4>{{ $listing->skipper }}</h4>
                                <p>{{ $skipperText }}</p>
                            </div>
                        </div>
                        @if($listing->user->super == '1')
                            <div class="keyinfo-sec">
                                <div class="keyinfo-icon">
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <div class="keyinfo-texts">
                                    <h4>Super owner</h4>
                                    <p>As a dedicated boat renter with great reviews, Mario ensures that they provide high quality services.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="boat-card-content-sec">
                        <div class="boat-description-sec">
                            <h3>Description of {{ $listing->user->name }}'s {{ $listing->type }}</h3>
                            <h6>{{ $listing->title }}</h6>
                            <p>
                                 {{ optional($listing->description[0] ?? null)->description }} 
                            </p>
                            {{-- <a href="">Read More</a> --}}
                        </div>
                    </div>
                    @if($sixEquipments)
                        <div class="boat-card-content-sec">
                            <div class="equipment-sec">
                                <h3>Equipment available on the {{ $listing->type }}</h3>
                                <ul class="equip-menus">
                                    @foreach($sixEquipments as $singleEquipments)
                                        <li>
                                            <img src="{{ asset('app-assets/site_assets/img/equipment-icon/'.str_replace('_','-', $singleEquipments).'.png') }}" class="icon-image-equipment" alt="{{ $singleEquipments }}">
                                            {{ ucfirst(str_replace('_',' ', $singleEquipments)) }}
                                        </li>
                                    @endforeach
                                </ul>
                                @if($totalEquipments > 6)
                                    <div class="equip-button-sec">
                                        <a href="#" class="equip_btn" data-toggle="modal" data-target="#equipment-modal">View all equipment (+{{ $viewEquipments}})</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="boat-card-content-sec">
                        <div class="equipment-sec">
                            <h3>Services provided</h3>
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
                        @if($listing->user->super == '1')
                            <ul class="offered_rating">
                                <li><i class="fa-solid fa-star"></i> 4.8 (31 reviews)</li>
                                <li><i class="fa-solid fa-square-check"></i> Verified profile</li>
                            </ul>
                        @endif
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
                                <li>Manufacturer: <strong>{{ $listing->manufacturer }}</strong></li>
                                <li>Model: <strong>{{ $listing->model }} Open</strong></li>
                                <li>Engine power: <strong>{{ optional($listing->otherListingSetting)->horsepower ?? '' }}hp</strong></li>
                                <li>Length: <strong>{{ $listing->length }}m </strong></li>
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
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <ul class="features-menu">
                                    <li><strong>Check-in & check-out</strong></li>
                                    <li>Check-in: <strong>{{ optional($listing->booking)->check_in }}</strong></li>
                                    <li>Check-out: <strong>{{ optional($listing->booking)->check_out }}</strong></li>
                                </ul>
                            </div>
                            @php 
                                if(session()->has('currency_code')):
                                    $to = session('currency_code');
                                else:
                                    $to = 'EUR';
                                endif;
                                $fuel_cost = 'Yes';
                                if($listing->fuel_include == '1'):
                                    $fuel_cost = getAmountWithSymble($listing->fuel_price,$listing->currency,$to);
                                endif;
                                $skipper_cost = 'Yes';
                                if($listing->skipper_include == '1'):
                                    $skipper_cost = getAmountWithSymble($listing->skipper_price,$listing->currency,$to);
                                endif;
                                if(optional($listing->booking)->cancellation_conditions == 'flexible'):
                                    $cancellation_conditions = 'Full refund to the tenant up to 1 day prior to arrival, excluding Service Fee and MyBoatBooker Commission. The tenant will be refunded the total amount of the booking (excluding Service Fee and MyBoatBooker Commission) if they cancel the booking until the day before check-in (time indicated on the listing by the owner or agreed between the users via MyBoatBooker messaging or 9:00 am, local time if not specified). If the Tenant arrives and decides to leave before the scheduled date, the days not spent on the boat are not refunded.';
                                elseif(optional($listing->booking)->cancellation_conditions == 'moderate'):
                                    $cancellation_conditions = '70% refund to the tenant up to 10 days prior to arrival, excluding Service Fee and MyBoatBooker Commission. If the tenant cancels at least 10 days before check-in (time indicated on the listing by the owner or agreed upon by the users via MyBoatBooker messaging or 9:00 am local time if not specified), they will be refunded 70% of the total amount of the booking (excluding Service Fee and MyBoatBooker Commission). If they cancel less than 10 days before check-in, they will not be refunded. If the Tenant arrives and decides to leave before the scheduled date, the days not spent on the boat are not refunded.';
                                else:
                                    $cancellation_conditions = '60% refund to the tenant up to 30 days prior to arrival, excluding Service Fee and MYBoatBooker Commission. If the Renter cancels at least 30 days before check-in (time indicated on the listing by the owner or agreed between users via MyBoatBooker messaging or 9:00 am local time if not specified), they will be refunded 60% of the total amount of the booking (excluding Service Fee and MyBoatBooker Commission). If they cancel less than 30 days before check-in, they will not be refunded. If the Tenant arrives and decides to leave before the scheduled date, the days not spent on the boat are not refunded.';
                                endif;
                                $security = 'No';
                                if(optional($listing->security)->security_deposit == '1')
                                {
                                    $security = 'Yes ('.getAmountWithSymble($listing->security->amount,$listing->currency,$to).')';
                                    if(optional($listing->security)->type == '0')
                                    {
                                        $security = 'Yes ('.optional($listing->security)->amount.'%)';
                                    }
                                }
                            @endphp
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <ul class="features-menu">
                                    <li><strong>Rules for the boat</strong></li>
                                    <li>Fuel included in price: <strong>{{ $fuel_cost }}</strong></li>
                                    <li>Is skipper included in the price: <strong>{{ $skipper_cost }}</strong></li>
                                    <li>Boat licence required: <strong>Yes (if hired without a skipper)</strong></li>
                                    <li>Minimum rental age: <strong>18 years old</strong></li>
                                    <li>Security Deposit: <strong>{{ $security }}</strong></li>
                                </ul>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <ul class="features-menu">
                                    <li><strong>Cancellation policy</strong></li>
                                    <li>{{ $cancellation_conditions }}</li>
                                    
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
    <div class="price_list_accordian">
        <div id="accordion">
            @php
                if ($lowseason && isset($listing->seasonPrice[0])):
                    $lowMonths = optional($listing->seasonPrice[0])->from;
                    $allLowMonth = '';
                    if($lowMonths){
                        $lowmonthArray = json_decode($lowMonths);
                        if(is_array($lowmonthArray))
                        {
                            $allLowMonth = implode(', ',$lowmonthArray);
                        }
                    }
                endif;
            @endphp
            @if($lowseason && isset($listing->seasonPrice[0]))
                @php
                    $lowMonths = optional($listing->seasonPrice[0])->from;
                    $allLowMonth = '';
                    if($lowMonths){
                        $lowmonthArray = json_decode($lowMonths);
                        if(is_array($lowmonthArray))
                        {
                            $allLowMonth = implode(', ',$lowmonthArray);
                        }
                    }
                @endphp
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Low Season Price
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <p class="monthheading">Months: <span>{{ $allLowMonth }}</span></p>
                            <h6>Prices</h6>
                            {!! priceWithHtml($lowseason, $listing->seasonPrice[0]->price) !!}
                        </div>
                    </div>
                </div>
            @endif
            @if($midSeason && isset($listing->seasonPrice[1]))
                @php
                    $midMonths = optional($listing->seasonPrice[1])->from;
                    $allMidMonth = '';
                    if($midMonths):
                        $midMonthArray = json_decode($midMonths);
                        if(is_array($midMonthArray))
                        {
                            $allMidMonth = implode(', ',$midMonthArray);
                        }
                        
                    endif;
                @endphp
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Mid Season Price
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <p class="monthheading">Months: <span>{{ $allMidMonth }}</span></p>
                            <h6>Prices</h6>
                            {!! priceWithHtml($midSeason, $listing->seasonPrice[1]->price) !!}
                        </div>
                    </div>
                </div>
            @endif
            @if($highSeason && isset($listing->seasonPrice[2]))
                @php
                    $hMonths = optional($listing->seasonPrice[2])->from;
                    $allHMonth = '';
                    if($hMonths):
                        $hMonthArray = json_decode($hMonths);
                        if(is_array($hMonthArray))
                        {
                            $allHMonth = implode(', ',$hMonthArray);
                        }
                    endif;
                @endphp
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                High Season Price
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <p class="monthheading">Months: <span>{{ $allHMonth }}</span></p>
                            <h6>Prices</h6>
                            {!! priceWithHtml($highSeason, $listing->seasonPrice[2]->price) !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
</div>
<!-- Equipment Modal Start-->
@if($equipments)
    <div class="modal fade equipment-modal" id="equipment-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="equipment-title-sec">
                        <h4 class="modal-title">Equipment</h4>
                        <p class="modal-subtitle">Discover all of the equipment on board this boat.</p>
                    </div>
                    <div class="equipment-content-sec">
                        <h2>On board</h2>
                        @foreach($equipments as $key => $equipmentData)
                            @if($equipmentData)
                                @php
                                    $equipmentnames = json_decode($equipmentData);
                                @endphp
                                <div class="equipment-services-sec">
                                    <h6>{{ ucfirst(str_replace('_',' ', $key)) }}</h6>
                                    <ul>
                                        @foreach($equipmentnames as $key => $equipmentname)
                                        <li>
                                            <img src="{{ asset('app-assets/site_assets/img/equipment-icon/'.str_replace('_','-', $equipmentname).'.png') }}" class="icon-image-equipment" alt="{{ $equipmentname }}">
                                            {{ ucfirst(str_replace('_',' ', $equipmentname)) }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
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
