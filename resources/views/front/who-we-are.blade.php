@extends('layouts.front.common')

@section('meta')
    <title>Manage Users</title>
@endsection
@section('css')
    
@endsection
@section('js')
    
@endsection
@section('content')
    <div class="section-title-page area-bg area-bg_dark area-bg_op_60">
        <div class="area-bg__inner">
          <div class="container text-center">
            <h1 class="b-title-page">Who we are</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Who we are</li>
              </ol>
            </nav>
            <!-- end .breadcrumb-->
            
          </div>
        </div>
      </div>
      <!-- end .b-title-page-->
      <!-- end .b-title-page-->
      <div class="about_us_section l-main-content">
        <div class="ui-decor ui-decor_mirror ui-decor_sm-h bg-primary"></div>
        <div class="container">
            <div class="row about_text_box">
                    <div class="col-lg-12 ">
                        <div class="text-left">
                            <h2 class="ui-title">About Click&Boat</h2>
                            <h3>Click&Boat, the leading professional </h3>
                            <div class="ui-content">
                                <p>It all started with two contractors and a simple observation: on average, among the million boats in France, very few are used for more than 10 days a year. Maintenance, insurance, mooring: a boat is expensive, sometimes very expensive with the annual expenses representing, on average, 10% of the price of the boat every year. It was during their many visits to French ports that Edouard and Jérémy came up with the idea of Click&Boat: a collaborative platform based on sharing and trust, to allow boat owners to earn money, confidently and safely.</p>
                                <p>It was during their many visits to French ports that Edouard and Jérémy came up with the idea of Click&Boat: a collaborative platform based on sharing and trust, to allow boat owners to earn money, confidently and safely.</p>
                                <p>It was during their many visits to French ports that Edouard and Jérémy came up with the idea of Click&Boat: a collaborative platform based on sharing and trust, to allow boat owners to earn money, confidently and safely.</p>
                                <h3>Insurance</h3>
                                <p>All owners present on the Click&Boat platform, both private and professional, must offer boats covered by insurance that is up-to-date and in line with their rental and/or co-navigation activity(ies) for online booking.</p>
                                <h3>Community</h3>
                                <p>Click&Boat is a real sailing community for enthusiasts who want to share their boat or rent a boat directly from its owner. Thousands already trust Click&Boat, so don't wait any longer: Sign up. To help the community to grow, why not share this page and join us on social networks (Facebook, Twitter, Instagram, Pinterest).</p>
                            </div>
                        </div>
                        <div class="about_sec_btn">
                            <a href="#">Find a yacht</a>
                        </div>
                    </div>
                </div>
        </div>
      </div>
      <div class="aboutus_boxes_section">
        <div class="text-center">
                <h2 class="ui-title">Morbi imperdiet leo eget nunc</h2>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                    <img src="{{ asset('app-assets/site_assets/img/decore04.png') }}" alt="photo"> </div>
                </div>
            </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="aboutus_inner_boxes">
                        <img src="{{ asset('app-assets/site_assets/img/multiple-users-silhouette.png') }}" alt="photo">
                        <h5>More than 1,100,000 members</h5>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="aboutus_inner_boxes">
                        <img src="{{ asset('app-assets/site_assets/img/boat-icon.png') }}" alt="photo">
                        <h5>More than 55,000 boats</h5>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="aboutus_inner_boxes">
                       <img src="{{ asset('app-assets/site_assets/img/boat-two-icon.png') }}" alt="photo">
                        <h5>More than 750 harbours</h5>
                    </div>
                </div>
            </div>
        </div>
      </div>

@endsection