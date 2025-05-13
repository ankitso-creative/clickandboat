@extends('layouts.front.common')

@section('meta')
<title>Contact</title>
@endsection
@section('css')

@endsection
@section('js')

@endsection
@section('content')
<section class="contact_banner_section">
    <div class="contact_banner_text">
        <h1>Contact Us</h1>
    </div>
</section>
<section class="contact_form_section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7">
                <div class="sec-title">
                    <span class="sub-title">Send us email</span>
                    <h2>Feel free to write</h2>
                </div>
                <form id="contact_form" name="contact_form" class="" action="{{ route('submitenquiry') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <input name="name" class="form-control" type="text" value="{{ old('name') }}" placeholder="Enter Name">
                                @error('name')<span class="required">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <input name="email" class="form-control required email" value="{{ old('email') }}" type="email" placeholder="Enter Email">
                                @error('email')<span class="required">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <input name="subject" class="form-control required" value="{{ old('subject') }}" type="text" placeholder="Enter Subject">
                                @error('subject')<span class="required">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <input name="phone" class="form-control" value="{{ old('phone') }}" type="text" placeholder="Enter Phone">
                                @error('phone')<span class="required">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea name="form_message" class="form-control required" rows="7" placeholder="Enter Message"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
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
                        </div>
                    </div>
                    <div class="mb-5 contact_btns">
                        <input name="form_botcheck" class="form-control" type="hidden" value="">
                        <button type="submit" class="mb-3 theme-btn btn-style-one mb-sm-0" data-loading-text="Please wait..."><span class="btn-title">Send message</span></button>
                    </div>
                </form>
            </div>
            <div class=" col-md-6 col-lg-5 contact_detail">
                <div class="sec-title">
                    <span class="sub-title">Need any help?</span>
                    <!-- <h2>Get in touch with us</h2>
                    <div class="text">Lorem ipsum is simply free text available dolor sit amet consectetur notted
                        adipisicing elit sed do eiusmod tempor incididunt simply dolore magna.</div> -->
                </div>
                <ul class="list-unstyled contact-details_info">
                    <li class="d-block d-sm-flex align-items-center ">
                        <div class="icon">
                           <i class="fa-regular fa-envelope"></i>
                        </div>
                        <div class="text">
                            <h6>Write email</h6>
                            <a href="mailto:info@myboatbooker.com">info@myboatbooker.com</a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</section>
<section class="contat_map_section">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39086102.69090007!2d-119.8093025!3d44.24236485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e1!3m2!1sen!2sin!4v1744779191137!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>
@endsection