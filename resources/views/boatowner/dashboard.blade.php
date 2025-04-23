@extends('layouts.boatowner.common')

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
        <h1>Ahoy there Captain!</h1>
    </div>
    <div class="card-section user-dashboard_section">
        @if(!$userData->getFirstMediaUrl('profile_image'))
        <div class="dashboard_box_one">
            <div class="row">
                <div class="col-md-9">
                    <div class="dashboard_box_one_text">
                        <div class="box_percentage">
                            <p>+20%</p>
                        </div>
                        <div class="box_text">
                            <h3>Add a profile photo</h3>
                            <p>This will enable users to identify you more easily</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard_box_btns">
                        <a href="">Add a photo</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="dashboard_box_two">
            <div class="row">
                <div class="col-md-9">
                    <div class="dashboard_box_one_text">
                        <div class="box_percentage">
                            <p>+20%</p>
                        </div>
                        <div class="box_text">
                            <h3>Add a profile photo</h3>
                            <p>This will enable users to identify you more easily</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard_box_btns">
                        <a href="">Add a photo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="recent_message_box">
                <h1>Recent Message</h1>
                <div class="no_message_box">
                    <p>You have no messages.</p>
                </div>
            </div> -->
    <div class="dashbaord_detail_boxes">
        <div class="row dash_panel">
            <div class="col-sm-12 col-md-2 col-lg-3 panel">
                <div class="logo"><i class="fa-solid fa-sailboat"></i></div>
                <span class="label">Total Boat </span>
                <span class="value">20</span>
            </div>
            <div class="col-sm-12 col-md-2 col-lg-3 panel">
                <div class="logo">
                    <i class="fa-solid fa-sailboat"></i>
                </div>
                <span class="label">Total Customer</span>
                <span class="value">400</span>
            </div>
            <div class="col-sm-12 col-md-2 col-lg-3 panel">
                <div class="logo">
                    <i class="fa-solid fa-sailboat"></i>
                </div>
                <span class="label">Total Listing</span>
                <span class="value">270</span>
            </div>
            <div class="col-sm-12 col-md-2 col-lg-3 panel">
                <div class="logo">
                   <i class="fa-solid fa-sailboat"></i>
                </div>
                <span class="label">Total Bookings</span>
                <span class="value">12</span>
            </div>
        </div>
    </div>
</div>
@endsection