@extends('layouts.front.common')

@section('meta')
    <title>Manage Users</title>
@endsection
@section('css')
    <style>
    .header{
        display: none !important;
    }
    .footer{
        display: none !important;
    }
</style>
@endsection
@section('js')
    <script>
        $('#password, #password_confirmation').on('input', function () {
            const password = $('#password').val();
            const confirmation = $('#password_confirmation').val();
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
            if (password !== confirmation) {
                errors.push("Password and confirmation do not match.");
            }

            $('#password-errors').html(errors.map(e => `<div style="color:red;">${e}</div>`).join(''));
        });
    </script>
@endsection
@section('content')
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
    <div class="l-main-content login_section">
        <div class="container">
            <div class="sing_upform_logo">
                <a href="{{ route('home') }}"><img src="{{ whiteLogoURL() }}"></a>
            </div>
            <div class="row">
                <div class="mx-auto col-md-12">
                    <h2 class="text-center ui-title-inner">Reset Password</h2>
                    <section class="section-form-contacts">
                        <div id="success"></div>
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                        
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required value="{{ old('email') }}">
                            </div>
                        
                            <div class="form-group">
                                <input type="password" id="password" class="form-control" placeholder="New Password" name="password" required>
                            </div>
                        
                            <div class="form-group">
                                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Confirm New Password" required>
                            </div>
                            <div id="password-errors"></div>
                            @if ($errors->any())
                                <div>
                                    @foreach($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif
                        
                            <div class="text-center form-group">
                                <button type="submit" class="login_btn">Reset Password</button>
                            </div>
                        </form>
                    </section>
                    <!-- end .b-form-contact-->
                </div>
            </div>
        </div>
    </div>
    @endsection