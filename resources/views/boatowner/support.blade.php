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
        box-shadow: none;
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
        @if(!$isMobile)
            <div class="no-booking-yet">
                <p>You haven't any message.</p>
            </div> 
        @endif
        @if($usersWithLastMessage && $isMobile)
            <div class="user-list-section">
                <ul>
                    @foreach($usersWithLastMessage as $userMessage)
                        @php 
                            $user = $userMessage['user'];
                            $message = $userMessage['message'];
                            $listingM = $userMessage['listing'];
                            
                            $image = $user->getFirstMediaUrl('profile_image');
                            if(!$image):
                                $image = 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
                            endif;
                        @endphp
                        <li class="">
                            <a href="{{ route('boatowner.message', ['receiver_id' => $user->id, 'slug' => $listingM->slug]) }}">
                                <div class="user-box-list">
                                    <div class="user-box-image">
                                        <img src="{{ $image }}" />
                                    </div>
                                    <div class="user-box-desc">
                                        <div class="user-title">
                                            <h2>{{ $user->name }}</h2>
                                            <span>{{ $message->created_at }}</span>
                                        </div>
                                        <div class="user-boat-name">
                                            <p>{{ $listingM->type  }} {{ $listingM->boat_name }}</p>
                                        </div>
                                        <div class="user-last-message">
                                            <p>{{ $message->message }} </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- <div class="card-section">
            <div class="card-sec-title">
                <h2>Booking Owner Lists</h2>
            </div>
            <div class="card-content booking-list-section">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Customer Name</th>
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
                                        $listing = $userMessage['listing']
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $listing->type  }} {{ $listing->boat_name }}</td>
                                        <td>
                                            <div class="td-actions">
                                                <a href="{{ route('boatowner.message', ['receiver_id' => $user->id, 'slug' => $listing->slug]) }}" class="btn"><i class="fas fa-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>
    
@endsection