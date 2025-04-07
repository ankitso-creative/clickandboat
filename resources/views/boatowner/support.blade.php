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
            <h1>All Your Bookings Support</h1>
        </div>
        {{-- <div class="no-booking-yet">
            <p>You haven't made a booking yet, <a href="#">search for a boat</a>.</p>
        </div> --}}
        <div class="card-section">
            <div class="card-sec-title">
                <h2>Booking Owner Lists</h2>
            </div>
            <div class="card-content">
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