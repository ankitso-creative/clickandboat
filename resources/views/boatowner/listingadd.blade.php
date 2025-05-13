@extends('layouts.boatowner.common')
@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
@section('css')
    <style>
        .dz-progress {
            display: none !important;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endsection
@section('js')
   
@endsection
@section('content')
    <div class="listing_banner">
        <div class="listing_banner_text">
            <h1>Ahoy there Captain!</h1>
            <p>Your yacht will soon be visible to the largest community of sailors interested in peer-to-peer yacht
                charters. Welcome to Booker Boat</p>
        </div>
    </div>
    <div class="col-lg-12 main-dashboard boatowner_listing_section">
        <div class="container">
            <form id="uploadForm" action="{{ route('boatowner.listing-store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="text-center boat_type_section">
                    <h2>Your boat</h2>
                    <h3>Type</h3>
                    <div class="your_boats_type">
                        <div class="radio-with-Icon">
                            @if(count($categories))
                                @foreach($categories as $category)
                                    <p class="radioOption-Item">
                                        <input type="radio" {{ singleCheckbox($loop->iteration,'1') }} name="type" id="BannerType{{ $loop->iteration }}" value="{{ $category->slug }}" class="ng-valid ng-dirty ng-touched ng-empty" aria-invalid="false">
                                        <label for="BannerType{{ $loop->iteration }}">
                                            <img src="{{ $category->getFirstMediaUrl('category_icon') }}">{{ $category->name }}
                                        </label>
                                    </p>
                                @endforeach
                            @endif
                            @error('type')<span class="required">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <div class="row password_section">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-default">City:<span class="required"> * </span></label>
                                <input type="text" name="city" value=""  class="form-control">
                                @error('city')<span class="required">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Harbour:<span class="required"> * </span></label>
                                <select name="harbour" class="form-control" placeholder="Search Loaction">
                                    <option value="">All Marinas</option>
                                    <option value="Marina Santa Eulalia">Marina Santa Eulalia</option>
                                    <option value="Puerto Sant Antoni">Puerto Sant Antoni</option>
                                    <option value="Marina Ibiza">Marina Ibiza</option>
                                    <option value="Marina Botafoch">Marina Botafoch</option>
                                    <option value="Ibiza Magna">Ibiza Magna</option>
                                    <option value="Club Nautico">Club Nautico</option>
                                </select>
                                @error('harbour')<span class="required">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-default">Manufacturer:<span class="required"> * </span></label>
                                <input type="text" name="manufacturer" class="form-control" value="{{ old('manufacturer') }}">
                                @error('manufacturer')<span class="required">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Model:<span class="required"> * </span></label>
                            <input type="text" name="model" class="form-control" value="{{ old('model') }}">
                            @error('model')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Is your boat rented with a skipper?<span class="required"> * </span></label>
                                <select name="skippers" class="form-control">
                                    <option value="With Skipper">With Skipper</option>
                                    <option value="Without Skipper">Without Skipper</option>
                                    <option value="With Skipper Or Without Skipper">With Skipper Or Without Skipper</option>
                                </select>
                                @error('professional')<span class="required">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Boat name:<span class="required"> * </span></label>
                            <input type="text" name="boat_name" class="form-control" value="{{ old('boat_name') }}">
                            @error('boat_name')<span class="required">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="photo-section">
                    <div class="text-center phot_heading">
                        <h1>Photos</h1>
                    </div>
                    <div class="photos_box_text">
                        <p class="photo_sub_heading">Drag and drop or <a href="#"> click here</a> to upload your photos</p>
                        <p>For the cover, choose a photo that shows the whole boat. Then add more photos of the details and the
                            interior.</p>
                    </div>
                    <p class="photo_sec_pera">Drag the photos to change the order they appear in</p>
                </div>
                <div class="col-sm-12 listing_add_image">
                    <div id="imageDropzone" class="dropzone">
                        <div class="dz-message">
                            <img src="{{ asset('app-assets/site_assets/img/camera.png') }}">
                            <p class="image_des_main_heading">Post your photos here</p>
                            <p>Minimum size: 400x400px</p>
                            <p>Format: jpeg, png, gif</p>
                            <p>Download from your device</p>
                        </div>
                    </div>
                </div>
                {{-- <div class="boatowner_listing_images">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="listing_img_box">
                                <img src="{{ asset('app-assets/site_assets/img/boat-type-1.jpg') }}">
                                <button class="remove_btn"><i class="far fa-times-circle"></i></button>
                            </div>
                            <div class="listing_img_box_hide">
                                <img class="camera_icon_img" src="{{ asset('app-assets/site_assets/img/camera.png') }}">
                                <p>Photo no. 1</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="listing_img_box">
                                <img src="{{ asset('app-assets/site_assets/img/boat-type-1.jpg') }}">
                                <button class="remove_btn"><i class="far fa-times-circle"></i></button>
                            </div>
                            <div class="listing_img_box_hide">
                                <img class="camera_icon_img" src="{{ asset('app-assets/site_assets/img/camera.png') }}">
                                <p>Photo no. 2</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="listing_img_box">
                                <img src="{{ asset('app-assets/site_assets/img/boat-type-1.jpg') }}">
                                <button class="remove_btn"><i class="far fa-times-circle"></i></button>
                            </div>
                            <div class="listing_img_box_hide">
                                <img class="camera_icon_img" src="{{ asset('app-assets/site_assets/img/camera.png') }}">
                                <p>Photo no. 3</p>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4 boat_listing_save_btn">
                        <a href="#">Add More</a>
                    </div>
                </div> --}}
                {{-- <div class="pt-4 boatowner_listing_videos">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="boatowner_listing_video_box">
                                <video width="100%" height="240" controls>
                                    <source src="movie.mp4" type="video/mp4">
                                    <source src="movie.ogg" type="video/ogg">
                                </video>
                            </div>
                            <div class="boatowner_listing_video_box_hide">
                                <i class="fa-solid fa-video"></i>
                                <p>Video no. 3</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="boatowner_listing_video_box">
                                <video width="100%" height="240" controls>
                                    <source src="movie.mp4" type="video/mp4">
                                    <source src="movie.ogg" type="video/ogg">
                                </video>
                            </div>
                            <div class="boatowner_listing_video_box_hide">
                                <i class="fa-solid fa-video"></i>
                                <p>Video no. 3</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="boatowner_listing_video_box">
                                <video width="100%" height="240" controls>
                                    <source src="movie.mp4" type="video/mp4">
                                    <source src="movie.ogg" type="video/ogg">
                                </video>
                            </div>
                            <div class="boatowner_listing_video_box_hide">
                                <i class="fa-solid fa-video"></i>
                                <p>Video no. 3</p>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4 boat_listing_save_btn">
                        <a href="#">Add More</a>
                    </div>
                </div> --}}
                <input type="hidden" name="s" value="general">
                <div class="boat_listing_images_video_save_btn">
                    <button class="save_btn" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        Dropzone.autoDiscover = false;
        const imageDropzone = new Dropzone("#imageDropzone", {
            url: "/upload",  
            paramName: 'file', 
            maxFilesize: 20, 
            acceptedFiles: 'image/*',
            autoProcessQueue: false,
            addRemoveLinks: true,
            dictDefaultMessage: 'Drag & Drop or Click to Upload Image',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(file, response) {
                console.log('File uploaded successfully:', response);
            },
            error: function(file, response) {
                console.error('Error uploading file:', response);
            }
        });
       
        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();
            $('button.save_btn').html('<i class="fas fa-spinner fa-spin me-2"></i> Wait Please...');
            let formData = new FormData(this);
            imageDropzone.files.forEach(function(file) {
                formData.append('files[]', file);
            });
            let formAction = $(this).attr('action');
            $.ajax({
                url: formAction,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    window.location.href = data.data.redirect_url;
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        let firstErrorField;
                        $.each(errors, function(fieldName, errorMessages) {
                            let field = $('[name="' + fieldName + '"]');
                            if (field.length) {
                                field.after('<div class="text-danger">' + errorMessages[0] + '</div>');
                                if (!firstErrorField) {
                                    firstErrorField = field;
                                }
                            }
                            if (firstErrorField) {
                                $('html, body').animate({
                                    scrollTop: firstErrorField.offset().top - 100 // adjust as needed
                                }, 'fast');
                            }
                        });
                        $('button.save_btn').html('Save');
                    } else {
                        console.error('Unexpected error:', xhr.responseText);
                        alert('An error occurred. Check console for details.');
                        $('button.save_btn').html('Save');
                    }
                }
            });
        });

    </script>
@endsection