@extends('layouts.customer.common')

@section('meta')
    <title>Dashboard - {{ config('app.name') }}</title>
@endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
@section('css')

@endsection
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@section('js')
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
    $( document ).ready(function() {
        $("#messages").animate({ scrollTop: $('#messages').height() }, "fast");
    });
    // $( document ).ready(function() {
    //     var receiver_id = $('form#message_form input[name="receiver_id"]').val();
    //     var csrfToken = $('meta[name="csrf-token"]').attr('content');
    //     setInterval(function()
    //     {
    //         $.ajax({
    //             url: "{{ route('customer.support.see-all-message') }}",
    //             type: "POST",
    //             data: { receiver_id: receiver_id },
    //             headers: {
    //                 'X-CSRF-TOKEN': csrfToken 
    //             },
    //             success: function(response) {
    //                 var resp = response;
    //                 if(resp.status == "success") {
    //                     $('.message ul').html(resp.html);
    //                     $(".message").animate({ scrollTop: $('.message ul').height() }, "fast");
    //                 }
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error("Error: " + status + " - " + error);
    //             }
    //         });
    //     },5000) 
    //         clearInterval(5000); 
    // });

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
    $(document).on('submit','#message_form', function(e) {
        e.preventDefault();
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
                    $('#messages .message').prepend(resp.html);
                    $("#messages .message").animate({ scrollTop: $('#messages div').height() }, "fast");
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
        <div class="message mCustomScrollbar" data-mcs-theme="minimal-dark">
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
                                        <small class="msg-time">10 Second Ago<?php echo $reply['created_on'] ?></small>
                                    </div>
                                </div>
                            </div>
                    @php
                        endforeach;
                    endif;
                @endphp
                <!--<li class="msg-day"><small>Wednesday</small></li>-->
                </div> 
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
        <div class="list-boat-sec">
            <div class="list-title">
                <h2>Your request regarding the boat of Audrey</h2>
            </div>
            <div class="list-boat-box">
                <div class="list-boat-img">
                    <img src="http://127.0.0.1:8000/app-assets/site_assets/img/image00076.jpg" alt="boat" class="img-fluid">
                </div>
                <div class="list-boat-text">
                    <h3>Maxi Dolphin 100ft Finot Conq</h3>
                    <span>2013</span><i class="fa-solid fa-circle"></i><a href="#">View the listing</a>
                    <p>Mediterranean Sea</p>
                </div>
            </div>
            <div class="list-boat-form">
                <!-- Form for dates -->
                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <div class="row sidebar_form">
                        <div class="p-0 col-md-6">
                            <div class="form-group">
                                <input type="date" id="checkin-date" name="checkin_date"
                                    class="form-control" placeholder="Check-in" />
                            </div>
                        </div>
                        <div class="p-0 col-md-6">
                            <div class="form-group">
                                <input type="date" id="checkout-date" class="form-control"
                                    name="checkout_date" placeholder="Check-out" />
                                <input type="hidden" id="days-val" value="" name="days_val" />
                            </div>
                        </div>
                    </div>
                    <div class="show-Price" id="show-Price-sec">
                        <p>Hire: <span id="hire">€47,143</span></p>
                        <p>Service Fee: <span id="service-fee">€45</span></p>
                        <p>APA (Advanced Provisioning Allowance): <span id="apa-fees">€0</span></p>
                        <p>Total: <span id="boat-total">€47,188</span></p>
                    </div>
                    <div class="d-flex flex-column">
                        <button class="btn book_btn">Book</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
@endsection
