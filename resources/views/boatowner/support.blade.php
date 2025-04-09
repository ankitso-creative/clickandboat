@extends('layouts.boatowner.common')

@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
<style>
    .booking-list-section .td-actions .btn {
        background: #f9a126 !important;
        padding: 9px 15px;
        border: 1px solid #f9a126;
        color: #fff;
    }
    .booking-list-section .td-actions .btn:hover{
        background: #fff !important;
        color: #f9a126;
    }
    .booking-list-section .table thead th {
        white-space: nowrap;
        font-weight: 600;
        font-size: 17px;
        background: #323131;
        color: #fff;
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }
    .booking-list-section .table tbody tr td{
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
            <h1>All Your Bookings Support</h1>
        </div>
        {{-- <div class="no-booking-yet">
            <p>You haven't made a booking yet, <a href="#">search for a boat</a>.</p>
        </div> --}}
        <div class="card-section">
            <div class="card-sec-title">
                <h2>Booking Owner Lists</h2>
            </div>
            <div class="card-content booking-list-section">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Owner Name</th>
                                <th>Boat Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($usersWithLastMessage)
                                @foreach($usersWithLastMessage as $userMessage)
                                    @php 
                                        $user = $userMessage['user'];
                                        $message = $userMessage['message'];
                                        $listing = App\Models\Admin\listing::where('id', $message->listing_id)->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $listing->type  }} {{ $listing->boat_name }}</td>
                                        <td>
                                            <div class="td-actions">
                                                <a href="{{ route('boatowner.message', ['receiver_id' => $user->id, 'slug' => $listing->slug]) }}" class="btn btn-success"><i class="fas fa-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection