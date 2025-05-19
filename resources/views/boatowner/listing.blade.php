@extends('layouts.boatowner.common')
@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
@section('css')

@endsection
@section('js')

@endsection
@section('content')
    <div class="col-lg-3">
        <aside class="sidebar desktop_sidebar">
            <div class="user">
            <div class="user-avatar">
                <a href="#">
                <img src="{{ userImage() }}" alt="dejodo">
                </a>
            </div>
            <h3>{{ userName() }}</h3>
            </div>
            <ul>
                <li class="{{ $active=='dashboard' ? 'active':'' }}"><a href="{{ route('boatowner.dashboard') }}"><i class="fas fa-th"></i> Dashboard</a></li>
                <li class="{{ $active=='profile' ? 'active':'' }}"><a href="{{ route('boatowner.profile') }}"><i class="fas fa-user-circle"></i> Profile</a></li>
                <li class="{{ $active=='listing' ? 'active':'' }}"><a href="{{ route('boatowner.listing') }}"><i class="fa-solid fa-list"></i> Listing</a></li>
                <li class="{{ $active=='customers' ? 'active':'' }}"><a href="{{ route('boatowner.customers') }}"><i class="fa-solid fa-users"></i> Customers</a></li>
                <li class="{{ $active=='booking' ? 'active':'' }}"><a href="{{ route('boatowner.booking.index') }}"><i class="fas fa-clipboard-list"></i> Bookings</a></li>
                <li class="{{ $active=='support' ? 'active':'' }}"><a href="{{ route('boatowner.support')}}"><i class="fas fa-heart"></i> Messages</a></li>
                <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
    </div>
    <div class="col-lg-9 main-dashboard">
        <div class="row">
            <div class="col-md-12">
               <div class="page-title">
                    <h1>Your Listing</h1>
                    <span></span>
                </div> 
            </div>
            <div class="col-md-6">
                <div class="your_listing_search">
                    <div class="form-group has-search-right">
                        <input type="text" class="form-control" placeholder="Search" id="search-input">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="add_listing_btn"><a href="{{ route('boatowner.listing-add') }}" class="btn add_new_button"><i class="fas fa-plus"></i> Add New</a></div> 
            </div>
        </div>
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
       
        <div class="row your_listing_section" id="listing-section">
            @if($results)
                @foreach($results as $result)
                    @php
                        $image = $result->getFirstMediaUrl('cover_images');
                        if(!$image):
                            $image = 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
                        endif;
                        $checked = '';
                        $bannerText = '<p class="img_commet_text">Your listing is only viewable by you, it is not yet approved by admin. </p>';
                        if($result->status==1):
                            $checked = 'checked';
                            $bannerText = '';
                        endif;
                    @endphp
                    
                    <div class="col-lg-4">
                        <div class="card list_edit_card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ $image }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-text bold">{{ ucfirst($result->boat_name) }} {{ $result->type }} - {{ $result->manufacturer }} {{ $result->model }} </h5>
                            </div>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="{{ route('boatowner.listing.edit', $result->id) }}">Edit /</a> 
                                
                                <a href="{{ route('boatowner.preview', $result->id) }}" target="_blank">Preview</a>
                            </li>
                            {{-- <li><div class="content active_inactive_btn">
                                <label class="switch m5">
                                    <input type="checkbox" {{ $checked }} class="change_status" Lid="{{ $result->id }}"> 
                                    <small></small>
                                </label>
                               </div>
                           </li> --}}
                            </ul>
                            {!!  $bannerText !!}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <script>
        $(document).on('keyup','#search-input',function(){
            var formData = $(this).val();
            $.ajax({
                url: "{{ route('boatowner.listing-search') }}",
                type: 'POST',
                data: { search: formData },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.success) 
                    {
                        $('#listing-section').html(response.html);
                    } 
                    else 
                    {
                       $('.message').html(response.message);
                    }
                },
            });
        })
        $(document).on('click','.change_status',function(){
            var id = $(this).attr('Lid');
            var value = 0;
            if ($(this).prop('checked')) {
                value = 1;
            }
            $.ajax({
                url: "{{ route('boatowner.change-status') }}",
                type: 'POST',
                data: { value: value, id: id},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.success) 
                    {
                        $('#listing-section').html(response.html);
                    } 
                    else 
                    {
                       $('.message').html(response.message);
                    }
                },
            });
        })
    </script>
@endsection