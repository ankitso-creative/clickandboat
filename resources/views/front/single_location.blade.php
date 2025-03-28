@extends('layouts.front.common')
@section('meta')
<title>Locations</title>
@endsection
@section('css')

@endsection
@section('js')

@endsection
@section('content')
<section class="city_page_banner">
   <div class="city_banner_text">
      <h1>{{ $result->name }}</h1>
   </div>
</section>
<section class="city_page_text">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            {!!  $result->description !!}
         </div>
      </div>
   </div>
</section>
@endsection