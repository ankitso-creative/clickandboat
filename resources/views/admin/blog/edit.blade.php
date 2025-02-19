@extends('layouts.admin.admin')

@section('meta')
    <title>Manage Users</title>
@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.1.0/css/datepicker.min.css" rel="stylesheet" type="text/css" />

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.1.0/js/datepicker.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.1.0/js/i18n/datepicker.en.min.js" type="text/javascript"></script>

@endsection
@section('content')
    <!-- BEGIN CONTENT --> 
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <h1 class="page-title"> Manage Users: Edit</h1>
            <div class="clear"></div>
            <div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" action="{{ route('admin.users.update',$userData->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
                        <div class="portlet">
							<div class="form-body">
                                <div class="form-group">
                                    <div class="col-md-3">
										<label>Role:<span class="required"> * </span></label>
										<select name="role" class="form-control">
                                            <option @if($userData->role=='boatowner') selected @endif value="boatowner">Boat Owner</option>
                                            <option @if($userData->role=='customer') selected @endif value="customer">Customer</option>
                                        </select>
									</div>
                                    <div class="col-sm-3">
										<label>First Name:<span class="required"> * </span></label>
										<input type="text" name="first_name" value="@if(isset($userData->profile->first_name)) {{ $userData->profile->first_name }} @endif" class="form-control"/> 
                                        @error('first_name')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="col-sm-3">
										<label>Last Name:<span class="required"> * </span></label>
										<input type="text" name="last_name" value="@if(isset($userData->profile->last_name)) {{ $userData->profile->last_name }} @endif" class="form-control"/> 
                                        @error('last_name')<span class="required">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-md-3">
										<label>Email:<span class="required"> * </span></label>
										<input type="email" value="{{ $userData->email }}" class="form-control" name="email">
                                        @error('email')<span class="required">{{ $message }}</span>@enderror
									</div>
                                    <div class="clearfix"></div>
									<div class="col-md-4">
										<label>Password:</label>
										<input type="password" class="form-control" name="password">
									</div>
									<div class="col-md-4">
										<label>Gender:<span class="required"> * </span></label>
										<select name="gender" class="form-control">
                                            <option @if(isset($userData->profile->gender) && $userData->profile->gender == 'Male') selected @endif value="male">Male</option>
                                            <option @if(isset($userData->profile->gender) && $userData->profile->gender == 'Female') selected @endif value="Female">Female</option>
                                            <option @if(isset($userData->profile->gender) && $userData->profile->gender == 'Others') selected @endif value="Others">Others</option>
                                        </select>
                                        @error('gender')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="col-md-4">
										<label>Date of birth:<span class="required"> * </span></label>
										<input type="text" value="@if(isset($userData->profile->dob)) {{ $userData->profile->dob }} @endif" class="form-control date-picker" name="dob" autocomplete="off">
                                        @error('dob')<span class="required">{{ $message }}</span>@enderror
									</div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-4">
										<label>Phone:<span class="required"> * </span></label>
										<input type="text" value="@if(isset($userData->profile->phone)) {{ $userData->profile->phone }} @endif" class="form-control" name="phone">
                                        @error('phone')<span class="required">{{ $message }}</span>@enderror
									</div>
                                    <div class="col-md-4">
										<label>Address:<span class="required"> * </span></label>
										<input type="text" value="@if(isset($userData->profile->address)) {{ $userData->profile->address }} @endif" class="form-control" name="address">
                                        @error('address')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="col-md-4">
										<label>Address Line Two</label>
										<input type="text" value="@if(isset($userData->profile->address_line_two)) {{ $userData->profile->address_line_two }} @endif" class="form-control" name="address_two">
										@error('address_two')<span class="required">{{ $message }}</span>@enderror
									</div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-3">
										<label>City:<span class="required"> * </span></label>
										<input type="text" value="@if(isset($userData->profile->city)) {{ $userData->profile->city }} @endif" class="city form-control" name="city">
                                        @error('city')<span class="required">{{ $message }}</span>@enderror
									</div>
                                    <div class="col-md-3">
										<label>State:<span class="required"> * </span></label>
										<input type="text" value="@if(isset($userData->profile->state)) {{ $userData->profile->state }} @endif" class="city form-control" name="state">
                                        @error('state')<span class="required">{{ $message }}</span>@enderror
									</div>
                                    <div class="col-md-3">
										<label>Country:<span class="required"> * </span></label>
                                        <select name="country" class="form-control">
										    {!! $options !!}
                                        </select>
                                        @error('country')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="col-md-3">
										<label>Post Code:<span class="required"> * </span></label>
										<input type="text" value="@if(isset($userData->profile->postcode)) {{ $userData->profile->postcode }} @endif" class="form-control" name="post_code">
                                        @error('post_code')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="clearfix"></div>
								</div>
								
								<div class="actions btn-set text-right">
									<button type="button" onclick="window.location = '';"class="btn btn default">
										<i class="fa fa-angle-left"></i> Back
									</button>	
									<input type="hidden" name="s" value="ok">
									<button type="submit"  class="btn btn-success mt-ladda-btn ladda-button btn-outline" data-style="contract" data-spinner-color="#333">
										<i class="fa fa-check"></i> Update
									</button>
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
    </script>
@endsection