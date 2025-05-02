@extends('layouts.customer.common')

@section('meta')
    <title>Dashboard - {{ config('app.name') }}</title>
@endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
@section('css')
<style>
    .main-dashboard {
        padding: 0px 20px 0px 2px !important;
    }
</style>
@endsection
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@section('js')
<script src="{{ asset('app-assets/site_assets/js/patterns.js') }}?ver=<?=time()?>"></script>
<script>

    $(document).ready(function() {
        var disable = [];
        flatpickr("#checkin-date", {
            inline: false,
            dateFormat: "d-m-Y",
            minDate: "today",
            disable: disable,
        });
        flatpickr("#checkout-date", {
            inline: false,
            dateFormat: "d-m-Y",
            minDate: "today",
            disable: disable,
        });
    })
    // $(document).ready(function(){
    //     var receiver_id = $('form#message_form input[name="receiver_id"]').val();
    //     var data = "receiver_id="+receiver_id;
    //     //var result = CallAjax('ajax/seen_notification', data);
    //     setInterval(function()
    //     {
    //         var result = CallAjax('ajax/see_all_message_request',data);
    //         if(result.status=="success")
    //         {
    //             $('.message ul').html(result.html);
    //             $('.mCustomScrollbar ul.message_sidebar').html(result.sidebar_html);
    //             $(".message").animate({ scrollTop: $('.message ul').height() }, "fast");
    //         }
    //     },5000) 
    //         clearInterval(5000); 
    // }); 
    $(document).on('keyup','input[name="message"]',function(){
        var message = $(this).val();
        var emailRegex = /[\w.-]+@[\w.-]+\.\w+/gi;
        var phoneRegex = /(\+?\d{1,4})?[\s.-]?\(?\d{2,4}\)?[\s.-]?\d{3,4}[\s.-]?\d{3,4}/g;
        var longNumberRegex = /\d{6,}/g;
        var dnsPattern = /(https?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- ./?%&=]*)?/i;
        if (emailRegex.test(message) || phoneRegex.test(message) || longNumberRegex.test(message) || dnsPattern.test(message)) {
            $('input[name="message"]').addClass('invalid-input');
            return;
        }
        else if(containsBlockedContent(message))
        {
            $('input[name="message"]').addClass('invalid-input');
            return;
        }
        else
        {
            $('input[name="message"]').removeClass('invalid-input');
            return;
        }
    })
    $( document ).ready(function() {
        $('#messages').animate({ scrollTop: $('#messages div.message').height() }, "fast");
    });
    $( document ).ready(function() {
        var receiver_id = $('form#message_form input[name="receiver_id"]').val();
        var slug = $('form#message_form input[name="slug"]').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        setInterval(function()
        {
            $.ajax({
                url: "{{ route('customer.support.see-all-message') }}",
                type: "POST",
                data: { receiver_id: receiver_id, slug: slug },
                headers: {
                    'X-CSRF-TOKEN': csrfToken 
                },
                success: function(response) {
                    var resp = response;
                    if(resp.status == "success") {
                        $('#messages div.message').html(resp.html);
                        $("#messages").animate({ scrollTop: $('#messages div.message').height() }, "fast");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + status + " - " + error);
                }
            });
        },5000) 
            clearInterval(5000); 
    });

    $(document).on('change','.file_upload',function()
    {
        var form = $(this).parents('form');
        var formData = new FormData(form[0]);

        var imgname  =  $('input[type=file]').val();
        $.ajax({
            url: "",
            dataType: "json",
            type: 'post', 
            data: formData, 
            contentType: false, 
            processData: false, 
            success: function (result) {
                if (result.status == "success") 
                {
                    $('.message').append(result.html);
                    $(".message").animate({ scrollTop: $('.message ul').height() }, "fast");
                } 
                
            },
        })
    }); 
    $(document).on('submit','#message_form', function(e) {
        e.preventDefault();
        var message = $('input[name="message"]').val();
        var emailRegex = /[\w.-]+@[\w.-]+\.\w+/gi;
        var phoneRegex = /(\+?\d{1,4})?[\s.-]?\(?\d{2,4}\)?[\s.-]?\d{3,4}[\s.-]?\d{3,4}/g;
        var longNumberRegex = /\d{6,}/g;
        var dnsPattern = /(https?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- ./?%&=]*)?/i;
        if (emailRegex.test(message) || phoneRegex.test(message) || longNumberRegex.test(message) || dnsPattern.test(message)) {
            $('input[name="message"]').addClass('invalid-input');
            return;
        }
        if(containsBlockedContent(message))
        {
            $('input[name="message"]').addClass('invalid-input');
            return;
        }
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('customer.support.send-message') }}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken 
            },
            success: function(response) {
                var resp = response;
                if(resp.status == "success") 
                {
                    $('#messages .message').append(resp.html);
                    $("#messages").animate({ scrollTop: $('#messages div.message').height() }, "fast");
                    $('#chat').val('');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error: " + status + " - " + error);
            }
        });
    });
</script>
@endsection

@section('content')
    <div class="col-lg-9 main-dashboard">
        <div class="message-text">
            <p>Any personal information supplied such as email addresses, phone numbers, social media & website links will be unable to be sent. Once a booking is made, personal information will be given.</p>
        </div>
        <div class="user-list-section">
            <ul>
                @if($usersWithLastMessage)
                    @foreach($usersWithLastMessage as $userMessage)
                        @php 
                            $user = $userMessage['user'];
                            $message = $userMessage['message'];
                            $listing = collect($user->listing)->filter(function($listing) use ($message) {
                                return $listing->id == $message['listing_id'];
                            })->first();
                            $aClass = '';
                            if($slug == $listing->slug):
                                $aClass = 'user-active';
                            endif;
                            $image = $user->getFirstMediaUrl('profile_image');
                            if(!$image):
                                $image = 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
                            endif;
                        @endphp
                        <li class="{{ $aClass }}">
                            <a href="{{ route('customer.message', $listing->slug) }}">
                                <div class="user-box-list">
                                    <div class="user-box-image">
                                        <img src="{{ $image }}" />
                                    </div>
                                    <div class="user-box-desc">
                                        <div class="user-title">
                                            <h2>{{ $user->name }}</h2>
                                            <span>{{ $message->created_at->format('d-m-Y') }}</span>
                                        </div>
                                        <div class="user-boat-name">
                                            <p>{{ $listing->type  }} {{ $listing->boat_name }}</p>
                                        </div>
                                        <div class="user-last-message">
                                            <p>{{ $message->message }} </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="message mCustomScrollbar" data-mcs-theme="minimal-dark">
            <div class="message-owner">
                <div class="message-avatar-box">
                    <div class="message-avatar-img">
                        @php 
                            $image = $receiver->getFirstMediaUrl('profile_image');
                            if(!$image):
                                $image = 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
                            endif;
                        @endphp
                        <img src="<?php echo $image?>" alt="user">
                    </div>
                    <div class="message-avatar-title">
                        <h3><?php echo $receiver->name?></h3>
                    </div>
                </div>
            </div>
            <div class="message-box" id="messages">
                <div class="message">
                    @php
                        if($replies): 
                            foreach($replies as $reply):
                                if($reply['sender_id'] == auth()->id()):
                                    $class = 'msg-right';
                                    $sub_class = 'msg-right-sub';
                                    $user_data = $sender;
                                else:
                                    $class = 'msg-left';
                                    $sub_class = 'msg-left-sub';
                                    $user_data = $receiver;
                                endif;
                                
                                if(empty($user_data->getFirstMediaUrl('profile_image'))):
                                    $user_image =  'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
                                else:
                                    $user_image = $user_data->getFirstMediaUrl('profile_image');
                                endif;
                                if($reply['message'])
                                {
                                    $message = $reply['message'];
                                }
                                else
                                {
                                    //$attachment_id = $reply['image'];
                                    //$name = $this->common_model->GetSingleValue(MEDIA_TABLE,'name', array('id' => $attachment_id));
                                    // $allowed = array('.jpg','.jpeg','.gif','.png');
                                    // if (in_array(strtolower(strrchr($name, '.')), $allowed)) {
                                    //     $message = '<a href="'.base_url('/uploads/'.$name).'"  target="_blank"><img class="msg_desc_img" style="width: 100px; height: 100px; object-fit:cover;" src="'.base_url('/uploads/'.$name).'"></a>';
                                    // }
                                    // else
                                    // {
                                    //     $message = '<a href="'.base_url('/uploads/'.$name).'" target="_blank"><img  class="msg_desc_img" src="'.base_url('assets/front/images/pdf-icon.png').'" style="width: 100px; height: 100px; object-fit:cover;"></a>';
                                    // }
                                }
                            @endphp
                                <div class="<?php echo $class?>">
                                    <div class="<?php echo $sub_class ?>">
                                        <div class="msg-avatar"><img src="<?php echo $user_image?>"></div>
                                        <div class="msg-content">
                                            <div class="msg-desc">
                                                <?php echo $message?>
                                            </div>
                                            <small class="msg-time">{{ Timeago($reply['created_at']) }}</small>
                                        </div>
                                    </div>
                                </div>
                            @php
                            endforeach;
                        endif;
                    @endphp
                <!--<li class="msg-day"><small>Wednesday</small></li>-->
                </div> 
                <form id="message_form">
                    {{-- <div class="upload-btn">
                        <a href="javascript:;" onclick="document.getElementById('msgInput').click();"><i class="fa-solid fa-paperclip"></i></a>
                        <input type="file" class="file_upload" id="msgInput" style="display:none" name="file" value="">
                    </div> --}}
                    <input type="hidden" name="receiver_id" value="<?php echo $receiver_id?>">
                    <input type="hidden" name="slug" value="<?php echo $slug?>">
                    <input type="text" name="message" placeholder="Type here..." id="chat">
                    <button class="btn-send" id="message_button"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
        
        <div class="list-boat-sec">
            <div class="list-title">
                <h2>Your request regarding the boat of {{ $receiver->name }}</h2>
            </div>
            <div class="list-boat-box">
                <div class="list-boat-img">
                    @php 
                        $image =  $listing->getFirstMediaUrl('cover_images');
                        if(!$image):
                            $image = 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
                        endif;
                        
                    @endphp
                    <img src="{{ $image }}" alt="boat" class="img-fluid">
                </div>
                <div class="list-boat-text">
                    <h3>{{ $listing->boat_name }}</h3>
                    <span>{{ $listing->construction_year }}</span><i class="fa-solid fa-circle"></i><a href="{{ route('singleboat', ['city' => $listing->city, 'type' => $listing->type, 'slug' => $listing->slug]) }}">View the listing</a>
                    <p>{{ $listing->city }}</p>
                </div>
            </div>
            @if($quotation)
                <div class="list-boat-form">
                    <!-- Form for dates -->
                    {{-- <form action="{{ route('checkout') }}" method="POST"> --}}
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <div class="row sidebar_form">
                            <div class="p-0 col-md-6">
                                <div class="form-group">
                                    <input type="text"  value="{{ $quotation->checkin }}" readonly name="checkin_date" class="form-control" placeholder="Check-in" />
                                </div>
                            </div>
                            <div class="p-0 col-md-6">
                                <div class="form-group">
                                    <input type="text"  value="{{ $quotation->checkout }}" readonly class="form-control" name="checkout_date" placeholder="Check-out" />
                                    <input type="hidden" name="quotation" value="{{ $quotationID }}">
                                    <input type="hidden" name="slug" value="<?php echo $listing->slug?>">
                                </div>
                            </div>
                        </div>
                        @php 
                            if($quotation->currency):
                                $symble = priceSymbol($quotation->currency);
                            else:
                                $symble = priceSymbol('USD');
                            endif;
                            $fuel_price = getAmountWithoutSymble($listing->fuel_price,$listing->currency,$quotation->currency);
                        @endphp
                        <div class="show-Price" id="show-Price-sec">
                            <p>Hire: <span id="hire">{{ $symble.$quotation->net_amount }}</span></p>
                            <p>Service Fee: <span id="service-fee">{{ $symble.$quotation->service_fee }}</span></p>
                            @if($listing->fuel_include == '1')
                                <p>Fuel Charges: <span id="service-fee">{{ $symble.$fuel_price }}</span></p>
                                <p>Total: <span id="boat-total" class="price-after">{{ $symble.$quotation->total + $fuel_price }}</span></p>
                            @else
                                <p>Total: <span id="boat-total">{{ $symble.$quotation->total }}</span></p>
                            @endif
                        </div>
                        <div class="d-flex flex-column">
                            @php
                                $userId = auth()->id();
                                $orderExists = App\Models\Order::where('user_id', $userId)->where('listing_id',$listing->id)->exists();
                                $orderID = App\Models\Order::where('user_id', $userId)->where('listing_id',$listing->id)->value('id');
                            @endphp
                            @if($orderExists)
                                <a href="{{ route('customer.booking.edit',$orderID) }}" class="btn book_btn">View Order</a>
                            @else
                                @if($quotation->status=='Accept')
                                    <button class="btn book_btn">Confirm And Pay</button>
                                @else
                                    <a class="btn book_btn">{{ $quotation->status }}</a>
                                @endif
                            @endif
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
