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
    
@endsection
@section('content')
    <!-- end .b-title-page-->   
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
                                <input type="password" class="form-control" placeholder="New Password" name="password" required>
                            </div>
                        
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm New Password" required>
                            </div>
                        
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