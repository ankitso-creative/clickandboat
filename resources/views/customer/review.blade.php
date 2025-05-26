@extends('layouts.customer.common')
@section('meta')
<title>Review - {{ config('app.name') }}</title>
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<div class="col-lg-9 main-dashboard">
    <div class="page-title">
        <h1>Add Review</h1>
    </div>
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
    <div class="">
        <div class="tab-pane" id="password">
            <div class="card-section">
                <div class="card-content">
                    <form class="password-form" action="{{ route('customer.submitreview') }}" method="Post">
                        @csrf
                        <div class="row password_section">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="label-default">Rating<span class="required"> *</span></label>
                                    <select name="rating" class="form-control">
                                        <option value="">Please Select</option>
                                        <option {{ checkselect($review->rate ?? '',1) }} value="1">1</option>
                                        <option {{ checkselect($review->rate ?? '',2) }} value="2">2</option>
                                        <option {{ checkselect($review->rate ?? '',3) }} value="3">3</option>
                                        <option {{ checkselect($review->rate ?? '',4) }} value="4">4</option>
                                        <option {{ checkselect($review->rate ?? '',5) }} value="5">5</option>
                                    </select>
                                </div>
                                @error('rating')<span class="required">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="label-default">Review<span class="required"> *</span></label>
                                    <textarea name="review" value="" class="form-control"> {{ $review->review ?? '' }}</textarea>
                                    <input type="hidden" name="slug" value="{{ $slug }}">
                                    @error('review')<span class="required">{{ $message }}</span>@enderror
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
            </div>
        </div>
        
    </div>
    
    @endsection