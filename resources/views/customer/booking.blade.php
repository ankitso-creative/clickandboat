@extends('layouts.customer.common')
@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
@section('css')
<style>
   .table thead th {
    white-space: nowrap;
    font-weight: 600;
    font-size: 17px;
    background: #323131;
    color: #fff;
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
    }
    .table tbody tr td {
        white-space: nowrap;
        vertical-align: middle;
        padding-bottom: 5px;
        padding-top: 5px;
    }
</style>
@endsection
@section('js')
@endsection
@section('content')
<div class="col-lg-9 main-dashboard">
    <div class="page-title">
        <h1>All Your Bookings</h1>
    </div>
    {{-- <div class="no-booking-yet">
        <p>You haven't made a booking yet, <a href="#">search for a boat</a>.</p>
    </div>
    <div class="pt-3 booking_btns">
        <a class="upcoming_btn" href="">Upcoming</a>
        <a class="past_btn" href="">Past</a>
    </div> --}}
    <div class="card-section">
        <div class="card-sec-title">
            <h2>Booking Places</h2>
        </div>
        <div class="card-content">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Transactions ID</th>
                            <th>CheckIn Date</th>
                            <th>CheckOut Date</th>
                            <th>Boat Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Submitted On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($results)
                            @foreach($results as $result)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $result->payment_intent_id }}</td>
                                    <td>{{ $result->check_in }}</td>
                                    <td>{{ $result->check_out }}</td>
                                    <td>Maxi Dolphin 100ft Finot Conq (2013) - NOMAD IV</td>
                                    <td>£{{ $result->amount_paid }}</td>
                                    <td>Boat</td>
                                    <td>{{ \Carbon\Carbon::parse($result->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="td-actions">
                                            <button class="btn btn-success"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection