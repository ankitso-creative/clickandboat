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
        <h1>All Your Bookings</h1>
    </div>
    <div class="no-booking-yet">
        <p>You haven't made a booking yet, <a href="#">search for a boat</a>.</p>
    </div>
    <div class="booking_btns">
        <a class="upcoming_btn" href="">Upcoming</a>
        <a class="past_btn" href="">Past</a>
    </div>
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
                            <th>Booking Date</th>
                            <th>Boat Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Submitted On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>22-11-2024</td>
                            <td>Maxi Dolphin 100ft Finot Conq (2013) - NOMAD IV</td>
                            <td>£75</td>
                            <td>Boat</td>
                            <td>12-01-2024</td>
                            <td>
                                <div class="td-actions">
                                    <button class="btn btn-success"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection