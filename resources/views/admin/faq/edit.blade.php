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
					<form class="form-horizontal form-row-seperated" action="{{ route('admin.faq.update',$result->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
                        <div class="portlet">
							<div class="form-body">
                                <div class="form-group">
									<div class="col-sm-12">
										<label>Question:<span class="required"> * </span></label>
										<textarea name="question" class="form-control">{{ $result->question }} </textarea>
                                        @error('question')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="col-sm-12">
										<label>Answer:<span class="required"> * </span></label>
										<textarea name="answer" class="form-control"> {{ $result->answer }} </textarea>
                                        @error('answer')<span class="required">{{ $message }}</span>@enderror
									</div>
									{{-- <div class="col-sm-12 language_edit">
										<label>Select Language:<span class="required"> * </span></label>
										@if(count($languages))
											@foreach ($languages as $language)
												<label class="mt-checkbox">
													<input type="radio" {{ singleCheckbox($language->code, $result->language) }} id="inlineCheckbox{{ $loop->iteration }}" value="{{ $language->code }}" name="language"> {{ $language->name }}
													<span></span>
												</label>
											@endforeach
										@endif
									</div> --}}
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