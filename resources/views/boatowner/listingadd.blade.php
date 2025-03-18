@extends('layouts.boatowner.common')
@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endsection
@section('js')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAli6rCJivgzTbWznnkqFtT_btPww6WBYs&libraries=places"></script>
    <script>
        $(document).ready(function () {
            google.maps.event.addDomListener(window, 'load', initialize);
        });
        function initialize() 
        {
            var input = document.getElementById('location-add');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry || !place.address_components) {
                    console.log("Place details not found");
                    return;
                }
                var city = '';
                var country = '';
                var state = '';
                for (var i = 0; i < place.address_components.length; i++) {
                    var component = place.address_components[i];
                    if (component.types.includes('locality')) {
                        city = component.long_name;
                    }
                    if (component.types.includes('administrative_area_level_1')) {
                        state = component.long_name;
                    }
                    if (component.types.includes('country')) {
                        country = component.long_name;
                    }
                }
                if (city && country && state) {
                    input.value = city + ', ' + state + ', '+ country;
                }
                if(city==state)
                {
                    input.value = city + ', ' + country;
                }
                $('#search-filter-fom').submit();
            });
        }
    </script>
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
                            <p class="radioOption-Item">
                                <input type="radio" name="type" id="BannerType1" value="Motorboat" class="ng-valid ng-dirty ng-touched ng-empty" aria-invalid="false">
                                <label for="BannerType1">
                                    <img src="{{ asset('app-assets/site_assets/img/Motorboat-V1.png') }}">Motorboat
                                </label>
                            </p>
                            <p class="radioOption-Item">
                                <input type="radio"  name="type" id="BannerType2" value="Sailboat" class="ng-valid ng-dirty ng-touched ng-empty" aria-invalid="false">
                                <label for="BannerType2">
                                    <img src="http://127.0.0.1:8000/app-assets/site_assets/img/Sailboat-V1.png"> Sailboat
                                </label>
                            </p>
                            <p class="radioOption-Item">
                                <input type="radio" name="type" id="BannerType3" value="RIB" class="ng-valid ng-dirty ng-touched ng-empty" aria-invalid="false">
                                <label for="BannerType3">
                                    <img src="http://127.0.0.1:8000/app-assets/site_assets/img/RIB-V1.png"> RIB
                                </label>
                            </p>
                            <p class="radioOption-Item">
                                <input type="radio"  name="type" id="BannerType4" value="Catamaran" class="ng-valid ng-dirty ng-touched ng-empty" aria-invalid="false">
                                <label for="BannerType4">
                                    <img src="http://127.0.0.1:8000/app-assets/site_assets/img/Catamaran-V1.png">Catamaran
                                </label>
                            </p>
                            <p class="radioOption-Item">
                                <input type="radio" name="type" id="BannerType5" value="Houseboat" class="ng-valid ng-dirty ng-touched ng-empty" aria-invalid="false">
                                <label for="BannerType5">
                                    <img src="http://127.0.0.1:8000/app-assets/site_assets/img/Jet-ski-V1.png">Jet ski
                                </label>
                            </p>
                            <p class="radioOption-Item">
                                <input type="radio"  name="type" id="BannerType6" value="Jet ski" class="ng-valid ng-dirty ng-touched ng-empty" aria-invalid="false">
                                <label for="BannerType6">
                                    <img src="http://127.0.0.1:8000/app-assets/site_assets/img/Gulet-V1.png">Gulet
                                </label>
                            </p>
                            <p class="radioOption-Item">
                                <input type="radio"  name="type" id="BannerType7" value="Gulet" class="ng-valid ng-dirty ng-touched ng-empty" aria-invalid="false">
                                <label for="BannerType7">
                                    <img src="http://127.0.0.1:8000/app-assets/site_assets/img/Boat-without-licence-V1.png"> Boat without licence
                                </label>
                            </p>
                            <p class="radioOption-Item">
                                <input type="radio" name="type" id="BannerType8" value="Yacht" class="ng-valid ng-dirty ng-touched ng-empty" aria-invalid="false">
                                <label for="BannerType8">
                                    <img src="http://127.0.0.1:8000/app-assets/site_assets/img/Yacht-V1.png"> Yacht
                                </label>
                            </p>
                            @error('type')<span class="required">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <div class="row password_section">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-default">City</label>
                                <input type="text" name="city" id="location-add" value="" class="form-control">
                                @error('city')<span class="required">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Harbour</label>
                                <input type="text" name="harbour" value="" class="form-control">
                                @error('harbour')<span class="required">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Are you a professional?</label>
                                <select name="professional" class="form-control" required>
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                                @error('professional')<span class="required">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-default">Manufacturer</label>
                                <input type="text" name="manufacturer" class="form-control" required value="{{ old('manufacturer') }}">
                                @error('manufacturer')<span class="required">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Model:<span class="required"> * </span></label>
                            <input type="text" name="model" class="form-control" required value="{{ old('model') }}">
                            @error('model')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label>Boat name:<span class="required"> * </span></label>
                            <input type="text" name="boat_name" class="form-control" required value="{{ old('boat_name') }}">
                            @error('boat_name')<span class="required">{{ $message }}</span>@enderror
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Is your boat rented with a skipper?</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-default">Capacity (authorised)</label>
                                <input type="text" name="city" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group length_input">
                                <label class="label-default">Length (m)</label>
                                <input type="text" name="city" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">How did you find out about Click&Boat?</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div> --}}
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
            maxFilesize: 2, 
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
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            e.preventDefault(); 
            let formData = new FormData(document.getElementById('uploadForm'));
            imageDropzone.files.forEach(function(file) {
                formData.append("files[]", file);
            });
            let formAction = document.getElementById('uploadForm').action;
            fetch(formAction, {
                method: "POST",
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', 
                }
            })
            .then(response => response.json())
            .then(data => {
                window.location.href = data.data.redirect_url; 
            })
            .catch(error => {
                console.error('Error submitting form:', error);
            });
        });
    </script>
@endsection