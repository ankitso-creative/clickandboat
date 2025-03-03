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
    <div class="fav_section">
        <div class="row">
        <?php
                        for ($i= 0; $i < 6; $i++) {                                                                                                                                                                                                                                                                                        
                        ?>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="location_inner_box">
                    <img src="{{ asset('app-assets/site_assets/img/locatoinimg-one.jpg') }}">
                    <div class="wishlist_icon">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <div class="location_inner_main_box">
                        <div class="location_inner_text">
                            <h3>Skiathos Port</h3>
                            <p class="location_pera">Motorboat Sting 485 sport 30 (2023)</p>
                            <p class="people_pera">4 people · 30 hp · 5 m</p>
                            <h5 class="location_price">From <span class="price_style">€27</span> / day</h5>
                            <div class="location_facility">
                                <ul>
                                    <li>With Skipper</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                        }
                        ?>
        </div>
    </div>
</div>
@endsection