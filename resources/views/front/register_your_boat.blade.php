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
    
</style>
    <!-- end .b-title-page-->
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
                                <input class="form-control" type="tel" id="phone" name="phone" placeholder="Telephone" required>
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
                            <button type="submit" class="btn_singup">Register Your Boat</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div> 
@endsection