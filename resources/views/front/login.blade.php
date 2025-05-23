@extends('layouts.front.common')

@section('meta')
    <title>Manage Users</title>
@endsection
@section('css')
    
@endsection
@section('js')
<script>
    $(document).on('click','#togglePassword', function () {
        let passwordField = $('#user-password');
        let type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        
        $(this).html(type === 'password' ? '<i class="fa-solid fa-eye"></i>' : '<i class="toggle-password fa fa-fw fa-eye-slash"></i>');
    });
</script>
@endsection
@section('content')
<style>
    .header{
        display: none !important;
    }
    .footer{
        display: none !important;
    }
    .header-video {
    position: relative;
    width: 100vw;
    height: 100vh;
    overflow: hidden;
}

#myVideo {
    width: 100vw;
    height: 100vh;
    object-fit: cover; /* Or use 'contain' if you want no cropping */
    object-position: center;
    display: block;
    background-color: black;
}

</style>
    <!-- end .b-title-page-->   
    <div class="l-main-content login_section login_sign_up_form">
        <div class="container">
        <div class="sing_upform_logo">
                <a href="{{ route('home') }}"><img src="{{ whiteLogoURL() }}"></a>
            </div>
            <div class="row">
                <div class="mx-auto col-md-12">
                <h2 class="text-center ui-title-inner">Login</h2>
                    <section class="section-form-contacts">
                        <h3>Welcome to my Boat Booker</h3>
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
                                <div id="togglePassword">
                                    <i class="fa-solid fa-eye"></i>
                                </div>
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