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
                                <input type="checkbox" id="Halfday" name="Halfday" value="Halfday">
                                <label for="Halfday"> Half day</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Fullday" name="Fullday" value="Fullday">
                                <label for="Fullday">Full day</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="Overnightstay" name="Overnightstay" value="Overnightstay">
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
                        </div>
                        <div class="location_checkbox_two">
                            <h5>Price per day</h5>
                        </div>
                        <div class="location_checkbox_two">
                            <div class="row">
                                <div class="number_list">
                                    <label>Number of peoples</label>
                                    <div class="number_list_filter">
                                        <div class="number_counter">
                                            <a href="#"><i class="fa-solid fa-minus"></i></a>
                                            <input type="number" id="quantity" name="quantity" min="1" max="5">
                                            <a href="#"><i class="fa-solid fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="number_list">
                                    <label>Number of cabins</label>
                                    <div class="number_list_filter">
                                        <div class="number_counter">
                                            <a href="#"><i class="fa-solid fa-minus"></i></a>
                                            <input type="number" id="quantity" name="quantity" min="1" max="5">
                                            <a href="#"><i class="fa-solid fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="number_list">
                                    <label>Number of berths</label>
                                    <div class="number_list_filter">
                                        <div class="number_counter">
                                            <a href="#"><i class="fa-solid fa-minus"></i></a>
                                            <input type="number" id="quantity" name="quantity" min="1" max="5">
                                            <a href="#"><i class="fa-solid fa-plus"></i></a>
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
                                                    <h5 class="location_price">From <span class="price_style">€27</span> / day</h5>
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