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
                <h1 class="b-title-page">Forgot Password</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="blog.html">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
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
                        <h2 class="ui-title-inner text-center">Forgot Password</h2>
                        <p class="text-center">Nulla pariatur excepteur sint occaecat cupidatat no proident culpa qui officia des mollit anim id est lab orum ut perspiciatis unde omnis iste natuser sit volupta tem accusantium sed ipsum laudantium.</p>
                        <div id="success"></div>
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email" class="form-control" required value="{{ old('email') }}">
                                  @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                         
                            @if(session('status'))
                                <div class="text-success mb-4">{{ session('status') }}</div>
                            @endif
                        
                            <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit">Send Password Reset Link</button>
                            </div>
                        </form>
                    </section>
                    <!-- end .b-form-contact-->
                </div>
            </div>
        </div>
    </div>
    @endsection