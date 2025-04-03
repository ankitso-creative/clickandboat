@extends('layouts.admin.admin')

@section('meta')
    <title>Manage Blogs</title>
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
            <h1 class="page-title"> Manage Category: Edit</h1>
            <div class="clear"></div>
            <div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" action="{{ route('admin.category.update',$result->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
                        <div class="portlet">
							<div class="form-body">
                                <div class="form-group">
                                    <div class="col-sm-4">
										<label>Name:<span class="required"> * </span></label>
										<input type="text" name="name" value="{{ $result->name }}" class="form-control"/> 
                                        @error('name')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="col-sm-4">
										<label>Image:<span class="required">  </span></label>
										<input type="file" name="image" value="" class="form-control"/> 
                                        @error('image')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="col-sm-4">
										<label>Icon:<span class="required">  </span></label>
										<input type="file" name="icon" value="" class="form-control"/> 
                                        @error('icon')<span class="required">{{ $message }}</span>@enderror
									</div>
									<div class="col-sm-4">
										<label>Image:<span class="required">  </span></label>
										<img src="{{ $result->getFirstMediaUrl('category_image') }}" class="img-responsive">
									</div>
									<div class="col-sm-4">
										<label>Icon:<span class="required">  </span></label>
										<img src="{{ $result->getFirstMediaUrl('category_icon') }}" class="img-responsive">
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="actions btn-set text-right">
									<button type="button" onclick="window.location = '';" class="btn btn default">
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
	
@endsection