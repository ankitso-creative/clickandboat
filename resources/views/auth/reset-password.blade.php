@extends('layouts.front.common')

@section('meta')
    <title>Manage Users</title>
@endsection
@section('css')
    
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
    <div class="section-title-page area-bg area-bg_dark area-bg_op_60">
        <div class="area-bg__inner">
            <div class="container text-center">
                <h1 class="b-title-page">LOGIN</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="blog.html">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </nav>
                <!-- end .breadcrumb-->

            </div>
        </div>
    </div>
    <!-- end .b-title-page-->   
    <div class="l-main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <section class="section-form-contacts">
                        <h2 class="ui-title-inner text-center">Reset Password</h2>
                        <p class="text-center">Nulla pariatur excepteur sint occaecat cupidatat no proident culpa qui officia des mollit anim id est lab orum ut perspiciatis unde omnis iste natuser sit volupta tem accusantium sed ipsum laudantium.</p>
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
                        
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Reset Password</button>
                            </div>
                        </form>
                    </section>
                    <!-- end .b-form-contact-->
                </div>
            </div>
        </div>
    </div>
    @endsection