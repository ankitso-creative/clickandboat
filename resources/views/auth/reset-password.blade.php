@extends('layouts.front.common')

@section('meta')
    <title>Manage Users</title>
@endsection
@section('css')
    
@endsection
@section('js')
    
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