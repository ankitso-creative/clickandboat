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
    <link href="{{ asset('app-assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    @endsection @section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAli6rCJivgzTbWznnkqFtT_btPww6WBYs&callback=initMap" async defer></script>
    <script src="{{ asset('app-assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        let map;
        let marker;
        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12
            });
            marker = new google.maps.Marker({
                map: map,
                title: "City Location"
            });
            fetchCityCoordinates("{{ $listing->city }}");
        }
        function fetchCityCoordinates(cityName) {
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                address: cityName
            }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    const cityLocation = results[0].geometry.location;
                    const lat = cityLocation.lat();
                    const lng = cityLocation.lng();
                    map.setCenter(cityLocation);
                    marker.setPosition(cityLocation);
                    marker.setTitle(cityName);
                } else {
                    alert("City not found: " + status);
                }
            });
        }
        $(document).ready(function() {
            $('.see-price').click(function() {
                if ($('#price-list').hasClass('open')) {
                    $('#price-list').removeClass('open');
                } else {
                    $('#price-list').addClass('open');
                }
            });
            $('#closeMenu').click(function() {
                $('#price-list').removeClass('open');
            });
        });
        function formatDate(date) {
            const day = ("0" + date.getDate()).slice(-2);
            const month = ("0" + (date.getMonth() + 1)).slice(-2);
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }
        var disable = [];
        @if (!empty($calendarArray))
            var disableObj = JSON.parse(@json($calendarArray));

            function convertDateFormat(dateStr) {
                var parts = dateStr.split('-');
                return `${parts[0]}-${parts[1]}-${parts[2]}`;
            }
            var disable = Object.values(disableObj).map(item => ({
                from: convertDateFormat(item.from),
                to: convertDateFormat(item.to)
            }));
        @endif
        flatpickr("#inline-datepicker", {
            mode: "range",
            inline: true,
            dateFormat: "d-m-Y",
            multipleMonth: true,
            showMonths: 2,
            monthSelectorType: "static",
            minDate: "today",
            disable: disable,
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    const checkIn = formatDate(selectedDates[0]);
                    const checkOut = formatDate(selectedDates[1]);
                    document.getElementById('checkin-date').value = checkIn;
                    document.getElementById('checkout-date').value = checkOut;
                    $.ajax({
                        url: '{{ route('getbookingprice') }}',
                        type: 'GET',
                        data: {
                            checkindate: checkIn,
                            checkoutdate: checkOut,
                            id: {{ $listing->id }}
                        },
                        success: function(response) {
                            if (response.status) {
                                $('#show-Price-sec,#show-Price-sec-2').removeClass('d-none');
                                $('#days-val, #days-val-2').val(response.days);
                                $('#total-days, #total-days-2, #total-days-3').html(response.days);
                                $('#charter-pice, #charter-pice-2').html(response.price);
                                $('#charter-fee, #charter-fee-2').html(response.servive_fee);
                                $('#charter-total, #charter-total-2, #charter-total-3').html(response.totalAmount);
                            } else {
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
            dateFormat: "d-m-Y",
            multipleMonth: true,
            showMonths: 1,
            monthSelectorType: "static",
            minDate: "today",
            disable: disable,
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    const checkIn = formatDate(selectedDates[0]);
                    const checkOut = formatDate(selectedDates[1]);
                    document.getElementById('checkin-date').value = checkIn;
                    document.getElementById('checkout-date').value = checkOut;
                    $.ajax({
                        url: '{{ route('getbookingprice') }}',
                        type: 'GET',
                        data: {
                            checkindate: checkIn,
                            checkoutdate: checkOut,
                            id: {{ $listing->id }}
                        },
                        success: function(response) {
                            if (response.status) {
                                $('#show-Price-sec').removeClass('d-none');
                                $('#days-val').val(response.days);
                                $('#total-days').html(response.days);
                                $('#charter-pice').html(response.price);
                                $('#charter-fee').html(response.servive_fee);
                                $('#charter-total').html(response.totalAmount);
                            } else {
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
        $(document).ready(function() 
        {
            flatpickr("#checkin-date, #checkout-date", {
                inline: false,
                mode: "range",
                dateFormat: "d-m-Y", 
                minDate: "today",
                disable: disable,
                onChange: function(selectedDates, dateStr, instance) 
                {
                    if (selectedDates.length === 2) {
                        const checkIn = formatDate(selectedDates[0]);
                        const checkOut = formatDate(selectedDates[1]);
                        document.getElementById('checkin-date').value = checkIn;
                        document.getElementById('checkout-date').value = checkOut;
                        $.ajax({
                            url: '{{ route('getbookingprice') }}',
                            type: 'GET',
                            data: {
                                checkindate: checkIn,
                                checkoutdate: checkOut,
                                id: {{ $listing->id }}
                            },
                            success: function(response) {
                                if (response.status) {
                                    $('#show-Price-sec,#qshow-Price-sec').removeClass('d-none');
                                    $('#days-val, #qdays-val').val(response.days);
                                    $('#total-days, #qtotal-days').html(response.days);
                                    $('#charter-pice').html(response.price);
                                    $('#charter-fee').html(response.servive_fee);
                                    $('#charter-total,#qcharter-total').html(response.totalAmount);
                                    $('#qcheckin-date').val(checkIn);
                                    $('#qcheckout-date').val(checkOut);
                                    $('#submit-qut').removeAttr('disabled');
                                } else {
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
            
            flatpickr("#qcheckin-date, #qcheckout-date", {
                inline: false,
                mode: "range",
                dateFormat: "d-m-Y",  
                minDate: "today",
                disable: disable,
                onChange: function(selectedDates, dateStr, instance) 
                {
                    if (selectedDates.length === 2) {
                        const checkIn = formatDate(selectedDates[0]);
                        const checkOut = formatDate(selectedDates[1]);
                        document.getElementById('qcheckin-date').value = checkIn;
                        document.getElementById('qcheckout-date').value = checkOut;
                        $.ajax({
                            url: '{{ route('getbookingprice') }}',
                            type: 'GET',
                            data: {
                                checkindate: checkIn,
                                checkoutdate: checkOut,
                                id: {{ $listing->id }}
                            },
                            success: function(response) {
                                if (response.status) {
                                    $('#show-Price-sec,#qshow-Price-sec').removeClass('d-none');
                                    $('#days-val, #qdays-val').val(response.days);
                                    $('#total-days, #qtotal-days').html(response.days);
                                    $('#charter-pice').html(response.price);
                                    $('#charter-fee').html(response.servive_fee);
                                    $('#charter-total,#qcharter-total').html(response.totalAmount);
                                    $('#checkin-date').val(checkIn);
                                    $('#checkout-date').val(checkOut);
                                    $('#submit-qut').removeAttr('disabled');
                                } else {
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
            $(document).on('submit','#form-quot', function(e) {
                e.preventDefault();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('customer.support.quotation') }}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken 
                    },
                    success: function(response) {
                        var resp = response;
                        if(resp.status == "success") 
                        {
                            $('#sidebar-right .owner-details-contain').addClass('d-none');
                            $('#sidebar-right .location-modal-box').removeClass('d-none');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + status + " - " + error);
                    }
                });
            });
            $(document).on('click','.favorite_item', function(){
                var list = $(this).attr('list');
                var self =  $(this)
                self.html('<i class="fa-solid fa-spinner fa-spin custom-spinner"></i>');
                $.ajax({
                    url: "{{ route('ajax.favorite') }}",  
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        item_id: list,
                        _token: '{{ csrf_token() }}'  
                    },
                    success: function(response) {
                        if (response.success) 
                        {
                            if(response.action=='save')
                            {
                                self.html('<i class="fa-solid fa-heart"></i> Add to favorites');
                            }
                            else
                            {
                                self.html('<i class="fa-regular fa-heart"></i> Add to favorites');
                            }
                        } else
                        {
                            
                        }
                    },
                    error: function() 
                    {
                        
                    }
                });
            })
        });
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                
            }).catch(err => {
            console.error('Failed to copy: ', err);
            });
        }
        $(document).ready(function() {
            $(".modal a").not(".dropdown-toggle").on("click", function() {
                $("#sidebar-right").modal("hide");
            });
            $('.not-login-user').on('click', function() {
                swal({
                    title: '',
                    text: 'You need to login as a customer.',
                    type: "",
                    showCancelButton: false,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Go to Login',
                    allowOutsideClick: false, 
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location.href = '/login';
                    } 
                })
            });
        });
    </script>
@endsection
@section('content')
    <?php
    //dd($calendarArray)
    ?>
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
                        <h1>Yacht charter in {{ $listing->city }} · {{ $listing->model }} — {{ $listing->manufacturer }}
                            Open (2023)</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="text-center col-md-12">
                        <ul class="rating-menus">
                            <li>
                                <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M14.6666 6.66666C14.6666 4.99999 10.6666 2.66666 7.99998 2.66666C5.33331 2.66666 1.33331 4.99999 1.33331 6.66666C1.33331 7.56633 1.6247 8.466 2.20748 9.36568C4.13831 8.89966 6.06915 8.66666 7.99998 8.66666C9.89884 8.66666 11.7977 8.89201 13.6965 9.34271C14.3433 8.12733 14.6666 7.23531 14.6666 6.66666ZM7.99998 9.99999C9.77776 9.99999 11.5555 10.2222 13.3333 10.6667C12.2222 12.4444 10.4444 13.3333 7.99998 13.3333C5.55554 13.3333 3.77776 12.4444 2.66665 10.6667C4.44442 10.2222 6.2222 9.99999 7.99998 9.99999ZM7.99998 6.66666C8.55226 6.66666 8.99998 6.21894 8.99998 5.66666C8.99998 5.11437 8.55226 4.66666 7.99998 4.66666C7.44769 4.66666 6.99998 5.11437 6.99998 5.66666C6.99998 6.21894 7.44769 6.66666 7.99998 6.66666Z">
                                    </path>
                                </svg>
                                {{ $listing->skipper }}
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_1028_12450" style="mask-type: alpha;" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="16" height="16">
                                        <rect width="16" height="16" fill="#D9D9D9"></rect>
                                    </mask>
                                    <g mask="url(#mask0_1028_12450)">
                                        <path
                                            d="M3.33333 12.5667C3.93333 11.9778 4.63056 11.5139 5.425 11.175C6.21944 10.8361 7.07778 10.6667 8 10.6667C8.92222 10.6667 9.78056 10.8361 10.575 11.175C11.3694 11.5139 12.0667 11.9778 12.6667 12.5667V4.00001H3.33333V12.5667ZM8 9.33334C7.35556 9.33334 6.80556 9.10557 6.35 8.65001C5.89444 8.19445 5.66667 7.64445 5.66667 7.00001C5.66667 6.35557 5.89444 5.80557 6.35 5.35001C6.80556 4.89445 7.35556 4.66668 8 4.66668C8.64444 4.66668 9.19445 4.89445 9.65 5.35001C10.1056 5.80557 10.3333 6.35557 10.3333 7.00001C10.3333 7.64445 10.1056 8.19445 9.65 8.65001C9.19445 9.10557 8.64444 9.33334 8 9.33334ZM3.33333 14.6667C2.96667 14.6667 2.65278 14.5361 2.39167 14.275C2.13056 14.0139 2 13.7 2 13.3333V4.00001C2 3.63334 2.13056 3.31945 2.39167 3.05834C2.65278 2.79723 2.96667 2.66668 3.33333 2.66668H4V1.33334H5.33333V2.66668H10.6667V1.33334H12V2.66668H12.6667C13.0333 2.66668 13.3472 2.79723 13.6083 3.05834C13.8694 3.31945 14 3.63334 14 4.00001V13.3333C14 13.7 13.8694 14.0139 13.6083 14.275C13.3472 14.5361 13.0333 14.6667 12.6667 14.6667H3.33333Z">
                                        </path>
                                    </g>
                                </svg>
                                Professional
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.02606 3.57293L8.02601 3.57493L8.02454 3.57661L8.02285 3.57809L8.02085 3.57814L8.01885 3.57809L8.01717 3.57661L8.01569 3.57493L8.01565 3.57293L8.01569 3.57093L8.01717 3.56924L8.01885 3.56777L8.02085 3.56772L8.02285 3.56777L8.02454 3.56924L8.02601 3.57093L8.02606 3.57293ZM9.00002 5.32322C9.61228 4.97997 10.0261 4.32477 10.0261 3.57293C10.0261 2.46548 9.1283 1.56772 8.02085 1.56772C6.91341 1.56772 6.01565 2.46548 6.01565 3.57293C6.01565 4.30759 6.41073 4.94997 7.00002 5.2992V5.71355L5.35419 5.71355V7.71355H7.00002L7.00002 12.6487C6.77579 12.5955 6.55563 12.5244 6.34173 12.4358C5.81598 12.218 5.33828 11.8988 4.93589 11.4964C4.5335 11.094 4.21431 10.6163 3.99654 10.0906C3.77877 9.56485 3.66669 9.00136 3.66669 8.4323H1.66669C1.66669 9.26401 1.8305 10.0876 2.14878 10.856C2.46706 11.6244 2.93357 12.3225 3.52168 12.9106C4.10978 13.4987 4.80796 13.9653 5.57636 14.2835C6.34475 14.6018 7.16831 14.7656 8.00002 14.7656C8.83172 14.7656 9.65529 14.6018 10.4237 14.2835C11.1921 13.9653 11.8903 13.4988 12.4784 12.9106C13.0665 12.3225 13.533 11.6244 13.8513 10.856C14.1695 10.0876 14.3334 9.26401 14.3334 8.4323H12.3334C12.3334 9.00136 12.2213 9.56485 12.0035 10.0906C11.7857 10.6163 11.4665 11.094 11.0641 11.4964C10.6618 11.8988 10.1841 12.218 9.65831 12.4358C9.44441 12.5244 9.22426 12.5955 9.00002 12.6487L9.00002 7.71355H10.6875V5.71355L9.00002 5.71355V5.32322Z">
                                    </path>
                                </svg>
                                Zudika
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <ul class="share-menu">
                            <li>
                                <a href="#" data-toggle="modal" data-target="#share-modal">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill="currentColor"
                                            d="M8 7L9.41 8.41L11 6.83V15H13V6.83L14.58 8.41L16 7L12 3L8 7ZM5 19L5 12H3L3 19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V12H19V19H5Z">
                                        </path>
                                    </svg>
                                    Share
                                </a>
                            </li>
                            @php
                                $heart_html = '<li class="wishlist_icon not-login-user"><a href="javascript:;" class="favorite_item"><i class="fa-regular fa-heart"></i> Add to favorites</a></li>';
                                if(Auth::check()):
                                    $user = auth()->user();
                                    if($user->role == 'customer'):
                                        $isFavorited = $user->favoriteitems()->where('listing_id', $listing->id)->exists();
                                        if(!$isFavorited):
                                            $heart_html = '<li class="wishlist_icon"><a href="javascript:;" list="'.$listing->id.'" class="favorite_item"><i class="fa-regular fa-heart"></i> Add to favorites</a></li>';
                                        else:
                                            $heart_html = '<li class="wishlist_icon"><a href="javascript:;" list="'.$listing->id.'" class="favorite_item"><i class="fa-solid fa-heart"></i> Add to favorites</a> </li>';
                                        endif;
                                    else:
                                        $heart_html = '';
                                    endif;
                                endif;
                            @endphp    
                            {!! $heart_html !!}
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
                            if (!$image) {
                                $image =
                                    'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png';
                            }
                            $profileImage = $listing->user->getFirstMediaUrl('profile_image');
                        @endphp
                        <div class="banner-first-image">
                            <a href="#"><img src="{{ $image }}" alt="Image" class="img-fluid" /></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="banner-grid-image">
                            @if (count($gallery_images))
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
                                        <li>{{ optional($listing->otherListingSetting)->horsepower ?? '' }} horsepower</li>
                                        <li>{{ $listing->length }} meters</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="boat-card-content-sec">
                            @php
                                if($listing->skipper == 'With Skipper'):
                                    $skipperText = ' Boat is rented with skipper.';
                                elseif($listing->skipper == 'Without Skipper'):
                                    $skipperText = 'Boat is rented without skipper, proof of a boating license is required.';
                                else:
                                    $skipperText = 'With Skipper Or Without Skipper - Boat can be hired with both, if rented without, proof of boating license is required.';
                                endif
                            @endphp
                            <div class="keyinfo-sec">
                                <div class="keyinfo-icon">
                                    <svg width="32" height="32" viewBox="0 0 48 48"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M24 30C29.3333 30 34.6667 30.6667 40 32C36.6667 37.3333 31.3333 40 24 40C16.6667 40 11.3333 37.3333 8 32C13.3333 30.6667 18.6667 30 24 30ZM24 32C19.8242 32 15.6471 32.4219 11.4669 33.2664C14.4031 36.4291 18.5331 38 24 38C29.3061 38 33.3528 36.5202 36.271 33.5413L36.5331 33.2664L35.5685 33.079C31.7103 32.3595 27.8546 32 24 32ZM24 8C32 8 44 17 44 20C44 22 42.6667 25.3333 40 30C34.6667 28.6667 29.3333 28 24 28C18.6667 28 13.3333 28.6667 8 30C5.33333 26.6667 4 23.3333 4 20C4 15 16 8 24 8ZM24 10C16.8548 10 6 16.445 6 20C6 22.5279 6.91745 25.1036 8.80456 27.7499C13.8663 26.5837 18.9323 26 24 26C28.9999 26 33.9982 26.5682 38.9923 27.7035L39.3855 26.9717C41.0294 23.8637 41.8931 21.5787 41.9907 20.2437L41.9985 20.0939L41.9646 20.0164C41.9245 19.932 41.8656 19.8274 41.7878 19.7067C41.5296 19.3063 41.1176 18.8121 40.577 18.2648C39.412 17.0852 37.7606 15.7663 35.9027 14.5471C31.6788 11.7752 27.1941 10 24 10ZM24 13C24.5128 13 24.9355 13.386 24.9933 13.8834L25 14V15H26C26.5128 15 26.9355 15.386 26.9933 15.8834L27 16C27 16.5128 26.614 16.9355 26.1166 16.9933L26 17H25V21C26.0544 21 26.9182 20.1841 26.9945 19.1493L27 19L27.0067 18.8834C27.0645 18.386 27.4872 18 28 18C28.5523 18 29 18.4477 29 19C29 21.1422 27.316 22.8911 25.1996 22.9951L25 23H23C20.7909 23 19 21.2091 19 19L19.0067 18.8834C19.0645 18.386 19.4872 18 20 18C20.5128 18 20.9355 18.386 20.9933 18.8834L21 19C21 20.1046 21.8954 21 23 21V17H22L21.8834 16.9933C21.386 16.9355 21 16.5128 21 16C21 15.4872 21.386 15.0645 21.8834 15.0067L22 15H23V14L23.0067 13.8834C23.0645 13.386 23.4872 13 24 13Z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="keyinfo-texts">
                                    <h4>{{ $listing->skipper }}</h4>
                                    <p>{{ $skipperText }}</p>
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
                                    <p>As a dedicated boat renter with great reviews, Mario ensures that they provide high
                                        quality services.</p>
                                </div>
                            </div>
                        </div>
                        <div class="boat-card-content-sec">
                            <div class="boat-description-sec">
                                <h3>Description of {{ $listing->user->name }}'s {{ $listing->type }}</h3>
                                <p class="boat_des_heading">{{ $listing->type }} {{ $listing->boat_name }} Open 705
                                    {{ optional($listing->otherListingSetting)->horsepower }}hp</p>
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
                                <h3>Services provided by Mario</h3>
                                <ul class="equip-menus">
                                    <li>
                                        <svg width="28" height="28" viewBox="0 0 48 48"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M24 30C29.3333 30 34.6667 30.6667 40 32C36.6667 37.3333 31.3333 40 24 40C16.6667 40 11.3333 37.3333 8 32C13.3333 30.6667 18.6667 30 24 30ZM24 32C19.8242 32 15.6471 32.4219 11.4669 33.2664C14.4031 36.4291 18.5331 38 24 38C29.3061 38 33.3528 36.5202 36.271 33.5413L36.5331 33.2664L35.5685 33.079C31.7103 32.3595 27.8546 32 24 32ZM24 8C32 8 44 17 44 20C44 22 42.6667 25.3333 40 30C34.6667 28.6667 29.3333 28 24 28C18.6667 28 13.3333 28.6667 8 30C5.33333 26.6667 4 23.3333 4 20C4 15 16 8 24 8ZM24 10C16.8548 10 6 16.445 6 20C6 22.5279 6.91745 25.1036 8.80456 27.7499C13.8663 26.5837 18.9323 26 24 26C28.9999 26 33.9982 26.5682 38.9923 27.7035L39.3855 26.9717C41.0294 23.8637 41.8931 21.5787 41.9907 20.2437L41.9985 20.0939L41.9646 20.0164C41.9245 19.932 41.8656 19.8274 41.7878 19.7067C41.5296 19.3063 41.1176 18.8121 40.577 18.2648C39.412 17.0852 37.7606 15.7663 35.9027 14.5471C31.6788 11.7752 27.1941 10 24 10ZM24 13C24.5128 13 24.9355 13.386 24.9933 13.8834L25 14V15H26C26.5128 15 26.9355 15.386 26.9933 15.8834L27 16C27 16.5128 26.614 16.9355 26.1166 16.9933L26 17H25V21C26.0544 21 26.9182 20.1841 26.9945 19.1493L27 19L27.0067 18.8834C27.0645 18.386 27.4872 18 28 18C28.5523 18 29 18.4477 29 19C29 21.1422 27.316 22.8911 25.1996 22.9951L25 23H23C20.7909 23 19 21.2091 19 19L19.0067 18.8834C19.0645 18.386 19.4872 18 20 18C20.5128 18 20.9355 18.386 20.9933 18.8834L21 19C21 20.1046 21.8954 21 23 21V17H22L21.8834 16.9933C21.386 16.9355 21 16.5128 21 16C21 15.4872 21.386 15.0645 21.8834 15.0067L22 15H23V14L23.0067 13.8834C23.0645 13.386 23.4872 13 24 13Z">
                                            </path>
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
                                <div class="show-Price d-none" id="show-Price-sec-2">
                                    <p>Days: <span id="total-days-2"></span></p>
                                    <p>Charter Price: {{ $symble }}<span id="charter-pice-2"></span></p>
                                    <p>Service Fee: {{ $symble }}<span id="charter-fee-2"></span></p>
                                    <p>Total: {{ $symble }}<span id="charter-total-2"></span></p>
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
                                    if (!$image):
                                        $image = 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
                                    endif;
                                    $join_date = \Carbon\Carbon::parse($listing->user->created_at)->format('F Y');
                                    $textP = '';
                                    if ($listing->professional === 'Yes'):
                                        $textP = '<span> Professional owner</span>';
                                    endif;
                                @endphp
                                <div class="idea_Sec_img">
                                    <img src="{{ $image }}" />
                                </div>
                                <div class="idea_sec_text">
                                    <h3>{{ $listing->user->name }}</h3>
                                    <p>Joined in {{ $join_date }} {!! $textP !!}</p>
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
                                <p><i class="fa-solid fa-language"></i> Language spoken: <span
                                        class="offered_language_style">English</span></p>
                                <p><i class="fa-regular fa-clock"></i> Response time: within a few hours</p>
                            </div>
                            <div class="contact_own_btn">
                                @if(Auth::check())
                                    @php
                                        $user = auth()->user();
                                    @endphp
                                    @if($user->role == 'customer')
                                        <a href="{{ route('customer.message', $listing->slug) }}" class="contact_owner_btn">Contact Owner</a>
                                    @else
                                        <a href="javascript:;" class="contact_owner_btn not-login-user">Contact Owner</a>
                                    @endif
                                @else
                                    <a href="javascript:;" class="contact_owner_btn not-login-user">Contact Owner</a>
                                @endif
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
                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <div class="row sidebar_form">
                                    <div class="p-0 col-md-6">
                                        <div class="form-group">
                                            <input type="date" id="checkin-date" name="checkin_date"
                                                class="form-control" placeholder="Check-in" />
                                        </div>
                                    </div>
                                    <div class="p-0 col-md-6">
                                        <div class="form-group">
                                            <input type="date" id="checkout-date" class="form-control"
                                                name="checkout_date" placeholder="Check-out" />
                                            <input type="hidden" id="days-val" value="" name="days_val" />
                                        </div>
                                    </div>
                                </div>
                                <div class="show-Price d-none" id="show-Price-sec">
                                    <p>Days: <span id="total-days"></span></p>
                                    <p>Charter Price: {{ $symble }}<span id="charter-pice"></span></p>
                                    <p>Service Fee: {{ $symble }}<span id="charter-fee"></span></p>
                                    <p>Total: {{ $symble }}<span id="charter-total"></span></p>
                                </div>
                                <div class="d-flex flex-column">
                                    @if(Auth::check())
                                        @php
                                            $user = auth()->user();
                                        @endphp
                                        @if($user->role == 'customer')
                                            <a class="mb-2 check_ava_btn" href="javascript:;" data-toggle="modal" data-target="#sidebar-right" class="btn btn-primary navbar-btn pull-left">
                                                Book
                                            </a>
                                        @else
                                            <a class="mb-2 check_ava_btn not-login-user" href="javascript:;">
                                                Book
                                            </a>
                                        @endif
                                    @else
                                        <a class="mb-2 check_ava_btn not-login-user" href="javascript:;">
                                            Book
                                        </a>
                                    @endif
                                    {{-- <span class="mt-1 mb-1 text-center d-block font-weight-bold">or</span>
                                    <button class="btn book_btn">Book</button> --}}
                                    <div class="pt-3 text-center form_text">
                                        <p>You will only be charged if the request is accepted</p>
                                        <p>Pay in 3 or 4 installments without fees with</p>
                                    </div>
                                </div>
                            </form>
                            <!-- Price List Link -->
                            {{-- <div class="mt-2 text-center">
                                <img src="{{ asset('app-assets/site_assets/img/klarna-logo.jpg') }}" />
                            </div> --}}
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
                                @php 
                                    if(session()->has('currency_code')):
                                        $to = session('currency_code');
                                    else:
                                        $to = 'USD';
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
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <ul class="features-menu">
                                        <li><strong>Rules for the boat</strong></li>
                                        <li>Fuel included in price: <strong>{{ $fuel_cost }}</strong></li>
                                        <li>Is skipper included in the price: <strong>{{ $skipper_cost }}</strong></li>
                                        <li>Boat licence required: <strong>Yes (if hired without a skipper)</strong></li>
                                        <li>Minimum rental age: <strong>18 years old</strong></li>
                                        <li>Security Deposit: <strong>{{ $security }}</strong></li>
                                    </ul>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <ul class="features-menu">
                                        <li><strong>Cancellation policy</strong></li>
                                        <li>{{ $cancellation_conditions }}</li>
                                        <li><i class="fa-regular fa-calendar"></i> <a href="#calender_sec_form">Enter dates</a></li>
                                    </ul>
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
            @if (optional($listing->price ?? null)->price)
                <li>
                    <div class="price_block">
                        <p class="price_block_date">Price </p>
                        <p class="price_block_price">{{ $listing->price->price }}</p>
                    </div>
                </li>
            @endif
            @if ($lowseason && isset($listing->seasonPrice[0]))
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
                <li>
                    <div class="price_block">
                        <p class="price_block_date">Low Season Price </p>
                        <p class="price_block_date">{{ $allLowMonth }} </p>
                        <p class="price_block_price">{{ minMaxPrice($lowseason, $listing->seasonPrice[0]->price) }}</p>
                    </div>
                </li>
            @endif
            @if ($midSeason && isset($listing->seasonPrice[1]))
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
                <li>
                    <div class="price_block">
                        <p class="price_block_date">Mid Season Price</p>
                        <p class="price_block_date">{{ $allMidMonth }}  </p>
                        <p class="price_block_price">{{ minMaxPrice($midSeason, $listing->seasonPrice[1]->price) }}</p>
                    </div>
                </li>
            @endif
            @if ($highSeason && isset($listing->seasonPrice[2]))
                @php
                    $hMonths = optional($listing->seasonPrice[2])->from;
                    $allHMonth = '';
                    if($hMonths):
                        $hMonthArray = json_decode($hMonths);
                        if(is_array($hMonthArray))
                        {
                            $allMidMonth = implode(', ',$hMonthArray);
                        }
                    endif;
                @endphp
                <li>
                    <div class="price_block">
                        <p class="price_block_date">High Season Price </p>
                        <p class="price_block_date">{{ $allMidMonth }}  </p>
                        <p class="price_block_price">{{ minMaxPrice($highSeason, $listing->seasonPrice[2]->price) }}</p>
                    </div>
                </li>
            @endif
        </ul>
    </div>
    <!-- Sidebar Right -->
    <div class="modal fade right location-modals" id="sidebar-right" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true"><i class="fa-solid fa-xmark"></i></span></button>
                    <h4 class="modal-title">Contact</h4>
                </div>
                <div class="modal-body">
                    <div class="owner-details-contain">
                        <div class="owner-detail-box">
                            <div class="owner-title">
                                <p>{{ $listing->user->name }}</p>
                            </div>
                            @php
                                $image = $listing->user->getFirstMediaUrl('profile_image');
                                if (!$image):
                                    $image = 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
                                endif;
                            @endphp
                            <div class="owner-avatar">
                                <img src="{{ $image }}" alt="boat">
                            </div>
                        </div>
                        <div class="booking-date-form">
                            <!-- Form for dates -->
                            <form action="{{ route('customer.support.quotation') }}" method="post" id="form-quot">
                                @csrf
                                <div class="row label_form">
                                    <div class="col-md-12">
                                        <label for="checkin_date">Select your dates</label>
                                    </div>
                                </div>
                                <div class="row sidebar_form">
                                    <div class="p-0 col-md-6">
                                        <div class="form-group">
                                            <input type="date" id="qcheckin-date" name="checkin_date" class="form-control" placeholder="Check-in" />
                                            
                                        </div>
                                    </div>
                                    <div class="p-0 col-md-6">
                                        <div class="form-group">
                                            <input type="date" id="qcheckout-date" class="form-control" name="checkout_date" placeholder="Check-out" />
                                            <input type="hidden" id="qdays-val" value="" name="qdays_val" />
                                            <input type="hidden" value="{{ $listing->slug }}" name="slug" />
                                        </div>
                                    </div>
                                </div>
                                <div class="show-Price d-none" id="qshow-Price-sec">
                                    <p>Days: <span id="qtotal-days"></span></p>
                                    <p>Price: {{ $symble }}<span id="qcharter-total"></span></p>
                                </div>
                                <div class="row message-modal-text">
                                    <div class="col-md-12">
                                        <h6>Your message</h6>
                                        <p>Make sure to specify in your message:</p>
                                        <ul>
                                            <li>Number of passengers for your rental</li>
                                            <li>With or without a skipper</li>
                                        </ul>
                                        <textarea class="form-control" name="messages" id="messages"placeholder="Write your message here...">Hello {{ $listing->user->name }}, I am interested in renting your {{ $listing->type }}, is it still available? If yes, can you please send me a message?
                                        </textarea>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <button class="btn book_btn" id="submit-qut" disabled>Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="location-modal-box d-none" >
                        <div class="location-image" style="background:url(https://www.charlestonoutdooradventures.com/wp-content/uploads/2023/02/Sisters-creeks-sunset-beautiful-drone-photo-scaled.jpg)">
                        </div>
                        <div class="expand-location-section">
                            <h2>Expand your options</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin nec tortor mi.</p>
                            <div class="expand_loc_btn">
                                <a href="{{ route('customer.message', $listing->slug) }}">See the conversations</a>
                                <a href="{{ route('search') }}">Receive other quotes</a>
                                <span>Recommended <i class="fa-solid fa-check"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    <!-- Social Share Modal Start -->
    <div class="modal fade share-modal" id="share-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h4 class="modal-title">Share</h4>
                    <ul>
                        <li>
                            <a target="blank" href="https://wa.me/?text={{ route('singleboat', ['city' => $listing->city, 'type' => $listing->type, 'slug' => $listing->slug]) }}">
                                <svg _ngcontent-ng-c161688016="" fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-ng-c161688016="" clip-path="url(#clip2)"><path _ngcontent-ng-c161688016="" d="M20.4124 3.48767C18.1662 1.2399 15.1794 0.0013409 11.9972 -3.05176e-05C5.43974 -3.05176e-05 0.103289 5.33473 0.100664 11.8919C0.0998996 13.9879 0.647563 16.034 1.68852 17.8375L0.000785828 24L6.30728 22.3464C8.04484 23.294 10.0012 23.7933 11.9921 23.7941H11.9971H11.9972C18.5536 23.7941 23.8909 18.4584 23.8936 11.9016C23.8947 8.72363 22.6584 5.7356 20.4124 3.48767ZM11.9972 21.7855H11.9933C10.2188 21.7846 8.47857 21.3082 6.9607 20.4075L6.59947 20.1933L2.85706 21.1745L3.85623 17.5271L3.62088 17.1531C2.63101 15.5792 2.10845 13.7603 2.10919 11.8927C2.11137 6.44256 6.54682 2.00864 12.0009 2.00864C14.6421 2.00974 17.1245 3.03924 18.9915 4.90752C20.8584 6.77577 21.8857 9.25937 21.8849 11.9007C21.8826 17.351 17.447 21.7855 11.9972 21.7855Z" fill="#E0E0E0"></path><path _ngcontent-ng-c161688016="" d="M0.546951 23.3163L2.15759 17.4353C1.16393 15.7141 0.641383 13.7614 0.64201 11.7615C0.644615 5.50395 5.73735 0.413025 11.9947 0.413025C15.0317 0.414396 17.8822 1.59632 20.0253 3.74147C22.1689 5.88659 23.3487 8.73794 23.3474 11.7704C23.3448 18.028 18.2518 23.1194 11.9952 23.1194C11.9947 23.1194 11.9955 23.1194 11.9952 23.1194H11.9901C10.0902 23.1188 8.22333 22.6419 6.56525 21.7382L0.546951 23.3163Z" fill="url(#paint2_linear)"></path><path _ngcontent-ng-c161688016="" clip-rule="evenodd" d="M9.05749 6.84321C8.8374 6.35387 8.60567 6.34408 8.39628 6.33551C8.22501 6.32817 8.02893 6.32862 7.83317 6.32862C7.63726 6.32862 7.3189 6.40224 7.04967 6.69627C6.78028 6.9903 6.02111 7.70111 6.02111 9.14675C6.02111 10.5926 7.07416 11.9895 7.22094 12.1857C7.36787 12.3817 9.25372 15.4432 12.2404 16.6209C14.7225 17.5998 15.2276 17.4051 15.7664 17.3561C16.3052 17.3071 17.5048 16.6454 17.7497 15.9593C17.9946 15.2732 17.9946 14.6852 17.9212 14.5623C17.8477 14.4398 17.6518 14.3664 17.3579 14.2194C17.064 14.0725 15.6195 13.3615 15.3501 13.2636C15.0807 13.1656 14.8848 13.1166 14.6889 13.4108C14.4929 13.7047 13.9301 14.3664 13.7587 14.5623C13.5873 14.7586 13.4159 14.7831 13.122 14.6362C12.8281 14.4888 11.8817 14.1788 10.7591 13.1778C9.88555 12.3991 9.2958 11.4372 9.12438 11.1431C8.95295 10.8492 9.106 10.69 9.25341 10.5435C9.38534 10.4119 9.54728 10.2005 9.69422 10.0289C9.84084 9.85736 9.88982 9.73491 9.98778 9.53899C10.0857 9.34276 10.0368 9.1712 9.96329 9.02426C9.88982 8.87733 9.31876 7.42422 9.05749 6.84321Z" fill="white" fill-rule="evenodd"></path><path _ngcontent-ng-c161688016="" d="M20.3152 3.44993C18.0947 1.22797 15.1422 0.0036493 11.9966 0.0022583C5.51442 0.0022583 0.239259 5.27576 0.236653 11.7577C0.235889 13.8296 0.777261 15.8522 1.80626 17.635L0.137932 23.7267L6.372 22.0921C8.08962 23.0288 10.0235 23.5224 11.9915 23.5232H11.9965H11.9966C18.4777 23.5232 23.7536 18.2487 23.7564 11.7671C23.7575 8.62577 22.5353 5.67204 20.3152 3.44993ZM11.9966 21.5377H11.9928C10.2386 21.5368 8.51834 21.0658 7.01791 20.1755L6.66082 19.9638L2.9614 20.9337L3.94908 17.3281L3.71643 16.9585C2.73794 15.4026 2.22137 13.6046 2.22213 11.7584C2.22427 6.37091 6.60878 1.9879 12.0003 1.9879C14.6112 1.98898 17.065 3.00667 18.9106 4.85349C20.756 6.70031 21.7715 9.15537 21.7708 11.7664C21.7685 17.1541 17.3838 21.5377 11.9966 21.5377Z" fill="white"></path></g><defs _ngcontent-ng-c161688016=""><linearGradient _ngcontent-ng-c161688016="" gradientUnits="userSpaceOnUse" id="paint2_linear" x1="11.9472" x2="11.9472" y1="23.3163" y2="0.413063"><stop _ngcontent-ng-c161688016="" stop-color="#20B038"></stop><stop _ngcontent-ng-c161688016="" offset="1" stop-color="#60D66A"></stop></linearGradient><clipPath _ngcontent-ng-c161688016="" id="clip2"><rect _ngcontent-ng-c161688016="" fill="white" height="24" width="23.8944"></rect></clipPath></defs></svg>
                                Whatsapp
                            </a>
                        </li>
                        <li>
                            <a target="blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('singleboat', ['city' => $listing->city, 'type' => $listing->type, 'slug' => $listing->slug]) }}">
                                <svg _ngcontent-ng-c161688016="" fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-ng-c161688016="" clip-path="url(#clip1)"><path _ngcontent-ng-c161688016="" d="M10.3333 21.8889C5.61111 21.0556 2 16.9444 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12C22 16.9444 18.3889 21.0556 13.6667 21.8889L13.1111 21.4444H10.8889L10.3333 21.8889Z" fill="url(#paint1_linear)"></path><path _ngcontent-ng-c161688016="" d="M15.8889 14.7778L16.3333 12H13.6667V10.0556C13.6667 9.27777 13.9444 8.66666 15.1667 8.66666H16.4444V6.11111C15.7222 6 14.9444 5.88889 14.2222 5.88889C11.9444 5.88889 10.3333 7.27777 10.3333 9.77777V12H7.83333V14.7778H10.3333V21.8333C10.8889 21.9444 11.4444 22 12 22C12.5556 22 13.1111 21.9444 13.6667 21.8333V14.7778H15.8889Z" fill="white"></path></g><defs _ngcontent-ng-c161688016=""><linearGradient _ngcontent-ng-c161688016="" gradientUnits="userSpaceOnUse" id="paint1_linear" x1="12" x2="12" y1="21.3078" y2="2"><stop _ngcontent-ng-c161688016="" stop-color="#0062E0"></stop><stop _ngcontent-ng-c161688016="" offset="1" stop-color="#19AFFF"></stop></linearGradient><clipPath _ngcontent-ng-c161688016="" id="clip1"><rect _ngcontent-ng-c161688016="" fill="white" height="20" width="20" x="2" y="2"></rect></clipPath></defs></svg>
                                Facebook
                            </a>
                        </li>
                        <li>
                            <a target="blank" href="mailto:?subject=Check out this post&body=I thought you might like this: {{ route('singleboat', ['city' => $listing->city, 'type' => $listing->type, 'slug' => $listing->slug]) }}">
                                <svg name="icon-email-24" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 6C22 4.9 21.1 4 20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6ZM20 6L12 11L4 6H20ZM20 18H4V8L12 13L20 8V18Z"></path>
                                </svg>
                                Email
                            </a>
                        </li>
                        <li>
                            <a href="#" onclick="copyToClipboard('{{ route('singleboat', ['city' => $listing->city, 'type' => $listing->type, 'slug' => $listing->slug]) }}'); return false;">
                                <svg name="icon-copy-24" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 1H4C2.9 1 2 1.9 2 3V17H4V3H16V1ZM15 5H8C6.9 5 6.01 5.9 6.01 7L6 21C6 22.1 6.89 23 7.99 23H19C20.1 23 21 22.1 21 21V11L15 5ZM8 21V7H14V12H19V21H8Z"></path>
                                </svg>
                                Copy the link
                            </a>
                        </li>
                    </ul>
                </div>
            
            </div>
        </div>
    </div>
</div>
<!-- Social Share Modal End -->
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
<!-- Button trigger modal -->
<button type="button" class="btn bookbutton_fix" data-toggle="modal" data-target="#bookbutton">
  Book
</button>

<!-- Modal -->
<div class="modal fade single_boat_popup" id="bookbutton" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
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
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <div class="row sidebar_form">
                            <div class="p-0 col-md-6">
                                <div class="form-group">
                                    <input type="date" id="checkin-date" name="checkin_date"
                                        class="form-control" placeholder="Check-in" />
                                </div>
                            </div>
                            <div class="p-0 col-md-6">
                                <div class="form-group">
                                    <input type="date" id="checkout-date" class="form-control"
                                        name="checkout_date" placeholder="Check-out" />
                                    <input type="hidden" id="days-val" value="" name="days_val" />
                                </div>

                            </form>
                            <!-- Price List Link -->
                           

                            </div>
                        </div>
                        <div class="show-Price d-none" id="show-Price-sec">
                            <p>Days: <span id="total-days"></span></p>
                            <p>Charter Price: <span id="charter-pice"></span></p>
                            <p>Service Fee: <span id="charter-fee"></span></p>
                            <p>Total: <span id="charter-total"></span></p>
                        </div>
                        <div class="d-flex flex-column">
                            @if(Auth::check())
                                @php
                                    $user = auth()->user();
                                @endphp
                                @if($user->role == 'customer')
                                    <a class="mb-2 check_ava_btn" href="javascript:;" data-toggle="modal" data-target="#sidebar-right" class="btn btn-primary navbar-btn pull-left">
                                        Book
                                    </a>
                                @else
                                    <a class="mb-2 check_ava_btn not-login-user" href="javascript:;">
                                        Book
                                    </a>
                                @endif
                            @else
                                <a class="mb-2 check_ava_btn not-login-user" href="javascript:;">
                                    Book
                                </a>
                            @endif
                            
                            {{-- <span class="mt-1 mb-1 text-center d-block font-weight-bold">or</span>
                            <button class="btn book_btn">Book</button> --}}
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
      </div>
    </div>
  </div>
</div>
@endsection
