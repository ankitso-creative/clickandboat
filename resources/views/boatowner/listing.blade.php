@extends('layouts.boatowner.common')
@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection
@section('css')

@endsection
@section('js')

@endsection
@section('content')
<div class="col-md-3">

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
                        if($result->status==1):
                            $checked = 'checked';
                        endif;
                    @endphp
                    <div class="col-lg-4">
                        <div class="card list_edit_card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ $image }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-text bold">{{ $result->boat_name }} - {{ $result->type }} {{ $result->manufacturer }} {{ $result->model }} </h5>
                            </div>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="{{ route('boatowner.listing.edit', $result->id) }}">Edit </a> 
                                {{-- <a href="#">Delete /</a> 
                                <a href="#">Preview listing</a> --}}
                            </li>
                            <li><div class="content active_inactive_btn">
                                <label class="switch m5">
                                    <input type="checkbox" {{ $checked }} class="change_status" Lid="{{ $result->id }}"> 
                                    <small></small>
                                </label>
                               </div>
                           </li>
                            </ul>
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