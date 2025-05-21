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
            <h1 class="page-title"> Manage Email: Edit</h1>
            <div class="clear"></div>
            <div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" action="{{ route('admin.emailtemplate.update',$result->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
                        <div class="portlet">
							<div class="form-body">
                                <div class="form-group">
									<div class="col-sm-4">
										<label>Title:<span class="required"> * </span></label>
										<input name="title" value="{{ $result->title }}" class="form-control" type="text" readonly> 
										@error('title')<span class="required">{{ $message }}</span>@enderror
                                    </div>
									<div class="col-sm-4">
										<label>Subject:<span class="required"> * </span></label>
										<input name="subject" value="{{ $result->subject }}" class="form-control" type="text"> 
										@error('subject')<span class="required">{{ $message }}</span>@enderror
                                    </div>
									<div class="col-sm-4">
										<label>Who Receive:<span class="required"> * </span></label>
										<input name="who_receive" value="{{ $result->who_receive }}" class="form-control" type="text">
										@error('who_receive')<span class="required">{{ $message }}</span>@enderror 
                                    </div>
									<div class="col-sm-12">
										<label>Description:<span class="required"> * </span></label>
										<textarea  name="description" id="summernote" class="form-control"> {{ $result->description }} </textarea>
										@error('description')<span class="required">{{ $message }}</span>@enderror
                                    </div>
									<div class="clearfix"></div>
								</div>
								<div class="text-right actions btn-set">
									<button type="button" onclick="window.location = '';" class="btn default">
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
		  	$('#summernote').summernote({
				height: 300,
		  	});
		});
	</script>
@endsection