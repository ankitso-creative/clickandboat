@extends('layouts.customer.common')

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
            <div class="recent_message_box">
                <h1>Recent Message</h1>
                <div class="no_message_box">
                    <p>You have no messages.</p>
                </div>
            </div>
        </div>
@endsection
