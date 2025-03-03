@extends('layouts.front.common')

@section('meta')
<title>Manage Users</title>
@endsection
@section('css')

@endsection
@section('js')

@endsection
@section('content')
<!-- Help Banner Section -->
<section class="help_banner_section">
    <div class="help_banner_text">
        <h5>Welcome to our Help Center</h5>
        <h1>How can we help you?</h1>
        <p>Search our knowledge base for answers to more than 150 questions !</p>
        <div id="search-wrapper">
            <i class="search-icon fas fa-search"></i>
            <input type="text" id="search" placeholder="Search...">
            <button id="search-button">Search</button>
        </div>
        <p><span class="help_text_style">Popular searches… :</span> Contact Booker Boat, payment, insurance,
            cancellation</p>
    </div>
</section>
<!-- /Help Banner Section -->
<!-- Knowledge Section -->
<section class="knowledge_section">
    <div class="container">
        <div class="text-center knowlwdge_heaidng">
            <h2>Knowledge base</h2>
        </div>
        <div class="row">
            <div class="mx-auto col-lg-9">
                <!-- Accordion -->
                <div id="accordionExample" class="shadow accordion">
                    <!-- Accordion item 2 -->
                    <div class="card">
                        <div id="headingTwo" class="border-0 shadow-sm card-header">
                            <h2 class="mb-0">
                                <button type="button" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo"
                                    class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">Collapsible
                                    I am a boat owner</button>
                            </h2>
                        </div>
                        <div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample"
                            class="collapse">
                            <div class="card-body">
                                <p class="m-0">Anim pariatur cliche reprehenderit, enim eiusmod high
                                    life accusamus
                                    terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                    brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                                    on it squid
                                    single-origin coffee nulla assumenda shoreditch et.</p>
                            </div>
                        </div>
                    </div><!-- End -->

                    <!-- Accordion item 3 -->
                    <div class="card">
                        <div id="headingThree" class="border-0 shadow-sm card-header">
                            <h2 class="mb-0">
                                <button type="button" data-toggle="collapse" data-target="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree"
                                    class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">Collapsible
                                    I am a boat renter (or I want to be one!)</button>
                            </h2>
                        </div>
                        <div id="collapseThree" aria-labelledby="headingThree" data-parent="#accordionExample"
                            class="collapse">
                            <div class="card-body">
                                <p class="m-0">Anim pariatur cliche reprehenderit, enim eiusmod high
                                    life accusamus
                                    terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                    brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                                    on it squid
                                    single-origin coffee nulla assumenda shoreditch et.</p>
                            </div>
                        </div>
                    </div><!-- End -->

                </div><!-- End -->
            </div>
        </div>
</section>
<section class="faq_section">
    <div class="container">
        <div class="text-center faq_heading">
            <h2>frequently asked questions</h2>
        </div>
        <div class="row">
            <div class="mx-auto col-lg-9">
                <!-- Accordion -->
                <div id="accordionExample" class="shadow accordion">

                    <!-- Accordion item 1 -->
                    <div class="card">
                        <div id="headingFour" class="bg-white border-0 shadow-sm card-header">
                            <h2 class="mb-0">
                                <button type="button" data-toggle="collapse" data-target="#collapseFour"
                                    aria-expanded="true" aria-controls="collapseFour"
                                    class="btn btn-link text-dark font-weight-bold text-uppercase collapsible-link">Collapsible
                                    Group Item
                                    #1</button>
                            </h2>
                        </div>
                        <div id="collapseFour" aria-labelledby="headingFour" data-parent="#accordionExample"
                            class="collapse show">
                            <div class="card-body">
                                <p class="m-0">Anim pariatur cliche reprehenderit, enim eiusmod high
                                    life accusamus
                                    terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                    brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                                    on it squid
                                    single-origin coffee nulla assumenda shoreditch et.</p>
                            </div>
                        </div>
                    </div><!-- End -->

                    <!-- Accordion item 2 -->
                    <div class="card">
                        <div id="headingFive" class="bg-white border-0 shadow-sm card-header">
                            <h2 class="mb-0">
                                <button type="button" data-toggle="collapse" data-target="#collapseFive"
                                    aria-expanded="false" aria-controls="collapseFive"
                                    class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">I
                                    am a boat renter (or I want to be one!)</button>
                            </h2>
                        </div>
                        <div id="collapseFive" aria-labelledby="headingFive" data-parent="#accordionExample"
                            class="collapse">
                            <div class="card-body">
                                <p class="m-0">Anim pariatur cliche reprehenderit, enim eiusmod high
                                    life accusamus
                                    terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                    brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                                    on it squid
                                    single-origin coffee nulla assumenda shoreditch et.</p>
                            </div>
                        </div>
                    </div><!-- End -->

                    <!-- Accordion item 3 -->
                    <div class="card">
                        <div id="headingSix" class="bg-white border-0 shadow-sm card-header">
                            <h2 class="mb-0">
                                <button type="button" data-toggle="collapse" data-target="#collapseSix"
                                    aria-expanded="false" aria-controls="collapseSix"
                                    class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">Collapsible
                                    Group Item #3</button>
                            </h2>
                        </div>
                        <div id="collapseSix" aria-labelledby="headingSix" data-parent="#accordionExample"
                            class="collapse">
                            <div class="card-body">
                                <p class="m-0">Anim pariatur cliche reprehenderit, enim eiusmod high
                                    life accusamus
                                    terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                    brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                                    on it squid
                                    single-origin coffee nulla assumenda shoreditch et.</p>
                            </div>
                        </div>
                    </div><!-- End -->

                </div><!-- End -->
            </div>
        </div>
    </div>
</section>
<!-- /Knowledge Section -->
<!-- More resources Section -->
<section class="more_resource_section">
    <div class="text-center more_resource_heading">
        <h2>More resources</h2>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="more_resource_box">
                <img src="{{ asset('app-assets/site_assets/img/watch-icon.png') }}">
                <h3>Customer Care
                    opening hours</h3>
                <p>Sed tempor aliquet fermentum. Nulla in nibh risus. Nam eget commodo ligula. Vestibulum a quam
                    sagittis,</p>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="more_resource_box">
                <img src="{{ asset('app-assets/site_assets/img/boat-icon-03.png') }}">
                <h3>Check our blog</h3>
                <p>Sed tempor aliquet fermentum. Nulla in nibh risus. Nam eget commodo ligula. Vestibulum a quam
                    sagittis,</p>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="more_resource_box">
                <img src="{{ asset('app-assets/site_assets/img/insta-icon.png') }}">
                <h3>Follow Us on instagram</h3>
                <p>Sed tempor aliquet fermentum. Nulla in nibh risus. Nam eget commodo ligula. Vestibulum a quam
                    sagittis,</p>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="more_resource_box">
                <img src="{{ asset('app-assets/site_assets/img/facebook-icon.png') }}">
                <h3> Follow our facebook</h3>
                <p>Sed tempor aliquet fermentum. Nulla in nibh risus. Nam eget commodo ligula. Vestibulum a quam
                    sagittis,</p>
            </div>
        </div>
    </div>
</section>
<!-- /More resources Section -->
<!-- Help contact Section -->
<section class="help_contact_section">
    <div class="row align-items-center">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="help_contact_text">
                <h2>Contact us!</h2>
                <p>Still have questions? If you didn't find what you need, you can send an inquiry through our contact
                    form.</p>
                <a href="#">Submit a reqiest</a>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="help_contact_img">
                <img src="{{ asset('app-assets/site_assets/img/help-contact-img.jpg') }}" alt="help-img">
            </div>
        </div>
    </div>
</section>
<!-- /Help contact Section -->
@endsection