@extends('layouts.front.common')

@section('meta')
<title>Locations</title>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAli6rCJivgzTbWznnkqFtT_btPww6WBYs&libraries=places"></script>
    <script>
        /* Price range Slider */
        const rangevalue = document.querySelector(".slider-container .price-slider");
        const rangeInputvalue = document.querySelectorAll(".range-input input");
        let priceGap = 50;
        const priceInputvalue = document.querySelectorAll(".price-input input");

        const form = document.getElementById("priceForm"); // Get the form element

        let timeout; // Timeout variable for debounce effect

        // Function to submit the form
        const submitForm = () => {
            $('#search-filter-fom').submit(); // Trigger the form submission using jQuery
        };

        for (let i = 0; i < priceInputvalue.length; i++) {
            priceInputvalue[i].addEventListener("input", e => {
                let minp = parseInt(priceInputvalue[0].value);
                let maxp = parseInt(priceInputvalue[1].value);
                let diff = maxp - minp;

                if (minp < 0) {
                    alert("Minimum price cannot be less than 0");
                    priceInputvalue[0].value = 0;
                    minp = 0;
                }
                if (maxp > {{ maxPriceValue() }}) {
                    alert("Maximum price cannot be greater than 10000");
                    priceInputvalue[1].value = {{ maxPriceValue() }};
                    maxp = {{ maxPriceValue() }};
                }
                if (minp > maxp - priceGap) {
                    priceInputvalue[0].value = maxp - priceGap;
                    minp = maxp - priceGap;

                    if (minp < 0) {
                        priceInputvalue[0].value = 0;
                        minp = 0;
                    }
                }
                if (diff >= priceGap && maxp <= rangeInputvalue[1].max) {
                    if (e.target.className === "min-input") {
                        rangeInputvalue[0].value = minp;
                        let value1 = rangeInputvalue[0].max;
                        rangevalue.style.left = `${(minp / value1) * 100}%`;
                    } else {
                        rangeInputvalue[1].value = maxp;
                        let value2 = rangeInputvalue[1].max;
                        rangevalue.style.right = `${100 - (maxp / value2) * 100}%`;
                    }
                }
                clearTimeout(timeout);
                timeout = setTimeout(submitForm, 1000); 
            });

            for (let i = 0; i < rangeInputvalue.length; i++) {
                rangeInputvalue[i].addEventListener("input", e => {
                    let minVal = parseInt(rangeInputvalue[0].value);
                    let maxVal = parseInt(rangeInputvalue[1].value);
                    let diff = maxVal - minVal;

                    if (diff < priceGap) {
                        if (e.target.className === "min-range") {
                            rangeInputvalue[0].value = maxVal - priceGap;
                        } else {
                            rangeInputvalue[1].value = minVal + priceGap;
                        }
                    } else {
                        priceInputvalue[0].value = minVal;
                        priceInputvalue[1].value = maxVal;
                        rangevalue.style.left = `${(minVal / rangeInputvalue[0].max) * 100}%`;
                        rangevalue.style.right = `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`;
                    }

                    clearTimeout(timeout);
                    timeout = setTimeout(submitForm, 1000); 
                });
            }
        }
        /* Length range  Slider*/
        const lengthvalue = document.querySelector(".slider-container-length .length-slider");
        const lengthInputvalue = document.querySelectorAll(".boat-input input");
        let lengthGap = 10;
        const priceInputvalues =  document.querySelectorAll(".length-input input");
        for (let i = 0; i < priceInputvalues.length; i++) 
        {
            priceInputvalues[i].addEventListener("input", e => {
                let minp = parseInt(priceInputvalues[0].value);
                let maxp = parseInt(priceInputvalues[1].value);
                let diff = maxp - minp
                if (minp < 0) {
                    alert("minimum length cannot be less than 0");
                    priceInputvalues[0].value = 0;
                    minp = 0;
                }
                if (maxp > {{ maxLengthValue() }}) {
                    alert("maximum length cannot be greater than 10000");
                    priceInputvalues[1].value = {{ maxLengthValue() }};
                    maxp = {{ maxLengthValue() }};
                }
                if (minp > maxp - lengthGap) {
                    priceInputvalues[0].value = maxp - lengthGap;
                    minp = maxp - lengthGap;

                    if (minp < 0) {
                        priceInputvalues[0].value = 0;
                        minp = 0;
                    }
                }
                if (diff >= lengthGap && maxp <= lengthInputvalue[1].max) {
                    if (e.target.className === "min-length") {
                        lengthInputvalue[0].value = minp;
                        let value1 = lengthInputvalue[0].max;
                        lengthvalue.style.left = `${(minp / value1) * 100}%`;
                    }
                    else {
                        lengthInputvalue[1].value = maxp;
                        let value2 = lengthInputvalue[1].max;
                        lengthvalue.style.right = 
                            `${100 - (maxp / value2) * 100}%`;
                    }
                }
                clearTimeout(timeout);
                timeout = setTimeout(submitForm, 1000);
            });

            for (let i = 0; i < lengthInputvalue.length; i++) {
                lengthInputvalue[i].addEventListener("input", e => {
                    let minVal = parseInt(lengthInputvalue[0].value);
                    let maxVal = parseInt(lengthInputvalue[1].value);
                    let diff = maxVal - minVal
                    if (diff < lengthGap) {
                        if (e.target.className === "min-boat-range") {
                            lengthInputvalue[0].value = maxVal - lengthGap;
                        }
                        else {
                            lengthInputvalue[1].value = minVal + lengthGap;
                        }
                    }
                    else {
                        priceInputvalues[0].value = minVal;
                        priceInputvalues[1].value = maxVal;
                        lengthvalue.style.left = `${(minVal / lengthInputvalue[0].max) * 100}%`;
                        lengthvalue.style.right = `${100 - (maxVal / lengthInputvalue[1].max) * 100}%`;
                    }
                    clearTimeout(timeout);
                    timeout = setTimeout(submitForm, 1000); 
                });
            }
        }
        flatpickr(".datePicker", {
            inline: false,          
            dateFormat: "d-m-Y", 
            minDate: "today",   
        });
        $(document).ready(function () {
            google.maps.event.addDomListener(window, 'load', initialize);
        });
        function initialize() 
        {
            var input = document.getElementById('location');
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
    <section class="location_page_banner">
        <div class="location_banner_text">
            <h1>Charter a motor boat or motor yacht<br>
                on Booker Boat at best price
            </h1>
        </div>
    </section>
    <!-- /Banner Section -->
    <!-- Location Filter Section -->
    <section class="location_filter_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <form action="{{ route('search') }}" method="get" id="search-filter-fom">
                        <div class="location_leftside_box">
                            <div class="location_options">
                                <ul>
                                    <li>
                                        <div class="where_box">
                                            <div class="icon_box">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </div>
                                            <div class="where_box_text">
                                                <h5>Where</h5>
                                                <input type="search" value="{{ request()->query('location') ?? '' }}" id="location" name="location" placeholder="City ofdeparture">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="where_box">
                                            <div class="icon_box">
                                                <i class="fa-solid fa-calendar-days"></i>
                                            </div>
                                            <div class="where_box_text">
                                                <h5>Dates</h5>
                                                <input type="text" id="calender" name="calender" class="datePicker"/>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="where_box">
                                            <div class="icon_box">
                                                <i class="fa-solid fa-person-skiing-nordic"></i>
                                            </div>
                                            <div class="where_box_text">
                                                <h5>Rental Type</h5>
                                                <select name="rental_type" id="rental_type">
                                                    <option  value="">With Or Without Skipper</option>
                                                    <option {{ checkselect(request()->query('rental_type'), 'with skipper') }} value="with skipper">With Skipper</option>
                                                    <option {{ checkselect(request()->query('rental_type'), 'without skipper') }} value="without skipper">Without Skipper</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="location_checkbox_one">
                            <div class="input-group">
                                <input type="checkbox" id="Halfday" name="halfday" value="1" {{ singleCheckbox(request()->query('halfday'),'1') }}>
                                <label for="Halfday"> Half day</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Fullday" name="fullday" value="1" {{ singleCheckbox(request()->query('fullday'),'1') }}>
                                <label for="Fullday">Full day</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Overnightstay" name="overnightstay" value="1" {{ singleCheckbox(request()->query('overnightstay'),'1') }}>
                                <label for="Overnightstay"> Overnight stay</label>
                            </div>
                        </div>
                        <div class="location_checkbox_two">
                            <h5>Boat type</h5>
                            <div class="input-group">
                                <input type="checkbox" id="All" name="All" value="All">
                                <label for="All"> All</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Sailboat" name="type[]" value="Sailboat" {{ checkCheckbox(request()->query('type'),'Sailboat') }}>
                                <label for="Sailboat">Sailboat</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Motorboat" name="type[]" value="Motorboat" {{ checkCheckbox(request()->query('type'),'Motorboat') }}>
                                <label for="Motorboat">Motorboat</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Catamaran" name="type[]" value="Catamaran" {{ checkCheckbox(request()->query('type'),'Catamaran') }}>
                                <label for="Catamaran"> Catamaran</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Sailingyacht" name="type[]" value="Sailingyacht" {{ checkCheckbox(request()->query('type'),'Sailingyacht') }}>
                                <label for="Sailingyacht"> Sailing yacht</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Fishingboat" name="type[]" value="Fishingboat" {{ checkCheckbox(request()->query('type'),'Fishingboat') }}>
                                <label for="Fishingboat"> Fishing boat</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Monohull" name="type[]" value="Monohull" {{ checkCheckbox(request()->query('type'),'Monohull') }}>
                                <label for="Monohull"> Monohull</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Jetskis" name="type[]" value="Jetskis" {{ checkCheckbox(request()->query('type'),'Jetskis') }}>
                                <label for="Jetskis"> Jet skis</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Rib" name="type[]" value="Rib" {{ checkCheckbox(request()->query('type'),'Rib') }}>
                                <label for="Rib"> Rib</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Yacht" name="type[]" value="Yacht" {{ checkCheckbox(request()->query('type'),'Yacht') }}>
                                <label for="Yacht"> Yacht</label>
                            </div>
                        </div>
                        <div class="location_checkbox_two">
                            <h5>Filter by Marina</h5>
                            <div class="input-group">
                                <input type="checkbox" id="All" name="All" value="All">
                                <label for="All"> All</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Marinasantaeulalia" name="Marinasantaeulalia"
                                    value="Marinasantaeulalia">
                                <label for="Marinasantaeulalia">Marina santa eulalia</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Puertosantantoni" name="Puertosantantoni"
                                    value="Puertosantantoni">
                                <label for="Puertosantantoni"> Puerto sant antoni</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Marinaibiza" name="Marinaibiza" value="Marinaibiza">
                                <label for="Marinaibiza"> Marina ibiza</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Marinabotafoch" name="Marinabotafoch" value="Marinabotafoch">
                                <label for="Marinabotafoch"> Marina botafoch</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Ibizamagna" name="Ibizamagna" value="Ibizamagna">
                                <label for="Ibizamagna"> Ibiza magna</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Clubnautico" name="Clubnautico" value="Clubnautico">
                                <label for="Clubnautico"> Club nautico</label>
                            </div>
                        </div>
                        <div class="location_checkbox_two">
                            <h5>Boat length</h5>
                            <div class="custom-wrapper">
                                <div class="boat-input">
                                    <input type="range" class="min-boat-range" min="0" max="{{ maxLengthValue() }}" value="{{ request()->query('min-length') ?? 0 }}" step="10">
                                    <input type="range" class="max-boat-range" min="0" max="{{ maxLengthValue() }}" value="{{ request()->query('max-length') ?? maxLengthValue() }}" step="10">
                                </div>
                                <div class="price-input-container">
                                    <div class="slider-container-length">
                                        <div class="length-slider">
                                        </div>
                                    </div>
                                    <div class="length-input">
                                        <div class="price-field">
                                            <input type="number" name="min-length" class="min-length-input" value="{{ request()->query('min-length') ?? 0}}">
                                        </div>
                                        <div class="price-field">
                                            <input type="number" name="max-length" class="max-length-input" value="{{ request()->query('max-length') ?? maxLengthValue() }}">
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="location_checkbox_two">
                            <h5>Price per day</h5>
                            <div class="custom-wrapper">
                                <div class="range-input">
                                    <input type="range" class="min-range" min="0" max="{{ maxPriceValue() }}" value="{{ request()->query('min_price') ?? 0 }}" step="50">
                                    <input type="range" class="max-range" min="0" max="{{ maxPriceValue() }}" value="{{ request()->query('max_price') ?? maxPriceValue() }}" step="50">
                                </div>
                                <div class="price-input-container">
                                    <div class="slider-container">
                                        <div class="price-slider">
                                        </div>
                                    </div>
                                    <div class="price-input">
                                        <div class="price-field">
                                            <input type="number" name="min_price" class="min-input" value="{{ request()->query('min_price') ?? 0 }}">
                                        </div>
                                        <div class="price-field">
                                            <input type="number" name="max_price" class="max-input" value="{{ request()->query('max_price') ?? maxPriceValue() }}">
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="location_checkbox_two">
                            <div class="toggle_filter">
                                <div class="toggle_text">
                                    <label>Super Owners</label>
                                    <p>Rent from well-reputed boat owners</p>
                                </div>
                                <div class="toggle_btn">
                                    <button type="button" class="btn btn-sm btn-toggle active" data-toggle="button"
                                        aria-pressed="true" autocomplete="off">
                                        <div class="handle"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="location_checkbox_two">
                            <h5>Ideal for</h5>
                            <div class="input-group">
                                <input type="checkbox" id="wakeboard-water" name="Wakeboard" value="Wakeboard">
                                <label for="wakeboard-water"> Wakeboard and water skis</label><br>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="water-based" name="waterbased" value="waterbased">
                                <label for="water-based">Water-based activities</label><br>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="unique-experience" name="uniqueexperience"
                                    value="uertosantantoni">
                                <label for="unique-experience"> Unique experience</label><br>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="fishing" name="fishing" value="fishing">
                                <label for="fishing"> Fishing</label><br>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="events" name="events" value="events">
                                <label for="events"> Events</label><br>
                            </div>
                        </div>
                        <div class="location_checkbox_two">
                            <h5>Equipment</h5>
                            <div class="input-group">
                                <input type="checkbox" id="wakeboard" name="Wakeboard" value="Wakeboard">
                                <label for="wakeboard"> Wakeboard</label><br>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="towable-tube" name="towable" value="towable">
                                <label for="towable-tube">Towable Tube</label><br>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="watermaker" name="watermaker" value="watermaker">
                                <label for="watermaker"> Watermaker</label><br>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="generator" name="generator" value="generator">
                                <label for="generator"> Generator</label><br>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="air-conditioning" name="Conditioning" value="Conditioning">
                                <label for="air-conditioning"> Air Conditioning</label><br>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="external-speakers" name="external" value="external">
                                <label for="external-speakers"> External speakers</label><br>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="events" name="events" value="events">
                                <label for="events"> Air Conditioning</label><br>
                            </div>
                        </div>
                        <div class="location_checkbox_two">
                            <div class="toggle_filter">
                                <div class="toggle_text">
                                    <label>Free cancellation</label>
                                    <p>Refunds are possible until the day before departure</p>
                                </div>
                                <div class="toggle_btn">
                                    <button type="button" class="btn btn-sm btn-toggle active" data-toggle="button"
                                        aria-pressed="true" autocomplete="off">
                                        <div class="handle"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="toggle_filter">
                                <div class="toggle_text">
                                    <label>Highest rated <i class="fa-solid fa-star"></i></label>
                                    <p>ROnly display boats with a rating over 4 stars</p>
                                </div>
                                <div class="toggle_btn">
                                    <button type="button" class="btn btn-sm btn-toggle active" data-toggle="button"
                                        aria-pressed="true" autocomplete="off">
                                        <div class="handle"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-9">
                    <div class="location_rightside_box">
                        <div class="location_main_heading">
                            <h2>{{ count($results) }} boats available</h2>
                        </div>
                        <div class="row">
                            @if($results)
                                @foreach ($results as $result)                                                                                                                                                                                                                                                                                  
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <a href="{{ route('singleboat', ['city' => $result->city, 'type' => $result->type, 'slug' => $result->slug]) }}">
                                            <div class="location_inner_box">
                                                <img src="{{ $result->getFirstMediaUrl('cover_images') ? $result->getFirstMediaUrl('cover_images') : 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png' }}">
                                                <div class="wishlist_icon">
                                                    <i class="fa-regular fa-heart"></i>
                                                </div> 
                                                <div class="location_inner_main_box">
                                                    <div class="location_inner_text">
                                                        <h3>{{ $result->city }}</h3>
                                                        <p class="location_pera">{{ $result->type }} {{ $result->manufacturer }} {{ $result->model }} sport 30 (2023)</p>
                                                        <p class="people_pera">{{ $result->capacity }} people · 30 hp · 5 m</p>
                                                        <h5 class="location_price">From <span class="price_style">€{{ $result->price->price ?? '' }}</span> / day</h5>
                                                        <div class="location_facility">
                                                            <ul>
                                                                <li>{{ $result->skipper }}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="location_review_box">
                                                        <span>Flexible cancellation</span>
                                                        <span><i class="fa-solid fa-star"></i> NEW</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="location_pagination">
                        {{ $results->appends(request()->all())->links('pagination::default') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection