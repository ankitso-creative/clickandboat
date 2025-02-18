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
            <h1 class="page-title"> Manage Users: Add</h1>
            <div class="clear"></div>
            <div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
                        <div class="portlet">
							<div class="form-body">
                                <div class="form-group">
                                    <div class="col-md-3">
										<label>Role:<span class="required"> * </span></label>
										<select name="role" class="form-control">
                                            <option value="boatowner">Boat Owner</option>
                                            <option value="customer">Customer</option>
                                        </select>
                                        @error('first_name')<span class="required">{{ $message }}</span>@enderror
									</div>
                                    <div class="col-sm-3">
										<label>First Name:<span class="required"> * </span></label>
										<input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control"/> 
                                        @error('first_name')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="col-sm-3">
										<label>Last Name:<span class="required"> * </span></label>
										<input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control"/> 
                                        @error('last_name')<span class="required">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-md-3">
										<label>Email:<span class="required"> * </span></label>
										<input type="email" value="{{ old('email') }}" class="form-control" name="email">
                                        @error('email')<span class="required">{{ $message }}</span>@enderror
									</div>
                                    <div class="clearfix"></div>
									<div class="col-md-4">
										<label>Password:<span class="required"> * </span></label>
										<input type="password" class="form-control" name="password">
                                        @error('password')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="col-md-4">
										<label>Gender:<span class="required"> * </span></label>
										<select name="gender" class="form-control">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
											<option value="Others">Others</option>
                                        </select>
                                        @error('gender')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="col-md-4">
										<label>Date of birth:<span class="required"> * </span></label>
										<input type="text" value="{{ old('dob') }}" class="form-control date-picker" name="dob" autocomplete="off">
                                        @error('dob')<span class="required">{{ $message }}</span>@enderror
									</div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-4">
										<label>Phone:<span class="required"> * </span></label>
										<input type="text" value="{{ old('phone') }}" class="form-control" name="phone">
                                        @error('phone')<span class="required">{{ $message }}</span>@enderror
									</div>
                                    <div class="col-md-4">
										<label>Address:<span class="required"> * </span></label>
										<input type="text" value="{{ old('address') }}" class="form-control" name="address">
                                        @error('address')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="col-md-4">
										<label>Address Line Two</label>
										<input type="text" value="{{ old('address_two') }}" class="form-control" name="address_two">
									</div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-3">
										<label>City:<span class="required"> * </span></label>
										<input type="text" value="{{ old('city') }}" class="city form-control" name="city">
                                        @error('city')<span class="required">{{ $message }}</span>@enderror
									</div>
                                    <div class="col-md-3">
										<label>State:<span class="required"> * </span></label>
										<input type="text" value="{{ old('state') }}" class="city form-control" name="state">
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
										<input type="text" value="{{ old('post_code') }}" class="form-control" name="post_code">
                                        @error('post_code')<span class="required">{{ $message }}</span>@enderror
									</div>
								</div>
								
								<div class="actions btn-set text-right">
									<button type="button" onclick="window.location = '';"class="btn btn default">
										<i class="fa fa-angle-left"></i> Back
									</button>	
									<input type="hidden" name="s" value="ok">
									<button type="submit"  class="btn btn-success mt-ladda-btn ladda-button btn-outline" data-style="contract" data-spinner-color="#333">
										<i class="fa fa-check"></i> Save
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