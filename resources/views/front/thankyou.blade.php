@extends('layouts.front.common')

@section('meta')
<title>Manage Users</title>
@endsection
@section('css')
<style>
.header.header-slider {
    display: none;
}   
.footer {
    display: none;
}
.back_to_home_btn a {
    background: #f9a126;
    border: 1px solid #f9a126;
    padding: 10px 15px;
    display: block;
    width: 75%;
    border-radius: 15px;
    color: #fff;
    cursor: pointer;
    transition: 0.3s;
    text-transform: uppercase;
    outline: none;
    text-align: center;
    margin: 0px auto;
}
.back_to_home_btn a:hover{
    background: none;
    color: #f9a126;
    border: 1px solid #f9a126;
}
.thankyou_section i {
    font-size: 70px;
    color: #f9a126;
    padding: 15px 0px;
}
.thankyou_section {
    text-align: center;
}
.thankyou_section p {
    padding: 0 90px;
    padding-top: 10px;
    padding-bottom: 21px;
}
.thankyou_section h2 {
    font-size: 28px;
    text-align: center;
    text-transform: uppercase;
    padding-top: 40px;
    color: #000;
}
</style>
@endsection
@section('js')

@endsection
@section('content')
<section class="login_sign_up_form">
        <div class="container">
            <div class="sing_upform_logo">
                <img src="{{ whiteLogoURL() }}">
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="signup_form">
                        <h2>Thank you</h2>
                    </div>
                    <div class="thankyou_section">
                        <h2>Thank You! We Appreciate You!</h2>
                        <i class="fa-solid fa-face-smile"></i>
                        <p>Your request has been received. We truly appreciate your time and support!</p>
                    </div>
                    <div class="back_to_home_btn">
                        <a href="{{ route('home') }}">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection