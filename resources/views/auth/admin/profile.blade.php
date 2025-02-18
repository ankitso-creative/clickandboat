@extends('layouts.admin.admin')

@section('meta')
    <title>Manage Users</title>
@endsection
@section('css')
    
@endsection
@section('js')
    
@endsection
@section('content')
    <!-- BEGIN CONTENT --> 
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <h1 class="page-title"> Manage Profile</h1>
            <div class="clear"></div>
            <div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" action="{{ route('admin.update') }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('put')
                        <div class="portlet">
							<div class="form-body">
                                <div class="form-group">
                                    <div class="col-sm-3">
										<label>Name:<span class="required"> * </span></label>
										<input type="text" name="name" value="{{ $admin->name }}" class="form-control"/> 
                                        @error('name')<span class="required">{{ $message }}</span>@enderror
									</div>
                                    <div class="col-md-3">
										<label>Email:<span class="required"> * </span></label>
										<input type="email" value="{{ $admin->email }}" readonly class="form-control" name="email">
                                        @error('email')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="col-md-3">
										<label>Password:<span class="required"> * </span></label>
										<input type="password" class="form-control" name="password">
                                        @error('password')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="col-md-3">
										<label>Confirm Password:<span class="required"> * </span></label>
										<input type="password" class="form-control" name="password_confirmation">
                                        @error('password_confirmation')<span class="required">{{ $message }}</span>@enderror
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
@endsection