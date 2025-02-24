@extends('layouts.front.common')

@section('meta')
    <title>Manage Users</title>
@endsection
@section('css')
    
@endsection
@section('js')
    
@endsection
@section('content')
<style>
    .header{
        display: none !important;
    }
    .footer{
        display: none !important;
    }
</style>
    <!-- <div class="section-title-page area-bg area-bg_dark area-bg_op_60">
        <div class="area-bg__inner">
            <div class="container text-center">
                <h1 class="b-title-page">Register</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="blog.html">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Register</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div> -->
    <!-- end .b-title-page-->
    <!-- <div class="l-main-content">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-md-6">
                    <section class="section-form-contacts">
                        <h2 class="text-center ui-title-inner">Sign Up</h2>
                        <p class="text-center">Nulla pariatur excepteur sint occaecat cupidatat no proident culpa qui officia des mollit anim id est lab orum ut perspiciatis unde omnis iste natuser sit volupta tem accusantium sed ipsum laudantium.</p>
                        <div id="success"></div>
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
                        <form class="text-center ui-form" action="{{ route('do_register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" id="user-email" type="email" name="email" placeholder="Email" />
                                @error('email')
                                    <span class="danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="user-fname" type="text" name="fname" placeholder="First Name" />
                                @error('fname')
                                    <span class="danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="user-lname" type="text" name="lname" placeholder="Last Name" />
                                @error('lname')
                                    <span class="danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="user-password" type="password" name="password" placeholder="Password" />
                                @error('password')
                                    <span class="danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div> -->
    <section class="login_sign_up_form">
        <div class="container">
            <div class="sing_upform_logo">
                <img src="{{ asset('app-assets/site_assets/img/Booker-Boat-Logo-V1-white.png') }}">
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="signup_form">
                        <h2>Log in or sign up</h2>
                    </div>
                    <div class="singup_welcome_section">
                        <h2>Welcome to Booker Boat</h2>
                        <form>
                            <div class="form-group">
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                            </div>
                            <button type="submit" class="register_btn">Continue</button>
                            <p class="form_or_text">Or</p>
                        </form>
                    </div>
                    <div class="form_signup_other_option">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <a href="#"><img src="{{ asset('app-assets/site_assets/img/signup-facebookicom.png') }}"> Continue with Facebook</a>
                            </div>
                            <div class="col-md-4">
                                <a href="#"><img src="{{ asset('app-assets/site_assets/img/signup-gooleicon.png') }}"> Continue with Google</a>
                            </div>
                            <div class="col-md-4">
                                <a href="#"><img src="{{ asset('app-assets/site_assets/img/signup-appleiconpng.png') }}"> Continue with Apple</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection