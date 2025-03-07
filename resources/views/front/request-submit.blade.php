@extends('layouts.front.common')

@section('meta')
<title>Contact</title>
@endsection
@section('css')

@endsection
@section('js')

@endsection
@section('content')
<section class="request_banner_section">
    <div class="request_banner_text">
        <h5>Help Center Booker Boat > Submit a request</h5>
        <h1>Submit a request</h1>
        <div id="search-wrapper">
            <i class="search-icon fas fa-search"></i>
            <input type="text" id="search" placeholder="Search...">
            <button id="search-button">Search</button>
        </div>
    </div>
</section>
<section class="request_submit_form_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Your Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection