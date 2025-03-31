@extends('layouts.front.common')

@section('meta')
<title>Manage Users</title>
@endsection
@section('css')

@endsection
@section('js')

@endsection
@section('content')
<section class="team_banner_section">
    <div class="team_banner_text">
        <h1>Team</h1>
    </div>
</section>
<section class="team_content_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center team_content_block">
                    <h2>Our Team</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin venenatis neque ac dolor tincidunt
                        tincidunt. Etiam eu posuere erat. Sed consectetur lacinia auctor.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="team_section_box">
                    <img src="{{ asset('app-assets/site_assets/img/menimg.jpg') }}">
                    <h2>Edvard gill</h2>
                    <p>Ceo, founder</p>
                    <ul class="team_social_media">
                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="team_section_box">
                    <img src="{{ asset('app-assets/site_assets/img/menimg.jpg') }}">
                    <h2>Edvard gill</h2>
                    <p>Ceo, founder</p>
                    <ul class="team_social_media">
                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="team_section_box">
                    <img src="{{ asset('app-assets/site_assets/img/menimg.jpg') }}">
                    <h2>Edvard gill</h2>
                    <p>Ceo, founder</p>
                    <ul class="team_social_media">
                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection