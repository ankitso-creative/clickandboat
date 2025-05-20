@extends('layouts.front.common')

@section('meta')
    <title>Manage Users</title>
@endsection
@section('css')
    
@endsection
@section('js')
    
@endsection
@section('content')
<section class="about_banner_section">
    <div class="about_banner_text">
        <!-- <p>About Booker Boat</p> -->
        <h1>About us</h1>
    </div>
</section>
<section class="about_content_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center about_text_block">
                    <h2>About us</h2>
                    <p class="pb-3 about_small_text">Welcome to My Boat Booker - your go-to destination for Ibiza boat rentals, made easy.</p>
                    <!-- <h3>Welcome to My Boat Booker - your go-to destination for Ibiza boat rentals, made easy.</h3> -->
                    <p>Born from the sun-soaked shores of Ibiza and built with a deep love for the sea, we launched My Boat Booker in 2025 with one simple goal: to make boat rentals in Ibiza as seamless, quick and reliable as possible.</p><br>
                    <!-- <h3 class="about_sec_heading">The professional and yacht charter platform</h3> -->
                    <p>After years of running a boat charter company here, we noticed a gap - booking a boat should be just as fun as being on one. So, we created a platform that brings boat owners and renters together with zero stress and all the good vibes, </p><br>
                    <p>Whether your a group of friends chasing the iconic ibiza party experience, or a family looking to create unforgettable memories out on the water, we’ve got the perfect boat for you. Think hidden coves, crystal-clear water, and that unbeatable feeling of freedom - that’s what we’re here to deliver. </p>
                    <h3>Why My Boat Booker?</h3>
                    <ul>
                        <li>Easy, fast & secure bookings</li>
                        <li>A wide range of boats for every kind of adventure</li>
                        <li>Local knowledge, real passion and friendly support</li>
                    </ul>
                    <p class="pt-3"> So whether your sailing into there sunset with your favourite people or turning up the volume for a boat party to remember, let My Boat Booker be your first step to the ultimate Ibiza boat rental experience.</p>
                    <p class="pt-3">Lets get you out on the water!"</p>
                </div>
            </div>
        </div>
        <div class="pt-5 row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="about_sec_img">
                    <img src="{{ asset('app-assets/site_assets/img/about-us-img-01.jpg') }}">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="about_sec_img">
                    <img src="{{ asset('app-assets/site_assets/img/about-us-img-02.jpg') }}">
                </div>
            </div>
        </div>
        <div class="about_find_boat">
            <a  href="{{ route('search') }}">Find a Boat</a>
        </div>
    </div>
</section>
<section class="about_slider">
    <div class="fluid-container ">
    <div class="row">
        <div class="about_sliders col-md-12">
            <div class="about_slide col-md-4">
                <div class="about_slider_box ">
                    <img src="{{ asset('app-assets/site_assets/img/about-icon-1.png') }}">
                    <h3>More than
                    1,100,000 members</h3>
                </div>
            </div>
            <div class="about_slide col-md-4">
                <div class="about_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/about-icon-2.png') }}">
                    <h3>More than
                    55,000 boats</h3>
                </div>
            </div>
            <div class="about_slide col-md-4">
                <div class="about_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/about-icon-3.png') }}">
                    <h3>More than
                    750 harbours</h3>
                </div>
            </div>
            <div class="about_slide col-md-4">
                <div class="about_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/about-icon-4.png') }}">
                    <h3>More than
                    560165 client reviews</h3>
                </div>
            </div>
            <div class="about_slide col-md-4">
                <div class="about_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/about-icon-1.png') }}">
                    <h3>More than
                    1,100,000 members</h3>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

        
@endsection