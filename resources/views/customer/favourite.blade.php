@extends('layouts.customer.common')

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
                    <h1>Save your favorite products</h1>
                </div>
                <div class="card-section fav_section">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="fav_inner_box">
                                <div class="card fav_box">
                                    <img src="https://clickandboat.so-creative-dev.org/storage/listing/cover_images/54/blog-img.jpg" alt="card">
                                </div>
                                <div class="card-body">
                                    <h5>ktm - Motorboat 2020</h5>
                                </div>
                                <a href="#">Book Now</a>
                                <button class="fav-remove-btn"><i class="far fa-times-circle"></i></button>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="fav_inner_box">
                                <div class="card fav_box">
                                    <img src="https://clickandboat.so-creative-dev.org/storage/listing/cover_images/54/blog-img.jpg" alt="card">
                                </div>
                                <div class="card-body">
                                    <h5>ktm - Motorboat 2020</h5>
                                </div>
                                <a href="#">Book Now</a>
                                <button class="fav-remove-btn"><i class="far fa-times-circle"></i></button>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="fav_inner_box">
                                <div class="card fav_box">
                                    <img src="https://clickandboat.so-creative-dev.org/storage/listing/cover_images/54/blog-img.jpg" alt="card">
                                </div>
                                <div class="card-body">
                                    <h5>ktm - Motorboat 2020</h5>
                                </div>
                                <a href="#">Book Now</a>
                                <button class="fav-remove-btn"><i class="far fa-times-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
