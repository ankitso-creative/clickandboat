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
        $('#user-password').on('input', function () {
            const password = $('#user-password').val();
            const errors = [];

            if (password.length < 8) {
                errors.push("Password must be at least 8 characters.");
            }
            if (!/[a-z]/.test(password) || !/[A-Z]/.test(password)) {
                errors.push("Password must contain both uppercase and lowercase letters.");
            }
            if (!/[a-zA-Z]/.test(password)) {
                errors.push("Password must contain letters.");
            }
            if (!/[0-9]/.test(password)) {
                errors.push("Password must contain at least one number.");
            }
            if (!/[^a-zA-Z0-9]/.test(password)) {
                errors.push("Password must contain at least one symbol.");
            }
            $('#password-errors').html(errors.map(e => `<div style="color:red;">${e}</div>`).join(''));
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
    
</style>
    <!-- end .b-title-page-->
<section class="hero">
  <div class="video fade-in">
    <div class="video_background">
      <div class="video_wrapper">
        <iframe src="https://www.youtube.com/embed/z977gKXg1_k?controls=0&showinfo=0&rel=0&autoplay=1&mute=1&loop=1&playlist=z977gKXg1_k&modestbranding=1&playsinline=1
" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</section>
    <div class="l-main-content sign_up_form_section">
        <div class="container">
        <div class="sing_upform_logo">
                <a href="{{ route('home') }}"><img src="{{ whiteLogoURL() }}"></a>
            </div>
            <div class="row">
                <div class="mx-auto col-md-12">
                <h2 class="text-center ui-title-inner">Welcome to my boat booker</h2>
                    <section class="section-form-contacts">
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
                                <input class="form-control" id="user-email" type="email" name="email" placeholder="Email" value="{{ Session::get('email-user') , '' }}" />
                                @error('email')
                                    <span class="danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="user-fname" type="text" name="fname" placeholder="First Name" value="{{ old('fname') }}" />
                                @error('fname')
                                    <span class="danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="user-lname" type="text" name="lname" placeholder="Last Name" value="{{ old('lname') }}" />
                                @error('lname')
                                    <span class="danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="tel" id="phone" name="phone" placeholder="Telephone" value="{{ old('phone') }}" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="user-password" type="password" name="password" placeholder="Password" />
                                <div id="togglePassword">
                                    <i class="fa-solid fa-eye"></i>
                                </div>
                                <input value="boatowner" type="hidden" name="role">
                                
                                @error('password')
                                    <span class="danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div id="password-errors"></div>
                            <button type="submit" class="btn_singup">Register Your Boat</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div> 
@endsection