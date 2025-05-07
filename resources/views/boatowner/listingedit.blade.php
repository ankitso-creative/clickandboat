@extends('layouts.boatowner.common')
@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{ asset('app-assets/site_assets/css/monthselect.css') }}">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link href="{{ asset('app-assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('app-assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/plugins/monthSelect/index.js"></script>

<script src="{{ asset('app-assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('app-assets/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#see-price').click(function() {
                if ($('#price-list').hasClass('open')) {
                    $('#price-list').removeClass('open');
                } else {
                    $('#price-list').addClass('open');
                }
            });
            $('#closeMenu').click(function() {
                $('#price-list').removeClass('open');
            });
            $('#closeMenu').click(function() {
                $('#price-list').removeClass('open');
            });
            $(document).on('change','.security-deposit',function(){
                var value = $(this).val();
                if(value == '0')
                {
                    $('.deposit-type, .deposit-amount').addClass('d-none');
                }
                else
                {
                    $('.deposit-type, .deposit-amount').removeClass('d-none');
                }
            })
            $(document).on('change','.fuel-Include',function(){
                var val = $(this).val();
                if(val == '0')
                {
                    $('.fule-price').addClass('d-none');
                }
                else
                {
                    $('.fule-price').removeClass('d-none');
                }
            })
            $(document).on('change','.skipper-Include',function(){
                var val = $(this).val();
                if(val == '0')
                {
                    $('.skipper-price').addClass('d-none');
                }
                else
                {
                    $('.skipper-price').removeClass('d-none');
                }
            })
        });
        flatpickr(".from_date", {
            inline: false,
            dateFormat: "d-m-Y",
            minDate: "today",
        });
        flatpickr(".from_to", {
            inline: false,
            dateFormat: "d-m-Y",
            minDate: "today",
        });
        flatpickr(".datePicker", {
            inline: false,
            dateFormat: "d-m-Y",
            minDate: "today",
        });
        
    $(document).ready(function () {
        $('#cancellationSelect').select2({
            width: '100%',
            minimumResultsForSearch: Infinity, 
            templateResult: function (data) {
                if (!data.id) return data.text;

                const desc = $(data.element).data('desc') || '';
                const $item = $('<span class="select2-option-item" data-desc="' + desc + '">' + data.text + '</span>');
                return $item;
            }
        });
        const $tooltip = $('#tooltipBox');
        $(document).on('mousemove', '.select2-results__option .select2-option-item', function (e) {
            const desc = $(this).data('desc');
            if (desc) {
            $tooltip.text(desc).css({
                top: e.pageY + 10 + 'px',
                left: e.pageX + 10 + 'px',
                display: 'block'
            });
            }
        });

        $(document).on('mouseleave', '.select2-results__option .select2-option-item', function () {
            $tooltip.hide();
        });
        $('#cancellationSelect').on('select2:close', function () {
            $tooltip.hide();
        });

         $('#cancellationSelect').on('select2:select', function () {
            $tooltip.hide();
        });
    });
    // $('.mySelect2').select2({
    //         selectOnClose: true
    //     });
    $(document).ready(function() 
    {
        $('.mySelect2').select2();
        function updateOptions() 
        {
            let selectedValues = [];
            $('.mySelect2').each(function() 
            {
                selectedValues = selectedValues.concat($(this).val() || []);
            });
            $('.mySelect2').each(function() {
                let $this = $(this);
                let currentValues = $this.val() || [];
                $this.find('option').each(function() {
                    let val = $(this).val();
                    if (currentValues.includes(val)) {
                    $(this).prop('disabled', false); 
                    } else if (selectedValues.includes(val)) {
                    $(this).prop('disabled', true); 
                    } else {
                    $(this).prop('disabled', false); 
                    }
                 });
                $this.trigger('change.mySelect2');
            });
        }
        $('.mySelect2').on('change', updateOptions);
        updateOptions(); // Initial call
    });
    </script>
@endsection
@section('content')
@if(session('success'))
<div class="alert alert-success" style="display: block;">
    <button class="close" data-close="alert"></button>
    <span> {{ session('success') }} </span>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger" style="display: block;">
    <button class="close" data-close="alert"></button>
    <span> {{ session('error') }} </span>
</div>
@endif
<div class="row account-overview dashboard_listing_edit">
    <div class="col-md-3">
        <div class="sidebar_box_pera">
            <h3>Ahoy there <span class="">Captain!</span> </h3>
            <p>Your yacht will soon be visible to the largest community of sailors interested in peer-to-peer yacht
                charters. Welcome to my Boat Booker</p>
        </div>
        <div class="listing_progress_bar">
            <!-- <p>Progress</p> -->
        </div>
        <nav class="sidebar side_bar">
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active show" id="nav-general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fa-solid fa-gear"></i> General <span><i class="fa-solid fa-check-double"></i></span></a>
                <a class="nav-item nav-link" id="nav-description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fa-solid fa-pen"></i> Description <span><i class="fa-solid fa-check-double"></i></span></a>
                <a class="nav-item nav-link" id="nav-image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fa-solid fa-image"></i> Images<span><i class="fa-solid fa-check-double"></i></span></a>
                <a class="nav-item nav-link" id="nav-price-tab" data-toggle="tab" href="#price" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fa-solid fa-dollar-sign"></i>Price<span><i class="fa-solid fa-check-double"></i></span></a>
                <a class="nav-item nav-link" id="nav-booking-tab" data-toggle="tab" href="#booking" role="tab" aria-controls="nav-about" aria-selected="false"><i class="fa-solid fa-calendar-days"></i> Booking<span><i class="fa-solid fa-check-double"></i></span></a>
                {{-- <a class="nav-item nav-link" id="nav-calender-tab" data-toggle="tab" href="#calender" role="tab" aria-controls="nav-about" aria-selected="false"><i class="fa-regular fa-calendar"></i>Calender<span><i class="fa-solid fa-check-double"></i></span></a> --}}
                <a class="nav-item nav-link" id="nav-equipment-tab" data-toggle="tab" href="#equipment" role="tab" aria-controls="nav-about" aria-selected="false"><i class="fa-solid fa-screwdriver-wrench"></i> Equipment<span><i class="fa-solid fa-check-double"></i></span></a>
                <a class="nav-item nav-link" id="nav-other-tab" data-toggle="tab" href="#other" role="tab" aria-controls="nav-about" aria-selected="false"><i class="fa-solid fa-book"></i> Other<span><i class="fa-solid fa-check-double"></i></span></a>
                {{-- <a class="nav-item nav-link" id="nav-discounts-tab" data-toggle="tab" href="#discounts" role="tab" aria-controls="nav-about" aria-selected="false"><i class="fa-solid fa-tags"></i>Discounts<span><i class="fa-solid fa-check-double"></i></span></a> --}}

            </div>
        </nav>
    </div>
    <div class="col-md-9 main-dashboard">
        <div class="listing_edit_btns">
            {{-- <a class="nav-item nav-link" id="nav-calender-tab" data-toggle="tab" href="#calender" role="tab" aria-controls="nav-about" aria-selected="false"></i>Calender</a> --}}
            <a href="{{ route('boatowner.preview',$listing->id) }}" class="pre_list_btn" target="_blank">Preview listing</a>
        </div>
        <div class="px-3 py-3 tab-content px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="nav-general-tab">
                <form method="POST" ntb="description">
                    <div class="text-center boat_type_section">
                        <h2>Your boat</h2>
                        <h3>Type</h3>
                        <div class="your_boats_type">
                            <div class="radio-with-Icon">
                                @if(count($categories))
                                    @foreach($categories as $category)
                                        <p class="radioOption-Item">
                                            <input type="radio" name="type" {{ checkradio($listing->type,$category->slug) }} id="BannerType{{ $loop->iteration }}" value="{{ $category->slug }}" class="ng-valid ng-dirty ng-touched ng-empty" aria-invalid="false">
                                            <label for="BannerType{{ $loop->iteration }}">
                                                <img src="{{ $category->getFirstMediaUrl('category_icon') }}">{{ $category->name }}
                                            </label>
                                        </p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label>City:<span class="required"> * </span></label>
                            <input type="text" name="city" class="form-control" required value="{{ old('city', $listing->city) }}">
                            @error('city')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-4">
                            <label>Harbour:<span class="required"> * </span></label>
                            <select name="harbour" class="form-control" placeholder="Search Loaction">
                                <option value="">All Marinas</option>
                                <option {{ checkselect($listing->harbour,'Marina Santa Eulalia') }} value="Marina Santa Eulalia">Marina Santa Eulalia</option>
                                <option {{ checkselect($listing->harbour,'Puerto Sant Antoni') }} value="Puerto Sant Antoni">Puerto Sant Antoni</option>
                                <option {{ checkselect($listing->harbour,'Marina Ibiza') }} value="Marina Ibiza">Marina Ibiza</option>
                                <option {{ checkselect($listing->harbour,'Marina Botafoch') }} value="Marina Botafoch">Marina Botafoch</option>
                                <option {{ checkselect($listing->harbour,'Ibiza Magna') }} value="Ibiza Magna">Ibiza Magna</option>
                                <option {{ checkselect($listing->harbour,'Club Nautico') }} value="Club Nautico">Club Nautico</option>
                            </select>
                            @error('harbour')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-4">
                            <label>Manufacturer:<span class="required"> * </span></label>
                            <input type="text" name="manufacturer" class="form-control" required
                                value="{{ old('manufacturer', $listing->manufacturer) }}">
                            @error('manufacturer')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-6">
                            <label>Model:<span class="required"> * </span></label>
                            <input type="text" name="model" class="form-control" required
                                value="{{ old('model', $listing->model) }}">
                            @error('model')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-6">
                            <label>Boat name<span class="required"> * </span></label>
                            <input type="text" name="boat_name" class="form-control" required
                                value="{{ old('boat_name', $listing->boat_name) }}">
                            @error('boat_name')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert d-none">
                                <button class="close" data-close="alert"></button>
                                <span class="message"></span>
                            </div>
                        </div>
                        <div class="text-center actions btn-set">
                            <input type="hidden" name="s" value="general">
                            <button type="submit" ntb="description" class="listing_sub_btn mt-ladda-btn ladda-button btn-outline" data-style="contract" data-spinner-color="#333">
                                Save
                            </button>
                            <a href="javascript:;" class="next-btn" ntp="description">Next</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="nav-description-tab">
                <div class="p-0 col-sm-12">
                    <h4 class="bold ">Title</h4>
                </div>
                <form method="POST" ntb="image">
                    <div class="pt-3 pl-0 col-md-6">
                        <div class="form-group">
                            <label></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $listing->title) }}"  placeholder="E.g.: 2012  honda">
                            @error('title')<span class="required">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="p-0 pt-4 col-sm-12 language_tab">
                        <h5 class="bold ">Language</h5>
                        <div class="language-label">
                        @php
                            $value = Session('lang');
                            if(!$value):
                                $value = 'en';
                            endif;
                        @endphp
                        @if(count($languages))
                            @foreach ($languages as $language)
                                    <label class="mt-checkbox">
                                    <input type="radio" {{ singleCheckbox($language->code, $value) }} id="inlineCheckbox{{ $loop->iteration }}" value="{{ $language->code }}" name="language">
                                    <span>{{ $language->name }}</span>
                                    </label>
                                
                            @endforeach
                        @endif
                        </div>
                    </div>
                    <div class="p-0 pt-4 col-sm-12">
                        <h4 class="bold ">Boat Description</h4>
                    </div>
                    <div class="pt-4 row">
                        <div class="col-md-12 col-lg-6">
                            <textarea class="form-control" rows="10" name="description">{{ optional($listing->description[0] ?? null)->description }}</textarea>
                            @error('description')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <p class="des__pera_text"> Write a short description of your boat, including how many people it sleeps, whether it has air conditioning or heating, and if there’s a toilet and shower. Mention any features that make your boat special, what the cabins are like, and what safety equipment is onboard. Be sure to include your pricing, what’s included in the price (like fuel, skipper, or cleaning), and what costs extra. Let people know where the boat departs from and if a security deposit is required.
                            </p>
                        </div>
                    </div>
                    <div class="p-0 pt-4 col-sm-12">
                        <h4 class="bold ">Whats Included</h4>
                    </div>
                    <div class="pt-4 row">
                        <div class="col-md-12 col-lg-6">
                            <textarea class="form-control" rows="8" name="what_included">{{ $listing->what_included }}</textarea>
                            @error('what_included')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <p class="des__pera_text">Write about what is included in your trip. For Example, your destinations, what is included in your price (captain, fuel, drinks, food, water sports), please state prices for anything that is not included in your price, late check out fee, sunset fee, paddle boards, snorkelling equipment, towels, start and end times.
                            </p>
                        </div>
                    </div>
                    <div class="p-0 pt-4 col-sm-12">
                        <h4 class="bold ">Security Deposit</h4>
                    </div>
                    @php
                        $sDnone = 'd-none';
                        if(optional($listing->security)->security_deposit == 1):
                            $sDnone = '';
                        endif;
                    @endphp
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Security Deposit</label>
                            <select name="security_deposit" class="form-control security-deposit">
                                <option {{ checkselect(optional($listing->security)->security_deposit,'0') }} value="0">No</option>
                                <option {{ checkselect(optional($listing->security)->security_deposit,'1') }} value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-lg-4 deposit-type {{ $sDnone }}">
                            <label>Deposit In</label>
                            <select name="deposit_type" class="form-control">
                                <option {{ checkselect(optional($listing->security)->type,'0') }} value="0">Percentage</option>
                                <option {{ checkselect(optional($listing->security)->type,'1') }} value="1">Flat Amount</option>
                            </select>
                        </div>
                        <div class="col-lg-4 deposit-amount {{ $sDnone }}">
                            <label>Deposit value</label>
                            <input type="text" name="deposit_amount" value="{{ optional($listing->security)->amount }}" class="form-control"> 
                        </div>
                    </div>
                    
                    <div class="p-0 pt-4 col-sm-12">
                        <h4 class="bold ">Is Your Boat With Or Without Captain</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Is Your Boat With Or Without Captain?<span class="required"> </span></label>
                            <select name="skipper" class="form-control">
                                <option {{ checkselect($listing->skipper,'With Skipper') }} value="With Skipper">With Skipper</option>
                                <option {{ checkselect($listing->skipper,'Without Skipper') }} value="Without Skipper">Without Skipper</option>
                                <option {{ checkselect($listing->skipper,'With Skipper Or Without Skipper') }} value="With Skipper Or Without Skipper">Both</option>
                            </select>
                            @error('onboard_capacity')<span class="required">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="p-0 pt-4 col-sm-12">
                        <h4 class="bold ">Technical</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Onboard capacity<span class="required"> * </span></label>
                            <input type="text" name="onboard_capacity" class="form-control" required value="{{ old('onboard_capacity', $listing->onboard_capacity) }}">
                            @error('onboard_capacity')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-6">
                            <label>Number of cabins<span class="required"> * </span></label>
                            <input type="text" name="cabins" class="form-control" required value="{{ old('cabins', $listing->cabins) }}">
                            @error('cabins')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-6">
                            <label>Number of berths<span class="required"> *</span></label>
                            <input type="text" name="berths" class="form-control" required value="{{ old('berths', $listing->berths) }}">
                            @error('berths')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-6">
                            <label>Number of bathrooms<span class="required"> *</span></label>
                            <input type="text" name="bathrooms" class="form-control" required value="{{ old('bathrooms', $listing->bathrooms) }}">
                            @error('bathrooms')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        {{-- <p class="des_text">Add one by one the sleeping areas of the boat and specify their composition.
                            For example, for 2 cabins, indicate: "1 cabin with 1 double bed" and "1 cabin with 2 single
                            beds."</p> --}}
                        <div class="col-lg-6">
                            <label>Length (m)<span class="required"> *</span></label>
                            <input type="text" name="length" class="form-control" required value="{{ old('boat_name', $listing->length) }}">
                            @error('length')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-6">
                            <label>Year of construction<span class="required"> * </span></label>
                            <input type="text" name="construction_year" class="form-control" required value="{{ old('construction_year', $listing->construction_year) }}">
                            @error('construction_year')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-4">
                            <label>Fuel (L/h)<span class="required"> * </span></label>
                            <input type="text" name="fuel" class="form-control" required value="{{ old('fuel', $listing->fuel) }}">
                            @error('fuel')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-4">
                            <label>Renovated<span class="required">  </span></label>
                            <input type="text" name="renovated" class="form-control"  value="{{ old('renovated', $listing->renovated) }}">
                            @error('renovated')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-4">
                            <label>Speed (Kn)<span class="required"></span></label>
                            <input type="text" name="speed" class="form-control"  value="{{ old('speed', $listing->speed) }}">
                            @error('speed')<span class="required">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="boat_listing_images_video_save_btn">
                        <div class="col-lg-12">
                            <div class="alert d-none">
                                <button class="close" data-close="alert"></button>
                                <span class="message"></span>
                            </div>
                        </div>
                        <input type="hidden" name="s" value="descriptions">
                        <button type="submit" class="listing_sub_btn mt-ladda-btn ladda-button btn-outline" data-style="contract" data-spinner-color="#333">
                            Save
                        </button>
                        <a href="javascript:;" class="next-btn" ntp="image">Next</a>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade edit_profile_sec" id="image" role="tabpanel" aria-labelledby="nav-image-tab">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="bold ">Images</h4>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-4 col-md-12 col-lg-4">
                        <label>Cover Image:<span class="required"> * </span></label>
                        <input type="file" name="image" id="file-input" class="form-control" accept="image/*">
                    </div>
                    <div class="col-sm-8" id="uploade-cover-image">
                        @php
                        $image = $listing->getFirstMediaUrl('cover_images');
                        @endphp
                        @if($image)
                        <img src="{{ $image }}" class="uploaded-image img-responsive pic-bordered">
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-12">
                        <div class="photo-section">
                            <div class="photos_box_text">
                                <p class="photo_sub_heading">Drag and drop or <a href="#"> click here</a> to upload your
                                    photos</p>
                                <p>For the cover, choose a photo that shows the whole boat. Then add more photos of the
                                    details and the
                                    interior.</p>
                            </div>
                            <p class="photo_sec_pera">Drag the photos to change the order they appear in</p>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div id="imageDropzone" class="dropzone">
                            <div class="dz-message">
                                <img src="{{ asset('app-assets/site_assets/img/camera.png') }}">
                                <p class="image_des_main_heading">Post your photos here</p>
                                <p>Minimum size: 400x400px</p>
                                <p>Format: jpeg, png, gif</p>
                                <p>Download from your device</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">

                        @php
                        $images = $listing->getMedia('listing_gallery');
                        $count = 0;
                        @endphp
                        <div class="col-md-12 uploaded_img">
                            <div class="row" id="uploaded-images">
                                @if(count($images))
                                    @foreach($images as $image) 
                                        @php  $count++ @endphp
                                        <div class="col-md-4 image-container" data-id="{{ $image->id }}">
                                            <img src="{{ $image->getUrl() }}" class="uploaded-image img-responsive pic-bordered">
                                            <button class="remove-btn" onclick="removeImageGallery({{ $image->id }}, this)"><i class="far fa-times-circle"></i></button>
                                        </div>
                                    @endforeach
                                    @for($i=$count+1; $i <= 3;$i++)
                                        <div class="col-md-4" id="empty-img-{{ $i }}">
                                            <div class="listing_img_box">
                                                <img class="camera_icon_img" src="{{ asset('app-assets/site_assets/img/camera.png') }}">
                                                <p>Photo no. {{ $i }}</p>
                                            </div>
                                        </div>
                                    @endfor
                                @else
                                    <div class="col-md-4" id="empty-img-1">
                                        <div class="listing_img_box">
                                            <img class="camera_icon_img"
                                                src="{{ asset('app-assets/site_assets/img/camera.png') }}">
                                            <p>Photo no. 1</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="empty-img-2">
                                        <div class="listing_img_box">
                                            <img class="camera_icon_img"
                                                src="{{ asset('app-assets/site_assets/img/camera.png') }}">
                                            <p>Photo no. 2</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="empty-img-3">
                                        <div class="listing_img_box">
                                            <img class="camera_icon_img"
                                                src="{{ asset('app-assets/site_assets/img/camera.png') }}">
                                            <p>Photo no. 3</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="photo-section">
                            <div class="text-center phot_heading">
                                <h1>Boat plan</h1>
                            </div>
                            <p class="photo_sec_pera">Add boat design plan so renters can project themselves.</p>
                        </div>
                        <div class="pt-3 col-sm-12">
                            <div id="imageDropzone-plan" class="dropzone">
                                <div class="dz-message">
                                    <img src="{{ asset('app-assets/site_assets/img/camera.png') }}">
                                    <p class="image_des_main_heading">Post your photos here</p>
                                    <p>Minimum size: 400x400px</p>
                                    <p>Format: jpeg, png, gif</p>
                                    <p>Download from your device</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                    $plans = $listing->getMedia('listing_plan');
                    @endphp
                    <div class="col-md-12 uploaded_img">
                        <div class="row" id="uploaded-images-plan">
                            @if($plans)
                                @foreach($plans as $plan)
                                    <div class="col-md-4 image-container" data-id="{{ $plan->id }}">
                                        <img src="{{ $plan->getUrl() }}" class="uploaded-image img-responsive pic-bordered">
                                        <button class="remove-btn" onclick="removeImageGallery({{ $plan->id }}, this)"><i
                                                class="far fa-times-circle"></i></button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="boat_listing_images_video_save_btn">
                        <a href="javascript:;" id="images-uploded">Save</a>
                        <a href="javascript:;" class="next-btn" ntp="price">Next</a>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade edit_profile_sec" id="price" role="tabpanel" aria-labelledby="nav-price-tab">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="bold ">Price</h4>
                        <p>Select a price for low season, mid season & high season. And any options that apply. You must select one price from each season.</p>
                    </div>
                </div>
                <form method="POST" ntb="booking">
                    <div class="row">
                        <div class="col-sm-12">
                            {{-- <h4 class="bold ">Price</h4> --}}
                            @php 
                                $lowseason = $listing->price()->where('season_price_id', optional($listing->seasonPrice[0] ?? null)->id)->first();
                                $midSeason = $listing->price()->where('season_price_id', optional($listing->seasonPrice[1] ?? null)->id)->first();
                                $highSeason = $listing->price()->where('season_price_id', optional($listing->seasonPrice[2] ?? null)->id)->first();
                                $lowSeasonMonth = json_decode(optional($listing->seasonPrice[0] ?? null)->from);
                                $midSeasonMonth = json_decode(optional($listing->seasonPrice[1] ?? null)->from);
                                $highSeasonMonth = json_decode(optional($listing->seasonPrice[2] ?? null)->from);
                            @endphp
                        </div>
                        {{-- <div class="col-sm-4">
                            <label>Price:<span class="required"> * </span></label>
                            <input type="text" name="price" value="{{ optional($listing->price)->price }}" class="form-control">
                            @error('price')<span class="required">{{ $message }}</span>@enderror
                        </div> --}}
                        <div class="clearfix"></div>
                        <div class="pt-4 col-sm-12">
                            <h4 class="bold ">Low Season Prices</h4>
                        </div>
                        <div class="col-sm-4">
                            <label>Season Month:<span class="required"> * </span></label>
                            <select multiple class="form-control mySelect2" name="season_price[1][from][]">
                                <option {{ checkSelectMulti($lowSeasonMonth,'January') }} value="January">January</option> 
                                <option {{ checkSelectMulti($lowSeasonMonth,'February') }} value="February">February</option> 
                                <option {{ checkSelectMulti($lowSeasonMonth, 'March') }} value="March">March</option> 
                                <option {{ checkSelectMulti($lowSeasonMonth,'April') }} value="April">April</option>
                                <option {{ checkSelectMulti($lowSeasonMonth,'May') }} value="May">May</option> 
                                <option {{ checkSelectMulti($lowSeasonMonth,'June') }} value="June">June</option> 
                                <option {{ checkSelectMulti($lowSeasonMonth,'July') }} value="July">July</option> 
                                <option {{ checkSelectMulti($lowSeasonMonth,'August') }} value="August">August</option> 
                                <option {{ checkSelectMulti($lowSeasonMonth,'September') }} value="September">September</option> 
                                <option {{ checkSelectMulti($lowSeasonMonth,'October') }} value="October">October</option> 
                                <option {{ checkSelectMulti($lowSeasonMonth,'November') }} value="November">November</option> 
                                <option {{ checkSelectMulti($lowSeasonMonth,'December') }} value="December">December</option> 
                            </select>
                            @error('season_price[1][from][]')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-4">
                            <label>Full day price:<span class="required"> * </span></label>
                            <input type="text" name="season_price[1][price]" value="{{ optional($listing->seasonPrice[0] ?? null)->price ?? '' }}" class="form-control">
                            <input type="hidden" name="season_price[1][name]" value="low_season">
                        </div>
                        <div class="col-sm-4">
                            <label>Overnight stay price:<span class="required"> </span></label>
                            <input type="text" name="season_price[1][over_night_price]" value="{{ $lowseason->over_night_price ?? '' }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>1 half day price:<span class="required">  </span></label>
                            <input type="text" name="season_price[1][one_half_day_price]" value="{{ $lowseason->one_half_day ?? '' }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>2 days price:<span class="required">  </span></label>
                            <input type="text" name="season_price[1][two_day_price]" value="{{ $lowseason->two_day ?? '' }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>3 days price:<span class="required"> </span></label>
                            <input type="text" name="season_price[1][three_day_price]" value="{{ $lowseason->three_day ?? '' }}" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label>4 days price:<span class="required"></span></label>
                            <input type="text" name="season_price[1][four_day_price]" value="{{ $lowseason->four_day ?? '' }}" class="form-control">
                        </div>
                        <div class="clear"></div>
                        <div class="col-sm-3">
                            <label>5 days price:<span class="required"></span></label>
                            <input type="text" name="season_price[1][five_day_price]" value="{{ $lowseason->five_day ?? '' }}"
                                class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label>6 days price:<span class="required"> </span></label>
                            <input type="text" name="season_price[1][six_day_price]" value="{{ $lowseason->six_day ?? '' }}"
                                class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label>1 week price:<span class="required"> </span></label>
                            <input type="text" name="season_price[1][one_week_price]" value="{{ $lowseason->one_week ?? '' }}"
                                class="form-control">
                        </div>
                        <div class="clearfix"></div>
                        <div class="pt-4 col-sm-12">
                            <h4 class="bold ">Mid Season Prices</h4>
                        </div>
                        <div class="col-sm-4">
                            <label>Season Month:<span class="required">* </span></label>
                            <select multiple class="form-control mySelect2" name="season_price[2][from][]">
                                <option {{ checkSelectMulti($midSeasonMonth,'January') }} value="January">January</option> 
                                <option {{ checkSelectMulti($midSeasonMonth,'February') }} value="February">February</option> 
                                <option {{ checkSelectMulti($midSeasonMonth, 'March') }} value="March">March</option> 
                                <option {{ checkSelectMulti($midSeasonMonth,'April') }} value="April">April</option>
                                <option {{ checkSelectMulti($midSeasonMonth,'May') }} value="May">May</option> 
                                <option {{ checkSelectMulti($midSeasonMonth,'June') }} value="June">June</option> 
                                <option {{ checkSelectMulti($midSeasonMonth,'July') }} value="July">July</option> 
                                <option {{ checkSelectMulti($midSeasonMonth,'August') }} value="August">August</option> 
                                <option {{ checkSelectMulti($midSeasonMonth,'September') }} value="September">September</option> 
                                <option {{ checkSelectMulti($midSeasonMonth,'October') }} value="October">October</option> 
                                <option {{ checkSelectMulti($midSeasonMonth,'November') }} value="November">November</option> 
                                <option {{ checkSelectMulti($midSeasonMonth,'December') }} value="December">December</option> 
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Full day price:<span class="required">* </span></label>
                            <input type="text" name="season_price[2][price]" value="{{ optional($listing->seasonPrice[1] ?? null)->price ?? '' }}" class="form-control">
                            <input type="hidden" name="season_price[2][name]" value="mid_season">
                        </div>
                        <div class="col-sm-4">
                            <label>Overnight stay price:<span class="required"> </span></label>
                            <input type="text" name="season_price[2][over_night_price]" value="{{ $midSeason->over_night_price ?? '' }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>1 half day price:<span class="required"> </span></label>
                            <input type="text" name="season_price[2][one_half_day_price]" value="{{ $midSeason->one_half_day ?? '' }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>2 days price:<span class="required"> </span></label>
                            <input type="text" name="season_price[2][two_day_price]" value="{{ $midSeason->two_day ?? '' }}"
                                class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>3 days price:<span class="required"></span></label>
                            <input type="text" name="season_price[2][three_day_price]" value="{{ $midSeason->three_day ?? '' }}"
                                class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label>4 days price:<span class="required"> </span></label>
                            <input type="text" name="season_price[2][four_day_price]" value="{{ $midSeason->four_day ?? '' }}"
                                class="form-control">
                        </div>
                        <div class="clear"></div>
                        <div class="col-sm-3">
                            <label>5 days price:<span class="required"> </span></label>
                            <input type="text" name="season_price[2][five_day_price]" value="{{ $midSeason->five_day ?? '' }}"
                                class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label>6 days price:<span class="required"> </span></label>
                            <input type="text" name="season_price[2][six_day_price]" value="{{ $midSeason->six_day ?? '' }}"
                                class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label>1 week price:<span class="required"></span></label>
                            <input type="text" name="season_price[2][one_week_price]" value="{{ $midSeason->one_week ?? '' }}"
                                class="form-control">
                        </div>
                        <div class="clearfix"></div>
                        <div class="pt-4 col-sm-12">
                            <h4 class="bold ">High Season Prices</h4>
                        </div>
                        <div class="col-sm-4">
                            <label>Season Month:<span class="required">* </span></label>
                            <select multiple class="form-control mySelect2" name="season_price[3][from][]">
                                <option {{ checkSelectMulti($highSeasonMonth,'January') }} value="January">January</option> 
                                <option {{ checkSelectMulti($highSeasonMonth,'February') }} value="February">February</option> 
                                <option {{ checkSelectMulti($highSeasonMonth, 'March') }} value="March">March</option> 
                                <option {{ checkSelectMulti($highSeasonMonth,'April') }} value="April">April</option>
                                <option {{ checkSelectMulti($highSeasonMonth,'May') }} value="May">May</option> 
                                <option {{ checkSelectMulti($highSeasonMonth,'June') }} value="June">June</option> 
                                <option {{ checkSelectMulti($highSeasonMonth,'July') }} value="July">July</option> 
                                <option {{ checkSelectMulti($highSeasonMonth,'August') }} value="August">August</option> 
                                <option {{ checkSelectMulti($highSeasonMonth,'September') }} value="September">September</option> 
                                <option {{ checkSelectMulti($highSeasonMonth,'October') }} value="October">October</option> 
                                <option {{ checkSelectMulti($highSeasonMonth,'November') }} value="November">November</option> 
                                <option {{ checkSelectMulti($highSeasonMonth,'December') }} value="December">December</option> 
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Full day price:<span class="required">*</span></label>
                            <input type="text" name="season_price[3][price]" value="{{ optional($listing->seasonPrice[2] ?? null)->price ?? '' }}" class="form-control">
                            <input type="hidden" name="season_price[3][name]" value="high_season">
                        </div>
                        <div class="col-sm-4">
                            <label>Overnight stay price:<span class="required"></span></label>
                            <input type="text" name="season_price[3][over_night_price]" value="{{ $highSeason->over_night_price ?? '' }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>1 half day price:<span class="required"></span></label>
                            <input type="text" name="season_price[3][one_half_day_price]" value="{{ $highSeason->one_half_day ?? '' }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>2 days price:<span class="required"> </span></label>
                            <input type="text" name="season_price[3][two_day_price]" value="{{ $highSeason->two_day ?? '' }}"
                                class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>3 days price:<span class="required"> </span></label>
                            <input type="text" name="season_price[3][three_day_price]" value="{{ $highSeason->three_day ?? '' }}"
                                class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label>4 days price:<span class="required"> </span></label>
                            <input type="text" name="season_price[3][four_day_price]" value="{{ $highSeason->four_day ?? '' }}"
                                class="form-control">
                        </div>
                        <div class="clear"></div>
                        <div class="col-sm-3">
                            <label>5 days price:<span class="required"> </span></label>
                            <input type="text" name="season_price[3][five_day_price]" value="{{ $highSeason->five_day ?? '' }}"
                                class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label>6 days price:<span class="required"> </span></label>
                            <input type="text" name="season_price[3][six_day_price]" value="{{ $highSeason->six_day ?? '' }}"
                                class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label>1 week price:<span class="required"> </span></label>
                            <input type="text" name="season_price[3][one_week_price]" value="{{ $highSeason->one_week ?? '' }}"
                                class="form-control">
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12">
                            <h4>Other Price</h4>
                        </div>
                        @php  
                            $fDnone = 'd-none';
                            if($listing->fuel_include == 1):
                                $fDnone = '';
                            endif;
                            $spDnone = 'd-none';
                            if($listing->skipper_include == 1):
                                $spDnone = '';
                            endif;
                        @endphp
                        <div class="col-lg-3">
                            <label>Is Fuel Included In Your Price?</label>
                            <select name="fuel_Include" class="form-control fuel-Include">
                                <option {{ checkselect($listing->fuel_include,0) }} value="0">Yes</option>
                                <option {{ checkselect($listing->fuel_include,1) }} value="1">No</option>
                            </select>
                        </div>
                        <div class="col-lg-3 fule-price {{ $fDnone }}">
                            <label>Price Of Fuel Per Hour</label>
                            <input type="text" name="fuel_price" value="{{ $listing->fuel_price }}" class="form-control"> 
                        </div>
                        <div class="col-lg-3">
                            <label>Is Skipper Included In Price?</label>
                            <select name="skipper_include" class="form-control skipper-Include">
                                <option {{ checkselect($listing->skipper_include,0) }} value="0">Yes</option>
                                <option {{ checkselect($listing->skipper_include,1) }} value="1">No</option>
                            </select>
                        </div>
                        <div class="col-lg-3 skipper-price {{ $spDnone }}">
                            <label>Price Of Skipper</label>
                            <input type="text" name="skipper_price" value="{{ $listing->skipper_price }}" class="form-control"> 
                        </div>

                    </div>
                    <div class="row ">
                        <div class="col-lg-12">
                            <div class="alert d-none">
                                <button class="close" data-close="alert"></button>
                                <span class="message"></span>
                            </div>
                        </div>
                        <div class="actions btn-set">
                            <!-- <button type="button" onclick="window.location = '';" class="btn default">
                                <i class="fa fa-angle-left"></i> Back
                            </button> -->
                            <input type="hidden" name="s" value="price">
                            <button  type="submit" class="listing_sub_btn mt-ladda-btn ladda-button btn-outline " data-style="contract" data-spinner-color="#333">
                               Save
                            </button>
                            <a href="javascript:;" class="next-btn" ntp="booking">Next</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="booking" role="tabpanel" aria-labelledby="nav-booking-tab">
                <form class="form-horizontal form-row-seperated" action="#" method="POST" enctype="multipart/form-data" ntb="equipment">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="bold ">Booking</h4>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-3">
                            <label>Cancellation conditions:<span class="required"> * </span></label>
                            <select name="cancellation_conditions" class="form-control" id="cancellationSelect">
                                <option data-desc=" Full refund to the tenant up to 1 day prior to arrival, excluding Service Fee and MyBoatBooker Commission. The tenant will be refunded the total amount of the booking (excluding Service Fee and MyBoatBooker Commission) if they cancel the booking until the day before check-in (time indicated on the listing by the owner or agreed between the users via MyBoatBooker messaging or 9:00 am, local time if not specified). If the Tenant arrives and decides to leave before the scheduled date, the days not spent on the boat are not refunded."
                                    {{ isset($listing->booking->cancellation_conditions) && $listing->booking->cancellation_conditions == 'flexible' ? 'selected':'' }}
                                    value="flexible">Flexible</option>
                                <option data-desc="70% refund to the tenant up to 10 days prior to arrival, excluding Service Fee and MyBoatBooker Commission. If the tenant cancels at least 10 days before check-in (time indicated on the listing by the owner or agreed upon by the users via MyBoatBooker messaging or 9:00 am local time if not specified), they will be refunded 70% of the total amount of the booking (excluding Service Fee and MyBoatBooker Commission). If they cancel less than 10 days before check-in, they will not be refunded. If the Tenant arrives and decides to leave before the scheduled date, the days not spent on the boat are not refunded."
                                    {{ isset($listing->booking->cancellation_conditions) && $listing->booking->cancellation_conditions == 'moderate' ? 'selected':'' }}
                                    value="moderate">Moderate</option>
                                <option  data-desc="60% refund to the tenant up to 30 days prior to arrival, excluding Service Fee and MYBoatBooker Commission. If the Renter cancels at least 30 days before check-in (time indicated on the listing by the owner or agreed between users via MyBoatBooker messaging or 9:00 am local time if not specified), they will be refunded 60% of the total amount of the booking (excluding Service Fee and MyBoatBooker Commission). If they cancel less than 30 days before check-in, they will not be refunded. If the Tenant arrives and decides to leave before the scheduled date, the days not spent on the boat are not refunded."
                                    {{ isset($listing->booking->cancellation_conditions) && $listing->booking->cancellation_conditions == 'strict' ? 'selected':'' }}
                                    value="strict">Strict</option>
                            </select>
                            <div id="tooltipBox" class="custom-tooltip"></div>
                            @error('cancellation_conditions')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-3">
                            <label>Check in:<span class="required"> * </span></label>
                            <input type="text" class="form-control timepicker" name="check_in" required
                                value="{{ $listing->booking->check_in ?? '' }}">
                            @error('check_in')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-3">
                            <label>Check out:<span class="required"> * </span></label>
                            <input type="text" class="form-control timepicker" name="check_out" required
                                value="{{ $listing->booking->check_out ?? '' }}">
                            @error('check_out')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        {{-- <div class="col-sm-3">
                            <label>Check in rental:<span class="required"> *</span></label>
                            <input type="text" class="form-control timepicker" name="check_in_rental"
                                value="{{ $listing->booking->check_in_rental ?? '' }}">

                        </div> --}}
                        <div class="clearfix"></div>
                        {{-- <div class="col-sm-3">
                            <label>Check out rental:<span class="required"> *</span></label>
                            <input type="text" class="form-control timepicker " name="check_out_rental"
                                value="{{ $listing->booking->check_out_rental ?? '' }}">
                        </div> --}}
                        {{-- <div class="col-sm-3">
                            <label>Fuel cost:<span class="required"> * </span></label>
                            <input type="text" class="form-control" name="fuel_cost" required
                                value="{{ $listing->booking->fuel_cost ?? '' }}">
                            @error('fuel_cost')<span class="required">{{ $message }}</span>@enderror
                        </div> --}}
                        <div class="col-sm-3">
                            <label>Is a boat licence required?:<span class="required"> * </span></label>
                            <select name="boat_licence" class="form-control">
                                <option
                                    {{ isset($listing->booking->boat_licence) && $listing->booking->boat_licence == 'no' ? 'selected':'' }}
                                    value="no">No</option>
                                <option
                                    {{ isset($listing->booking->boat_licence) && $listing->booking->boat_licence == 'yes' ? 'selected':'' }}
                                    value="yes">Yes</option>
                            </select>
                            @error('boat_licence')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-3">
                            <label>Extra night on board for free:<span class="required"> * </span></label>
                            <select name="night_fees" class="form-control">
                                <option
                                    {{ isset($listing->booking->night_fees) && $listing->booking->night_fees == 'no' ? 'selected':'' }}
                                    value="no">No</option>
                                <option
                                    {{ isset($listing->booking->night_fees) && $listing->booking->night_fees == 'yes' ? 'selected':'' }}
                                    value="yes">Yes</option>
                            </select>
                            @error('night_fees')<span class="required">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert d-none">
                                <button class="close" data-close="alert"></button>
                                <span class="message"></span>
                            </div>
                        </div>
                        <div class="text-right actions btn-set">
                            <!-- <button type="button" onclick="window.location = '';" class="btn default">
                                <i class="fa fa-angle-left"></i> Back
                            </button> -->
                            <input type="hidden" name="s" value="booking">
                            <button type="submit" class="listing_sub_btn mt-ladda-btn ladda-button btn-outline"
                                data-style="contract" data-spinner-color="#333">
                                 Save
                            </button>
                            <a href="javascript:;" class="next-btn" ntp="equipment">Next</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="calender" role="tabpanel" aria-labelledby="nav-calender-tab">
                <form method="POST">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="bold ">Select the dates when your boat is unavailable.</h4>
                        </div>
                        <div class="clearfix"></div>
                        @php
                        $calendars = $listing->calendar;
                        @endphp
                        <div class="col-lg-12">
                            <div class="fac_container">
                                @if(!count($calendars))
                                <div class="single_calender_container row" style="margin-top:10px;">
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-4" id="">
                                                <label>From:<span class="required"> * </span></label>
                                                <input type="text" class="form-control from_date"
                                                    name="calendar[1][from_date]" required>
                                            </div>
                                            <div class="col-sm-4" id="">
                                                <label>To:<span class="required"> * </span></label>
                                                <input type="text" class="form-control from_to"
                                                    name="calendar[1][from_to]" required>
                                            </div>
                                            <input type="hidden" value="1" class="form-control calendar_id"
                                                name="calendar[1][calendar_id]">
                                            <div class="col-sm-4" id="">
                                                <label>Reason:<span class="required"> * </span></label>
                                                <select class="form-control reason" name="calendar[1][reason]">
                                                    <option value="Unavailable">Unavailable</option>
                                                    <option value="Breakdown">Breakdown / Damage</option>
                                                    <option value="Wintering">Wintering / End of season</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 action_buttons"></div>
                                </div>
                                @else
                                @php
                                $countDate = 0;
                                @endphp
                                @foreach($calendars as $calendar)
                                @php
                                $countDate++;
                                $remove_btn = '';
                                if($countDate > 1):
                                $remove_btn = '<button type="button" class="btn btn-danger btn-sm remove_newf_row">
                                    remove </button>';
                                endif;
                                @endphp
                                <div class="single_calender_container row" style="margin-top:10px;">
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-4" id="">
                                                <label>From:<span class="required"> * </span></label>
                                                <input type="text" value="{{ $calendar['from_date'] }}"
                                                    class="form-control from_date"
                                                    name="calendar[{{$countDate}}][from_date]">
                                            </div>
                                            <div class="col-sm-4" id="">
                                                <label>To:<span class="required"> * </span></label>
                                                <input type="text" value="{{ $calendar['from_to'] }}"
                                                    class="form-control from_to"
                                                    name="calendar[{{$countDate}}][from_to]">
                                            </div>
                                            <div class="col-sm-4" id="">
                                                <label>Reason:<span class="required"> * </span></label>
                                                <select class="form-control reason"
                                                    name="calendar[{{$countDate}}][reason]">
                                                    <option @if($calendar['reason']=='Unavailable' ) {{ 'selected' }}
                                                        @endif value="Unavailable">Unavailable</option>
                                                    <option @if($calendar['reason']=='Breakdown' ) {{ 'selected' }}
                                                        @endif value="Breakdown">Breakdown / Damage</option>
                                                    <option @if($calendar['reason']=='Wintering' ) {{ 'selected' }}
                                                        @endif value="Wintering">Wintering / End of season</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 action_buttons">{!! $remove_btn !!}</div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="col-lg-12" style="margin-top: 8px;margin-bottom: 10px;">
                                <button type="button" class="btn btn-success btn-sm add_newf_row"> Add another date
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert d-none">
                                <button class="close" data-close="alert"></button>
                                <span class="message"></span>
                            </div>
                        </div>
                        <div class="actions btn-set">
                            <!-- <button type="button" onclick="window.location = '';" class="btn default">
                                <i class="fa fa-angle-left"></i> Back
                            </button> -->
                            <input type="hidden" name="s" value="calendar">
                            <button type="submit" class="listing_sub_btn mt-ladda-btn ladda-button btn-outline"
                                data-style="contract" data-spinner-color="#333">
                                 Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade equipment_sec" id="equipment" role="tabpanel" aria-labelledby="nav-equipment-tab">
                <form method="POST" ntb="other">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="bold ">Equipment</h4>
                        </div>
                        @php
                        $outdoor_equipment = [];
                        if(isset($listing->equipment->outdoor_equipment) &&
                        !empty($listing->equipment->outdoor_equipment)):
                        $outdoor_equipment = json_decode($listing->equipment->outdoor_equipment);
                        endif;
                        $extra_comfrot = [];
                        if(isset($listing->equipment->extra_comfrot) && !empty($listing->equipment->extra_comfrot)):
                        $extra_comfrot = json_decode($listing->equipment->extra_comfrot);
                        endif;
                        $navigation_equipment = [];
                        if(isset($listing->equipment->navigation_equipment) &&
                        !empty($listing->equipment->navigation_equipment)):
                        $navigation_equipment = json_decode($listing->equipment->navigation_equipment);
                        endif;
                        $kitchen = [];
                        if(isset($listing->equipment->kitchen) && !empty($listing->equipment->kitchen)):
                        $kitchen = json_decode($listing->equipment->kitchen);
                        endif;
                        $leisure_activities = [];
                        if(isset($listing->equipment->leisure_activities) &&
                        !empty($listing->equipment->leisure_activities)):
                        $leisure_activities = json_decode($listing->equipment->leisure_activities);
                        endif;
                        $onboard_energy = [];
                        if(isset($listing->equipment->onboard_energy) && !empty($listing->equipment->onboard_energy)):
                        $onboard_energy = json_decode($listing->equipment->onboard_energy);
                        endif;
                        $water_sports = [];
                        if(isset($listing->equipment->water_sports) && !empty($listing->equipment->water_sports)):
                        $water_sports = json_decode($listing->equipment->water_sports);
                        endif;
                        @endphp
                        <div class="col-lg-4">
                            <p class="bold">Outdoor Equipment :</p>
                            <div class="mt-checkbox-inline outdoor_equipment">
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox21"
                                        @if(in_array('bimini',$outdoor_equipment)) {{ 'checked' }} @endif value="bimini"
                                        name="outdoor_equipment[]"> Bimini
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox22"
                                        @if(in_array('outdoor_shower',$outdoor_equipment)) {{ 'checked' }} @endif
                                        value="outdoor_shower" name="outdoor_equipment[]"> Outdoor shower
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox23"
                                        @if(in_array('external_table',$outdoor_equipment)) {{ 'checked' }} @endif
                                        value="external_table" name="outdoor_equipment[]"> External table
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox24"
                                        @if(in_array('external_speaker',$outdoor_equipment)) {{ 'checked' }} @endif
                                        value="external_speaker" name="outdoor_equipment[]"> External speakers
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox25"
                                        @if(in_array('teak_deck',$outdoor_equipment)) {{ 'checked' }} @endif
                                        value="teak_deck" name="outdoor_equipment[]"> Teak deck
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox26"
                                        @if(in_array('bow_sundeck',$outdoor_equipment)) {{ 'checked' }} @endif
                                        value="bow_sundeck" name="outdoor_equipment[]"> Bow sundeck
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox27"
                                        @if(in_array('aft_sundeck',$outdoor_equipment)) {{ 'checked' }} @endif
                                        value="aft_sundeck" name="outdoor_equipment[]"> Aft sundeck
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <p class="bold">Extra Comfrot : </p>
                            <div class="mt-checkbox-inline extra_comfrot">
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox28"
                                        @if(in_array('hot_water',$extra_comfrot)) {{ 'checked' }} @endif
                                        value="hot_water" name="extra_comfrot[]"> Hot Water
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox29"
                                        @if(in_array('watermarker',$extra_comfrot)) {{ 'checked' }} @endif
                                        value="watermarker" name="extra_comfrot[]"> Watermarker
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox30"
                                        @if(in_array('air_condition',$extra_comfrot)) {{ 'checked' }} @endif
                                        value="air_condition" name="extra_comfrot[]"> Air Conditioning
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox31" @if(in_array('fans',$extra_comfrot))
                                        {{ 'checked' }} @endif value="fans" name="extra_comfrot[]"> Fans
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox32" @if(in_array('heating',$extra_comfrot))
                                        {{ 'checked' }} @endif value="heating" name="extra_comfrot[]"> Heating
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox33"
                                        @if(in_array('electric_toilet',$extra_comfrot)) {{ 'checked' }} @endif
                                        value="electric_toilet" name="extra_comfrot[]"> Electric Toilet
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox34"
                                        @if(in_array('bed_lien',$extra_comfrot)) {{ 'checked' }} @endif value="bed_lien"
                                        name="extra_comfrot[]"> bed Lien
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox35"
                                        @if(in_array('bath_towel',$extra_comfrot)) {{ 'checked' }} @endif
                                        value="bath_towel" name="extra_comfrot[]"> Bath Towel
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox36"
                                        @if(in_array('beach_towels',$extra_comfrot)) {{ 'checked' }} @endif
                                        value="beach_towels" name="extra_comfrot[]"> Beach Towels
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox37" @if(in_array('wi_fi',$extra_comfrot))
                                        {{ 'checked' }} @endif value="wi_fi" name="extra_comfrot[]"> Wi-Fi
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox38"
                                        @if(in_array('usb_socket',$extra_comfrot)) {{ 'checked' }} @endif
                                        value="usb_socket" name="extra_comfrot[]"> USB socket
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox39" @if(in_array('tv',$extra_comfrot))
                                        {{ 'checked' }} @endif value="tv" name="extra_comfrot[]"> TV
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <p class="bold">Navigation equipment : </p>
                            <div class="mt-checkbox-inline navigation_equipment">
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox40" value="dinghy"
                                        @if(in_array('dinghy',$navigation_equipment)) {{ 'checked' }} @endif
                                        name="navigation_equipment[]"> Dinghy
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox41" value="dinghy_motor"
                                        @if(in_array('dinghy_motor',$navigation_equipment)) {{ 'checked' }} @endif
                                        name="navigation_equipment[]"> Dinghy's motor
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox42" value="bow_thruster"
                                        @if(in_array('bow_thruster',$navigation_equipment)) {{ 'checked' }} @endif
                                        name="navigation_equipment[]"> Bow thruster
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox43" value="electric_windlass"
                                        @if(in_array('electric_windlass',$navigation_equipment)) {{ 'checked' }} @endif
                                        name="navigation_equipment[]"> Electric windlass
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox44" value="autopilot"
                                        @if(in_array('autopilot',$navigation_equipment)) {{ 'checked' }} @endif
                                        name="navigation_equipment[]"> Autopilot
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox45" value="gps"
                                        @if(in_array('gps',$navigation_equipment)) {{ 'checked' }} @endif
                                        name="navigation_equipment[]"> GPS
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox46" value="depth_sounder"
                                        @if(in_array('depth_sounder',$navigation_equipment)) {{ 'checked' }} @endif
                                        name="navigation_equipment[]"> Depth sounder
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox47" value="vhf"
                                        @if(in_array('vhf',$navigation_equipment)) {{ 'checked' }} @endif
                                        name="navigation_equipment[]"> VHF
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox48" value="satellite_phone"
                                        @if(in_array('satellite_phone',$navigation_equipment)) {{ 'checked' }} @endif
                                        name="navigation_equipment[]"> Satellite phone
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox49" value="guides_maps"
                                        @if(in_array('guides_maps',$navigation_equipment)) {{ 'checked' }} @endif
                                        name="navigation_equipment[]"> Guides & Maps
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p class="bold">Kitchen :</p>
                            <div class="mt-checkbox-inline kitchen">
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox50" @if(in_array('fridge',$kitchen))
                                        {{ 'checked' }} @endif value="fridge" name="kitchen[]"> Fridge
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox51" @if(in_array('freezer',$kitchen))
                                        {{ 'checked' }} @endif value="freezer" name="kitchen[]"> Freezer
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox52" @if(in_array('oven_stovetop',$kitchen))
                                        {{ 'checked' }} @endif value="oven_stovetop" name="kitchen[]"> Oven/Stovetop
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox53" @if(in_array('bbq_grill',$kitchen))
                                        {{ 'checked' }} @endif value="bbq_grill" name="kitchen[]"> BBQ Grill
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox54" @if(in_array('microwave',$kitchen))
                                        {{ 'checked' }} @endif value="microwave" name="kitchen[]"> Microwave
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox55"
                                        @if(in_array('coffee_machine',$kitchen)) {{ 'checked' }} @endif
                                        value="coffee_machine" name="kitchen[]"> Coffee Machine
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox56" @if(in_array('ice_machine',$kitchen))
                                        {{ 'checked' }} @endif value="ice_machine" name="kitchen[]"> Ice Machine
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox57" @if(in_array('ice_box',$kitchen))
                                        {{ 'checked' }} @endif value="ice_box" name="kitchen[]"> Ice Box
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <p class="bold">Leisure Activities :</p>
                            <div class="mt-checkbox-inline leisure_activities">
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox58"
                                        @if(in_array('paddle_board',$leisure_activities)) {{ 'checked' }} @endif
                                        value="paddle_board" name="leisure_activities[]"> Paddle board
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox59"
                                        @if(in_array('kayak',$leisure_activities)) {{ 'checked' }} @endif value="kayak"
                                        name="leisure_activities[]"> Kayak
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox60"
                                        @if(in_array('snorkelling_equipment',$leisure_activities)) {{ 'checked' }}
                                        @endif value="snorkelling_equipment" name="leisure_activities[]"> Snorkelling
                                    equipment
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox61"
                                        @if(in_array('fishing_equipment',$leisure_activities)) {{ 'checked' }} @endif
                                        value="fishing_equipment" name="leisure_activities[]"> Fishing equipment
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox62"
                                        @if(in_array('diving_equipment',$leisure_activities)) {{ 'checked' }} @endif
                                        value="diving_equipment" name="leisure_activities[]"> Diving equipment
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox63"
                                        @if(in_array('seabob',$leisure_activities)) {{ 'checked' }} @endif
                                        value="seabob" name="leisure_activities[]"> Seabob
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox64"
                                        @if(in_array('bike',$leisure_activities)) {{ 'checked' }} @endif value="bike"
                                        name="leisure_activities[]"> Bike
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox65"
                                        @if(in_array('electric_scooter',$leisure_activities)) {{ 'checked' }} @endif
                                        value="electric_scooter" name="leisure_activities[]"> Electric scooter
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox66"
                                        @if(in_array('drone',$leisure_activities)) {{ 'checked' }} @endif value="drone"
                                        name="leisure_activities[]"> Drone
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox67"
                                        @if(in_array('video_camera',$leisure_activities)) {{ 'checked' }} @endif
                                        value="video_camera" name="leisure_activities[]"> Video camera
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <p class="bold">Onboard Energy:</p>
                            <div class="mt-checkbox-inline onboard_energy">
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox68"
                                        @if(in_array('generator',$onboard_energy)) {{ 'checked' }} @endif
                                        value="generator" name="onboard_energy[]"> Generator
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox69"
                                        @if(in_array('power_inverter',$onboard_energy)) {{ 'checked' }} @endif
                                        value="power_inverter" name="onboard_energy[]"> Power inverter
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox70"
                                        @if(in_array('220v_power_outlet',$onboard_energy)) {{ 'checked' }} @endif
                                        value="220v_power_outlet" name="onboard_energy[]"> 220V power outlet
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <p class="bold">Water Sports :</p>
                            <div class="mt-checkbox-inline water_sports">
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox71"
                                        @if(in_array('water_skis',$water_sports)) {{ 'checked' }} @endif
                                        value="water_skis" name="water_sports[]"> Water skis
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox72" @if(in_array('monoski',$water_sports))
                                        {{ 'checked' }} @endif value="monoski" name="water_sports[]"> Monoski
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox73"
                                        @if(in_array('wakeboard',$water_sports)) {{ 'checked' }} @endif
                                        value="wakeboard" name="water_sports[]"> Wakeboard
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox74"
                                        @if(in_array('towable_tube',$water_sports)) {{ 'checked' }} @endif
                                        value="towable_tube" name="water_sports[]"> Towable Tube
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox75"
                                        @if(in_array('inflatable_banana',$water_sports)) {{ 'checked' }} @endif
                                        value="inflatable_banana" name="water_sports[]"> Inflatable banana
                                    <span></span>
                                </label>
                                <label class="mt-checkbox">
                                    <input type="checkbox" id="inlineCheckbox76"
                                        @if(in_array('kneeboard',$water_sports)) {{ 'checked' }} @endif
                                        value="kneeboard" name="water_sports[]"> Kneeboard
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert d-none">
                                <button class="close" data-close="alert"></button>
                                <span class="message"></span>
                            </div>
                        </div>
                        <div class="text-right actions btn-set">
                            <!-- <button type="button" onclick="window.location = '';" class="btn default">
                                <i class="fa fa-angle-left"></i> Back
                            </button> -->
                            <input type="hidden" name="s" value="equipment">
                            <button type="submit" class="listing_sub_btn mt-ladda-btn ladda-button btn-outline"
                                data-style="contract" data-spinner-color="#333">
                                Save
                            </button>
                            <a href="javascript:;" class="next-btn" ntp="other">Next</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="nav-other-tab">
                <form class="form-horizontal form-row-seperated" action="{{ route('admin.general-settings', $listing->id) }}" method="POST"enctype="multipart/form-data" ntb="">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="bold ">Technical points</h4>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-4">
                            <label>Engine type:<span class="required"> * </span></label>
                            <select class="form-control" name="engine_type">
                                <option
                                    {{ isset($listing->otherListingSetting->engine_type) && $listing->otherListingSetting->engine_type == 'Inboard' ? 'selected':'' }}
                                    value="Inboard">Inboard</option>
                                <option
                                    {{ isset($listing->otherListingSetting->engine_type) && $listing->otherListingSetting->engine_type == 'Outboard' ? 'selected':'' }}
                                    value="Outboard">Outboard</option>
                            </select>
                            @error('engine_type')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-4">
                            <label>Engine horsepower (HP):<span class="required"> * </span></label>
                            <input type="number" min="1" class="form-control" name="horsepower" required value="{{ $listing->otherListingSetting->horsepower ?? '' }}">
                            @error('horsepower')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-4">
                            <label>Width (m):<span class="required">*</span></label>
                            <input type="text" class="form-control" required name="width" value="{{ $listing->otherListingSetting->width ?? '' }}">
                        </div>
                        
                        <div class="clearfix"></div>
                        <div class="col-sm-4">
                            <label>Draft (m):<span class="required"></span></label>
                            <input type="text" class="form-control" name="draft" value="{{ $listing->otherListingSetting->draft ?? '' }}">

                        </div>
                        <div class="col-sm-4">
                            <label>Horsepower of the tender:<span class="required"> </span></label>
                            <input type="text" class="form-control" name="horsepower_tender" value="{{ $listing->otherListingSetting->horsepower_tender ?? '' }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert d-none">
                                <button class="close" data-close="alert"></button>
                                <span class="message"></span>
                            </div>
                        </div>
                        <div class="text-right actions btn-set">
                            <!-- <button type="button" onclick="window.location = '';" class="btn default">
                                <i class="fa fa-angle-left"></i> Back
                            </button> -->
                            <input type="hidden" name="s" value="other">
                            <button type="submit" class="listing_sub_btn mt-ladda-btn ladda-button btn-outline" data-style="contract" data-spinner-color="#333">
                                Save
                            </button>
                            <a href="javascript:;" class="publish-btn">Publish</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="discounts" role="tabpanel" aria-labelledby="nav-discounts-tab">
                <form method="POST">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="bold ">Standard discounts</h4>
                        </div>
                        <div class="col-sm-4">
                            <label>First booking discount (%)</label>
                            <input type="number" name="first_booking_discount"
                                value="{{ $listing->discount->first_booking_discount ?? ''}}" class="form-control"
                                placeholder="%">
                        </div>
                        <!-- Early-bird Discount -->
                        <div class="col-sm-12">
                            <h4 class="pt-4 bold">Early-bird discount</h4>
                        </div>
                        @php
                        $early_booking = '';
                        if(isset($listing->discount->early_bird_discount)):
                        $early_booking = unserialize($listing->discount->early_bird_discount);
                        endif;
                        @endphp
                        <div class="col-sm-4">
                            <label>Early booking window </label>
                            <select name="early_booking[early_booking_month]" class="form-control">
                                <option
                                    {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='' ? 'selected' : "" }}
                                    value="">Select</option>
                                <option
                                    {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='1' ? 'selected' : "" }}
                                    value="1">1 month in advance</option>
                                <option
                                    {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='2' ? 'selected' : "" }}
                                    value="2">2 months in advance</option>
                                <option
                                    {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='3' ? 'selected' : "" }}
                                    value="3">3 months in advance</option>
                                <option
                                    {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='4' ? 'selected' : "" }}
                                    value="4">4 months in advance</option>
                                <option
                                    {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='5' ? 'selected' : "" }}
                                    value="5">5 months in advance</option>
                                <option
                                    {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='6' ? 'selected' : "" }}
                                    value="6">6 months in advance</option>
                                <option
                                    {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='12' ? 'selected' : "" }}
                                    value="12">12 months in advance</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Minimum rental duration </label>
                            <select name="early_booking[minimum_duration]" class="form-control">
                                <option
                                    {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='' ? 'selected' : "" }}
                                    value=" ">Select</option>
                                <option
                                    {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='2' ? 'selected' : "" }}
                                    value="2">2 days or more</option>
                                <option
                                    {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='3' ? 'selected' : "" }}
                                    value="3">3 days or more</option>
                                <option
                                    {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='4' ? 'selected' : "" }}
                                    value="4">4 days or more</option>
                                <option
                                    {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='5' ? 'selected' : "" }}
                                    value="5">5 days or more</option>
                                <option
                                    {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='6' ? 'selected' : "" }}
                                    value="6">6 days or more</option>
                                <option
                                    {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='7' ? 'selected' : "" }}
                                    value="7">7 days or more</option>
                                <option
                                    {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='14' ? 'selected' : "" }}
                                    value="14">14 days or more</option>
                                <option
                                    {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='21' ? 'selected' : "" }}
                                    value="21">21 days or more</option>
                                <option
                                    {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='30' ? 'selected' : "" }}
                                    value="30">30 days or more</option>
                                <option
                                    {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='always' ? 'selected' : "" }}
                                    value="always">Always</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Discount (%) </label>
                            <input type="number" name="early_booking[discount]"
                                value="{{ $early_booking['discount'] ?? "" }}" class="form-control" placeholder="%">
                        </div>
                        <!-- Last-minute Booking -->
                        <div class="col-sm-12">
                            <h4 class="pt-4 bold ">Last minute booking</h4>
                        </div>
                        @php
                        $last_minute_booking = '';
                        if(isset($listing->discount->last_minute_booking)):
                        $last_min_booking = unserialize($listing->discount->last_minute_booking);
                        endif;
                        @endphp
                        <div class="col-sm-4">
                            <label>Last minute booking window </label>
                            <select name="last_min_booking[days]" class="form-control">
                                <option
                                    {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='' ? 'selected' : "" }}
                                    value=" ">Select</option>
                                <option
                                    {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='1' ? 'selected' : "" }}
                                    value="1">1 days before booking</option>
                                <option
                                    {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='2' ? 'selected' : "" }}
                                    value="2">2 days before booking</option>
                                <option
                                    {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='3' ? 'selected' : "" }}
                                    value="3">3 days before booking</option>
                                <option
                                    {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='4' ? 'selected' : "" }}
                                    value="4">4 days before booking</option>
                                <option
                                    {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='5' ? 'selected' : "" }}
                                    value="5">5 days before booking</option>
                                <option
                                    {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='6' ? 'selected' : "" }}
                                    value="6">6 days before booking</option>
                                <option
                                    {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='7' ? 'selected' : "" }}
                                    value="7">7 days before booking</option>
                                <option
                                    {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='14' ? 'selected' : "" }}
                                    value="14">14 days before booking</option>
                                <option
                                    {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='30' ? 'selected' : "" }}
                                    value="30">30 days before booking</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Minimum rental duration</label>
                            <select name="last_min_booking[day_rental_duration]" class="form-control">
                                <option
                                    {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='' ? 'selected' : "" }}
                                    value=" ">Select</option>
                                <option
                                    {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='2' ? 'selected' : "" }}
                                    value="2">2 days or more</option>
                                <option
                                    {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='3' ? 'selected' : "" }}
                                    value="3">3 days or more</option>
                                <option
                                    {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='4' ? 'selected' : "" }}
                                    value="4">4 days or more</option>
                                <option
                                    {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='5' ? 'selected' : "" }}
                                    value="5">5 days or more</option>
                                <option
                                    {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='6' ? 'selected' : "" }}
                                    value="6">6 days or more</option>
                                <option
                                    {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='7' ? 'selected' : "" }}
                                    value="7">7 days or more</option>
                                <option
                                    {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='14' ? 'selected' : "" }}
                                    value="14">14 days or more</option>
                                <option
                                    {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='21' ? 'selected' : "" }}
                                    value="21">21 days or more</option>
                                <option
                                    {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='30' ? 'selected' : "" }}
                                    value="30">30 days or more</option>
                                <option
                                    {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='always' ? 'selected' : "" }}
                                    value="always">Always</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Discount (%) </label>
                            <input type="number" name="last_min_booking[discount]"
                                value="{{ $last_min_booking['discount'] ?? '' }}" class="form-control" placeholder="%">
                        </div>
                        <!-- Length-of-stay discounts -->
                        <div class="col-sm-12">
                            <h4 class="pt-4 bold ">Length of stay discounts</h4>
                        </div>
                        @php
                        $length_stay_dis = '';
                        if(isset($listing->discount->length_of_stay_discounts)):
                        $length_stay_dis = unserialize($listing->discount->length_of_stay_discounts);
                        endif;
                        @endphp
                        <div class="col-sm-4">
                            <label>Length of stay discounts </label>
                            <select name="length_stay_dis[days]" class="form-control">
                                <option
                                    {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='' ? 'selected' : "" }}
                                    value=" ">Select</option>
                                <option
                                    {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='2' ? 'selected' : "" }}
                                    value="2">2 days or more</option>
                                <option
                                    {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='3' ? 'selected' : "" }}
                                    value="3">3 days or more</option>
                                <option
                                    {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='4' ? 'selected' : "" }}
                                    value="4">4 days or more</option>
                                <option
                                    {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='5' ? 'selected' : "" }}
                                    value="5">5 days or more</option>
                                <option
                                    {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='6' ? 'selected' : "" }}
                                    value="6">6 days or more</option>
                                <option
                                    {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='7' ? 'selected' : "" }}
                                    value="7">7 days or more</option>
                                <option
                                    {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='14' ? 'selected' : "" }}
                                    value="14">14 days or more</option>
                                <option
                                    {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='21' ? 'selected' : "" }}
                                    value="21">21 days or more</option>
                                <option
                                    {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='30' ? 'selected' : "" }}
                                    value="30">30 days or more</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Discount (%) </label>
                            <input type="number" name="length_stay_dis[discount]" class="form-control"
                                value="{{ $length_stay_dis['discount'] ?? '' }}" placeholder="%">
                        </div>
                        <!-- Custom discounts -->
                        <div class="col-sm-12">
                            <h4 class="pt-4 bold ">Custom discounts</h4>
                        </div>
                        @php
                        $custom_discounts = '';
                        if(isset($listing->discount->custom_discounts)):
                        $custom_discounts = unserialize($listing->discount->custom_discounts);
                        endif;
                        @endphp
                        <div class="col-sm-12">
                            <label>Booking dates </label>
                        </div>
                        <div class="col-sm-4 cus_input">
                            <input type="text" name="custom_discount[from_date]"
                                value="{{ $custom_discounts['from_date'] ?? '' }}" class="form-control datePicker"
                                placeholder="From">
                        </div>
                        <div class="col-sm-4 cus_input">
                            <input type="text" name="custom_discount[to_date]" class="form-control datePicker"
                                value="{{ $custom_discounts['to_date'] ?? '' }}" placeholder="To">
                        </div>

                        <div class="col-sm-12">
                            <label>Rental dates </label>
                        </div>
                        <div class="col-sm-4 cus_input">
                            <input type="text" name="custom_discount[rental_from_date]" class="form-control datePicker"
                                value="{{ $custom_discounts['rental_from_date'] ?? '' }}" placeholder="From">
                        </div>
                        <div class="col-sm-4 cus_input">
                            <input type="text" name="custom_discount[rental_to_date]" class="form-control datePicker"
                                value="{{ $custom_discounts['rental_to_date'] ?? '' }}" placeholder="To">
                        </div>
                        <div class="col-sm-4 cus_input">
                            <input type="number" name="custom_discount[discount]" class="form-control"
                                value="{{ $custom_discounts['discount'] ?? '' }}" placeholder="Discount (%) ">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert d-none">
                                <button class="close" data-close="alert"></button>
                                <span class="message"></span>
                            </div>
                        </div>
                        <div class="text-right actions btn-set">
                            <!-- <button type="button" onclick="window.location = '';" class="btn default">
                                <i class="fa fa-angle-left"></i> Back
                            </button> -->
                            <input type="hidden" name="s" value="discount">
                            <button type="submit" class="listing_sub_btn mt-ladda-btn ladda-button btn-outline"
                                data-style="contract" data-spinner-color="#333">
                                 Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.timepicker').timepicker({
            timeFormat: 'H:i',
            minuteStep: 30,
            defaultTime: '12:00 AM'

        });
    });
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').addClass('d-none');
        }, 5000);
        $(document).on('click', '.add_newf_row', function(e) {
            var remove_btn_html =
                '<button type="button" class="btn btn-danger btn-sm remove_newf_row" > remove </button>';
            var html = '<div class="single_calender_container row" style="">';
            html += $('.single_calender_container:first').html();
            html += '</div>';
            $('.fac_container').append(html);
            var total_container = $('.single_calender_container').length;
            $('.single_calender_container:last').find('.action_buttons').html(remove_btn_html);
            $('.single_calender_container:last').find('.from_date').attr('name', 'calendar[' +
                total_container + '][from_date]');
            $('.single_calender_container:last').find('.from_to').attr('name', 'calendar[' +
                total_container + '][from_to]');
            $('.single_calender_container:last').find('.reason').attr('name', 'calendar[' +
                total_container + '][reason]');
            $('.single_calender_container:last').find('.from_date').val('');
            $('.single_calender_container:last').find('.from_to').val('');
            $('.single_calender_container:last').find('.reason').val('');
            flatpickr(".from_date", {
                inline: false,
                dateFormat: "d-m-Y",
                minDate: "today",
            });
            flatpickr(".from_to", {
                inline: false,
                dateFormat: "d-m-Y",
                minDate: "today",
            });
        });
        $(document).on('click', '.remove_newf_row', function(e) {
            $(this).parents('.single_calender_container').remove();
        });
        $(document).on('click', '.next-btn', function(e) {
            var ntb = $(this).attr('ntp');
            $('.nav-item.nav-link').removeClass('active ahow');
            $('.tab-pane').removeClass('active show');
            $('#nav-'+ntb+'-tab').addClass('active show');
            $('#'+ntb+'').addClass('active show');
        });
        $(document).on('click','#images-uploded',function(){
            $('.nav-item.nav-link').removeClass('active ahow');
            $('.tab-pane').removeClass('active show');
            $('#nav-price-tab').addClass('active show');
            $('#price').addClass('active show');
        })
        $(document).on('submit', 'form', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var ntb = $(this).attr('ntb');
            $.ajax({
                url: "{{ route('boatowner.listing-settings',$listing->id) }}", 
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        $('.alert').removeClass('alert-danger');
                        $('.alert').removeClass('d-none');
                        $('.alert').addClass('alert-success');
                        $('.message').html(response.message);
                        setTimeout(function() {
                            $('.alert').addClass('d-none');
                            if(ntb != '')
                            {
                                $('.nav-item.nav-link').removeClass('active ahow');
                                $('.tab-pane').removeClass('active show');
                                $('#nav-'+ntb+'-tab').addClass('active show');
                                $('#'+ntb+'').addClass('active show');
                            }
                            else
                            {
                                $('.publish-btn').removeClass('d-none');
                            }
                        }, 2000);
                    } else {
                        $('.alert').removeClass('d-none');
                        $('.alert').addClass('alert-danger');
                        $('.message').html(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';
                    for (var field in errors) {
                        errorMessage += errors[field] + '<br>'; // Show validation errors
                    }
                    $('.alert').removeClass('d-none');
                    $('.alert').addClass('alert-danger');
                    $('.message').html(errorMessage);

                }
            });
        })
        $(document).on('click','.publish-btn', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('boatowner.listingpublish',$listing->id) }}", 
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        $('.alert').removeClass('alert-danger');
                        $('.alert').removeClass('d-none');
                        $('.alert').addClass('alert-success');
                        $('.message').html(response.message);
                        setTimeout(function() {
                            $('.alert').addClass('d-none');
                            window.location.href = response.redirect_url;
                        }, 2000);
                    } else {
                        $('.alert').removeClass('d-none');
                        $('.alert').addClass('alert-danger');
                        $('.message').html(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';
                    for (var field in errors) {
                        errorMessage += errors[field] + '<br>'; // Show validation errors
                    }
                    $('.alert').removeClass('d-none');
                    $('.alert').addClass('alert-danger');
                    $('.message').html(errorMessage);

                }
            });
        })
    });
    // Disable autoDiscover to manually initialize Dropzone
    let imageCount = 0;
    // Function to update the image count display
    function updateImageCount() {
        imageCount = document.querySelectorAll('#uploaded-images .image-container').length;
        if (imageCount >= 1 && imageCount <= 3) {
            const divToRemove = document.getElementById('empty-img-'+imageCount); // Replace 'someDivId' with the actual ID of the div
            if (divToRemove) {
                divToRemove.remove(); // Remove the div from the DOM
            }
        }
    }

    Dropzone.autoDiscover = false;
    const imageDropzone = new Dropzone("#imageDropzone", {
        url: "{{ route('boatowner.uploadgallery',$listing->id) }}", // URL to handle file upload
        paramName: 'file', // The name that will be used to send the file
        maxFilesize: 20, // Max file size in MB
        acceptedFiles: 'image/*', // Only allow image files
        dictDefaultMessage: 'Drag & Drop or Click to Upload Image',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for security
        },
        success: function(file, response) {
            console.log('File uploaded successfully', response);
            // Display the uploaded image and the remove button
            const imageContainer = document.createElement('div');
            imageContainer.classList.add('image-container');
            imageContainer.classList.add('col-md-4');
            imageContainer.setAttribute('data-id', response.data.id);

            const image = document.createElement('img');
            image.src = response.data.url; // URL of the uploaded image
            image.classList.add('uploaded-image');
            imageContainer.appendChild(image);

            const removeButton = document.createElement('button');
            removeButton.innerHTML = '<i class="far fa-times-circle"></i>';
            removeButton.classList.add('remove-btn');
            removeButton.onclick = function() {
                removeImage(response.data.id, imageContainer, file);
            };
            imageContainer.appendChild(removeButton);
            document.getElementById('uploaded-images').appendChild(imageContainer);
            updateImageCount()
        },
        error: function(file, response) {
            const errorMessage = response || 'An error occurred during upload';
            // Display error message in the preview box (customize this part as needed)
            const errorElement = document.createElement('div');
            errorElement.classList.add('dz-error-message');
            errorElement.innerHTML = `<span>${errorMessage}</span>`;

            // Find the preview element and append the error message
            const previewElement = file.previewElement;
            previewElement.classList.add('dz-error'); // Add error styling to preview
            previewElement.appendChild(errorElement); // Append the error message to preview
            console.log('Error uploading file', response);

            // Remove the file preview after a short delay (optional)
            setTimeout(() => {
                imageDropzone.removeFile(file);
            }, 10000); // Adjust the delay time as needed
        }
    });
    const imageDropzonetwo = new Dropzone("#imageDropzone-plan", {
        url: "{{ route('boatowner.uploadplanimage',$listing->id) }}", // URL to handle file upload
        paramName: 'file', // The name that will be used to send the file
        maxFilesize: 20, // Max file size in MB
        acceptedFiles: 'image/*', // Only allow image files
        dictDefaultMessage: 'Drag & Drop or Click to Upload Image',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for security
        },
        success: function(file, response) {
            console.log('File uploaded successfully', response);
            // Display the uploaded image and the remove button
            const imageContainer = document.createElement('div');
            imageContainer.classList.add('image-container');
            imageContainer.classList.add('col-md-4');
            imageContainer.setAttribute('data-id', response.data.id);

            const image = document.createElement('img');
            image.src = response.data.url; // URL of the uploaded image
            image.classList.add('uploaded-image-plan');
            imageContainer.appendChild(image);

            const removeButton = document.createElement('button');
            removeButton.innerHTML = '<i class="far fa-times-circle"></i>';
            removeButton.classList.add('remove-btn');
            removeButton.onclick = function() {
                removeImage(response.data.id, imageContainer, file);
            };
            imageContainer.appendChild(removeButton);
            document.getElementById('uploaded-images-plan').appendChild(imageContainer);
        },
        error: function(file, response) {
            const errorMessage = response || 'An error occurred during upload';
            // Display error message in the preview box (customize this part as needed)
            const errorElement = document.createElement('div');
            errorElement.classList.add('dz-error-message');
            errorElement.innerHTML = `<span>${errorMessage}</span>`;

            // Find the preview element and append the error message
            const previewElement = file.previewElement;
            previewElement.classList.add('dz-error'); // Add error styling to preview
            previewElement.appendChild(errorElement); // Append the error message to preview
            console.log('Error uploading file', response);

            // Remove the file preview after a short delay (optional)
            setTimeout(() => {
                imageDropzonetwo.removeFile(file);
            }, 10000); // Adjust the delay time as needed
        }
    });

    // Function to remove the image from both front-end and back-end
    function removeImage(imageId, imageContainer, dropzoneFile) {
        // Send AJAX request to remove the image from the database
        fetch("{{ route('boatowner.removegallery') }}", {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id: imageId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    imageContainer.remove();
                    if (dropzoneFile) {
                        imageDropzone.removeFile(dropzoneFile);
                        imageDropzonetwo.removeFile(dropzoneFile);
                    }
                    updateImageCount();
                } else {

                }
            })
            .catch(error => {

            });
    }
    $(document).ready(function() {
        $('#file-input').on('change', function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('image', $('#file-input')[0].files[0]);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                url: "{{ route('boatowner.uploadcoverimage',$listing->id) }}", // URL for the image upload endpoint
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        var html =
                            '<label>Cover Image:<span class="required"> * </span></label><img src="' +
                            response.imageUrl + '" class="img-responsive pic-bordered" >';
                        $('#uploade-cover-image').html(html)
                        $('#statusMessage').text("Image uploaded successfully!").css('color',
                            'green');
                    } else {
                        $('#statusMessage').text("Image upload failed!").css('color', 'red');
                    }
                },
                error: function(xhr, status, error) {
                    $('#statusMessage').text('An error occurred while uploading the image.')
                        .css('color', 'red');
                }
            });
        });
    });

    function removeImageGallery(imageId, buttonElement) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this!",
            type: "warning", // 'type' is valid in SweetAlert1
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, I am sure!',
            cancelButtonText: 'No, cancel it!',
            closeOnConfirm: false, // This prevents the alert from closing immediately
            closeOnCancel: true // This allows closing on cancel
        },
        function(isConfirm) {
            if (isConfirm) {
                // Send AJAX request to remove the image from the backend
                fetch("{{ route('boatowner.removegallery') }}", {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id: imageId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove the image container from the DOM
                            buttonElement.closest('.image-container').remove();
                            swal("Deleted!", "The image has been removed.", "success");
                        } else {
                            swal("Failed!", "Failed to remove the image.", "error");
                        }
                    })
                    .catch(error => {
                        console.error('Error removing image:', error);
                        swal("Error!", "There was a problem removing the image.", "error");
                    });
            } else {
                swal("Cancelled", "The image was not removed.", "error");
            }
        });
    }
</script>
@endsection