@extends('layouts.front.common')

@section('meta')
<title>Locations</title>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
    <link href="{{ asset('app-assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAli6rCJivgzTbWznnkqFtT_btPww6WBYs&libraries=places"></script>
    <script src="{{ asset('app-assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
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
            $(document).on('click','.favorite_item', function(){
                var list = $(this).attr('list');
                var self =  $(this)
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
                                self.html('<i class="fa-solid fa-heart"></i>');
                            }
                            else
                            {
                                self.html('<i class="fa-regular fa-heart"></i>');
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
        /* Price range Slider */
        let timeout;
        const submitForm = () => {
           $('#search-filter-fom').submit(); 
        };
        // const rangevalue = document.querySelector(".slider-container .price-slider");
        // const rangeInputvalue = document.querySelectorAll(".range-input input");
        // let priceGap = 50;
        // const priceInputvalue = document.querySelectorAll(".price-input input");

        // const form = document.getElementById("priceForm"); // Get the form element

        // let timeout; // Timeout variable for debounce effect

        // // Function to submit the form
        // const submitForm = () => {
        //     $('#search-filter-fom').submit(); // Trigger the form submission using jQuery
        // };

        // for (let i = 0; i < priceInputvalue.length; i++) {
        //     priceInputvalue[i].addEventListener("input", e => {
        //         let minp = parseInt(priceInputvalue[0].value);
        //         let maxp = parseInt(priceInputvalue[1].value);
        //         let diff = maxp - minp;

        //         if (minp < 0) {
        //             alert("Minimum price cannot be less than 0");
        //             priceInputvalue[0].value = 0;
        //             minp = 0;
        //         }
        //         if (maxp > {{ maxPriceValue() }}) {
        //             alert("Maximum price cannot be greater than 10000");
        //             priceInputvalue[1].value = {{ maxPriceValue() }};
        //             maxp = {{ maxPriceValue() }};
        //         }
        //         if (minp > maxp - priceGap) {
        //             priceInputvalue[0].value = maxp - priceGap;
        //             minp = maxp - priceGap;

        //             if (minp < 0) {
        //                 priceInputvalue[0].value = 0;
        //                 minp = 0;
        //             }
        //         }
        //         if (diff >= priceGap && maxp <= rangeInputvalue[1].max) {
        //             if (e.target.className === "min-input") {
        //                 rangeInputvalue[0].value = minp;
        //                 let value1 = rangeInputvalue[0].max;
        //                 rangevalue.style.left = `${(minp / value1) * 100}%`;
        //             } else {
        //                 rangeInputvalue[1].value = maxp;
        //                 let value2 = rangeInputvalue[1].max;
        //                 rangevalue.style.right = `${100 - (maxp / value2) * 100}%`;
        //             }
        //         }
        //         clearTimeout(timeout);
        //         timeout = setTimeout(submitForm, 1000); 
        //     });

        //     for (let i = 0; i < rangeInputvalue.length; i++) {
        //         rangeInputvalue[i].addEventListener("input", e => {
        //             let minVal = parseInt(rangeInputvalue[0].value);
        //             let maxVal = parseInt(rangeInputvalue[1].value);
        //             let diff = maxVal - minVal;

        //             if (diff < priceGap) {
        //                 if (e.target.className === "min-range") {
        //                     rangeInputvalue[0].value = maxVal - priceGap;
        //                 } else {
        //                     rangeInputvalue[1].value = minVal + priceGap;
        //                 }
        //             } else {
        //                 priceInputvalue[0].value = minVal;
        //                 priceInputvalue[1].value = maxVal;
        //                 rangevalue.style.left = `${(minVal / rangeInputvalue[0].max) * 100}%`;
        //                 rangevalue.style.right = `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`;
        //             }

        //             clearTimeout(timeout);
        //             timeout = setTimeout(submitForm, 1000); 
        //         });
        //     }
        // }
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
    @if($isMobile)
        <!-- Filter Mobile Section -->
        <section class="location_filter_mobile">
            <div class="container">
                <form action="{{ route('search') }}" method="get" id="search-filter-mobile">
                    <div class="row mob_filter_one">
                        <div class="col location_col">
                            <div class="form-group has-search">
                                <span class="fa fa-search form-control-feedback"></span>
                                <select name="location" class="loaction-search" placeholder="Search Loaction">
                                    <option value="">All Marinas</option>
                                    <option {{ checkselect(request()->query('location'), 'Marina Santa Eulalia') }} value="Marina Santa Eulalia">Marina Santa Eulalia</option>
                                    <option {{ checkselect(request()->query('location'), 'Puerto Sant Antoni') }} value="Puerto Sant Antoni">Puerto Sant Antoni</option>
                                    <option {{ checkselect(request()->query('location'), 'Marina Ibiza') }} value="Marina Ibiza">Marina Ibiza</option>
                                    <option {{ checkselect(request()->query('location'), 'Marina Botafoch') }} value="Marina Botafoch">Marina Botafoch</option>
                                    <option {{ checkselect(request()->query('location'), 'Ibiza Magna') }} value="Ibiza Magna">Ibiza Magna</option>
                                    <option {{ checkselect(request()->query('location'), 'Club Nautico') }} value="Club Nautico">Club Nautico</option>
                                </select>
                            </div>
                        </div>
                        <div class="col date_col">
                            <div class="mb-4 form-group">
                                <div class="datepicker date input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                                    </div>
                                    <input type="date" value="{{ request()->query('startdate') }}" id="calender" name="calender" class="datePicker form-control datePicker-search"
                                        placeholder="Add your dates" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mob_filter_two">
                        <div class="col-md-8">
                            <select name="type[]" id="boats">
                                <option value="">Boat</option>
                                <option {{ checkSelectMulti(request()->query('type'),'Motorboat') }} value="Motorboat">Motorboat</option>
                                <option {{ checkSelectMulti(request()->query('type'),'Sailboat') }} value="Sailboat">Sailboat</option>
                                <option {{ checkSelectMulti(request()->query('type'),'Rib') }} value="Ribs">Rib</option>
                                <option {{ checkSelectMulti(request()->query('type'),'Catamaran') }} value="Catamaran">Catamaran</option>
                                <option {{ checkSelectMulti(request()->query('type'),'Yacht') }} value="Yacht">Yacht</option>
                                <option {{ checkSelectMulti(request()->query('type'),'Sailingyacht') }} value="Sailingyacht">Sailing yacht</option>
                                <option {{ checkSelectMulti(request()->query('type'),'Monohull') }} value="Monohull">Monohull</option>
                            </select>
                            <select name="rental_type" id="rental_type">
                                <option value="">Skipper</option>
                                <option {{ checkselect(request()->query('rental_type'), 'With Skipper') }} value="With Skipper">With Skipper</option>
                                <option {{ checkselect(request()->query('rental_type'), 'Without Skipper') }} value="Without Skipper">Without Skipper</option>
                                <option {{ checkselect(request()->query('rental_type'), 'With Skipper Or Without Skipper') }} value="With Skipper Or Without Skipper">Both</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="button" data-toggle="modal" data-target="#staticBackdrop" class="btn filter_btn"><i class="fa-solid fa-sliders"></i> Filter</button>
                        </div>
                    </div>
                    <input type="hidden"value="{{ request()->query('people') ?? 0 }}" name="people">
                    <input type="hidden"value="{{ request()->query('cabins') ?? 0 }}" name="cabins">
                    <input type="hidden"value="{{ request()->query('berths') ?? 0 }}" name="berths">
                    <input type="hidden"value="{{ request()->query('equipment') ?? 0 }}" name="equipment">
                    <input type="hidden"value="{{ request()->query('min_length') ?? 0 }}" name="min_length">
                    <input type="hidden"value="{{ request()->query('max_length') ?? 0 }}" name="max_length">
                </form>
            </div>
        </section>
    @endif
    <!-- Banner Section -->
    <section class="location_page_banner">
        <div class="location_banner_text">
        <h1>FIND YOUR IBIZA BOAT RENTAL AT THE <br>BEST PRICE WITH MY BOAT BOOKER
        </h1>
        </div>
    </section>
    <!-- /Banner Section -->
    <!-- Location Filter Section -->
    <section class="location_filter_section">
        <div class="container-fluid">
            <div class="row">
                @if(!$isMobile)
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <form action="{{ route('search') }}" method="get" id="search-filter-fom" class="desktop_filter_section">
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
                                                <select name="location" class="loaction-search" placeholder="Search Loaction">
                                                    <option value="">All Marinas</option>
                                                    <option {{ checkselect(request()->query('location'), 'Marina Santa Eulalia') }} value="Marina Santa Eulalia">Marina Santa Eulalia</option>
                                                    <option {{ checkselect(request()->query('location'), 'Puerto Sant Antoni') }} value="Puerto Sant Antoni">Puerto Sant Antoni</option>
                                                    <option {{ checkselect(request()->query('location'), 'Marina Ibiza') }} value="Marina Ibiza">Marina Ibiza</option>
                                                    <option {{ checkselect(request()->query('location'), 'Marina Botafoch') }} value="Marina Botafoch">Marina Botafoch</option>
                                                    <option {{ checkselect(request()->query('location'), 'Ibiza Magna') }} value="Ibiza Magna">Ibiza Magna</option>
                                                    <option {{ checkselect(request()->query('location'), 'Club Nautico') }} value="Club Nautico">Club Nautico</option>
                                                </select>
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
                                                    <input type="text" value="{{ request()->query('startdate') }}" id="calender" name="calender" placeholder="Add your dates" class="datePicker"/>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="where_box">
                                                <div class="icon_box">
                                                <svg name="icon-skipper-17" width="17" height="14" viewBox="0 0 17 14" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8334 5.33331C16.8334 3.24998 11.8334 0.333313 8.50008 0.333313C5.16675 0.333313 0.166748 3.24998 0.166748 5.33331C0.166748 6.45791 0.530984 7.5825 1.25946 8.70709C3.673 8.12457 6.08654 7.83331 8.50008 7.83331C10.8737 7.83331 13.2472 8.115 15.6208 8.67839C16.4292 7.15915 16.8334 6.04413 16.8334 5.33331ZM8.50008 9.49998C10.7223 9.49998 12.9445 9.77776 15.1667 10.3333C13.7779 12.5555 11.5556 13.6666 8.50008 13.6666C5.44453 13.6666 3.2223 12.5555 1.83341 10.3333C4.05564 9.77776 6.27786 9.49998 8.50008 9.49998ZM8.50008 5.33331C9.19044 5.33331 9.75008 4.77367 9.75008 4.08331C9.75008 3.39296 9.19044 2.83331 8.50008 2.83331C7.80973 2.83331 7.25008 3.39296 7.25008 4.08331C7.25008 4.77367 7.80973 5.33331 8.50008 5.33331Z"></path>
                                                    </svg>
                                                </div>
                                                <div class="where_box_text rental_tyle_field">
                                                    <h5>Rental Type</h5>
                                                    <select name="rental_type" id="rental_type">
                                                        <option  value="">Skipper</option>
                                                        <option {{ checkselect(request()->query('rental_type'), 'With Skipper') }} value="With Skipper">With Skipper</option>
                                                        <option {{ checkselect(request()->query('rental_type'), 'Without Skipper') }} value="Without Skipper">Without Skipper</option>
                                                        <option {{ checkselect(request()->query('rental_type'), 'With Skipper Or Without Skipper') }} value="With Skipper Or Without Skipper">Both</option>
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
                                    <input type="checkbox" id="Monohull" name="type[]" value="Monohull" {{ checkCheckbox(request()->query('type'),'Monohull') }}>
                                    <label for="Monohull"> Monohull</label>
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
                            {{-- <div class="location_checkbox_two">
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
                            </div> --}}
                            <div class="location_checkbox_two">
                                <h5>Boat length</h5>
                                <div class="custom-wrapper">
                                    <div class="boat-input">
                                        <input type="range" class="min-boat-range" min="0" max="200" value="{{ request()->query('min_length') ?? 0 }}" step="10">
                                        <input type="range" class="max-boat-range" min="0" max="200" value="{{ request()->query('max_length') ?? maxLengthValue() }}" step="10">
                                    </div>
                                    <div class="price-input-container">
                                        <div class="slider-container-length">
                                            <div class="length-slider">
                                            </div>
                                        </div>
                                        <div class="length-input">
                                            <div class="price-field">
                                                <input type="number" name="min_length" class="min-length-input" value="{{ request()->query('min_length') ?? 0}}">
                                            </div>
                                            <div class="price-field">
                                                <input type="number" name="max_length" class="max-length-input" value="{{ request()->query('max_length') ?? 200 }}">
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="location_checkbox_two">
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
                            </div> --}}
                            <div class="location_checkbox_two">
                                <div class="row">
                                    <div class="number_list">
                                        <label>Number of peoples</label>
                                        <div class="number_list_filter">
                                            <div class="number_counter">
                                                <a href="javascript:;" class="people-minus"><i class="fa-solid fa-minus"></i></a>
                                                <input type="number" id="people" value="{{ request()->query('people') ?? 0 }}" name="people">
                                                <a href="javascript:;" class="people-plus"><i class="fa-solid fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="number_list">
                                        <label>Number of cabins</label>
                                        <div class="number_list_filter">
                                            <div class="number_counter">
                                                <a href="javascript:;" class="cabins-minus"><i class="fa-solid fa-minus"></i></a>
                                                <input type="number" id="cabins" value="{{ request()->query('cabins') ?? 0 }}" name="cabins">
                                                <a href="javascript:;" class="cabins-plus"><i class="fa-solid fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="number_list">
                                        <label>Number of berths</label>
                                        <div class="number_list_filter">
                                            <div class="number_counter">
                                                <a href="javascript:;" class="berths-minus"><i class="fa-solid fa-minus"></i></a>
                                                <input type="number" id="berths" value="{{ request()->query('berths') ?? 0 }}" name="berths">
                                                <a href="javascript:;" class="berths-plus"><i class="fa-solid fa-plus"></i></a>
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
                                    <input type="checkbox" {{ singleCheckbox(request()->query('equipment'),'Wakeboard') }} id="wakeboard" name="equipment" value="Wakeboard">
                                    <label for="wakeboard"> Wakeboard</label><br>
                                </div>
                                <div class="input-group">
                                    <input type="checkbox" {{ singleCheckbox(request()->query('equipment'),'towable') }} id="towable-tube" name="equipment" value="towable">
                                    <label for="towable-tube">Towable Tube</label><br>
                                </div>
                                <div class="input-group">
                                    <input type="checkbox" {{ singleCheckbox(request()->query('equipment'),'watermarker') }} id="watermaker" name="equipment" value="watermarker">
                                    <label for="watermaker"> watermarker</label><br>
                                </div>
                                <div class="input-group">
                                    <input type="checkbox" {{ singleCheckbox(request()->query('equipment'),'generator') }} id="generator" name="equipment" value="generator">
                                    <label for="generator"> Generator</label><br>
                                </div>
                                <div class="input-group">
                                    <input type="checkbox" {{ singleCheckbox(request()->query('equipment'),'Conditioning') }} id="air-conditioning" name="equipment" value="Conditioning">
                                    <label for="air-conditioning"> Air Conditioning</label><br>
                                </div>
                                <div class="input-group">
                                    <input type="checkbox" {{ singleCheckbox(request()->query('equipment'),'external') }} id="external-speakers" name="equipment" value="external">
                                    <label for="external-speakers"> External speakers</label><br>
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
                                        <p>Only display boats with a rating over 4 stars</p>
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
                @endif
                <div class="col-sm-12 col-md-6 col-lg-9">
                    <div class="location_rightside_box">
                        <div class="location_main_heading">
                            <h2>{{ count($results) }} boats available</h2>
                        </div>
                        <div class="row">
                            @if(count($results))
                                @foreach ($results as $result) 
                                    @php
                                        $heart_html = '<div class="wishlist_icon not-login-user"><a href="javascript:;" class="favorite_item"><i class="fa-regular fa-heart"></i></a></div>';
                                        if(Auth::check()):
                                            $user = auth()->user();
                                            if($user->role == 'customer'):
                                                $isFavorited = $user->favoriteitems()->where('listing_id', $result->id)->exists();
                                                if(!$isFavorited):
                                                    $heart_html = '<div class="wishlist_icon"><a href="javascript:;" list="'.$result->id.'" class="favorite_item"><i class="fa-regular fa-heart"></i></a></div>';
                                                else:
                                                    $heart_html = '<div class="wishlist_icon"><a href="javascript:;" list="'.$result->id.'" class="favorite_item"><i class="fa-solid fa-heart"></i></a></div>';
                                                endif;
                                            else:
                                                $heart_html = '';
                                            endif;
                                        endif;
                                    @endphp                                                                                                                                                                                                                                                                                 
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="location_inner_box">
                                            <a href="{{ route('singleboat', ['city' => $result->city, 'type' => $result->type, 'slug' => $result->slug]) }}">
                                                <img src="{{ $result->getFirstMediaUrl('cover_images') ? $result->getFirstMediaUrl('cover_images') : 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png' }}">
                                            </a>
                                            {!! $heart_html !!} 
                                            <a href="{{ route('singleboat', ['city' => $result->city, 'type' => $result->type, 'slug' => $result->slug]) }}">
                                                <div class="location_inner_main_box">
                                                    <div class="location_inner_text">
                                                        <h3>{{ $result->city }}</h3>
                                                        <p class="location_pera">{{ $result->type }} {{ $result->manufacturer }} {{ $result->model }}</p>
                                                        <p class="people_pera">{{ $result->onboard_capacity }} people · {{ optional($result->otherListingSetting)->horsepower }} hp · {{ $result->length }} m</p>
                                                        @if(getListingPrice($result->slug))
                                                            <h5 class="location_price">From <span class="price_style">{{ getListingPrice($result->slug) }}</span> / day</h5>
                                                        @else
                                                            <h5 class="location_price"><span class="price_style"></span></h5>
                                                        @endif
                                                        <div class="location_facility">
                                                            <ul>
                                                                <li><svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M14.6666 6.66666C14.6666 4.99999 10.6666 2.66666 7.99998 2.66666C5.33331 2.66666 1.33331 4.99999 1.33331 6.66666C1.33331 7.56633 1.6247 8.466 2.20748 9.36568C4.13831 8.89966 6.06915 8.66666 7.99998 8.66666C9.89884 8.66666 11.7977 8.89201 13.6965 9.34271C14.3433 8.12733 14.6666 7.23531 14.6666 6.66666ZM7.99998 9.99999C9.77776 9.99999 11.5555 10.2222 13.3333 10.6667C12.2222 12.4444 10.4444 13.3333 7.99998 13.3333C5.55554 13.3333 3.77776 12.4444 2.66665 10.6667C4.44442 10.2222 6.2222 9.99999 7.99998 9.99999ZM7.99998 6.66666C8.55226 6.66666 8.99998 6.21894 8.99998 5.66666C8.99998 5.11437 8.55226 4.66666 7.99998 4.66666C7.44769 4.66666 6.99998 5.11437 6.99998 5.66666C6.99998 6.21894 7.44769 6.66666 7.99998 6.66666Z">
                                                                        </path>
                                                                    </svg>{{ $result->skipper }}</li>
                                                                <li><i class="fa-solid fa-trophy"></i> Super owner</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="location_review_box">
                                                        <span>Flexible cancellation</span>
                                                        <span><i class="fa-solid fa-star"></i> NEW</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <p>Oops! No results found. Please try a different search or filter.</p>
                                </div>
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
    <!-- Modal -->
    @if($isMobile)
        <div class="modal fade mobile_filter_model" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">More filters</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="close_arrow" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('search') }}" method="get" class="mobile_filter_section" id="search-filter-fom">
                            <div class="location_checkbox_two">
                                <h5>Boat length</h5>
                                <div class="custom-wrapper">
                                    <div class="boat-input">
                                        <input type="range" class="min-boat-range" min="0" max="200" value="{{ request()->query('min_length') ?? 0 }}" step="10">
                                        <input type="range" class="max-boat-range" min="0" max="200" value="{{ request()->query('max_length') ?? 200 }}" step="10">
                                    </div>
                                    <div class="price-input-container">
                                        <div class="slider-container-length">
                                            <div class="length-slider">
                                            </div>
                                        </div>
                                        <div class="length-input">
                                            <div class="price-field">
                                                <input type="number" name="min_length" class="min-length-input" value="{{ request()->query('min_length') ?? 0}}">
                                            </div>
                                            <div class="price-field">
                                                <input type="number" name="max_length" class="max-length-input" value="{{ request()->query('max_length') ?? 200 }}">
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="location_checkbox_two">
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
                            </div> --}}
                            <div class="location_checkbox_two">
                                <div class="row">
                                    <div class="number_list">
                                        <label>Number of peoples</label>
                                        <div class="number_list_filter">
                                            <div class="number_counter">
                                                <a href="javascript:;" class="people-minus"><i class="fa-solid fa-minus"></i></a>
                                                <input type="number" id="people" value="{{ request()->query('people') ?? 0 }}" name="people">
                                                <a href="javascript:;" class="people-plus"><i class="fa-solid fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="number_list">
                                        <label>Number of cabins</label>
                                        <div class="number_list_filter">
                                            <div class="number_counter">
                                                <a href="javascript:;" class="cabins-minus"><i class="fa-solid fa-minus"></i></a>
                                                <input type="number" id="cabins" value="{{ request()->query('cabins') ?? 0 }}" name="cabins">
                                                <a href="javascript:;" class="cabins-plus"><i class="fa-solid fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="number_list">
                                        <label>Number of berths</label>
                                        <div class="number_list_filter">
                                            <div class="number_counter">
                                                <a href="javascript:;" class="berths-minus"><i class="fa-solid fa-minus"></i></a>
                                                <input type="number" id="berths" value="{{ request()->query('berths') ?? 0 }}" name="berths">
                                                <a href="javascript:;" class="berths-plus"><i class="fa-solid fa-plus"></i></a>
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
                                    <input type="checkbox" {{ singleCheckbox(request()->query('equipment'),'Wakeboard') }} id="wakeboard" name="equipment" value="Wakeboard">
                                    <label for="wakeboard"> Wakeboard</label><br>
                                </div>
                                <div class="input-group">
                                    <input type="checkbox" {{ singleCheckbox(request()->query('equipment'),'towable') }} id="towable-tube" name="equipment" value="towable">
                                    <label for="towable-tube">Towable Tube</label><br>
                                </div>
                                <div class="input-group">
                                    <input type="checkbox" {{ singleCheckbox(request()->query('equipment'),'watermarker') }} id="watermaker" name="equipment" value="watermarker">
                                    <label for="watermaker"> watermarker</label><br>
                                </div>
                                <div class="input-group">
                                    <input type="checkbox" {{ singleCheckbox(request()->query('equipment'),'generator') }} id="generator" name="equipment" value="generator">
                                    <label for="generator"> Generator</label><br>
                                </div>
                                <div class="input-group">
                                    <input type="checkbox" {{ singleCheckbox(request()->query('equipment'),'Conditioning') }} id="air-conditioning" name="equipment" value="Conditioning">
                                    <label for="air-conditioning"> Air Conditioning</label><br>
                                </div>
                                <div class="input-group">
                                    <input type="checkbox" {{ singleCheckbox(request()->query('equipment'),'external') }} id="external-speakers" name="equipment" value="external">
                                    <label for="external-speakers"> External speakers</label><br>
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
                                <input type="hidden" name="location" value="{{ request()->query('location') }}">
                                @if(!empty(request()->query('type')))
                                    @foreach(request()->query('type') as $valueT)
                                        <input type="hidden" name="type[]" value="{{ $valueT }}">
                                    @endforeach
                                @endif
                               
                                <input type="hidden" name="rental_type" value="{{ request()->query('rental_type') }}">
                                <div class="toggle_filter">
                                    <div class="toggle_text">
                                        <label>Highest rated <i class="fa-solid fa-star"></i></label>
                                        <p>Only display boats with a rating over 4 stars</p>
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
                    
                </div>
            </div>
        </div>
    @endif
@endsection