@extends('layouts.front.common')
@section('meta')
<title>Motorboat Quicksilver 675 Open 150hp</title>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection
@section('js')

@endsection
@section('content')
    <!-- Banner Section -->
    <section class="blog_inner_banner" style="background-image: url('{{ $result->getFirstMediaUrl('blog_image') }}')">
        <div class="blog_inner_text_box">
            <p class="blog_text">Inspiration</p>
            {{-- <h1>A New Year’s Eve Yacht Party:<br>
                Celebrate in Style</h1> --}}
            <h1>{{ $result->title }}</h1>
            <p class="blog_pera">{{ \Carbon\Carbon::parse($result->created_at)->format('d F Y') }} / 4 minute read / May</p>
            <ul class="blog_banner_social_media">
                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-google-plus-g"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-pinterest"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                <li><a href="#"><i class="fa-regular fa-envelope"></i></a></li>
            </ul>
        </div>
    </section>
    <!-- /Banner Section -->
    <!-- Blog text images section -->
    <section class="inner_blog_text_section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $result->description !!}
                </div>
            </div>
        </div>
    </section>
    <!-- /Blog text images section -->
    <!-- next trip Section -->
    <section class="next_trip_section single_blog_trip">
        <h2>You May Also Like</h2>
        <div class="container-fluid">
            <div class="row">
                @if($relatedBlogs)
                @foreach($relatedBlogs as $relatedBlog)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="next_trip_box">
                        <img src="{{ $relatedBlog->getFirstMediaUrl('blog_image') }}">
                        <div class="next_trip_text">
                            <h3>{{ $relatedBlog->title }}</h3>
                            <p>{{ substr(strip_tags($relatedBlog->description),0,170) }}...</p>
                            <div class="trip_date_text">
                                <span><a href="{{ route('single-blog',$relatedBlog->slug) }}">View Post</a></span>
                                <span>{{ \Carbon\Carbon::parse($relatedBlog->created_at)->format('F d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- /next trip Section -->
    <!-- Single blog form Section -->
    <section class="single_blog_comment_section">
        <div class="container">
            @if(count($result->comments))
            <div class="row">
                <div class="col-md-12">
                    <div class="comment_section">
                        <h5 class="comment_sec_title">{{ count($result->comments) }} comments</h5>
                        <ol class="comment-list">
                            @foreach($result->comments as $comment)
                                <li>
                                    <div class="comment_section_image_text">
                                        <div class="comment_sec_img">
                                            <img src="https://secure.gravatar.com/avatar/932c8ea1b10749d281aff4113d5feb42?s=60&d=mm&r=g">
                                        </div>
                                        <div class="comment_sec_text">
                                            <h5 class="author_name">{{ $comment->name }}</h5>
                                            <a href=""><time>{{ \Carbon\Carbon::parse($comment->created_at)->format('d F Y \a\t H \h i \m\i\n') }}</time></a>
                                        </div>
                                    </div>
                                    <div class="comment_content">
                                        <p class="cus_comment_reply">{{ $comment->message }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <h3>Leave a Reply</h3>
                    <p class="comment_form_pera">Your Email Address will not be published required Field are marked</p>
                    <form id="blog-comment">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 form-group comment_area">
                                <label for="exampleFormControlTextarea1">Comment*</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="comment" rows="4" required></textarea>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name*</label>
                                    <input type="text" class="form-control" id="name" aria-describedby="name" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email*</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Website</label>
                                    <input type="text" class="form-control" id="website" aria-describedby="website" name="website">
                                    <input type="hidden" name="slug" value="{{ $result->slug }}">
                                </div>
                            </div>
                        </div>
                        <p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"> 
                            <label for="wp-comment-cookies-consent">Save my name, email, and website in this browser for the next time I comment.</label>
                        </p>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert d-none">
                                    <button class="close" data-close="alert"></button>
                                    <span class="message"></span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="post_comment_btn">Post Comment</button>
                    </form>
                </div>
            </div>
    </section>
@endsection
