@extends('layouts.customer.common')
@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.1.0/css/datepicker.min.css" rel="stylesheet"
    type="text/css" />

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.1.0/js/datepicker.min.js" type="text/javascript">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.1.0/js/i18n/datepicker.en.min.js"
    type="text/javascript"></script>

@endsection
@section('content')
<div class="col-lg-9 main-dashboard">
    <div class="page-title">
        <h1>Complete your profile</h1>
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
    <ul class="nav nav-tabs cus_profile" id="details-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" href="#profile">Verifications </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="#personal-detail" >Information</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="#password">Password</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="#delete">Setting</a>
        </li>
    </ul>
    <div class="">
        <div class="tab-pane" id="personal-detail" >
            <div class="card-section">
                <div class="card-sec-title">
                    <h2>Personal Information</h2>
                </div>
                <div class="card-section-two">
                    <div class="card-content">
                        <div class="line-entry change-avatar">
                            <div id="statusMessage"></div>
                            <div class="user-avatar">
                                <img src="{{ $userData->getFirstMediaUrl('profile_image') ?? 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png' }}"
                                    id="avatar" alt="dejodo">
                            </div>
                            <div class="upload">
                                <h6>Change your photo</h6>
                                <p>Minimum size: 260px x 260px</p>
                                <input type="file" name="file" class="inputfile" id="file-input">
                                <label for="file-input" id="fileSelectButton" class="select_img_btn">Select an
                                    image</label>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <form class="personal-details-form" action="{{ route('customer.profile.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="pt-3 row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">First Name<span class="required"> *</span></label>
                                    <input type="text" name="first_name" value="{{ $userData->profile->first_name ?? '' }}" class="form-control">
                                    @error('first_name')<span class="required">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">Last Name<span class="required"> *</span></label>
                                    <input type="text" name="last_name" value="{{ $userData->profile->last_name ?? '' }}" class="form-control">
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
                                    <input type="text" name="dob" value="{{ $userData->profile->dob ?? '' }}" class="form-control date-picker" autocomplete="off">
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
                                    <label class="label-default">Telephone<span class="required"> *</span></label>
                                    <input type="tel" name="phone" value="{{ $userData->profile->phone ?? '' }}" class="form-control">
                                    @error('phone')<span class="required">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">Address<span class="required"> *</span></label>
                                    <input type="text" name="address" value="{{ $userData->profile->address ?? '' }}" class="form-control">
                                    @error('address')<span class="required">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">City<span class="required"> *</span></label>
                                    <input type="text" name="city" value="{{ $userData->profile->city ?? '' }}" class="form-control">
                                    @error('city')<span class="required">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-default">State<span class="required"> *</span></label>
                                    <input type="text" name="state" value="{{ $userData->profile->state ?? '' }}" class="form-control">
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
                                    <input type="text" name="postcode" value="{{ $userData->profile->postcode ?? '' }}" class="form-control">
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
        </div>
        {{-- <div class="tab-pane" id="experience">
            <div class="card-section">
                <div class="card-sec-title">
                    <h2>Your nautical level</h2>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Example select</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Example select</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3 row nautical_row">
                        <div class="col-md-4">
                            <h3>Your boat licence</h3>
                            <div class="input-group">
                                <input type="checkbox" id="coastal" name="coastal" value="coastal">
                                <label for="coastal"> Coastal license</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="offshore" name="offshore" value="offshore">
                                <label for="offshore"> Offshore license</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="inland" name="inland" value="inland">
                                <label for="inland"> Inland license</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3>Other</h3>
                            <div class="input-group">
                                <input type="checkbox" id="radio" name="radio" value="radio">
                                <label for="radio"> Radio operator's certificate</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="professional" name="professional" value="professional">
                                <label for="professional"> Professional skipper licence</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3>Sailing experience</h3>
                            <div class="input-group">
                                <input type="checkbox" id="chartered" name="chartered" value="chartered">
                                <label for="chartered"> I've chartered a boat before</label>
                            </div>
                            <div class="input-group">
                                <input type="checkbox" id="owner" name="owner" value="owner">
                                <label for="owner"> I'm an owner</label>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3 row">
                        <div class="col-md-6">
                            <div class="natutical_message_box">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"
                                        placeholder="Provide full details about yourself and your experience."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                </div>
            </div>
        </div> --}}
        <div class="tab-pane" id="password">
            <div class="card-section">
                <div class="card-sec-title">
                    <h2>Change your password</h2>
                </div>
                <div class="card-content">
                    <form class="password-form" action="{{ route('customer.password.update') }}" method="Post">
                        @csrf
                        @method('PUT')
                        <div class="row password_section">
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
        <div class="tab-pane" id="delete">
            <div class="card-section">
                <div class="card-sec-title">
                    <h2>Setting</h2>
                </div>
                <div class="card-content">
                    <form class="deactivate-form" action="" method="">
                        <div class="card-sec-title">
                            <p>Delete My Account</p>
                        </div>
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
            maxDate: new Date(),
        });
    });
    $(document).ready(function() {
        $('#file-input').on('change', function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('image', $('#file-input')[0].files[0]);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                url: '{{ route("customer.profile.image")}}', // URL for the image upload endpoint
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        $('.change-avatar #avatar').attr('src', response.imageUrl).show();
                        $('.user-avatar img').attr('src', response.imageUrl).show();
                        $('#statusMessage').text("Image uploaded successfully!").css(
                            'color', 'green');
                    } else {
                        $('#statusMessage').text("Image upload failed!").css('color',
                            'red');
                    }
                },
                error: function(xhr, status, error) {
                    $('#statusMessage').text('An error occurred while uploading the image.')
                        .css('color', 'red');
                }
            });
        });
    });
    </script>
    @endsection