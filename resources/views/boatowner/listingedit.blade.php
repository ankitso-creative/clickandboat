@extends('layouts.boatowner.common')
@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
    <link href="{{ asset('app-assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('app-assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('app-assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('app-assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('app-assets/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
   $(document).ready(function() {
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
   </script>
@endsection
@section('content')
    <div class="col-lg-9 main-dashboard">
        <div class="page-title">
            <h1>Edit Your Listing</h1>
        </div>
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
        <div class="row">
            <section id="tabs">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="nav-home" aria-selected="true">General </a>
                                    <a class="nav-item nav-link" id="nav-image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="nav-profile" aria-selected="false">Images</a>
                                    <a class="nav-item nav-link" id="nav-price-tab" data-toggle="tab" href="#price" role="tab" aria-controls="nav-contact" aria-selected="false">Price</a>
                                    <a class="nav-item nav-link" id="nav-booking-tab" data-toggle="tab" href="#booking" role="tab" aria-controls="nav-about" aria-selected="false">Booking</a>
                                    
                                    <a class="nav-item nav-link" id="nav-calender-tab" data-toggle="tab" href="#calender" role="tab" aria-controls="nav-about" aria-selected="false">Calender</a>
                                    <a class="nav-item nav-link" id="nav-equipment-tab" data-toggle="tab" href="#equipment" role="tab" aria-controls="nav-about" aria-selected="false">Equipment</a>
                                    <a class="nav-item nav-link" id="nav-other-tab" data-toggle="tab" href="#other" role="tab" aria-controls="nav-about" aria-selected="false">Other</a>
                                    <a class="nav-item nav-link" id="nav-discounts-tab" data-toggle="tab" href="#discounts" role="tab" aria-controls="nav-about" aria-selected="false">Discounts</a>
                                </div>
                            </nav>
                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="nav-general-tab">
                                    {{-- <form action="{{ route('boatowner.listing-settings', $listing->id) }}" method="POST" enctype="multipart/form-data"> --}}
                                    <form method="POST">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>Type:<span class="required"> * </span></label>
                                                <select name="type" class="form-control" required>
                                                    <option @if($listing->type=='Motorboat') {{ 'selected' }} @endif; value="Motorboat">Motorboat</option>
                                                    <option @if($listing->type=='Sailboat') {{ 'selected' }} @endif; value="Sailboat">Sailboat</option>
                                                    <option @if($listing->type=='RIB') {{ 'selected' }} @endif; value="RIB">RIB</option>
                                                    <option @if($listing->type=='Catamaran') {{ 'selected' }} @endif; value="Catamaran">Catamaran</option>
                                                    <option @if($listing->type=='Houseboat') {{ 'selected' }} @endif; value="Houseboat">Houseboat</option>
                                                    <option @if($listing->type=='Jet ski') {{ 'selected' }} @endif; value="Jet ski">Jet ski</option>
                                                    <option @if($listing->type=='Gulet') {{ 'selected' }} @endif; value="Gulet">Gule </option>
                                                    <option @if($listing->type=='Boat without licence') {{ 'selected' }} @endif; value="Boat without licence">Boat without licence</option>
                                                    <option @if($listing->type=='Yacht') {{ 'selected' }} @endif; value="Yacht">Yacht</option>
                                                </select>
                                                @error('type')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Harbour:<span class="required"> * </span></label>
                                                <input type="text" name="harbour" value="{{ old('harbour', $listing->harbour) }}" class="form-control" required>
                                                @error('harbour')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-lg-4">
                                                <label>City:<span class="required"> * </span></label>
                                                <input type="text" name="city" class="form-control" required value="{{ old('city', $listing->city) }}">
                                                @error('city')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-4">
                                                <label>Are you a professional?:<span class="required"> * </span></label>
                                                <select name="professional" class="form-control" required>
                                                    <option  @if($listing->professional=='No') {{ 'selected' }} @endif value="No">No</option>
                                                    <option  @if($listing->professional=='Yes') {{ 'selected' }} @endif value="Yes">Yes</option>
                                                </select>
                                                @error('professional')<span class="required">{{ $message }}</span>@enderror
                                            </div>	
                                            <div class="col-lg-4">
                                                <label>Manufacturer:<span class="required"> * </span></label>
                                                <input type="text" name="manufacturer" class="form-control" required value="{{ old('manufacturer', $listing->manufacturer) }}">
                                                @error('manufacturer')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Model:<span class="required"> * </span></label>
                                                <input type="text" name="model" class="form-control" required value="{{ old('model', $listing->model) }}">
                                                @error('model')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-4">
                                                <label>Is your boat rented with a skipper?:<span class="required"> * </span></label>
                                                <select name="skipper" class="form-control" required>
                                                    <option @if($listing->skipper=='with skipper') {{ 'selected' }} @endif value="with skipper">With Skipper </option>
                                                    <option @if($listing->skipper=='without skipper') {{ 'selected' }} @endif value="without skipper">Without Skipper</option>
                                                    <option @if($listing->skipper=='with Or without skipper') {{ 'selected' }} @endif value="with Or without skipper">With Or Without Skipper</option>
                                                </select>
                                                @error('skipper')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            
                                            <div class="col-lg-4">
                                                <label>Capacity:<span class="required"> * </span></label>
                                                <input type="text" name="capacity" class="form-control"  value="{{ old('capacity', $listing->capacity) }}">
                                                @error('capacity')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Length (m)<span class="required"> * </span></label>
                                                <input type="text" name="length" class="form-control" value="{{ old('length', $listing->length) }}">
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-12">
                                                <h4 class="bold ">Company</h4>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-4">
                                                <label>Company's name<span class="required"> * </span></label>
                                                <input type="text" name="company_name" class="form-control" required value="{{ old('company_name', $listing->company_name) }}">
                                                @error('company_name')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Website<span class="required">  </span></label>
                                                <input type="text" name="website" class="form-control" value="{{ old('website', $listing->website) }}">
                                            </div> 
                                            <div class="clearfix"></div>
                                            <div class="col-lg-12">
                                                <h4 class="bold ">Description</h4>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-6">
                                                <label>Boat name:<span class="required"> * </span></label>
                                                <input type="text" name="boat_name" class="form-control" required value="{{ old('boat_name', $listing->boat_name) }}">
                                                @error('boat_name')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Title:<span class="required"> </span></label>
                                                <input type="text" name="title" class="form-control" value="{{ old('title', $listing->title) }}">
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-12">
                                                <label>Description:<span class="required"> </span></label>
                                                <textarea type="text" name="description" class="form-control">{{ $listing->description }}</textarea>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-12">
                                                <h4 class="bold ">Technical</h4>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-3">
                                                <label>Onboard capacity:<span class="required"> </span></label>
                                                <input type="text" name="onboard_capacity" class="form-control" value="{{ old('onboard_capacity', $listing->onboard_capacity) }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Number of cabins:<span class="required"> </span></label>
                                                <input type="text" name="cabins" class="form-control" value="{{ old('cabins', $listing->cabins) }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Number of berths:<span class="required"> </span></label>
                                                <input type="text" name="berths" class="form-control" value="{{ old('berths', $listing->berths) }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Number of bathrooms:<span class="required"> </span></label>
                                                <input type="text" name="bathrooms" class="form-control" value="{{ old('bathrooms', $listing->bathrooms) }}">
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-3">
                                                <label>Year of construction:<span class="required"> </span></label>
                                                <input type="text" name="construction_year" class="form-control" value="{{ old('construction_year', $listing->construction_year) }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Fuel(L/h):<span class="required"> </span></label>
                                                <input type="text" name="fuel" class="form-control" value="{{ old('fuel', $listing->fuel) }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Renovated:<span class="required"> </span></label>
                                                <input type="text" name="renovated" class="form-control" value="{{ old('renovated', $listing->renovated) }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>speed (kn):<span class="required"> </span></label>
                                                <input type="text" name="speed" class="form-control" value="{{ old('speed', $listing->speed) }}">
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
                                            <div class="actions btn-set">
                                                <button type="button" onclick="window.location = '';" class="btn btn default">
                                                    <i class="fa fa-angle-left"></i> Back
                                                </button>	
                                                <input type="hidden" name="s" value="general">
                                                <button type="submit" class="btn btn-success mt-ladda-btn ladda-button btn-outline" data-style="contract" data-spinner-color="#333">
                                                    <i class="fa fa-check"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade edit_profile_sec" id="image" role="tabpanel" aria-labelledby="nav-image-tab">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="bold ">Images</h4>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-sm-4">
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
                                            <h4 class="bold ">Gallery</h4>
                                        </div>
                                        <div class="col-sm-12">
                                            <div id="imageDropzone" class="dropzone">
                                                <div class="dz-message">
                                                    Drag & Drop or Click to Upload Image
                                                </div>
                                            </div>
                                        </div>
                                        @php 
                                            $images = $listing->getMedia('listing_gallery'); 
                                        @endphp
                                        <div class="col-md-12 uploaded_img">
                                            <div class="row" id="uploaded-images">
                                            @if($images)
                                                @foreach($images as $image)
                                                    <div class="col-md-4 image-container" data-id="{{ $image->id }}">
                                                        <img src="{{ $image->getUrl() }}" class="uploaded-image img-responsive pic-bordered">
                                                        <button class="remove-btn" onclick="removeImageGallery({{ $image->id }}, this)"><i class="far fa-times-circle"></i></button>
                                                    </div>
                                                @endforeach
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade edit_profile_sec" id="price" role="tabpanel" aria-labelledby="nav-price-tab">
                                    <form method="POST">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h4 class="bold ">Price</h4>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-4">
                                                <label>Price:<span class="required"> * </span></label>
                                                <input type="text" name="price" class="form-control" required value="{{ $listing->price->price ?? '' }}">
                                                @error('price')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="clear"></div>
                                            <div class="col-sm-12">
                                                <h4 class="bold ">Advance Price Options</h4>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>1 half day price:<span class="required">  </span></label>
                                                <input type="text" name="one_half_day_price" value="{{ $listing->price->one_half_day ?? '' }}" class="form-control" >
                                            </div>
                                            <div class="col-sm-3">
                                                <label>2 days price:<span class="required">  </span></label>
                                                <input type="text" name="two_day_price" value="{{ $listing->price->two_day ?? '' }}" class="form-control" >
                                            </div>
                                            <div class="col-sm-3">
                                                <label>3 days price:<span class="required">  </span></label>
                                                <input type="text" name="three_day_price" value="{{ $listing->price->three_day ?? '' }}" class="form-control" >
                                            </div>
                                            <div class="col-sm-3">
                                                <label>4 days price:<span class="required">  </span></label>
                                                <input type="text" name="four_day_price" value="{{ $listing->price->four_day ?? '' }}" class="form-control" >
                                            </div>
                                            <div class="clear"></div>
                                            <div class="col-sm-4">
                                                <label>5 days price:<span class="required">  </span></label>
                                                <input type="text" name="five_day_price" value="{{ $listing->price->five_day ?? '' }}" class="form-control" >
                                            </div>
                                            <div class="col-sm-4">
                                                <label>6 days price:<span class="required">  </span></label>
                                                <input type="text" name="six_day_price" value="{{ $listing->price->six_day ?? '' }}" class="form-control" >
                                            </div>
                                            <div class="col-sm-4">
                                                <label>1 week price:<span class="required">  </span></label>
                                                <input type="text" name="one_week_price" value="{{ $listing->price->one_week ?? '' }}" class="form-control" >
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
                                                <button type="button" onclick="window.location = '';" class="btn btn default">
                                                    <i class="fa fa-angle-left"></i> Back
                                                </button>	
                                                <input type="hidden" name="s" value="price">
                                                <button type="submit"  class="btn btn-success mt-ladda-btn ladda-button btn-outline " data-style="contract" data-spinner-color="#333">
                                                    <i class="fa fa-check"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="booking" role="tabpanel" aria-labelledby="nav-booking-tab">
                                    <form class="form-horizontal form-row-seperated" action="#" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h4 class="bold ">Booking</h4>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-3">
                                                <label>Cancellation conditions:<span class="required"> * </span></label>
                                                <select name="cancellation_conditions" class="form-control">
                                                    <option {{ isset($listing->booking->cancellation_conditions) && $listing->booking->cancellation_conditions == 'flexible' ? 'selected':'' }} value="flexible">Flexible</li>
                                                    <option {{ isset($listing->booking->cancellation_conditions) && $listing->booking->cancellation_conditions == 'moderate' ? 'selected':'' }} value="moderate">Moderate</li>
                                                    <option {{ isset($listing->booking->cancellation_conditions) && $listing->booking->cancellation_conditions == 'strict' ? 'selected':'' }} value="strict">Strict</li>
                                                </select>
                                                @error('cancellation_conditions')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Check in:<span class="required"> * </span></label>
                                                <input type="text" class="form-control timepicker" name="check_in" required value="{{ $listing->booking->check_in ?? '' }}">
                                                @error('check_in')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Check out:<span class="required"> * </span></label>
                                                <input type="text" class="form-control timepicker" name="check_out" required value="{{ $listing->booking->check_out ?? '' }}">
                                                @error('check_out')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Check in rental:<span class="required"> </span></label>
                                                <input type="text" class="form-control timepicker" name="check_in_rental" value="{{ $listing->booking->check_in_rental ?? '' }}">
                                                
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-3">
                                                <label>Check out rental:<span class="required"> </span></label>
                                                <input type="text" class="form-control timepicker " name="check_out_rental" value="{{ $listing->booking->check_out_rental ?? '' }}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Fuel cost:<span class="required"> * </span></label>
                                                <input type="text" class="form-control" name="fuel_cost" required value="{{ $listing->booking->fuel_cost ?? '' }}">
                                                @error('fuel_cost')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Is a boat licence required?:<span class="required"> * </span></label>
                                                <select name="boat_licence" class="form-control">
                                                    <option {{ isset($listing->booking->boat_licence) && $listing->booking->boat_licence == 'no' ? 'selected':'' }} value="no">No</option>
                                                    <option {{ isset($listing->booking->boat_licence) && $listing->booking->boat_licence == 'yes' ? 'selected':'' }} value="yes">Yes</option>
                                                </select>
                                                @error('boat_licence')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Extra night on board for free:<span class="required"> * </span></label>
                                                <select name="night_fees" class="form-control">
                                                    <option {{ isset($listing->booking->night_fees) && $listing->booking->night_fees == 'no' ? 'selected':'' }} value="no">No</option>
                                                    <option {{ isset($listing->booking->night_fees) && $listing->booking->night_fees == 'yes' ? 'selected':'' }} value="yes">Yes</option>
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
                                            <div class="actions btn-set text-right">
                                                <button type="button" onclick="window.location = '';"class="btn btn default">
                                                    <i class="fa fa-angle-left"></i> Back
                                                </button>	
                                                <input type="hidden" name="s" value="booking">
                                                <button type="submit"  class="btn btn-success mt-ladda-btn ladda-button btn-outline" data-style="contract" data-spinner-color="#333">
                                                    <i class="fa fa-check"></i> Save
                                                </button>
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
                                                                        <input type="text" class="form-control from_date" name="calendar[1][from_date]" required>
                                                                    </div>
                                                                    <div class="col-sm-4" id="">
                                                                        <label>To:<span class="required"> * </span></label>
                                                                        <input type="text" class="form-control from_to" name="calendar[1][from_to]" required>
                                                                    </div>
                                                                    <input type="hidden" value="1" class="form-control calendar_id" name="calendar[1][calendar_id]">
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
                                                                    $remove_btn = '<button type="button" class="btn btn-danger btn-sm remove_newf_row"> remove </button>';
                                                                endif;
                                                            @endphp
                                                            <div class="single_calender_container row" style="margin-top:10px;">
                                                                <div class="col-sm-10">
                                                                    <div class="row">
                                                                        <div class="col-sm-4" id="">
                                                                            <label>From:<span class="required"> * </span></label>
                                                                            <input type="text" value="{{ $calendar['from_date'] }}" class="form-control from_date" name="calendar[{{$countDate}}][from_date]">
                                                                        </div>
                                                                        <div class="col-sm-4" id="">
                                                                            <label>To:<span class="required"> * </span></label>
                                                                            <input type="text" value="{{ $calendar['from_to'] }}" class="form-control from_to" name="calendar[{{$countDate}}][from_to]">
                                                                        </div>
                                                                        <div class="col-sm-4" id="">
                                                                            <label>Reason:<span class="required"> * </span></label>
                                                                            <select class="form-control reason" name="calendar[{{$countDate}}][reason]">
                                                                                <option @if($calendar['reason'] == 'Unavailable') {{ 'selected' }} @endif value="Unavailable">Unavailable</option>
                                                                                <option @if($calendar['reason'] == 'Breakdown') {{ 'selected' }} @endif value="Breakdown">Breakdown / Damage</option>
                                                                                <option @if($calendar['reason'] == 'Wintering') {{ 'selected' }} @endif value="Wintering">Wintering / End of season</option>
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
                                                    <button type="button" class="btn btn-success btn-sm add_newf_row" > Add another date  </button>
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
                                                <button type="button" onclick="window.location = '';" class="btn btn default">
                                                    <i class="fa fa-angle-left"></i> Back
                                                </button>	
                                                <input type="hidden" name="s" value="calendar">
                                                <button type="submit" class="btn btn-success mt-ladda-btn ladda-button btn-outline" data-style="contract" data-spinner-color="#333">
                                                    <i class="fa fa-check"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>	
                                </div>
                                <div class="tab-pane fade equipment_sec" id="equipment" role="tabpanel" aria-labelledby="nav-equipment-tab">
                                    <form  method="POST">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h4 class="bold ">Equipment</h4>
                                            </div>
                                            <div class="col-sm-12">
                                                <p class="bold">Outdoor Equipment :</p>
                                            </div>
                                            @php
                                                $outdoor_equipment = [];
                                                if(isset($listing->equipment->outdoor_equipment) && !empty($listing->equipment->outdoor_equipment)):
                                                    $outdoor_equipment = json_decode($listing->equipment->outdoor_equipment);
                                                endif;
                                                $extra_comfrot = [];
                                                if(isset($listing->equipment->extra_comfrot) && !empty($listing->equipment->extra_comfrot)):
                                                    $extra_comfrot = json_decode($listing->equipment->extra_comfrot);
                                                endif;
                                                $navigation_equipment = [];
                                                if(isset($listing->equipment->navigation_equipment) && !empty($listing->equipment->navigation_equipment)):
                                                    $navigation_equipment = json_decode($listing->equipment->navigation_equipment);
                                                endif;
                                                $kitchen = [];
                                                if(isset($listing->equipment->kitchen) && !empty($listing->equipment->kitchen)):
                                                    $kitchen = json_decode($listing->equipment->kitchen);
                                                endif;
                                                $leisure_activities = [];
                                                if(isset($listing->equipment->leisure_activities) && !empty($listing->equipment->leisure_activities)):
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
                                            <div class="col-sm-12">
                                                <div class="mt-checkbox-inline outdoor_equipment">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox21" @if(in_array('bimini',$outdoor_equipment)) {{ 'checked' }} @endif value="bimini" name="outdoor_equipment[]"> Bimini
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox22" @if(in_array('outdoor_shower',$outdoor_equipment)) {{ 'checked' }} @endif value="outdoor_shower" name="outdoor_equipment[]"> Outdoor shower
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox23" @if(in_array('external_table',$outdoor_equipment)) {{ 'checked' }} @endif value="external_table" name="outdoor_equipment[]"> External table
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox24" @if(in_array('external_speaker',$outdoor_equipment)) {{ 'checked' }} @endif value="external_speaker" name="outdoor_equipment[]"> External speakers
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox25" @if(in_array('teak_deck',$outdoor_equipment)) {{ 'checked' }} @endif value="teak_deck" name="outdoor_equipment[]"> Teak deck
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox26" @if(in_array('bow_sundeck',$outdoor_equipment)) {{ 'checked' }} @endif value="bow_sundeck" name="outdoor_equipment[]"> Bow sundeck
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox27" @if(in_array('aft_sundeck',$outdoor_equipment)) {{ 'checked' }} @endif value="aft_sundeck" name="outdoor_equipment[]"> Aft sundeck
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <p class="bold">Extra Comfrot : </p>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mt-checkbox-inline extra_comfrot">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox28" @if(in_array('hot_water',$extra_comfrot)) {{ 'checked' }} @endif value="hot_water" name="extra_comfrot[]"> Hot Water
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox29" @if(in_array('watermarker',$extra_comfrot)) {{ 'checked' }} @endif value="watermarker" name="extra_comfrot[]"> Watermarker
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox30" @if(in_array('air_condition',$extra_comfrot)) {{ 'checked' }} @endif value="air_condition" name="extra_comfrot[]"> Air Conditioning
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox31" @if(in_array('fans',$extra_comfrot)) {{ 'checked' }} @endif value="fans" name="extra_comfrot[]"> Fans
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox32" @if(in_array('heating',$extra_comfrot)) {{ 'checked' }} @endif value="heating" name="extra_comfrot[]"> Heating
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox33" @if(in_array('electric_toilet',$extra_comfrot)) {{ 'checked' }} @endif value="electric_toilet" name="extra_comfrot[]"> Electric Toilet
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox34" @if(in_array('bed_lien',$extra_comfrot)) {{ 'checked' }} @endif value="bed_lien" name="extra_comfrot[]"> bed Lien
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox35" @if(in_array('bath_towel',$extra_comfrot)) {{ 'checked' }} @endif value="bath_towel" name="extra_comfrot[]"> Bath Towel
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox36" @if(in_array('beach_towels',$extra_comfrot)) {{ 'checked' }} @endif value="beach_towels" name="extra_comfrot[]"> Beach Towels
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox37" @if(in_array('wi_fi',$extra_comfrot)) {{ 'checked' }} @endif value="wi_fi" name="extra_comfrot[]"> Wi-Fi
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox38" @if(in_array('usb_socket',$extra_comfrot)) {{ 'checked' }} @endif value="usb_socket" name="extra_comfrot[]"> USB socket
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox39" @if(in_array('tv',$extra_comfrot)) {{ 'checked' }} @endif value="tv" name="extra_comfrot[]"> TV
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
    
                                            <div class="col-sm-12">
                                                <p class="bold" >Navigation equipment : </p>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mt-checkbox-inline navigation_equipment">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox40" value="dinghy" @if(in_array('dinghy',$navigation_equipment)) {{ 'checked' }} @endif name="navigation_equipment[]"> Dinghy
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox41" value="dinghy_motor" @if(in_array('dinghy_motor',$navigation_equipment)) {{ 'checked' }} @endif name="navigation_equipment[]"> Dinghy's motor
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox42" value="bow_thruster" @if(in_array('bow_thruster',$navigation_equipment)) {{ 'checked' }} @endif name="navigation_equipment[]"> Bow thruster
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox43" value="electric_windlass" @if(in_array('electric_windlass',$navigation_equipment)) {{ 'checked' }} @endif name="navigation_equipment[]"> Electric windlass
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox44" value="autopilot" @if(in_array('autopilot',$navigation_equipment)) {{ 'checked' }} @endif name="navigation_equipment[]"> Autopilot
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox45" value="gps" @if(in_array('gps',$navigation_equipment)) {{ 'checked' }} @endif name="navigation_equipment[]"> GPS
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox46" value="depth_sounder" @if(in_array('depth_sounder',$navigation_equipment)) {{ 'checked' }} @endif name="navigation_equipment[]"> Depth sounder
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox47" value="vhf" @if(in_array('vhf',$navigation_equipment)) {{ 'checked' }} @endif name="navigation_equipment[]"> VHF
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox48" value="satellite_phone" @if(in_array('satellite_phone',$navigation_equipment)) {{ 'checked' }} @endif name="navigation_equipment[]"> Satellite phone
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox49" value="guides_maps" @if(in_array('guides_maps',$navigation_equipment)) {{ 'checked' }} @endif name="navigation_equipment[]"> Guides & Maps
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
    
                                            <div class="col-sm-12">
                                                <p class="bold">Kitchen :</p>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mt-checkbox-inline kitchen">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox50" @if(in_array('fridge',$kitchen)) {{ 'checked' }} @endif value="fridge" name="kitchen[]"> Fridge
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox51" @if(in_array('freezer',$kitchen)) {{ 'checked' }} @endif value="freezer" name="kitchen[]"> Freezer
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox52" @if(in_array('oven_stovetop',$kitchen)) {{ 'checked' }} @endif value="oven_stovetop" name="kitchen[]"> Oven/Stovetop
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox53" @if(in_array('bbq_grill',$kitchen)) {{ 'checked' }} @endif value="bbq_grill" name="kitchen[]"> BBQ Grill
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox54" @if(in_array('microwave',$kitchen)) {{ 'checked' }} @endif value="microwave" name="kitchen[]"> Microwave
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox55" @if(in_array('coffee_machine',$kitchen)) {{ 'checked' }} @endif value="coffee_machine" name="kitchen[]"> Coffee Machine
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox56" @if(in_array('ice_machine',$kitchen)) {{ 'checked' }} @endif value="ice_machine" name="kitchen[]"> Ice Machine
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox57" @if(in_array('ice_box',$kitchen)) {{ 'checked' }} @endif value="ice_box" name="kitchen[]"> Ice Box
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
    
                                            <div class="col-sm-12">
                                                <p class="bold">Leisure Activities :</p>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mt-checkbox-inline leisure_activities">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox58" @if(in_array('paddle_board',$leisure_activities)) {{ 'checked' }} @endif value="paddle_board" name="leisure_activities[]"> Paddle board
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox59" @if(in_array('kayak',$leisure_activities)) {{ 'checked' }} @endif value="kayak" name="leisure_activities[]"> Kayak
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox60" @if(in_array('snorkelling_equipment',$leisure_activities)) {{ 'checked' }} @endif value="snorkelling_equipment" name="leisure_activities[]"> Snorkelling equipment
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox61" @if(in_array('fishing_equipment',$leisure_activities)) {{ 'checked' }} @endif value="fishing_equipment" name="leisure_activities[]"> Fishing equipment
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox62" @if(in_array('diving_equipment',$leisure_activities)) {{ 'checked' }} @endif value="diving_equipment" name="leisure_activities[]"> Diving equipment
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox63" @if(in_array('seabob',$leisure_activities)) {{ 'checked' }} @endif value="seabob" name="leisure_activities[]"> Seabob
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox64" @if(in_array('bike',$leisure_activities)) {{ 'checked' }} @endif value="bike" name="leisure_activities[]"> Bike
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox65" @if(in_array('electric_scooter',$leisure_activities)) {{ 'checked' }} @endif value="electric_scooter" name="leisure_activities[]"> Electric scooter
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox66" @if(in_array('drone',$leisure_activities)) {{ 'checked' }} @endif value="drone" name="leisure_activities[]"> Drone
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox67" @if(in_array('video_camera',$leisure_activities)) {{ 'checked' }} @endif value="video_camera" name="leisure_activities[]"> Video camera
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <p class="bold">Onboard Energy:</p>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mt-checkbox-inline onboard_energy">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox68" @if(in_array('generator',$onboard_energy)) {{ 'checked' }} @endif value="generator" name="onboard_energy[]"> Generator
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox69" @if(in_array('power_inverter',$onboard_energy)) {{ 'checked' }} @endif value="power_inverter" name="onboard_energy[]"> Power inverter
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox70" @if(in_array('220v_power_outlet',$onboard_energy)) {{ 'checked' }} @endif value="220v_power_outlet" name="onboard_energy[]"> 220V power outlet
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <p class="bold">Water Sports :</p>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mt-checkbox-inline water_sports">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox71" @if(in_array('water_skis',$water_sports)) {{ 'checked' }} @endif value="water_skis" name="water_sports[]"> Water skis
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox72" @if(in_array('monoski',$water_sports)) {{ 'checked' }} @endif value="monoski" name="water_sports[]"> Monoski
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox73" @if(in_array('wakeboard',$water_sports)) {{ 'checked' }} @endif value="wakeboard" name="water_sports[]"> Wakeboard
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox74" @if(in_array('towable_tube',$water_sports)) {{ 'checked' }} @endif value="towable_tube" name="water_sports[]"> Towable Tube
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox75" @if(in_array('inflatable_banana',$water_sports)) {{ 'checked' }} @endif value="inflatable_banana" name="water_sports[]"> Inflatable banana
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="inlineCheckbox76" @if(in_array('kneeboard',$water_sports)) {{ 'checked' }} @endif value="kneeboard" name="water_sports[]"> Kneeboard
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
                                            <div class="actions btn-set text-right">
                                                <button type="button" onclick="window.location = '';"class="btn btn default">
                                                    <i class="fa fa-angle-left"></i> Back
                                                </button>	
                                                <input type="hidden" name="s" value="equipment">
                                                <button type="submit"  class="btn btn-success mt-ladda-btn ladda-button btn-outline" data-style="contract" data-spinner-color="#333">
                                                    <i class="fa fa-check"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="nav-other-tab">
                                    <form class="form-horizontal form-row-seperated" action="{{ route('admin.general-settings', $listing->id) }}" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h4 class="bold ">Technical points</h4>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-3">
                                                <label>Engine type:<span class="required"> * </span></label>
                                                <select class="form-control" name="engine_type">
                                                    <option {{ isset($listing->otherListingSetting->engine_type) && $listing->otherListingSetting->engine_type == 'Inboard' ? 'selected':'' }} value="Inboard">Inboard</option>
                                                    <option {{ isset($listing->otherListingSetting->engine_type) && $listing->otherListingSetting->engine_type == 'Outboard' ? 'selected':'' }} value="Outboard">Outboard</option>
                                                </select>
                                                @error('engine_type')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Engine horsepower (HP):<span class="required"> * </span></label>
                                                <input type="text" class="form-control" name="horsepower" required value="{{ $listing->otherListingSetting->horsepower ?? '' }}">
                                                @error('horsepower')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Width (m):<span class="required">  </span></label>
                                                <input type="text" class="form-control" name="width" value="{{ $listing->otherListingSetting->width ?? '' }}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Draft (m):<span class="required">  </span></label>
                                                <input type="text" class="form-control" name="draft" value="{{ $listing->otherListingSetting->draft ?? '' }}">
                                                
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-4">
                                                <label>Equipped offshore:<span class="required">  </span></label>
                                                <select name="offshore" class="form-control">
                                                    <option {{ isset($listing->otherListingSetting->offshore) && $listing->otherListingSetting->offshore == 'no' ? 'selected':'' }} value="no">No</option>
                                                    <option {{ isset($listing->otherListingSetting->offshore) && $listing->otherListingSetting->offshore == 'yes' ? 'selected':'' }} value="yes">Yes</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Number of crew members:<span class="required">  </span></label>
                                                <input type="number" class="form-control" name="crew_members" value="{{ $listing->otherListingSetting->crew_members ?? '' }}">
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Horsepower of the tender:<span class="required">  </span></label>
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
                                            <div class="actions btn-set text-right">
                                                <button type="button" onclick="window.location = '';"class="btn btn default">
                                                    <i class="fa fa-angle-left"></i> Back
                                                </button>	
                                                <input type="hidden" name="s" value="other">
                                                <button type="submit"  class="btn btn-success mt-ladda-btn ladda-button btn-outline" data-style="contract" data-spinner-color="#333">
                                                    <i class="fa fa-check"></i> Save
                                                </button>
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
                                                <input type="number" name="first_booking_discount" value="{{ $listing->discount->first_booking_discount ?? ''}}" class="form-control" placeholder="%">
                                            </div>
                                            <!-- Early-bird Discount -->
                                            <div class="col-sm-12">
                                                <h4 class="bold ">Early-bird discount</h4>
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
                                                    <option {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='' ? 'selected' : "" }} value="">Select</option>
                                                    <option {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='1' ? 'selected' : "" }} value="1">1 month in advance</option>
                                                    <option {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='2' ? 'selected' : "" }} value="2">2 months in advance</option>
                                                    <option {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='3' ? 'selected' : "" }} value="3">3 months in advance</option>
                                                    <option {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='4' ? 'selected' : "" }} value="4">4 months in advance</option>
                                                    <option {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='5' ? 'selected' : "" }} value="5">5 months in advance</option>
                                                    <option {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='6' ? 'selected' : "" }} value="6">6 months in advance</option>
                                                    <option {{ isset($early_booking['early_booking_month']) && $early_booking['early_booking_month'] =='12' ? 'selected' : "" }} value="12">12 months in advance</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Minimum rental duration </label>
                                                <select name="early_booking[minimum_duration]" class="form-control">
                                                    <option {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='' ? 'selected' : "" }} value=" ">Select</option>
                                                    <option {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='2' ? 'selected' : "" }} value="2">2 days or more</option>
                                                    <option {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='3' ? 'selected' : "" }} value="3">3 days or more</option>
                                                    <option {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='4' ? 'selected' : "" }} value="4">4 days or more</option>
                                                    <option {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='5' ? 'selected' : "" }} value="5">5 days or more</option>
                                                    <option {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='6' ? 'selected' : "" }} value="6">6 days or more</option>
                                                    <option {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='7' ? 'selected' : "" }} value="7">7 days or more</option>
                                                    <option {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='14' ? 'selected' : "" }} value="14">14 days or more</option>
                                                    <option {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='21' ? 'selected' : "" }} value="21">21 days or more</option>
                                                    <option {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='30' ? 'selected' : "" }} value="30">30 days or more</option>
                                                    <option {{ isset($early_booking['minimum_duration']) && $early_booking['minimum_duration'] =='always' ? 'selected' : "" }} value="always">Always</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Discount (%) </label>
                                                <input type="number" name="early_booking[discount]" value="{{ $early_booking['discount'] ?? "" }}" class="form-control" placeholder="%">
                                            </div>
                                            <!-- Last-minute Booking -->
                                            <div class="col-sm-12">
                                                <h4 class="bold ">Last minute booking</h4>
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
                                                    <option {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='' ? 'selected' : "" }} value=" ">Select</option>
                                                    <option {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='1' ? 'selected' : "" }} value="1">1 days before booking</option>
                                                    <option {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='2' ? 'selected' : "" }} value="2">2 days before booking</option>
                                                    <option {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='3' ? 'selected' : "" }} value="3">3 days before booking</option>
                                                    <option {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='4' ? 'selected' : "" }} value="4">4 days before booking</option>
                                                    <option {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='5' ? 'selected' : "" }} value="5">5 days before booking</option>
                                                    <option {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='6' ? 'selected' : "" }} value="6">6 days before booking</option>
                                                    <option {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='7' ? 'selected' : "" }} value="7">7 days before booking</option>
                                                    <option {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='14' ? 'selected' : "" }} value="14">14 days before booking</option>
                                                    <option {{ isset($last_min_booking['days']) && $last_min_booking['days'] =='30' ? 'selected' : "" }} value="30">30 days before booking</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Minimum rental duration</label>
                                                <select name="last_min_booking[day_rental_duration]" class="form-control">
                                                    <option {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='' ? 'selected' : "" }} value=" ">Select</option>
                                                    <option {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='2' ? 'selected' : "" }} value="2">2 days or more</option>
                                                    <option {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='3' ? 'selected' : "" }} value="3">3 days or more</option>
                                                    <option {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='4' ? 'selected' : "" }} value="4">4 days or more</option>
                                                    <option {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='5' ? 'selected' : "" }} value="5">5 days or more</option>
                                                    <option {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='6' ? 'selected' : "" }} value="6">6 days or more</option>
                                                    <option {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='7' ? 'selected' : "" }} value="7">7 days or more</option>
                                                    <option {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='14' ? 'selected' : "" }} value="14">14 days or more</option>
                                                    <option {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='21' ? 'selected' : "" }} value="21">21 days or more</option>
                                                    <option {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='30' ? 'selected' : "" }} value="30">30 days or more</option>
                                                    <option {{ isset($last_min_booking['day_rental_duration']) && $last_min_booking['day_rental_duration'] =='always' ? 'selected' : "" }} value="always">Always</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Discount (%) </label>
                                                <input type="number" name="last_min_booking[discount]" value="{{ $last_min_booking['discount'] ?? '' }}" class="form-control" placeholder="%">
                                            </div>
                                            <!-- Length-of-stay discounts -->
                                            <div class="col-sm-12">
                                                <h4 class="bold ">Length of stay discounts</h4>
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
                                                    <option {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='' ? 'selected' : "" }} value=" ">Select</option>
                                                    <option {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='2' ? 'selected' : "" }} value="2">2 days or more</option>
                                                    <option {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='3' ? 'selected' : "" }} value="3">3 days or more</option>
                                                    <option {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='4' ? 'selected' : "" }} value="4">4 days or more</option>
                                                    <option {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='5' ? 'selected' : "" }} value="5">5 days or more</option>
                                                    <option {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='6' ? 'selected' : "" }} value="6">6 days or more</option>
                                                    <option {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='7' ? 'selected' : "" }} value="7">7 days or more</option>
                                                    <option {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='14' ? 'selected' : "" }} value="14">14 days or more</option>
                                                    <option {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='21' ? 'selected' : "" }} value="21">21 days or more</option>
                                                    <option {{ isset($length_stay_dis['days']) && $length_stay_dis['days'] =='30' ? 'selected' : "" }} value="30">30 days or more</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Discount (%) </label>
                                                <input type="number" name="length_stay_dis[discount]" class="form-control" value="{{ $length_stay_dis['discount'] ?? '' }}" placeholder="%">
                                            </div>
                                            <!-- Custom discounts -->
                                            <div class="col-sm-12">
                                                <h4 class="bold ">Custom discounts</h4>
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
                                            <div class="col-sm-4">
                                                <input type="text" name="custom_discount[from_date]" value="{{ $custom_discounts['from_date'] ?? '' }}" class="form-control datePicker" placeholder="From">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="custom_discount[to_date]" class="form-control datePicker" value="{{ $custom_discounts['to_date'] ?? '' }}" placeholder="To">
                                            </div>
                                            
                                            <div class="col-sm-12">
                                                <label>Rental dates </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="custom_discount[rental_from_date]" class="form-control datePicker" value="{{ $custom_discounts['rental_from_date'] ?? '' }}" placeholder="From">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="custom_discount[rental_to_date]" class="form-control datePicker" value="{{ $custom_discounts['rental_to_date'] ?? '' }}" placeholder="To">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="number" name="custom_discount[discount]" class="form-control" value="{{ $custom_discounts['discount'] ?? '' }}" placeholder="Discount (%) ">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="alert d-none">
                                                    <button class="close" data-close="alert"></button>
                                                    <span class="message"></span>
                                                </div>
                                            </div>
                                            <div class="actions btn-set text-right">
                                                <button type="button" onclick="window.location = '';"class="btn btn default">
                                                    <i class="fa fa-angle-left"></i> Back
                                                </button>	
                                                <input type="hidden" name="s" value="discount">
                                                <button type="submit"  class="btn btn-success mt-ladda-btn ladda-button btn-outline" data-style="contract" data-spinner-color="#333">
                                                    <i class="fa fa-check"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
            $(document).on('click','.add_newf_row', function(e) 
            {
                var remove_btn_html = '<button type="button" class="btn btn-danger btn-sm remove_newf_row" > remove </button>';
                var html = '<div class="single_calender_container row" style="">';
                html += $('.single_calender_container:first').html();
                html += '</div>'; 
                $('.fac_container').append(html);
                var total_container = $('.single_calender_container').length;
                $('.single_calender_container:last').find('.action_buttons').html(remove_btn_html);
                $('.single_calender_container:last').find('.from_date').attr('name','calendar['+total_container+'][from_date]');
                $('.single_calender_container:last').find('.from_to').attr('name','calendar['+total_container+'][from_to]');
                $('.single_calender_container:last').find('.reason').attr('name','calendar['+total_container+'][reason]');
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
            $(document).on('click','.remove_newf_row',function(e)
		    {
			    $(this).parents('.single_calender_container').remove();
			});
            $(document).on('submit','form',function(e){
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('boatowner.listing-settings',$listing->id) }}",  // URL for the image upload endpoint
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if(response.success) {
                            $('.alert').removeClass('alert-danger');
							$('.alert').removeClass('d-none');
                            $('.alert').addClass('alert-success');
                            $('.message').html(response.message);
                            setTimeout(function() {
                                $('.alert').addClass('d-none');  
                            }, 5000);
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
                            errorMessage += errors[field] + '<br>';  // Show validation errors
                        }
                        $('.alert').removeClass('d-none');
                        $('.alert').addClass('alert-danger');
                        $('.message').html(errorMessage);

                    }
                });
            })
        });
		// Disable autoDiscover to manually initialize Dropzone
		Dropzone.autoDiscover = false;
	    const imageDropzone = new Dropzone("#imageDropzone", {
			url: "{{ route('boatowner.uploadgallery',$listing->id) }}",  // URL to handle file upload
			paramName: 'file',  // The name that will be used to send the file
			maxFilesize: 2,  // Max file size in MB
			acceptedFiles: 'image/*',  // Only allow image files
			dictDefaultMessage: 'Drag & Drop or Click to Upload Image',
			headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'  // CSRF token for security
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
					removeImage(response.data.id, imageContainer,file);
				};
	
				imageContainer.appendChild(removeButton);
				document.getElementById('uploaded-images').appendChild(imageContainer);
			},
			error: function(file, response) {
                const errorMessage = response || 'An error occurred during upload';
                // Display error message in the preview box (customize this part as needed)
                const errorElement = document.createElement('div');
                errorElement.classList.add('dz-error-message');
                errorElement.innerHTML = `<span>${errorMessage}</span>`;
        
                // Find the preview element and append the error message
                const previewElement = file.previewElement;
                previewElement.classList.add('dz-error');  // Add error styling to preview
                previewElement.appendChild(errorElement);  // Append the error message to preview
                console.log('Error uploading file', response);
        
                // Remove the file preview after a short delay (optional)
                setTimeout(() => {
                    imageDropzone.removeFile(file);
                }, 10000);  // Adjust the delay time as needed
            }
		});
		// Function to remove the image from both front-end and back-end
		function removeImage(imageId, imageContainer,dropzoneFile) {
			// Send AJAX request to remove the image from the database
			fetch("{{ route('boatowner.removegallery') }}", {
				method: 'DELETE',
				headers: {
					'X-CSRF-TOKEN': '{{ csrf_token() }}',
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({ id: imageId })
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					// Remove the image from the front-end
					imageContainer.remove();
					if (dropzoneFile) {
						imageDropzone.removeFile(dropzoneFile);
					}
					
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
                    url: "{{ route('boatowner.uploadcoverimage',$listing->id) }}",  // URL for the image upload endpoint
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
							var html = '<label>Cover Image:<span class="required"> * </span></label><img src="'+response.imageUrl+'" class="img-responsive pic-bordered" >';
                            $('#uploade-cover-image').html(html)
                            $('#statusMessage').text("Image uploaded successfully!").css('color', 'green');
                        } else {
                            $('#statusMessage').text("Image upload failed!").css('color', 'red');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#statusMessage').text('An error occurred while uploading the image.').css('color', 'red');
                    }
                });
            });
        });
		function removeImageGallery(imageId, buttonElement) 
		{
			swal({
				title: "Are you sure?",
				text: "You will not be able to recover this!",
				type: "warning",  // 'type' is valid in SweetAlert1
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Yes, I am sure!',
				cancelButtonText: 'No, cancel it!',
				closeOnConfirm: false,  // This prevents the alert from closing immediately
				closeOnCancel: true     // This allows closing on cancel
			}, 
			function(isConfirm) 
			{
				if (isConfirm) {
					// Send AJAX request to remove the image from the backend
					fetch("{{ route('boatowner.removegallery') }}", {
						method: 'DELETE',
						headers: {
							'X-CSRF-TOKEN': '{{ csrf_token() }}',
							'Content-Type': 'application/json',
						},
						body: JSON.stringify({ id: imageId })
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