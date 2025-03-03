@extends('layouts.boatowner.common')
@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
@section('css')

@endsection
@section('js')

@endsection
@section('content')
<div class="col-lg-12 main-dashboard boatowner_listing_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title">
                    <h1>Ahoy there Captain!</h1>
                    <p>Your yacht will soon be visible to the largest community of sailors interested in peer-to-peer
                        yacht
                        charters. Welcome to Click&Boat!</p>
                </div>
            </div>
        </div>
        <div class="text-center boat_type_section">
            <h2>Your boat</h2>
            <h3>Type</h3>
            <div class="line-entry">
                <div class="col-1-1 entry full-width">
                    <div class="col-1-1 value kind-boat">
                        <div class="content-button" data-typeid="Motorboat" data-context="productcreate">
                            <button aria-label="Motorboat">
                                <div class="boatsIconColor">
                                    <img src="{{ asset('app-assets/site_assets/img/Motorboat-V1.png') }}">
                                </div>
                                Motorboat
                            </button>
                        </div>
                        <div class="content-button" data-typeid="Sailboat" data-context="productcreate">
                            <button aria-label="Sailboat">
                                <div class="boatsIconColor">
                                    <img src="{{ asset('app-assets/site_assets/img/Sailboat-V1.png') }}">
                                </div>
                                Sailboat
                            </button>
                        </div>
                        <div class="content-button" data-typeid="RIB" data-context="productcreate">
                            <button aria-label="RIB">
                                <div class="boatsIconColor">
                                    <img src="{{ asset('app-assets/site_assets/img/RIB-V1.png') }}">
                                </div>
                                RIB
                            </button>
                        </div>
                        <div class="content-button" data-typeid="Catamaran" data-context="productcreate">
                            <button aria-label="Catamaran">
                                <div class="boatsIconColor">
                                    <img src="{{ asset('app-assets/site_assets/img/Catamaran-V1.png') }}">
                                </div>
                                Catamaran
                            </button>
                        </div>
                        <div class="content-button" data-typeid="Jet Ski" data-context="productcreate">
                            <button aria-label="Jet ski">
                                <div class="boatsIconColor">
                                    <img src="{{ asset('app-assets/site_assets/img/Jet-ski-V1.png') }}">
                                </div>
                                Jet ski
                            </button>
                        </div>
                        <div class="content-button" data-typeid="Gulet" data-context="productcreate">
                            <button aria-label="Gulet">
                                <div class="boatsIconColor">
                                    <img src="{{ asset('app-assets/site_assets/img/Gulet-V1.png') }}">
                                </div>
                                Gulet
                            </button>
                        </div>
                        <div class="content-button" data-typeid="Without license" data-context="productcreate">
                            <button aria-label="Boat without licence ">
                                <div class="boatsIconColor">
                                    <img src="{{ asset('app-assets/site_assets/img/Boat-without-licence-V1.png') }}">
                                </div>
                                Boat without licence
                            </button>
                        </div>
                        <div class="content-button" data-typeid="Yacht" data-context="productcreate">
                            <button aria-label="Yacht">
                                <div class="boatsIconColor">
                                    <img src="{{ asset('app-assets/site_assets/img/Yacht-V1.png') }}">
                                </div>
                                Yacht
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-section">
            <form class="password-form" action="" method="Post">
                <div class="row password_section">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label-default">City</label>
                            <input type="text" name="city" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Harbour</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Are you a professional?</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label-default">Manufacturer</label>
                            <input type="text" name="city" value="" class="form-control" placeholder="Manufacturer">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label-default">Model</label>
                            <input type="text" name="city" value="" class="form-control" placeholder="Model">
                        </div>
                    </div>
                    <div class="col-md-6">
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
                    </div>
                    <div class="col-md-6">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center form-group">
                            <button class="save_btn">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="photo-section">
            <div class="phot_heading">
                <h1>Photos</h1>
            </div>
            <div class="photos_box_text">
                <p class="photo_sub_heading">Drag and drop or click here to upload your photos</p>
                <p>For the cover, choose a photo that shows the whole boat. Then add more photos of the details and the
                    interior.</p>
                <p class="photo_sec_pera">Drag the photos to change the order they appear in</p>
            </div>
        </div>
        <div class="card-section">
            <div class="image_des">
                <img src="{{ asset('app-assets/site_assets/img/camera.png') }}">
                <p class="image_des_main_heading">Post your photos here</p>
                <p>Minimum size: 400x400px</p>
                <p>Format: jpeg, png, gif</p>
                <a href="">Download from your device</a>
            </div>
        </div>
        <div class="boatowner_listing_images">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('app-assets/site_assets/img/feature-img-2.jpg') }}">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('app-assets/site_assets/img/feature-img-2.jpg') }}">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('app-assets/site_assets/img/feature-img-2.jpg') }}">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('app-assets/site_assets/img/feature-img-2.jpg') }}">
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection