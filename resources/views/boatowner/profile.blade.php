@extends('layouts.boatowner.common')
@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.1.0/css/datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.1.0/js/datepicker.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.1.0/js/i18n/datepicker.en.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAli6rCJivgzTbWznnkqFtT_btPww6WBYs&libraries=places"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        $('.mySelect2').select2({
            selectOnClose: true
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
            });
        }
        
        const input = document.querySelector("#phone");
        const iti = window.intlTelInput(input, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            initialCountry: "auto",
            nationalMode: false, // Ensures full international number is shown
        });

        
        @if(old('phone', optional($userData->profile)->phone))
            iti.setNumber("{{ old('phone', optional($userData->profile)->phone) }}");
        @endif

    </script>
@endsection
@section('content')
<div class="col-lg-9 main-dashboard">
    <div class="page-title">
        <h1>Your Profile</h1>
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
    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul> 
        </div>
    @endif
    <ul class="nav nav-tabs pro_tabs" id="details-tabs">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" href="#profile">Verifications </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="#personal-detail" >Information</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="#experience">Boating experience level </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="#password">Password</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="#delete">Setting</a>
        </li>
    </ul>
    <div class="">
        <div class="tab-pane" id="profile">
            <div class="verification_box_section">
                <h2>Verification of your profile</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="verification_box">
                            <i class="fa-solid fa-circle-check"></i>
                            <h3>Your email<br> address</h3>
                            <p>Item checked</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($exists)
                            <div class="verification_box">
                                <i class="fa-solid fa-circle-check"></i>
                                <h3>Your<br> Sailing CV</h3>
                                <p>Item checked</p>
                            </div>
                        @else
                            <a href="#experience">
                                <div class="verification_box">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    <h3>Your<br> Sailing CV</h3>
                                    <p class="item-checked">Item checked</p>
                                </div>
                                <div class="complete_cv">
                                    <p>Complete my nautical CV</p>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="" id="personal-detail">
            <div class="card-section">
                <div class="card-sec-title">
                    <h2>Personal Information</h2>
                </div>
                <div class="card-section">
                <div class="card-content">
                    <div class="line-entry change-avatar">
                        @php 
                            $image = $userData->getFirstMediaUrl('profile_image');
                            if(!$image):
                                $image = 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
                            endif;
                            
                        @endphp
                        <div id="statusMessage"></div>
                        <div class="user-avatar">
                            <img src="{{ $image }}" id="avatar" alt="dejodo">
                        </div>
                        <div class="upload">
                            <h6>Change your photo</h6>
                            <p>Minimum size: 260px x 260px</p>
                            <input type="file" name="file" class="inputfile" id="file-input" accept="image/*">
                            <label for="file-input" id="fileSelectButton" class="select_img_btn">Select an image</label>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
                <div class="card-content">
                    <form class="personal-details-form" action="{{ route('boatowner.profile.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="pt-3 row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">First Name<span class="required"> *</span></label>
                                    <input type="text" name="first_name" value="{{ optional($userData->profile)->first_name ?? '' }}" class="form-control">
                                    @error('first_name')<span class="required">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">Last Name<span class="required"> *</span></label>
                                    <input type="text" name="last_name" value="{{ optional($userData->profile)->last_name ?? '' }}" class="form-control">
                                    @error('last_name')<span class="required">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">Email<span class="required"> *</span></label>
                                    <input type="email" name="email" readonly value="{{ $userData->email ?? '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">Gender<span class="required"> *</span></label>
                                    <select name="gender" class="form-control">
                                        <option @if(isset($userData->profile->gender) && $userData->profile->gender == 'Male') selected @endif value="male">Male</option>
                                        <option @if(isset($userData->profile->gender) && $userData->profile->gender == 'Female') selected @endif value="Female">Female</option>
                                        <option @if(isset($userData->profile->gender) && $userData->profile->gender == 'Others') selected @endif value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">Date of birth</label>
                                    <input type="text" name="dob" value="{{ optional($userData->profile)->dob ?? '' }}" class="form-control date-picker" autocomplete="off">
                                </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">Language spoken<span class="required"></span></label>
                                    <select name="language" class="form-control">
                                        {!! selectOption('languages','name','code','',array('status' , '1')) !!}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">Phone<span class="required"> *</span></label>
                                    <input id="phone" type="tel" name="phone" value="{{ optional($userData->profile)->phone ?? '' }}" class="form-control">
                                    @error('phone')<span class="required">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">Address<span class="required"> *</span></label>
                                    <input type="text" name="address" value="{{ optional($userData->profile)->address ?? '' }}" class="form-control">
                                    @error('address')<span class="required">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">City<span class="required"> *</span></label>
                                    <input type="text" name="city" id="location" value="{{ optional($userData->profile)->city ?? '' }}" class="form-control">
                                    @error('city')<span class="required">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">State<span class="required"> *</span></label>
                                    <input type="text" name="state" value="{{ optional($userData->profile)->state ?? '' }}" class="form-control">
                                    @error('state')<span class="required">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">Country<span class="required"> *</span></label>
                                    <select name="country" class="form-control">
                                        {!! $options !!}
                                    </select>
                                    @error('country')<span class="required">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">Postal Code<span class="required"> *</span></label>
                                    <input type="text" name="postcode" value="{{ optional($userData->profile)->postcode ?? '' }}" class="form-control">
                                    @error('postcode')<span class="required">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center form-group">
                                    <button class="save_btn">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-section">
                <div class="card-sec-title">
                    <h2>Company</h2>
                </div>
                <form class="personal-details-form" action="{{ route('boatowner.company.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-default">Company<span class="required"> </span></label>
                                <input type="text" name="company_name" value="{{ optional($userData->company)->company_name }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-default">Address<span class="required"> </span></label>
                                <input type="text" name="companyaddress" value="{{ optional($userData->company)->address }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-default">SIRET<span class="required"> </span></label>
                                <input type="text" name="siret" value="{{ optional($userData->company)->siret }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-default">Intracommunity VAT<span class="required"> </span></label>
                                <input type="text" name="intracommunity_vat" value="{{ optional($userData->company)->intracommunity_vat }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-default">Website<span class="required"> </span></label>
                                    <input type="text" name="website" value="{{ optional($userData->company)->website }}" class="form-control">
                            </div>
                        </div>
                        @php
                            $bookingManagement = json_decode(optional($userData->company)->booking_management_system);
                        @endphp
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-default">Booking Management System<span class="required"> </span></label>
                                <select multiple name="booking_management_system[]" class="form-control mySelect2">
                                    <option {{ checkSelectMulti($bookingManagement,'mmk') }} value="mmk">Mmk</option>
                                    <option {{ checkSelectMulti($bookingManagement,'sedna') }} value="sedna">Sedna</option>
                                    <option {{ checkSelectMulti($bookingManagement,'nausys') }} value="nausys">Nausys</option>
                                    <option {{ checkSelectMulti($bookingManagement,'yachtsys') }} value="yachtsys">Yachtsys</option>
                                    <option {{ checkSelectMulti($bookingManagement,'misterbooking') }} value="misterbooking">Mister Booking</option>
                                    <option {{ checkSelectMulti($bookingManagement,'andronautic') }} value="andronautic">Andronautic</option>
                                    <option {{ checkSelectMulti($bookingManagement,'digitalnautic') }} value="digitalnautic">Digital Nautic</option>
                                    <option {{ checkSelectMulti($bookingManagement,'nauticmanager') }} value="nauticmanager">Nautic Manager</option>
                                    <option {{ checkSelectMulti($bookingManagement,'myba') }} value="myba">MYBA</option>
                                    <option {{ checkSelectMulti($bookingManagement,'nautal') }} value="nautal">Nautal</option>
                                    <option {{ checkSelectMulti($bookingManagement,'fareharbor') }} value="fareharbor">Fare Harbor</option>
                                    <option {{ checkSelectMulti($bookingManagement,'anker') }} value="anker">5 Anker</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-sec-title">
                        <h2>Company's files</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-default">Certificate of incorporation</label>
                                <input type="file" id="myfiles" name="certificate" class="form-control" accept=".jpeg,.jpg,.pdf,.png">
                            </div>
                            @php 
                                $certificate = $userData->getFirstMediaUrl('certificate');
                                $extension = pathinfo($certificate, PATHINFO_EXTENSION);
                            @endphp
                            @if($certificate)
                                @if($extension=='pdf')
                                    <div class="user-Certificate">
                                        <a href="{{ $certificate }}" target="_blank"><img src="{{ asset('app-assets/site_assets/img/pdf-img.png') }}" id="avatar" alt="identity"></a>
                                    </div>
                                @else
                                    <div class="user-Certificate">
                                        <img src="{{ $certificate }}" id="avatar" alt="identity">
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-default">Identity Document (passport, ID card, driving licence)</label>
                                <input type="file" id="myfiles" name="identity" class="form-control" accept=".jpeg,.jpg,.pdf,.png">
                            </div>
                            @php 
                                $identity = $userData->getFirstMediaUrl('identity');
                                $extensionID = pathinfo($identity, PATHINFO_EXTENSION);
                            @endphp
                            @if($identity)
                                @if($extensionID == 'pdf')
                                    <div class="user-identity">
                                        <a href="{{ $identity }}" target="_blank"><img src="{{ asset('app-assets/site_assets/img/pdf-img.png') }}" id="avatar" alt="identity"></a>
                                    </div>
                                @else
                                    <div class="user-identity">
                                        <img src="{{ $identity }}" id="avatar" alt="identity">
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-default">IBAN</label>
                                <input type="file" id="myfiles" name="iban" class="form-control" accept=".jpeg,.jpg,.pdf,.png">
                            </div>
                            @php 
                                $iban = $userData->getFirstMediaUrl('iban');
                                $extensionIB = pathinfo($iban, PATHINFO_EXTENSION);
                            @endphp
                            @if($iban)
                                @if($extensionIB == 'pdf')
                                    <div class="user-iban">
                                        <a href="{{ $iban }}" target="_blank"><img src="{{ asset('app-assets/site_assets/img/pdf-img.png') }}" id="avatar" alt="identity"></a>
                                    </div>
                                @else
                                    <div class="user-iban">
                                        <img src="{{ $iban }}" id="avatar" alt="identity">
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center form-group">
                                <button class="save_btn">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane" id="experience">
            <div class="card-section">
                <div class="card-sec-title">
                    <h2>Your nautical level</h2>
                </div>
                <div class="card-content">
                    <form class="experience-form" action="{{ route('boatowner.experience.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Example select</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="level">
                                        <option {{ checkselect(optional($userData->exprience)->level,'Never sailed') }} value="Never sailed">Never sailed</option>
                                        <option {{ checkselect(optional($userData->exprience)->level,'Beginner') }} value="Beginner">Beginner</option>
                                        <option {{ checkselect(optional($userData->exprience)->level,'Intermediate') }} value="Intermediate">Intermediate</option>
                                        <option {{ checkselect(optional($userData->exprience)->level,'Very Good') }} value="Very Good">Very Good</option>
                                        <option {{ checkselect(optional($userData->exprience)->level,'Pro') }} value="Pro">Pro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Example select</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="prefer">
                                        <option {{ checkselect(optional($userData->exprience)->prefer,'Sailboat') }} value="Sailboat">Sailboat</option>
                                        <option {{ checkselect(optional($userData->exprience)->prefer,'Motorboat') }} value="Motorboat">Motorboat</option>
                                        <option {{ checkselect(optional($userData->exprience)->prefer,'Both') }} value="Both">Both</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="pt-3 row nautical_row">
                            <div class="col-md-4">
                                <h3>Your boat licence</h3>
                                @php
                                    $boat_licence = json_decode(optional($userData->exprience)->boat_licence);
                                    $other = json_decode(optional($userData->exprience)->other);
                                    $sailing_experience = json_decode(optional($userData->exprience)->sailing_experience);
                                @endphp
                                <div class="input-group">
                                    <input type="checkbox" id="coastal" name="boat_licence[]" value="coastal" {{ checkCheckbox($boat_licence,'coastal') }}>
                                    <label for="coastal"> Coastal license</label>
                                </div>
                                <div class="input-group">
                                    <input type="checkbox" id="offshore" name="boat_licence[]" value="offshore" {{ checkCheckbox($boat_licence,'offshore') }}>
                                    <label for="offshore"> Offshore license</label>
                                </div>
                                <div class="input-group">
                                    <input type="checkbox" id="inland" name="boat_licence[]" value="inland" {{ checkCheckbox($boat_licence,'inland') }}>
                                    <label for="inland"> Inland license</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h3>Other</h3>
                                <div class="input-group">
                                    <input type="checkbox" id="radio" name="other[]" value="radio-operator" {{ checkCheckbox($other,'radio-operator') }}> 
                                    <label for="radio"> Radio operator's certificate</label>
                                </div>
                                <div class="input-group">
                                    <input type="checkbox" id="professional" name="other[]" value="professional" {{ checkCheckbox($other,'professional') }}>
                                    <label for="professional"> Professional skipper licence</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h3>Sailing experience</h3>
                                <div class="input-group">
                                    <input type="checkbox" id="chartered" name="sailing_experience[]" value="chartered" {{ checkCheckbox($sailing_experience,'chartered') }}>
                                    <label for="chartered"> I've chartered a boat before</label>
                                </div>
                                <div class="input-group">
                                    <input type="checkbox" id="owner" name="sailing_experience[]" value="owner" {{ checkCheckbox($sailing_experience,'owner') }}>
                                    <label for="owner"> I'm an owner</label>
                                </div>
                            </div>
                        </div>
                        <div class="pt-3 row">
                            <div class="col-md-12 col-lg-6">
                                <div class="natutical_message_box">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Provide full details about yourself and your experience." name="description">{{ optional($userData->exprience)->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="natutical_text_box">
                                    <h5>Briefly describe yourself</h5>
                                    <p>Your age, your hobbies, your job, your region</p>
                                    <h5>Are you more of a motorboat or a sailboat type of person?</h5>
                                    <p>Explain what you like about sailing (fishing, water skiing, regattas, etc.)</p>
                                    <h5>How long have you been sailing for?</h5>
                                    <p>Briefly explain your sailing background and your various experiences as a renter or
                                        owner, crew member or skipper</p>
                                    <h5>Others</h5>
                                    <p>Your fears, your projects (regattas, crossings, travels, buying, maintenance, etc.)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center form-group">
                                    <button class="save_btn">Save</button>
                             </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="password">
            <div class="card-section">
                <div class="card-sec-title">
                    <h2>Change your password</h2>
                </div>
                <div class="card-content">
                    <form class="password-form" action="{{ route('boatowner.password.update') }}" method="Post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="label-default">Old password</label>
                                    <input type="password" name="old_password" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="label-default">New password</label>
                                    <input type="password" name="password" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="label-default">Re-enter the password</label>
                                    <input type="password" name="password_confirmation" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center form-group">
                                    <button class="save_btn">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="mb-5 tab-pane" id="delete">
            <div class="card-section">
                <div class="card-sec-title">
                    <h2>Setting</h2>
                </div>
                <div class="setting_section">
                    <div class="input-group">
                        <input type="checkbox" id="water-based" name="waterbased" value="waterbased">
                        <label for="water-based">Receive a text when you have a new message</label><br>
                    </div>
                </div>
                <div class="text-center form-group">
                    <button class="save_btn">Save</button>
                </div>
                <div class="card-content">
                    <form class="deactivate-form" action="{{ route('boatowner.account.delete') }}" method="Post">
                        @csrf
                        @method('PUT')
                        <div class="card-sec-title">
                            <p>Delete My Account</p>
                        </div>
                        <input type="hidden" name="delete" value="1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="delete_acc_btn">Delete</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
         $(document).ready(function() {
            $('.date-picker').datepicker({
                language: 'en',
                format: 'dd-mm-yyyy',   
                autoclose: true,        
                todayHighlight: true,  
                 maxDate : new Date(),
            });
            
        });
        $(document).ready(function() {
            $('#file-input').on('change', function(e) {
                e.preventDefault();  
                var formData = new FormData();  
                formData.append('image', $('#file-input')[0].files[0]);  
                formData.append('_token', $('meta[name="csrf-token"]').attr('content')); 
                 $.ajax({
                    url: '{{ route("boatowner.profile.image")}}',  // URL for the image upload endpoint
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            $('.change-avatar #avatar').attr('src', response.imageUrl).show();
                            $('.user-avatar img').attr('src', response.imageUrl).show();
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
    </script>
@endsection