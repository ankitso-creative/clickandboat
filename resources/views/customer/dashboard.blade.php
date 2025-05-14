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
        @if(!$userData->getFirstMediaUrl('profile_image'))
            <div class="card-section user-dashboard_section">
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
                                <a href="{{ route('customer.profile') }}">Add a photo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(!isset($userData->profile) && empty($userData->profile))
            <div class="card-section user-dashboard_section">
                <div class="dashboard_box_two mb-2">
                    <div class="complete_profile_text">
                        <div class="profile_com_text">
                            <h2>Complete your profile to add important information.</h2>
                            <p>We need a few more details to serve you better.</p>
                        </div>
                        <a href="{{ route('customer.profile') }}">Finish</a>
                    </div> 
                </div>
            </div>
        @endif
        <div class="dashbaord_detail_boxes">
            <div class="row dash_panel">
                <div class="col-sm-12 col-md-2 col-lg-3 panel">
                    <div class="logo"><i class="fa-solid fa-sailboat"></i></div>
                    <span class="label">Total Order</span>
                    <span class="value">{{ App\Models\Order::where('user_id', $userData->id)->count() }}</span>
                </div>
                <div class="col-sm-12 col-md-2 col-lg-3 panel">
                    <div class="logo">
                        <i class="fa-solid fa-sailboat"></i>
                    </div>
                    <span class="label">Total Favourite Items</span>
                    <span class="value">{{ App\Models\FavoriteItem::where('user_id', $userData->id)->count() }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
