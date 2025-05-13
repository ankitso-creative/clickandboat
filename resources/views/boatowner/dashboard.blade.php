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
                            <a href="{{ route('boatowner.profile') }}">Add a photo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @php
        if(session()->has('currency_code')):
            $code = session('currency_code');
        else:
            $code = 'USD';
        endif;
        $symbol = priceSymbol($code);

    @endphp
    <div class="dashbaord_detail_boxes">
        <div class="row dash_panel">
            <div class="col-sm-12 col-md-2 col-lg-3 panel">
                <div class="logo"><i class="fa-solid fa-sailboat"></i></div>
                <span class="label">Total Boat</span>
                <span class="value">{{ $listingCount }}</span>
            </div>
            <div class="col-sm-12 col-md-2 col-lg-3 panel">
                <div class="logo">
                    <i class="fa-solid fa-sailboat"></i>
                </div>
                <span class="label">Total Bookings</span>
                <span class="value">{{ $ordersCount }}</span>
            </div>
            <div class="col-sm-12 col-md-2 col-lg-3 panel">
                <div class="logo">
                    <i class="fa-solid fa-sailboat"></i>
                </div>
                <span class="label">Total Amount Paid</span>
                <span class="value">{{ $symbol.$amountPaidAmount }}</span>
            </div>
            <div class="col-sm-12 col-md-2 col-lg-3 panel">
                <div class="logo">
                    <i class="fa-solid fa-sailboat"></i>
                </div>
                <span class="label">Total Pending Amount</span>
                <span class="value">{{ $symbol.$pendingAmount }}</span>
            </div>

            <div class="col-sm-12 col-md-2 col-lg-3 panel">
                <div class="logo">
                    <i class="fa-solid fa-sailboat"></i>
                </div>
                <span class="label">Total Amount</span>
                <span class="value">{{ $symbol.$totalAmount }}</span>
            </div>
            
        </div>
    </div>
</div>
@endsection