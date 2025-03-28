@extends('layouts.front.common')
@section('meta')
<title>Locations</title>
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<!-- Banner Section -->
<section class="location_page_banner">
   <div class="location_banner_text">
      <h1>Locations
      </h1>
   </div>
</section>
<!-- /Banner Section -->
<!-- Location Filter Section -->
<section class="city_location">
   <div class="container">
      <div class="row">
         <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="city_box">
               <img src="{{ asset('app-assets/site_assets/img/Vedra.jpg') }}">
               <div class="city_box_text">
                  <h2>Es Vedrà</h2>
                  <p>Es Vedrà is a small, uninhabited rocky island off the southwest coast of Ibiza, Spain. Rising dramatically from the </p>
                  <div class="trip_date_text">
                     <span><a href="https://clickboat.so-creative-dev.org/single_location">View Location</a></span>
                     <span>March 19, 2025</span>
                  </div>
               </div>
               
            </div>
         </div>
         <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="city_box">
               <img src="{{ asset('app-assets/site_assets/img/cala-jondal.jpg') }}">
               <div class="city_box_text">
                  <h2>Cala Jondal</h2>
                  <p>Cala Jondal is one of Ibiza’s most exclusive and stylish beaches, located on the island’s south coast, just a short distance from Ibiza Town. Surrounded by pine-covered cliffs and crystal-clear turquoise waters, this cove is famous for its upscale beach clubs,</p>
                  <div class="trip_date_text">
                     <span><a href="#">View Location</a></span>
                     <span>March 19, 2025</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="city_box">
               <img src="{{ asset('app-assets/site_assets/img/cala.jpg') }}">
               <div class="city_box_text">
                  <h2>Cala Codolar & The Smugglers’ Cave</h2>
                  <p>Cala Codolar is a peaceful and secluded beach on Ibiza’s west coast, offering crystal-clear waters, golden sand, and a relaxed atmosphere. But beyond its natural beauty, it hides a secret gem</p>
                  <div class="trip_date_text">
                     <span><a href="#">View Location</a></span>
                     <span>March 19, 2025</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   @endsection