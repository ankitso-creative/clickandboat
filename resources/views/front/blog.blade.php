@extends('layouts.front.common')

@section('meta')
<title>Manage Users</title>
@endsection
@section('css')

@endsection
@section('js')

@endsection
@section('content')
<!-- Blog banner Section-->
<section class="blog_banner">
    <div class="blog_banner_text">
        <h5>Destination Information</h5>
        <h1>A short guide to the best Azores<br>
            islands to visit by boat</h1>
        <p>1 February / 2025</p>
        <a href="">View Post</a>
    </div>
</section>
<!-- /Blog banner Section-->
 <!-- Destination Info Section-->
<section class="destination_info_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="destination_info_text">
                    <p class="desti_small_heading">Destination Information</p>
                    <h2>Dream Cruise Routes for Foodies 2023/24</h2>
                    <p class="desti_date_pera">1 February / 2025</p>
                    <p class="desti_des">Rent a boat, set sail and enjoy the tastes of the world. Welcome to our Dream
                        Cruise Routes for Foodies!</p>
                    <a href="">View Post</a>
                </div>
            </div>
        </div>
    </div>
</section>
 <!-- /Destination Info Section-->
 <!-- Destination banner Section-->
<section class="destination_banner_img">
    <div class="conatiner">
        <div class="text-center col-md-12">
            <img src="{{ asset('app-assets/site_assets/img/blog-01.jpg') }}">
        </div>
    </div>
</section>
 <!-- /Destination banner Section-->
 <!-- Blog Section-->
<section class="blog_section">
    <div class="container">
    <?php
                    for ($i= 0; $i < 10; $i++) {                                                                                                                                                                                                                                                                                        
                    ?>
        <div class="row align-items-center">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="blog_img">
                    <img src="{{ asset('app-assets/site_assets/img/blog-02.jpg') }}">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="blog_text_box">
                    <p class="blog_teg">Featured Posts: The Latest / News Inspiration</p>
                    <h2>Sailing events to look
                        out for in 2025</h2>
                    <p class="blog_date">11 January 2025 / Felicie</p>
                    <p class="blog_des_pera">Every year, the boating world surprises and delights sailing fans around
                        the world with events, races and regattas. We’ve put together a short list of sailing events
                        we’ll be looking…</p>
                    <a href="#">View Post</a>
                </div>
            </div>
        </div>
        <?php
                        }
                        ?>
    </div>
<!-- /Blog Section-->    
 <!-- Pagination Section-->    
    <div class="location_pagination">
                    <div class="pagination">
                        <a href="#">&laquo;</a>
                        <a class="active" href="#">1</a>
                        <a  href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#">6</a>
                        <a href="#">&raquo;</a>
                    </div>
                </div>
</section>
 <!-- /Pagination Section-->
@endsection