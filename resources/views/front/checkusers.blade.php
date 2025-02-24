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
                        <form  action="{{ route('checkemail') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <input value="{{$role}}" type="hidden" name="role">
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