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
    <!-- end .b-title-page-->   
    <div class="l-main-content login_section">
        <div class="container">
        <div class="sing_upform_logo">
                <img src="{{ asset('app-assets/site_assets/img/Booker-Boat-Logo-V1-white.png') }}">
            </div>
            <div class="row">
                <div class="mx-auto col-md-12">
                <h2 class="text-center ui-title-inner">Login</h2>
                    <section class="section-form-contacts">
                        <h3>Welcome to Booker Boat</h3>
                        <!-- <p class="text-center">Nulla pariatur excepteur sint occaecat cupidatat no proident culpa qui officia des mollit anim id est lab orum ut perspiciatis unde omnis iste natuser sit volupta tem accusantium sed ipsum laudantium.</p> -->
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
                        <form class="text-center b-form-contacts ui-form" id="contactForm" action="{{ route('user_login') }}" method="post">
                            @csrf
                            <div class="text-left form-group">
                                <input class="form-control" id="user-email" type="email" name="email" placeholder="Email" value="{{ Session::get('email-user') , '' }}" />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-left form-group">
                                <input class="form-control" id="user-password" type="password" name="password" placeholder="Password" />
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="login_form_btns">
                                <button class="login_btn">Login</button>
                                <a class="btn-forgot" href="{{ route('password.request') }}">forgot-password</a>
                            </div>
                        </form>
                    </section>
                    <!-- end .b-form-contact-->
                </div>
            </div>
        </div>
    </div>
    @endsection