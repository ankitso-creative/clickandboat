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
                <h1>Dashboard</h1>
            </div>
            <div class="card-section user-dashboard_section">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="user_dashboard_box">
                            <div class="user_icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="user_numbers">
                                <p>Total Customers</p>
                                <h5>1005</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="user_dashboard_box">
                            <div class="user_icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="user_numbers">
                                <p>Favourite Items</p>
                                <h5>1005</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="user_dashboard_box">
                            <div class="user_icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="user_numbers">
                                <p>Total Customers</p>
                                <h5>1005</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
