@extends('layouts.boatowner.common')
@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
@section('css')

@endsection
@section('js')

@endsection
@section('content')
    <div class="col-lg-9 main-dashboard">
        <div class="page-title">
            <h1>Add Your Listing</h1>
        </div>
        @if($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <section id="tabs">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="nav-general-tab">
                                    <form action="{{ route('boatowner.listing-store') }}" method="POST" enctype="multipart/form-data"> 
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>Type:<span class="required"> * </span></label>
                                                <select name="type" class="form-control" required>
                                                    <option value="Motorboat">Motorboat</option>
                                                    <option value="Sailboat">Sailboat</option>
                                                    <option value="RIB">RIB</option>
                                                    <option value="Catamaran">Catamaran</option>
                                                    <option value="Houseboat">Houseboat</option>
                                                    <option value="Jet ski">Jet ski</option>
                                                    <option value="Gulet">Gule </option>
                                                    <option value="Boat without licence">Boat without licence</option>
                                                    <option value="Yacht">Yacht</option>
                                                </select>
                                                @error('type')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Harbour:<span class="required"> * </span></label>
                                                <input type="text" name="harbour" value="{{ old('harbour') }}" class="form-control" required>
                                                @error('harbour')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-lg-4">
                                                <label>City:<span class="required"> * </span></label>
                                                <input type="text" name="city" class="form-control" required value="{{ old('city') }}">
                                                @error('city')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-4">
                                                <label>Are you a professional?:<span class="required"> * </span></label>
                                                <select name="professional" class="form-control" required>
                                                    <option value="No">No</option>
                                                    <option value="Yes">Yes</option>
                                                </select>
                                                @error('professional')<span class="required">{{ $message }}</span>@enderror
                                            </div>	
                                            <div class="col-lg-4">
                                                <label>Manufacturer:<span class="required"> * </span></label>
                                                <input type="text" name="manufacturer" class="form-control" required value="{{ old('manufacturer') }}">
                                                @error('manufacturer')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Model:<span class="required"> * </span></label>
                                                <input type="text" name="model" class="form-control" required value="{{ old('model') }}">
                                                @error('model')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-4">
                                                <label>Is your boat rented with a skipper?:<span class="required"> * </span></label>
                                                <select name="skipper" class="form-control" required>
                                                    <option value="with skipper">With Skipper </option>
                                                    <option value="without skipper">Without Skipper</option>
                                                    <option value="with Or without skipper">With Or Without Skipper</option>
                                                </select>
                                                @error('skipper')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            
                                            <div class="col-lg-4">
                                                <label>Capacity:<span class="required"> * </span></label>
                                                <input type="text" name="capacity" class="form-control"  value="{{ old('capacity') }}">
                                                @error('capacity')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Length (m)<span class="required"> * </span></label>
                                                <input type="text" name="length" class="form-control" value="{{ old('length') }}">
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-12">
                                                <h4 class="bold ">Company</h4>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-4">
                                                <label>Company's name<span class="required"> * </span></label>
                                                <input type="text" name="company_name" class="form-control" required value="{{ old('company_name') }}">
                                                @error('company_name')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Website<span class="required">  </span></label>
                                                <input type="text" name="website" class="form-control" value="{{ old('website') }}">
                                            </div> 
                                            <div class="clearfix"></div>
                                            <div class="col-lg-12">
                                                <h4 class="bold ">Description</h4>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-6">
                                                <label>Boat name:<span class="required"> * </span></label>
                                                <input type="text" name="boat_name" class="form-control" required value="{{ old('boat_name') }}">
                                                @error('boat_name')<span class="required">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Title:<span class="required"> </span></label>
                                                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-12">
                                                <label>Description:<span class="required"> </span></label>
                                                <textarea type="text" name="description" class="form-control"></textarea>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-12">
                                                <h4 class="bold ">Technical</h4>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-3">
                                                <label>Onboard capacity:<span class="required"> </span></label>
                                                <input type="text" name="onboard_capacity" class="form-control" value="{{ old('onboard_capacity') }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Number of cabins:<span class="required"> </span></label>
                                                <input type="text" name="cabins" class="form-control" value="{{ old('cabins') }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Number of berths:<span class="required"> </span></label>
                                                <input type="text" name="berths" class="form-control" value="{{ old('berths') }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Number of bathrooms:<span class="required"> </span></label>
                                                <input type="text" name="bathrooms" class="form-control" value="{{ old('bathrooms') }}">
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-3">
                                                <label>Year of construction:<span class="required"> </span></label>
                                                <input type="text" name="construction_year" class="form-control" value="{{ old('construction_year') }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Fuel(L/h):<span class="required"> </span></label>
                                                <input type="text" name="fuel" class="form-control" value="{{ old('fuel') }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Renovated:<span class="required"> </span></label>
                                                <input type="text" name="renovated" class="form-control" value="{{ old('renovated') }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>speed (kn):<span class="required"> </span></label>
                                                <input type="text" name="speed" class="form-control" value="{{ old('speed') }}">
                                            </div>
                                            <div class="clearfix"></div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="alert d-none">
                                                    <button class="close" data-close="alert"></button>
                                                    <span class="message"></span>
                                                </div>
                                            </div>
                                            <div class="actions btn-set">
                                                <button type="button" onclick="window.location = '';" class="btn btn default">
                                                    <i class="fa fa-angle-left"></i> Back
                                                </button>	
                                                <input type="hidden" name="s" value="general">
                                                <button type="submit" class="btn btn-success mt-ladda-btn ladda-button btn-outline" data-style="contract" data-spinner-color="#333">
                                                    <i class="fa fa-check"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection