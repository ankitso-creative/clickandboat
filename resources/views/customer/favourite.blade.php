@extends('layouts.customer.common')

@section('meta')
<title>Dashboard - {{ config('app.name') }}</title>
@endsection

@section('css')

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $(document).on('click','.favorite_item', function(){
                var list = $(this).attr('list');
                var self =  $(this)
                $.ajax({
                    url: "{{ route('ajax.favorite') }}",  
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        item_id: list,
                        _token: '{{ csrf_token() }}'  
                    },
                    success: function(response) {
                        if (response.success) 
                        {
                            if(response.action=='save')
                            {
                                self.html('<i class="fa-solid fa-heart"></i>');
                            }
                            else
                            {
                                self.parents('.single-item').remove();
                            }
                        } else
                        {
                            
                        }
                    },
                    error: function() 
                    {
                        
                    }
                });
            });
        })
    </script>
@endsection

@section('content')
<div class="col-lg-9 main-dashboard">
    <div class="page-title">
        <h1>Save your favorite products</h1>
    </div>
    <div class="fav_section">
        <div class="row">
       
            @if(count($results))
                @foreach ($results as $result) 
                    @php
                        $heart_html = '<div class="wishlist_icon not-login-user"><i class="fa-regular fa-heart"></i></div>';
                        if(Auth::check()):
                            $user = auth()->user();
                            if($user->role == 'customer'):
                                $isFavorited = $user->favoriteitems()->where('listing_id', $result->listing->id)->exists();
                                if(!$isFavorited):
                                    $heart_html = '<div class="wishlist_icon"><a href="javascript:;" list="'.$result->listing->id.'" class="favorite_item"><i class="fa-regular fa-heart"></i></a></div>';
                                else:
                                    $heart_html = '<div class="wishlist_icon"><a href="javascript:;" list="'.$result->listing->id.'" class="favorite_item"><i class="fa-solid fa-heart"></i></a></div>';
                                endif;
                            else:
                                $heart_html = '';
                            endif;
                        endif;
                    @endphp                                                                                                                                                                                                                                                                                 
                    <div class="col-sm-12 col-md-6 col-lg-4 single-item">
                        <div class="location_inner_box">
                            <a href="{{ route('singleboat', ['city' => $result->listing->city, 'type' => $result->listing->type, 'slug' => $result->listing->slug]) }}">
                                <img src="{{ $result->listing->getFirstMediaUrl('cover_images') ? $result->listing->getFirstMediaUrl('cover_images') : 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png' }}">
                            </a>
                            {!!  $heart_html !!} 
                            <a href="{{ route('singleboat', ['city' => $result->listing->city, 'type' => $result->listing->type, 'slug' => $result->listing->slug]) }}">
                                <div class="location_inner_main_box">
                                    <div class="location_inner_text">
                                        <h3>{{ $result->listing->city }}</h3>
                                        <p class="location_pera">{{ $result->listing->type }} {{ $result->listing->manufacturer }} {{ $result->listing->model }} sport 30 (2023)</p>
                                        <p class="people_pera">{{ $result->listing->capacity }} people · 30 hp · 5 m</p>
                                        <h5 class="location_price">From <span class="price_style">{{ getListingPrice($result->listing->slug) }}</span> / day</h5>
                                        <div class="location_facility">
                                            <ul>
                                                <li><svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M14.6666 6.66666C14.6666 4.99999 10.6666 2.66666 7.99998 2.66666C5.33331 2.66666 1.33331 4.99999 1.33331 6.66666C1.33331 7.56633 1.6247 8.466 2.20748 9.36568C4.13831 8.89966 6.06915 8.66666 7.99998 8.66666C9.89884 8.66666 11.7977 8.89201 13.6965 9.34271C14.3433 8.12733 14.6666 7.23531 14.6666 6.66666ZM7.99998 9.99999C9.77776 9.99999 11.5555 10.2222 13.3333 10.6667C12.2222 12.4444 10.4444 13.3333 7.99998 13.3333C5.55554 13.3333 3.77776 12.4444 2.66665 10.6667C4.44442 10.2222 6.2222 9.99999 7.99998 9.99999ZM7.99998 6.66666C8.55226 6.66666 8.99998 6.21894 8.99998 5.66666C8.99998 5.11437 8.55226 4.66666 7.99998 4.66666C7.44769 4.66666 6.99998 5.11437 6.99998 5.66666C6.99998 6.21894 7.44769 6.66666 7.99998 6.66666Z">
                                                        </path>
                                                    </svg>{{ $result->listing->skipper }}</li>
                                                <li><i class="fa-solid fa-trophy"></i> Super owner</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="location_review_box">
                                        <span>Flexible cancellation</span>
                                        <span><i class="fa-solid fa-star"></i> NEW</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <p>Oops! No results found.</p>
                </div>
            @endif
       
        </div>
    </div>
</div>
@endsection