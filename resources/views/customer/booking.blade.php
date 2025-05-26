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
                                        if($result->currency):
                                            $symble = priceSymbol($result->currency);
                                        else:
                                            $symble = priceSymbol('EUR');
                                        endif;
                                        $userId = auth()->id();
                                        $exist = App\Models\ListingReview::where('user_id',$userId)->where('listing_id',$listing->id)->exists();
                                        $isWithin7Days = false;
                                        if ($result->created_at) {
                                            $isWithin7Days = Illuminate\Support\Carbon::parse($result->created_at)->gt(Illuminate\Support\Carbon::now()->subDays(7));
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $result->payment_intent_id }}</td>
                                        <td>{{ $result->check_in }}</td>
                                        <td>{{ $result->check_out }}</td>
                                        <td>{{ $listing->boat_name }}</td>
                                        <td>{{ $symble.$result->amount_paid }}</td>
                                        <td>{{ $symble.$result->pending_amount }}</td>
                                        <td>{{ $symble.$result->total }}</td>
                                        <td>{{ $result->payment_status }}</td>
                                        <td>{{ \Carbon\Carbon::parse($result->created_at)->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="td-actions">
                                                <a class="btn btn-success" href="{{ route('customer.booking.edit',$result->id) }}"><i class="fas fa-edit"></i></a>
                                                @if($result->payment_status == 'Completed' && !$exist && $isWithin7Days)
                                                    <a class="btn btn-success" href="{{ route('customer.addreview',$listing->slug) }}"><i class="fas fa-star"></i></a>
                                                @endif
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