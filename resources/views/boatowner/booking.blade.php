@extends('layouts.boatowner.common')
@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
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
    padding-bottom: 10px;
    padding-top: 10px;
}
 </style>
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
        @if(session('success'))
            <div class="alert alert-success" style="display: block;">
                <button class="close" data-close="alert"></button>
                <span> {{ session('success') }} </span>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" style="display: block;">
                <button class="close" data-close="alert"></button>
                <span> {{ session('error') }} </span>
            </div>
        @endif
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
                            <th>Transaction Id</th>
                            <th>Check In</th>
                            <th>Name</th>
                            <th>Amount Paid</th>
                            <th>Pending Paid</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Submitted On</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @if($results)
                            @foreach($results as $result)
                                @php
                                    $listing = App\Models\Admin\Listing::where('id',$result->listing_id)->first();
                                    $symble = priceSymbol($listing->currency);
                                    $amountPaid = getAmountWithoutSymble($result->amount_paid,$result->currency,$listing->currency);
                                    $pendingAmount = getAmountWithoutSymble($result->pending_amount,$result->currency,$listing->currency);
                                    $total = getAmountWithoutSymble($result->total,$result->currency,$listing->currency);
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $result->payment_intent_id }}</td>
                                    <td>{{ $result->check_in }}</td>
                                    <td>{{ $result->user->name }}</td>
                                    <td>{{ $symble.round($amountPaid) }}</td>
                                    <td>{{ $symble.round($pendingAmount) }}</td>
                                    <td>{{ $symble.round($total) }}</td>
                                    <td>{{ $result->payment_status }}</td>
                                    <td>{{ $result->created_at }}</td>
                                    <td>
                                        <div class="td-actions">
                                            <a class="btn btn-success" href="{{ route('boatowner.booking.edit', $result->id) }}"><i class="fas fa-edit"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {{ $results->appends(request()->all())->links('pagination::default') }}
            </div>
        </div>
    </div>
</div>
@endsection