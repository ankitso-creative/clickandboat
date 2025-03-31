@extends('layouts.front.common')

@section('meta')
    <title>Manage Users</title>
@endsection
@section('css')
    
@endsection
@section('js')
    
@endsection
@section('content')
<section class="about_banner_section">
    <div class="about_banner_text">
        <p>About Booker Boat</p>
        <h1>Who we are</h1>
    </div>
</section>
<section class="about_content_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center about_text_block">
                    <h2>About Booker Boat</h2>
                    <p class="about_small_text">the leading professional and boat hire company</p>
                    <h3>In the beginning</h3>
                    <p>In ac nunc in metus mattis molestie. Etiam suscipit enim id nulla dapibus vehicula. Nullam bibendum rhoncus bibendum. Phasellus vestibulum metus ex, quis efficitur ligula rutrum eu. Maecenas vehicula eget ex gravida blandit. Nunc lacinia lobortis felis. Suspendisse venenatis ultricies cursus. Praesent arcu leo, faucibus a euismod sit amet, porttitor nec felis. Etiam et volutpat ex. Maecenas nec libero sed diam scelerisque rhoncus vel nec mauris. In non nisl in mi aliquam finibus in quis est. Vivamus vestibulum, libero sed feugiat porttitor, odio ligula elementum urna, a laoreet risus velit at lorem. </p>
                    <h3 class="about_sec_heading">The professional and yacht charter platform</h3>
                    <p>Nunc vulputate diam ultrices, ornare mi ac, lacinia dolor. Proin ut turpis lectus. Duis vitae magna et risus dictum cursus. In vitae magna in metus volutpat egestas. Sed ornare felis eget ex tincidunt, sed condimentum ex malesuada. Nulla euismod tortor sed lorem consequat vulputate. Sed tempus purus quis tristique porttitor. Integer aliquam sapien et justo elementum pretium. Praesent in nisi in magna semper pretium.</p><br>
                    <p>Vestibulum euismod posuere vulputate. Fusce a nunc sit amet mauris vehicula lacinia. Mauris in efficitur turpis. Vestibulum at volutpat metus. Nulla efficitur sollicitudin facilisis. Aliquam erat volutpat. Duis eget aliquam turpis.</p>
                </div>
            </div>
        </div>
        <div class="pt-5 row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="about_sec_img">
                    <img src="{{ asset('app-assets/site_assets/img/about-us-img-01.jpg') }}">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="about_sec_img">
                    <img src="{{ asset('app-assets/site_assets/img/about-us-img-02.jpg') }}">
                </div>
            </div>
        </div>
        <div class="about_find_boat">
            <a  href="">Find a Boat</a>
        </div>
    </div>
</section>
<section class="about_slider">
    <div class="fluid-container ">
    <div class="row">
        <div class="about_sliders col-md-12">
            <div class="about_slide col-md-4">
                <div class="about_slider_box ">
                    <img src="{{ asset('app-assets/site_assets/img/about-icon-1.png') }}">
                    <h3>IMore than
                    1,100,000 members</h3>
                </div>
            </div>
            <div class="about_slide col-md-4">
                <div class="about_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/about-icon-2.png') }}">
                    <h3>More than
                    55,000 boats</h3>
                </div>
            </div>
            <div class="about_slide col-md-4">
                <div class="about_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/about-icon-3.png') }}">
                    <h3>More than
                    750 harbours</h3>
                </div>
            </div>
            <div class="about_slide col-md-4">
                <div class="about_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/about-icon-4.png') }}">
                    <h3>More than
                    560165 client reviews</h3>
                </div>
            </div>
            <div class="about_slide col-md-4">
                <div class="about_slider_box">
                    <img src="{{ asset('app-assets/site_assets/img/about-icon-1.png') }}">
                    <h3>IMore than
                    1,100,000 members</h3>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section class="about_zigzag_section">
    <div class="row align-items-center">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="about_insurance_box">
                <img src="{{ asset('app-assets/site_assets/img/about-us-insurance-img.jpg') }}">
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="about_insurance_text">
                <h2>Insurance</h2>
                <p>Aenean purus dolor, lobortis in sem eu, aliquam sollicitudin erat. Duis commodo non ante sit amet tristique. Quisque sit amet commodo lectus, et laoreet erat. Etiam bibendum enim augue, in fringilla nibh vestibulum a. Cras sit amet interdum ex. Integer nibh tortor, iaculis eget suscipit placerat, rutrum et augue. Suspendisse fermentum sed nibh et mollis. Ut ut ultrices enim. Duis quis porta sapien, sit amet elementum augue.</p>
            </div>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="about_insurance_text">
                <h2>Cummunity</h2>
                <p>Aenean purus dolor, lobortis in sem eu, aliquam sollicitudin erat. Duis commodo non ante sit amet tristique. Quisque sit amet commodo lectus, et laoreet erat. Etiam bibendum enim augue, in fringilla nibh vestibulum a. Cras sit amet interdum ex. Integer nibh tortor, iaculis eget suscipit placerat, rutrum et augue. Suspendisse fermentum sed nibh et mollis. Ut ut ultrices enim. Duis quis porta sapien, sit amet elementum augue.</p>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="about_insurance_box">
                <img src="{{ asset('app-assets/site_assets/img/about-us-insuranceimg-02.jpg') }}">
            </div>
        </div>
    </div>
</section>
        
@endsection