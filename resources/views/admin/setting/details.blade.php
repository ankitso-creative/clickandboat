@extends('layouts.admin.admin')

@section('meta')
    <title>Manage Settings</title>
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
            <h1 class="page-title"> Manage Settings</h1>
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
			<div class="alert alert-danger" style="display: none;">
				<button class="close" data-close="alert"></button>
				<span id='error-msg'> </span>
			</div>
            <div class="clearfix"></div>
            <div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" action="{{ route('admin.setting_update') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="portlet">
							<div class="form-body">
                                <div class="form-group">
									<div class="col-md-12">
										<h4 class="bold">Website Logo</h4>
									</div>
									<div class="clearfix"></div>
                                    <div class="col-md-3">
										<label>Website Logo (png):</label>
										<input type="file" name="image" class="form-control" id="file-input" accept="image/png">
									</div>
									@php
										$hideClass = 'hide';
										if($results['logo']):
											$hideClass = '';
										endif;
									@endphp
									<div class="col-md-3 {{ $hideClass }}" id="logo-img">
										<label>Website Logo:</label>
										<img src="{{ $results['logo'] }}" class="img-responsive pic-bordered" id="website-logo">
									</div>

									<div class="col-md-3"> 
										<label>Website Logo White(png):</label>
										<input type="file" name="image-white" class="form-control" id="file-input-white" accept="image/png">
									</div>
									@php
										$hideClass = 'hide';
										if(isset($results['logo-white'])):
											$hideClass = '';
										endif;
									@endphp
									<div class="col-md-3 {{ $hideClass }}" id="logo-img-white">
										<label>Website Logo White:</label>
										<img src="{{ $results['logo-white'] }}" class="img-responsive pic-bordered" id="website-logo-white">
									</div>
									<div class="clearfix"></div>

									<div class="col-md-12">
										<h4 class="bold">Website Details</h4>
									</div>
									<div class="clearfix"></div>
                                    <div class="col-sm-4">
										<label>Meta Title:</label>
										<input type="text" name="setting[meta_title]" value="{{ $results['meta_title'] ?? '' }}" class="form-control"/> 
                                    </div>
									<div class="col-sm-8">
										<label>Meta Description:</label>
										<input type="text" name="setting[meta_description]" value="{{ $results['meta_description'] ?? '' }}" class="form-control"/> 
                                    </div>
									<div class="clearfix"></div>
									<div class="col-sm-4">
										<label>Website Address:</label>
										<input type="text" name="setting[address]" value="{{ $results['address'] ?? '' }}" class="form-control"/> 
                                    </div>
									<div class="col-sm-4">
										<label>Website Email:</label>
										<input type="email" name="setting[email]" value="{{ $results['email'] ?? '' }}" class="form-control"/> 
                                    </div>
									<div class="col-sm-4">
										<label>Website Phone:</label>
										<input type="tel" name="setting[phone]" value="{{ $results['phone'] ?? '' }}" class="form-control"/> 
                                    </div>
									<div class="clearfix"></div>
									{{-- <h4>Admin Settings</h4>
									<div class="col-sm-4">
										<label>Result Per Page:<span class="required"> * </span></label>
										<input type="number" name="result_per_page" value="" class="form-control"/> 
                                    </div> --}}
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
            $('#file-input').on('change', function(e) {
                e.preventDefault();  
                var formData = new FormData();  
                formData.append('image', $('#file-input')[0].files[0]);  
                formData.append('_token', $('meta[name="csrf-token"]').attr('content')); 
                $.ajax({
                    url: '{{ route("admin.upload_logo") }}',  // URL for the image upload endpoint
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            $('#logo-img').removeClass('hide');
                            $('#website-logo').attr('src', response.imageUrl);
                        } else {
                            $('.alert-danger').css("display",'block');
                            $('#error-msg').html("Image upload failed!");
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#statusMessage').text('An error occurred while uploading the image.').css('color', 'red');
                    }
                });
            });
        });
		$(document).ready(function() {
            $('#file-input-white').on('change', function(e) {
                e.preventDefault();  
                var formData = new FormData();  
                formData.append('image-white', $('#file-input-white')[0].files[0]);  
                formData.append('_token', $('meta[name="csrf-token"]').attr('content')); 
                $.ajax({
                    url: '{{ route("admin.upload_logo_white") }}',  // URL for the image upload endpoint
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            $('#logo-img-white').removeClass('hide');
                            $('#website-logo-white').attr('src', response.imageUrl);
                        } else {
                            $('.alert-danger').css("display",'block');
                            $('#error-msg').html("Image upload failed!");
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