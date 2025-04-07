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
      <h1>Explore Ibiza by Boat: All the best stops<br> for your ibiza boat trip
      </h1>
   </div>
</section>
<!-- /Banner Section -->
<!-- Location Filter Section -->
<section class="city_location">
   <div class="container">
      <div class="row">
         @if(count($results))
            @foreach ($results as $result) 
               <div class="col-sm-12 col-md-4 col-lg-4">
                  <div class="city_box">

                     <img src="{{ $result->getFirstMediaUrl('location_image') }}">

                     <div class="city_box_text">
                        <h2>{{ $result->name }}</h2>
                        <p>{{ substr(strip_tags($result->description),0,170) }}...</p>
                        <div class="trip_date_text">
                           <span><a href="{{ route('area',$result->slug) }}">View Location</a></span>
                           <span>{{ \Carbon\Carbon::parse($result->created_at)->format('F d, Y') }}</span>
                        </div>
                     </div>
                     
                  </div>
               </div>

            @endforeach
         @else
             <div class="col-sm-12 col-md-12 col-lg-12">
                 <p>Oops! No results found.</p>
             </div>
         @endif

      </div>
   </section>
   @endsection