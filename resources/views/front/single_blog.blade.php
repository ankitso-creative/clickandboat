@extends('layouts.front.common')
@section('meta')
<title>Motorboat Quicksilver 675 Open 150hp</title>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection
<!-- Banner Section -->
<section class="blog_inner_banner">
    <div class="blog_inner_text_box">
        <p class="blog_text">Inspiration</p>
        {{-- <h1>A New Year’s Eve Yacht Party:<br>
            Celebrate in Style</h1> --}}
        <h1>{{ $result->title }}</h1>
        <p class="blog_pera">7 December 2024 / 4 minute read / May</p>
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
                {{-- <p>Sed venenatis, massa a malesuada placerat, augue mi dapibus felis, ac ultrices sapien purus euismod
                    purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vehicula, arcu non lacinia
                    volutpat, lorem lectus suscipit leo, id imperdiet risus risus sed risus. Proin rutrum vehicula nibh
                    a interdum. Aliquam vel elementum turpis. Praesent orci ante, pharetra et velit sit amet, faucibus
                    viverra est. Integer faucibus lacinia sem, ut posuere orci feugiat ut. Etiam eu quam risus. Cras et
                    ligula purus. In et massa sapien. Ut convallis lectus nisi. Duis massa lacus, aliquam at viverra a,
                    venenatis id magna. Quisque fermentum vestibulum neque a iaculis. Aliquam erat volutpat. Aenean nec
                    nulla sit amet ex tincidunt fringilla non sit amet tellus.<br><br>
                    Nulla turpis eros, tincidunt ut hendrerit sed, sagittis eget erat. Cras porta condimentum augue non
                    convallis. Phasellus eget laoreet lacus, a varius mauris. Morbi quis ipsum vitae lacus egestas
                    feugiat. Donec vitae arcu urna. Proin arcu ex, aliquam sit amet sapien in, varius cursus quam.
                    Mauris ac nisi nec mi rhoncus suscipit et ut dolor. Praesent euismod ullamcorper elit sodales
                    vulputate. Phasellus in sem aliquet, interdum libero nec, consectetur nisi.</p>
                <img src="{{ asset('app-assets/site_assets/img/blog-img-02.jpg') }}">
                <p>Etiam dignissim commodo justo ac bibendum. Ut auctor turpis non mauris vehicula consectetur. Nam
                    rhoncus molestie arcu a pretium. Proin consectetur venenatis nibh ut molestie. Maecenas rhoncus odio
                    vel dui fermentum, nec rhoncus sem imperdiet. Donec eu neque sed enim congue laoreet sed eget massa.
                    Sed et neque vitae enim interdum facilisis. Cras et urna tortor. Sed pellentesque ex eget diam
                    accumsan auctor. Proin auctor viverra pulvinar.<br><br>
                    Maecenas aliquam sem a turpis varius, vel bibendum augue commodo. In egestas ligula sit amet nulla
                    tempor suscipit. Quisque vel mauris eu sapien pellentesque laoreet. Ut convallis nulla vel tellus
                    elementum, sed ultricies nulla tincidunt. Integer vehicula sollicitudin ornare. Sed in sem dapibus,
                    aliquam quam ac, tincidunt eros. Praesent malesuada, enim a scelerisque vestibulum, risus urna
                    ultrices quam, et cursus nisl ipsum a eros. In nec nisl commodo, rhoncus libero et, tincidunt
                    turpis. Cras id congue sem. Vivamus nisl risus, iaculis ut lorem vel, porta lobortis lectus.</p>
                <img src="{{ asset('app-assets/site_assets/img/blog-img-03.jpg') }}">
                <p>Sed venenatis, massa a malesuada placerat, augue mi dapibus felis, ac ultrices sapien purus euismod
                    purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vehicula, arcu non lacinia
                    volutpat, lorem lectus suscipit leo, id imperdiet risus risus sed risus. Proin rutrum vehicula nibh
                    a interdum. Aliquam vel elementum turpis. Praesent orci ante, pharetra et velit sit amet, faucibus
                    viverra est. Integer faucibus lacinia sem, ut posuere orci feugiat ut. Etiam eu quam risus. Cras et
                    ligula purus. In et massa sapien. Ut convallis lectus nisi. Duis massa lacus, aliquam at viverra a,
                    venenatis id magna. Quisque fermentum vestibulum neque a iaculis. Aliquam erat volutpat. Aenean nec
                    nulla sit amet ex tincidunt fringilla non sit amet tellus.</p> --}}
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
                    <img src="{{ asset('app-assets/site_assets/img/blog-img-1.jpg') }}">
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
        <div class="row">
            <div class="col-md-12">
                <div class="comment_section">
                    <h5 class="comment_sec_title">0 comments</h5>
                    <ol class="comment-list">
                        <li>
                            <div class="comment_section_image_text">
                                <div class="comment_sec_img">
                                    <img
                                        src="https://secure.gravatar.com/avatar/932c8ea1b10749d281aff4113d5feb42?s=60&d=mm&r=g">
                                </div>
                                <div class="comment_sec_text">
                                    <h5 class="author_name">Abhishek</h5>
                                    <a href=""><time>20 March 2025 at 5 h 24 min</time></a>
                                    <p class="awaiting_content">Your comment is awaiting moderation.</p>
                                </div>
                            </div>
                            <div class="comment_content">
                                <p class="cus_comment_reply">Great</p>
                            </div>
                            <div class="commet_reply">
                                <a href="" class="comment_reply_btn">Reply</a>
                            </div>
                            <ol class="comment-list comment_reply_sec">
                                <li>
                                    <div class="comment_section_image_text">
                                        <div class="comment_sec_img">
                                            <img
                                                src="https://secure.gravatar.com/avatar/932c8ea1b10749d281aff4113d5feb42?s=60&d=mm&r=g">
                                        </div>
                                        <div class="comment_sec_text">
                                            <h5 class="author_name">Abhishek</h5>
                                            <a href=""><time>20 March 2025 at 5 h 24 min</time></a>
                                            <p class="awaiting_content">Your comment is awaiting moderation.</p>
                                        </div>
                                    </div>
                                    <div class="comment_content">
                                        <p class="cus_comment_reply">Great</p>
                                    </div>
                                    <div class="commet_reply">
                                        <a href="" class="comment_reply_btn">Reply</a>
                                    </div>
                                </li>
                            </ol>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Leave a Reply</h3>
                <p class="comment_form_pera">Your Email Address will not be published required Field are marked</p>
                <form>
                    <div class="row">
                        <div class="col-md-12 form-group comment_area">
                            <label for="exampleFormControlTextarea1">Comment*</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name*</label>
                                <input type="text" class="form-control" id="name" aria-describedby="name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email*</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group website_field">
                                <label for="exampleInputEmail1">Website</label>
                                <input type="text" class="form-control" id="website" aria-describedby="website">
                            </div>
                        </div>
                    </div>
                    <p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent"
                            name="wp-comment-cookies-consent" type="checkbox" value="yes"> <label
                            for="wp-comment-cookies-consent">Save my name, email, and website in this browser for the
                            next time I comment.</label></p>
                    <button type="submit" class="post_comment_btn">Post Comment</button>
                </form>
            </div>
        </div>
</section>
<!-- /Single blog form Section -->
@section('js')
@endsection