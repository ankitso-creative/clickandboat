@extends('layouts.front.common')

@section('meta')
<title>Manage Users</title>
@endsection
@section('css')

@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $(document).on('click','#see-more-faq',function(){
                var self = $(this);
                if($('.see_more_faq').css('display') == 'none')
                {
                    $('.see_more_faq').css('display','block') ;
                    self.text('Less');
                }
                else
                {
                    $('.see_more_faq').css('display','none') ;
                    self.text('See More');
                }
            })
        })
        $(document).on('click', '#loadMore', function () {
            let button = $(this);
            let page = button.data('next-page');

            $.ajax({
                url: '?page=' + page,
                type: 'GET',
                beforeSend: function () {
                    button.text('Loading...');
                },
                success: function (response) {
                    $('#accordionExample').append(response.html);

                    if (response.next_page) {
                        button.data('next-page', response.next_page);
                        button.text('Load More');
                    } else {
                        button.remove(); // No more pages
                    }
                },
                error: function () {
                    alert('Something went wrong!');
                    button.text('Load More');
                }
            });
        });
    </script>
@endsection
@section('content')
<!-- Help Banner Section -->
<section class="help_banner_section">
    <div class="help_banner_text">
        <h5>Welcome to our Help Center</h5>
        <h1>How can we help you?</h1>
        <p>Search our knowledge base for answers to more than 150 questions !</p>
        <div id="search-wrapper">
            <form >
                <i class="search-icon fas fa-search"></i>
                <input type="text" id="search" name="question" value="{{ request()->query('question') ?? '' }}" placeholder="Search...">
                <button id="search-button">Search</button>
            </form>
        </div>
        <p><span class="help_text_style">Contact MyBoatBooker</p>
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
            <div class="mx-auto col-lg-10">
                <!-- Accordion -->
                <div id="accordionExample" class="shadow accordion">
                    @if(count($faqs))
                        @foreach($faqs as $faq)
                            <div class="card">
                                <div id="heading{{ $faq->id }}" class="border-0 shadow-sm card-header">
                                    <h2 class="mb-0">
                                        <button type="button" data-toggle="collapse" data-target="#collapse{{ $faq->id }}"
                                            aria-expanded="false" aria-controls="collapse{{$faq->id }}"
                                            class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                            {{ $loop->iteration }}. {{ $faq->question }}
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapse{{ $faq->id }}" aria-labelledby="heading{{ $faq->id }}" data-parent="#accordionExample"
                                    class="collapse">
                                    <div class="card-body">
                                        <p class="m-0">{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="mt-5 text-center read_more_btn">
                    @if ($faqs->hasMorePages())
                        <div class="mt-4 text-center">
                            <button id="loadMore" class="btn" data-next-page="{{ $faqs->currentPage() + 1 }}">View More</button>
                        </div>
                    @endif
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
            <i class="fa-solid fa-clock"></i>
                <h3>Customer Care
                    opening hours</h3>
                <p>Our agents are available from Monday to Friday from 9 am to 6 pm</p>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="more_resource_box">
            <i class="fa-solid fa-sailboat"></i>
                <h3>Check our blog</h3>
                <p>Visit our blog to get inspiration for your next trip!</p>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="more_resource_box">
            <i class="fa-brands fa-square-instagram"></i>
                <h3>Follow Us on instagram</h3>
                <p>To keep more than 40.000 boats in your pocket or handle your bookings directly from the harbor!</p>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="more_resource_box">
            <i class="fa-brands fa-square-facebook"></i>
                <h3> Follow our facebook</h3>
                <p>To keep more than 40.000 boats in your pocket or handle your bookings directly from the harbor!</p>
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
                <a href="{{ route('contact') }}">Submit a request</a>
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