@extends('layouts.admin.admin')

@section('meta')
    <title>Manage Blogs</title>
@endsection
@section('css')
<link href="{{ asset('app-assets/global/plugins/bootstrap-summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('app-assets/global/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript"></script>
@endsection
@section('js')

@endsection
@section('content')
    <!-- BEGIN CONTENT --> 
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <h1 class="page-title"> Manage Blog: Edit</h1>
            <div class="clear"></div>
            <div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" action="{{ route('admin.update-language', $language->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
                        <div class="portlet">
							<div class="form-body">
                                <div class="form-group">
                                    <div class="col-sm-6">
										<label>Language Name:<span class="required"> * </span></label>
										<input type="text" name="name" value="{{ $language->name }}" class="form-control"/> 
                                        @error('name')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="col-sm-6">
										<label>Language Code:<span class="required"> * </span></label>
										<input type="text" name="code" value="{{ $language->code }}" class="form-control"/> 
                                        @error('code')<span class="required">{{ $message }}</span>@enderror
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