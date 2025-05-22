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
        <h1>{{ __('about.title')}}</h1>
    </div>
</section>
<section class="about_content_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center about_text_block">
                    <h2>{{ __('about.title')}}</h2>
                    <p class="pb-3 about_small_text">{{ __('about.sb-title') }}</p>
                    <!-- <h3>Welcome to My Boat Booker - your go-to destination for Ibiza boat rentals, made easy.</h3> -->
                    <p>{{ __('about.p-1') }}</p><br>
                    <!-- <h3 class="about_sec_heading">The professional and yacht charter platform</h3> -->
                    <p>{{ __('about.p-2') }} </p><br>
                    <p>{{ __('about.p-3') }} </p>
                    <h3>{{ __('about.heading') }}</h3>
                    <ul>
                        <li>{{ __('about.li-1') }}</li>
                        <li>{{ __('about.li-2') }}</li>
                        <li>{{ __('about.li-3') }}</li>
                    </ul>
                    <p class="pt-3"> {{ __('about.p-4') }}</p>
                    <p class="pt-3">{{ __('about.p-5') }}</p>
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
            <a  href="{{ route('search') }}">{{ __('about.find-boat') }}</a>
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
                    <h3>{{ __('about.icon-1') }}</h3>
                </div>
            </div>
            <div class="about_slide col-md-4">
                <div class="about_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/about-icon-2.png') }}">
                    <h3>{{ __('about.icon-2') }}</h3>
                </div>
            </div>
            <div class="about_slide col-md-4">
                <div class="about_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/about-icon-3.png') }}">
                    <h3>{{ __('about.icon-3') }}</h3>
                </div>
            </div>
            <div class="about_slide col-md-4">
                <div class="about_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/about-icon-4.png') }}">
                    <h3>{{ __('about.icon-4') }}</h3>
                </div>
            </div>
            <div class="about_slide col-md-4">
                <div class="about_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/about-icon-1.png') }}">
                    <h3>{{ __('about.icon-5') }}</h3>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

        
@endsection