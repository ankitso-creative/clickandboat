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
    <div class="section-title-page area-bg area-bg_dark area-bg_op_60">
        <div class="area-bg__inner">
            <div class="container text-center">
                <h1 class="b-title-page">Register Your Boat</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="blog.html">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Register Your Boat</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div> 
    <!-- end .b-title-page-->
    <div class="l-main-content">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-md-6">
                    <section class="section-form-contacts">
                        <h2 class="text-center ui-title-inner">test</h2>
                        <p class="text-center">Nulla pariatur excepteur sint occaecat cupidatat no proident culpa qui officia des mollit anim id est lab orum ut perspiciatis unde omnis iste natuser sit volupta tem accusantium sed ipsum laudantium.</p>
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
                                <input class="form-control" id="user-email" type="email" name="email" placeholder="Email" />
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
                                <input class="form-control" id="user-password" type="password" name="password" placeholder="Password" />
                                <input value="boatowner" type="hidden" name="role">
                                @error('password')
                                    <span class="danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Register Your Boat</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div> 
@endsection