@extends('layouts.boatowner.common')

@section('meta')
    <title>Dashboard - {{ config('app.name') }}</title>
@endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
<style>
.main-dashboard {
    padding: 0px 20px 0px 2px !important;
}
</style>
@section('css')

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
    $(document).ready(function(){
        var receiver_id = $('form#message_form input[name="receiver_id"]').val();
        var slug = $('form#message_form input[name="slug"]').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        setInterval(function()
        {
            $.ajax({
                url: "{{ route('boatowner.support.see-count-message') }}",
                type: "POST",
                data: { receiver_id: receiver_id, slug: slug },
                headers: {
                    'X-CSRF-TOKEN': csrfToken 
                },
                success: function(response) {
                    var resp = response;
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + status + " - " + error);
                }
            });
        },5000) 
            clearInterval(5000); 
    }); 
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
                url: "{{ route('boatowner.support.see-all-message') }}",
                type: "POST",
                data: { receiver_id: receiver_id, slug: slug },
                headers: {
                    'X-CSRF-TOKEN': csrfToken 
                },
                success: function(response) {
                    var resp = response;
                    if(resp.status == "success") {
                        $('#messages div.message').html(resp.html);
                        $('#messages').animate({ scrollTop: $('#messages div.message').height() }, "fast");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + status + " - " + error);
                }
            });
        },5000) 
            clearInterval(5000); 
    });

    $(document).on('change','.file_upload',function(){
        
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
    $(document).on('keyup','input[name="message"]',function(){
        var message = $(this).val();
        var cleanedMessage = message.replace(/\s+/g, '');
        var emailRegex = /[\w.-]+\s*@\s*[\w.-]+\s*\.\s*\w+/gi;
        var phoneRegex = /(\+?\d{1,4})?[\s\-.\(]*\d{2,4}[\s\-.\)]*\d{3,4}[\s\-.\)]*\d{3,4}/g;
        var longNumberRegex = /\d{4,}/g;
        var dnsPattern = /(https?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- ./?%&=]*)?/i;
        var digitMatches = message.match(/\d/g);
        var totalDigits = digitMatches ? digitMatches.length : 0;
        if (emailRegex.test(cleanedMessage) || phoneRegex.test(message) || longNumberRegex.test(message) || dnsPattern.test(cleanedMessage) || totalDigits > 4 ) {
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
    $(document).on('submit','#message_form', function(e) {
        e.preventDefault();
        var message = $('input[name="message"]').val();
        var cleanedMessage = message.replace(/\s+/g, '');
        var emailRegex = /[\w.-]+\s*@\s*[\w.-]+\s*\.\s*\w+/gi;
        var phoneRegex = /(\+?\d{1,4})?[\s\-.\(]*\d{2,4}[\s\-.\)]*\d{3,4}[\s\-.\)]*\d{3,4}/g;
        var longNumberRegex = /\d{4,}/g;
        var dnsPattern = /(https?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- ./?%&=]*)?/i;
        var digitMatches = message.match(/\d/g);
        var totalDigits = digitMatches ? digitMatches.length : 0;
        if (emailRegex.test(cleanedMessage) || phoneRegex.test(message) || longNumberRegex.test(message) || dnsPattern.test(cleanedMessage) || totalDigits > 4) {
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
            url: "{{ route('boatowner.support.send-message') }}",
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
                    $('#messages div.message').append(resp.html);
                    $("#messages").animate({ scrollTop: $('#messages div.message').height() }, "fast");
                    $('#chat').val('');
                }
                else
                {
                    $('input[name="message"]').addClass('invalid-input');
                    return;
                }
            },
            error: function(xhr, status, error) {
                console.error("Error: " + status + " - " + error);
            }
        });
    });
    $(document).on('submit','#spcial-offer-form', function(e) {
        e.preventDefault();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('boatowner.support.spcial-offer-edit') }}",
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
                    $('#messages div.message').append(resp.html);
                    $("#messages").animate({ scrollTop: $('#messages div.message').height() }, "fast");
                    $('#chat').val('');
                    $('#sidebar-right').modal('hide');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error: " + status + " - " + error);
            }
        });
    });
    $(document).on('change','#special-offers',function(){
        var val = $(this).val();
        var price = $('#price-get').attr('pdata');
        var discountprice = (price*val)/100;
        var priceafterdiscount = price - discountprice;
        $('.price-after').html(priceafterdiscount);
    })
</script>
@endsection

@section('content')
    <div class="col-lg-9 main-dashboard">
        <div class="message-text">
            <p>Any personal information supplied such as email addresses, phone numbers, social media & website links will be unable to be sent. Once a booking is made, personal information will be given.</p>
        </div>
        @if(!$isMobile)
        <div class="user-list-section">
            <ul>
                @if($usersWithLastMessage)
                    @foreach($usersWithLastMessage as $userMessage)
                        @php 
                            $user = $userMessage['user'];
                            $message = $userMessage['message'];
                            $listingM = $userMessage['listing'];
                            $aClass = '';
                            if($slug == $listingM->slug):
                                $aClass = 'user-active';
                            endif;
                            $image = $user->getFirstMediaUrl('profile_image');
                            if(!$image):
                                $image = 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
                            endif;
                        @endphp
                        <li class="{{ $aClass }}">
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
                @endif
            </ul>
        </div>
        @endif
        <div class="message mCustomScrollbar" data-mcs-theme="minimal-dark">
            <div class="message-owner">
                <div class="message-avatar-box">
                    @php 
                        $image = $receiver->getFirstMediaUrl('profile_image');
                        if(!$image):
                            $image = 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
                        endif;
                    @endphp
                    <div class="message-avatar-img">
                        <img src="<?php echo $image?>" alt="user">
                    </div>
                    <div class="message-avatar-title">
                        <h3><?php echo $receiver->name?></h3>
                    </div>
                </div>
                {{-- <div class="message-avatar-link">
                    <a href="#">View Profile</a>
                </div> --}}
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
                    <input type="text" name="message" placeholder="type here..." id="chat">
                    <button class="btn-send" id="message_button"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
            </div>
            
        </div>
        <div class="list-boat-sec">
            <div class="list-title">
                <h2>This is to rent your motorboat {{ $receiver->name }}</h2>
            </div>
            <div class="list-boat-box">
                @php 
                    $image =  $listing->getFirstMediaUrl('cover_images');
                    if(!$image):
                        $image = 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
                    endif;
                    
                @endphp
                <div class="list-boat-img">
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
                                </div>
                            </div>
                        </div>
                        @php 
                            if($quotation->currency):
                                $symble = priceSymbol($listing->currency);
                            else:
                                $symble = priceSymbol('EUR');
                            endif;
                            $request['checkindate'] = $quotation->checkin;
                            $request['checkoutdate'] = $quotation->checkout;
                            $request['id'] = $quotation->listing_id;
                            $price = bookingPrice($request,$listing->currency);
                            if($quotation->days == 'half_day'):
                                $netAmount = $price['oneHalfDayPrice'];
                                $total = $price['oneHalfDayPrice'];
                                if($quotation->discount):
                                    $netAmountWD = $price['price'] * $quotation->discount / 100;
                                    $totalWD = $price['totalAmount'] * $quotation->discount / 100;
                                    $netAmount = $price['oneHalfDayPrice'] - $netAmountWD;
                                    $total = $price['oneHalfDayPrice'] - $totalWD;
                                else:
                                    $netAmount = $price['price'];
                                    $total = $price['totalAmount'];
                                endif;
                            else:
                                $netAmount = $price['price'];
                                $total = $price['totalAmount'];
                                if($quotation->discount):
                                    $netAmountWD = $price['price'] * $quotation->discount / 100;
                                    $totalWD = $price['totalAmount'] * $quotation->discount / 100;
                                    $netAmount = $price['price'] - $netAmountWD;
                                    $total = $price['totalAmount'] - $totalWD;
                                else:
                                    $netAmount = $price['price'];
                                    $total = $price['totalAmount'];
                                endif;
                            endif;
                            // if($quotation->discount):
                            //     $netAmountWD = $price['price'] * $quotation->discount / 100;
                            //     $totalWD = $price['totalAmount'] * $quotation->discount / 100;
                            //     $netAmount = $price['price'] - $netAmountWD;
                            //     $total = $price['totalAmount'] - $totalWD;
                            // else:
                            //     $netAmount = $price['price'];
                            //     $total = $price['totalAmount'];
                            // endif;
                        @endphp
                        <div class="show-Price" id="show-Price-sec">
                            <p>Hire: <span id="hire" class="price-after">{{ $symble.$netAmount }}</span></p>
                            <p>Service Fee: <span id="service-fee">{{ $symble.$quotation->service_fee }}</span></p>
                            <p>Total: <span id="boat-total">{{ $symble.$total }}</span></p>
                        </div>
                        @if($quotation->status == 'Pending')
                            <div class="d-flex flex-column">
                                <a class="btn book_pre_accept" href="{{ route('boatowner.support.update.quotation',$quotation->id) }}" >Accept booking</a>
                                <a class="btn book_personal" href="javascript:;" data-toggle="modal" data-target="#sidebar-right">Offer a discount</a>
                                <a class="btn book_refuse" href="{{ route('boatowner.support.cancel.quotation',$quotation->id) }}">Refuse the request</a>
                            </div>
                        @else
                            <div class="d-flex flex-column">
                                <a class="btn book_personal">{{ $quotation->status }}</a>
                            </div>
                        @endif
                    </form>
                </div>
            @endif
        </div>
        
    </div>


  <!-- Sidebar Right -->
    @if($quotation)
        <div class="modal fade right special-offers-modal" id="sidebar-right" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Special Offers</h4>
                    </div>
                    <div class="modal-body">
                        <form id="spcial-offer-form">
                            <div class="rental-box-sec">
                                <div class="rental-title">
                                    <h5>Rental</h5>
                                </div>
                                <div class="rental-feilds-box">
                                    <div class="row">
                                        <div class="pl-0 col-md-6">
                                            <div class="form-group">
                                                <label for="check-in">Check-in Date</label>
                                                <input type="text" class="form-control" value="{{ $quotation->checkin }}" name="check-in" id="check-in" placeholder="" readonly />
                                            </div>
                                        </div>

                                        <div class="pr-0 col-md-6">
                                            <div class="form-group">
                                                <label for="check-out">Check-out Date</label>
                                                <input type="text" class="form-control" value="{{ $quotation->checkout }}" name="check-out" id="check-out" placeholder="" readonly />
                                                <input type="hidden" value="{{ $quotation->id }}" name="quotation">
                                                <input type="hidden" value="{{ $listing->slug }}" name="locationslug">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="offer-separator">
                                <div class="rental-title">
                                    <h5>Prices</h5>
                                </div>
                                @php 
                                    if($quotation->currency):
                                        $symble = priceSymbol($listing->currency);
                                    else:
                                        $symble = priceSymbol('EUR');
                                    endif;
                                @endphp
                                <div class="rental-feilds-box">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="charter-sec">
                                                    <div class="charter-title"><p>Charter</p></div>
                                                    <div class="charter-price"><p>{{ $symble }}<span class="price-after">{{ $total }}</span></p></div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="check-in" class="offered-label">Offered extras</label>
                                                <div class="charter-sec">
                                                    <div class="charter-title"><p>Skipper</p></div>
                                                    <div class="charter-price"><p>€200</p></div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="check-in">Discount</label>
                                                <select class="form-control" name="discount" id="special-offers">
                                                    @for($d=0; $d <= 20; $d++)
                                                        <option value="{{ $d }}">{{ $d }}%</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="total-form-group">
                                                <div class="total-title"><h6>Total Price</h6></div>
                                                <div class="total-amount" id="price-get" pdata="{{ $total }}" ><p>{{ $symble }}<span class="price-after">{{ $total }}</span></p></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="confirm-btn btn">Send Special Offer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
