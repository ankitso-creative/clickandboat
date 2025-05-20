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
        <div class="container sing_upform_logo">
        <a href="{{ route('home') }}"><img src="{{ asset('app-assets/site_assets/img/myboatbooker-logo.webp') }}"></a>
            <div class="row">
                <div class="mx-auto col-md-12">
                <h2 class="text-center ui-title-inner">Forgot Password</h2>
                    <section class="section-form-contacts">
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
                                <div class="mb-4 text-success">{{ session('status') }}</div>
                            @endif
                        
                            <div class="text-center form-group">
                                <button class="btn-forgot" type="submit">Send Password Reset Link</button>
                            </div>
                        </form>
                    </section>
                    <!-- end .b-form-contact-->
                </div>
            </div>
        </div>
    </div>
    @endsection