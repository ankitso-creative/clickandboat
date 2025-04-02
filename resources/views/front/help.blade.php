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
            <i class="search-icon fas fa-search"></i>
            <input type="text" id="search" placeholder="Search...">
            <button id="search-button">Search</button>
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
                    <!-- Accordion item 1 -->
                    <div class="card">
                        <div id="headingOne" class="border-0 shadow-sm card-header">
                            <h2 class="mb-0">
                                <button type="button" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="false" aria-controls="collapseOne"
                                    class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                    1. What is MyBoatBooker, and how does it work?</button>
                            </h2>
                        </div>
                        <div id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample"
                            class="collapse">
                            <div class="card-body">
                                <p class="m-0">[MyboatBooker] is a peer-to-peer boat rental platform that connects boat
                                    owners with renters. Owners list their boats, and renters can book them for a
                                    specified date & time.</p>
                            </div>
                        </div>
                    </div><!-- End -->

                    <!-- Accordion item 2 -->
                    <div class="card">
                        <div id="headingTwo" class="border-0 shadow-sm card-header">
                            <h2 class="mb-0">
                                <button type="button" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo"
                                    class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                    2. How do I book a boat?</button>
                            </h2>
                        </div>
                        <div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample"
                            class="collapse">
                            <div class="card-body">
                                <p class="m-0">Browse marinas, choose your boat, select a desired date and time, and
                                    complete the booking request directly with the owner. The boat owner will review
                                    your request, give you a price and once approved, you'll receive a confirmation.
                                    Follow the steps to pay at checkout.</p>
                            </div>
                        </div>
                    </div><!-- End -->
                    <!-- Accordion item 3 -->
                    <div class="card">
                        <div id="headingThree" class="border-0 shadow-sm card-header">
                            <h2 class="mb-0">
                                <button type="button" data-toggle="collapse" data-target="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree"
                                    class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                    3. Do I need a boating license?</button>
                            </h2>
                        </div>
                        <div id="collapseThree" aria-labelledby="headingThree" data-parent="#accordionExample"
                            class="collapse">
                            <div class="card-body">
                                <p class="m-0">Requirements vary based on boat type. Some boats require a valid boating
                                    license and some without. While others can be rented with a licensed captain. Check
                                    the listing details or contact the owner for specifics.</p>
                            </div>
                        </div>
                    </div><!-- End -->
                    <!-- Accordion item 4 -->
                    <div class="card">
                        <div id="headingFour" class="border-0 shadow-sm card-header">
                            <h2 class="mb-0">
                                <button type="button" data-toggle="collapse" data-target="#collapseFour"
                                    aria-expanded="false" aria-controls="collapseFour"
                                    class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                    4. Can I rent a boat without prior boating experience?</button>
                            </h2>
                        </div>
                        <div id="collapseFour" aria-labelledby="headingFour" data-parent="#accordionExample"
                            class="collapse">
                            <div class="card-body">
                                <p class="m-0">Yes! Many boat owners offer rentals with a captain, so you can enjoy the
                                    water without needing to operate the boat yourself.</p>
                            </div>
                        </div>
                    </div><!-- End -->
                    <!-- Accordion item 5 -->
                    <div class="card">
                        <div id="headingFive" class="border-0 shadow-sm card-header">
                            <h2 class="mb-0">
                                <button type="button" data-toggle="collapse" data-target="#collapseFive"
                                    aria-expanded="false" aria-controls="collapseFive"
                                    class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                    5. How much does it cost to rent a boat?</button>
                            </h2>
                        </div>
                        <div id="collapseFive" aria-labelledby="headingFive" data-parent="#accordionExample"
                            class="collapse">
                            <div class="card-body">
                                <p class="m-0">Pricing depends on the boat type, rental duration, and location. Each
                                    boat owner sets their rates, which are displayed on the listing.</p>
                            </div>
                        </div>
                    </div><!-- End -->
                    
                    <div class="see_more_faq">
                        <!-- Accordion item 6 -->
                        <div class="card">
                            <div id="headingSix" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseSix"
                                        aria-expanded="false" aria-controls="collapseSix"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        6. Are there any additional fees?</button>
                                </h2>
                            </div>
                            <div id="collapseSix" aria-labelledby="headingSix" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">Some rentals may include extra charges for fuel, cleaning, captain
                                        services, or optional add-ons like water sports equipment. Check the listing for
                                        details.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 7 -->
                        <div class="card">
                            <div id="headingSeven" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseSeven"
                                        aria-expanded="false" aria-controls="collapseSeven"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        7. How do I pay for my rental?</button>
                                </h2>
                            </div>
                            <div id="collapseSeven" aria-labelledby="headingSeven" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">Payments are made securely through our platform using a credit/debit
                                        card or other available payment options. We do not support cash transactions.
                                    </p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 8 -->
                        <div class="card">
                            <div id="headingEight" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseEight"
                                        aria-expanded="false" aria-controls="collapseEight"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        8. Is my payment secure?</button>
                                </h2>
                            </div>
                            <div id="collapseEight" aria-labelledby="headingEight" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">Yes, we use encrypted payment processing to ensure your transactions
                                        are safe and secure.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 9 -->
                        <div class="card">
                            <div id="headingNine" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseNine"
                                        aria-expanded="false" aria-controls="collapseNine"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        9. What is the cancellation policy?</button>
                                </h2>
                            </div>
                            <div id="collapseNine" aria-labelledby="headingNine" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">Cancellation policies vary by boat owner. Some offer full refunds if
                                        canceled within a certain timeframe, while others have stricter policies. The
                                        policy is listed on each boat’s page.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 10 -->
                        <div class="card">
                            <div id="headingTen" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseTen"
                                        aria-expanded="false" aria-controls="collapseTen"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        10. What happens if the weather is bad on my rental day?</button>
                                </h2>
                            </div>
                            <div id="collapseTen" aria-labelledby="headingTen" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">If unsafe weather conditions prevent your rental, you can reschedule
                                        or receive a refund per the owner’s policy.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 11 -->
                        <div class="card">
                            <div id="headingEleven" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseEleven"
                                        aria-expanded="false" aria-controls="collapseEleven"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        11. What is included in my rental?</button>
                                </h2>
                            </div>
                            <div id="collapseEleven" aria-labelledby="headingEleven" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">Each listing will specify what’s included, such as life jackets,
                                        fuel, and equipment. Some boats may have optional add-ons like water skis or
                                        fishing gear.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 12 -->
                        <div class="card">
                            <div id="headingTwelve" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseTwelve"
                                        aria-expanded="false" aria-controls="collapseTwelve"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        12. Can I bring food and drinks?</button>
                                </h2>
                            </div>
                            <div id="collapseTwelve" aria-labelledby="headingTwelve" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">Most boat rentals allow food and drinks, but check with the owner for
                                        any restrictions (e.g., alcohol policies).</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 13 -->
                        <div class="card">
                            <div id="headingThirteen" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseThirteen"
                                        aria-expanded="false" aria-controls="collapseThirteen"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        13. Can I bring pets on the boat?</button>
                                </h2>
                            </div>
                            <div id="collapseThirteen" aria-labelledby="headingThirteen" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">Some boat owners allow pets, while others do not. Check the listing
                                        details or contact the owner to confirm.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 14 -->
                        <div class="card">
                            <div id="headingFourteen" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseFourteen"
                                        aria-expanded="false" aria-controls="collapseFourteen"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        14. Do I need to refuel the boat before returning it?</button>
                                </h2>
                            </div>
                            <div id="collapseFourteen" aria-labelledby="headingFourteen" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">Some owners include fuel in the rental price, while others require
                                        renters to refill the tank. Check the boat listing for specific instructions.
                                    </p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 15 -->
                        <div class="card">
                            <div id="headingFifteen" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseFifteen"
                                        aria-expanded="false" aria-controls="collapseFifteen"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        15. Is insurance included with my rental?</button>
                                </h2>
                            </div>
                            <div id="collapseFifteen" aria-labelledby="headingFifteen" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        We offer optional rental insurance to protect both renters and owners. Some
                                        owners may require proof of insurance before confirming your booking. </p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 16 -->
                        <div class="card">
                            <div id="headingSixteen" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseSixteen"
                                        aria-expanded="false" aria-controls="collapseSixteen"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        16. What safety measures should I follow?</button>
                                </h2>
                            </div>
                            <div id="collapseSixteen" aria-labelledby="headingSixteen" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        Always wear a life jacket, follow local boating regulations, and adhere to any
                                        guidelines set by the boat owner.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 17 -->
                        <div class="card">
                            <div id="headingSeventeen" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseSeventeen"
                                        aria-expanded="false" aria-controls="collapseSeventeen"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        17. What should I do in case of an emergency?</button>
                                </h2>
                            </div>
                            <div id="collapseSeventeen" aria-labelledby="headingSeventeen"
                                data-parent="#accordionExample" class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        Call local emergency services immediately if needed. Also, inform the boat owner
                                        and our support team.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 18 -->
                        <div class="card">
                            <div id="headingEighteen" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseEighteen"
                                        aria-expanded="false" aria-controls="collapseEighteen"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        18. How do I list my boat for rent?</button>
                                </h2>
                            </div>
                            <div id="collapseEighteen" aria-labelledby="headingEighteen" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        Simply create an account, upload photos, set your pricing, and provide details
                                        about your boat. Once your listing is live, renters can book your boat.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 19 -->
                        <div class="card">
                            <div id="headingNineteen" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseNineteen"
                                        aria-expanded="false" aria-controls="collapseNineteen"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        19. How do I get paid?</button>
                                </h2>
                            </div>
                            <div id="collapseNineteen" aria-labelledby="headingNineteen" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        Once a rental is completed, payments are processed securely and transferred to
                                        your account within a few days.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 20 -->
                        <div class="card">
                            <div id="headingTwenty" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseTwenty"
                                        aria-expanded="false" aria-controls="collapseTwenty"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        20. What if a renter damages my boat?</button>
                                </h2>
                            </div>
                            <div id="collapseTwenty" aria-labelledby="headingTwenty" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        We offer optional insurance and security deposit options to help protect against
                                        damages. You can also set your own rental terms to safeguard your boat.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 21 -->
                        <div class="card">
                            <div id="headingTwentyone" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseTwentyone"
                                        aria-expanded="false" aria-controls="collapseTwentyone"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        21. What types of boats are available for rent?</button>
                                </h2>
                            </div>
                            <div id="collapseTwentyone" aria-labelledby="headingTwentyone"
                                data-parent="#accordionExample" class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        We offer a wide range of boats, including pontoons, sailboats, motorboats,
                                        kayaks, and luxury yachts. You can browse the full list of available boats and
                                        choose the one that best suits your needs.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 22 -->
                        <div class="card">
                            <div id="headingTwentytwo" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseTwentytwo"
                                        aria-expanded="false" aria-controls="collapseTwentytwo"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        22. What should I bring on the rental day?</button>
                                </h2>
                            </div>
                            <div id="collapseTwentytwo" aria-labelledby="headingTwentytwo"
                                data-parent="#accordionExample" class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        Make sure to bring any necessary identification, your boating license (if
                                        required), and personal items like sunscreen, food, and water. Check with the
                                        boat owner for any specific requirements.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 23 -->
                        <div class="card">
                            <div id="headingTwentythree" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseTwentythree"
                                        aria-expanded="false" aria-controls="collapseTwentythree"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        23. What should I do if I have an issue during my rental?</button>
                                </h2>
                            </div>
                            <div id="collapseTwentythree" aria-labelledby="headingTwentythree"
                                data-parent="#accordionExample" class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        If you experience any problems, first contact the boat owner. If further
                                        assistance is needed, reach out to Click & Boat customer support for help.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 24 -->
                        <div class="card">
                            <div id="headingTwentyFour" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseTwentyFour"
                                        aria-expanded="false" aria-controls="collapseTwentyFour"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        24. How can I contact MyBoatBooker’s customer support?</button>
                                </h2>
                            </div>
                            <div id="collapseTwentyFour" aria-labelledby="headingTwentyFour"
                                data-parent="#accordionExample" class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        You can reach MyBoatBooker’s support team through the help center on the
                                        website, by email or submit a request form.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 25 -->
                        <div class="card">
                            <div id="headingTwentyFive" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseTwentyFive"
                                        aria-expanded="false" aria-controls="collapseTwentyFive"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        25. What if I need to change my booking details?</button>
                                </h2>
                            </div>
                            <div id="collapseTwentyFive" aria-labelledby="headingTwentyFive"
                                data-parent="#accordionExample" class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        If you need to modify your booking, contact the boat owner as soon as possible.
                                        Some changes may require approval, and additional fees may apply.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 26 -->
                        <div class="card">
                            <div id="headingTwentySix" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseTwentySix"
                                        aria-expanded="false" aria-controls="collapseTwentySix"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        26. Is My Boat Booker safe to use?</button>
                                </h2>
                            </div>
                            <div id="collapseTwentySix" aria-labelledby="headingTwentySix"
                                data-parent="#accordionExample" class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        Yes, My Boat Booker uses secure payment methods and verifies boat owners to
                                        ensure a trustworthy rental experience. Always communicate and make payments
                                        through the platform for added security.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 27 -->
                        <div class="card">
                            <div id="headingTwentySeven" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseTwentySeven"
                                        aria-expanded="false" aria-controls="collapseTwentySeven"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        27. Do I need to create an account to use My Boat Booker?</button>
                                </h2>
                            </div>
                            <div id="collapseTwentySeven" aria-labelledby="headingTwentySeven"
                                data-parent="#accordionExample" class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        Yes, you must create an account to book a boat, send messages to boat owners,
                                        and manage your reservations. Signing up is free and only takes a few minutes
                                    </p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 28 -->
                        <div class="card">
                            <div id="headingTwentyeight" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseTwentyeight"
                                        aria-expanded="false" aria-controls="collapseTwentyeight"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        28. When will I receive my refund if I cancel?</button>
                                </h2>
                            </div>
                            <div id="collapseTwentyeight" aria-labelledby="headingTwentyeight"
                                data-parent="#accordionExample" class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        If you’re eligible for a refund, My Boat Booker processes it as soon as the
                                        cancellation is confirmed. Refunds may take 3-10 business days to appear,
                                        depending on your payment provider.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 29 -->
                        <div class="card">
                            <div id="headingTwentynine" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseTwentynine"
                                        aria-expanded="false" aria-controls="collapseTwentynine"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        29. How much does it cost to list my boat?</button>
                                </h2>
                            </div>
                            <div id="collapseTwentynine" aria-labelledby="headingTwentynine"
                                data-parent="#accordionExample" class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        It is free to list your boat on My Boat Booker.. The platform only charges a
                                        commission when a booking is successfully completed.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 30 -->
                        <div class="card">
                            <div id="headingThirty" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseThirty"
                                        aria-expanded="false" aria-controls="collapseThirty"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        30. How do I set my rental price?</button>
                                </h2>
                            </div>
                            <div id="collapseThirty" aria-labelledby="headingThirty" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        You can set your own price based on factors like:</p>
                                    <ul>
                                        <li>Boat type and size</li>
                                        <li>Location and demand</li>
                                        <li>Seasonality</li>
                                        <li>Additional services (e.g., skipper, fuel, equipment)</li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 31 -->
                        <div class="card">
                            <div id="headingThirtyone" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseThirtyone"
                                        aria-expanded="false" aria-controls="collapseThirtyone"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        31. Who is responsible for refueling the boat?</button>
                                </h2>
                            </div>
                            <div id="collapseThirtyone" aria-labelledby="headingThirtyone"
                                data-parent="#accordionExample" class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        Most rentals follow a “full-to-full” fuel policy, meaning you receive the boat
                                        with a full tank and must return it with a full tank. Be sure to check with the
                                        owner before departure.</p>
                                </div>
                            </div>
                        </div><!-- End -->
                        <!-- Accordion item 32 -->
                        <div class="card">
                            <div id="headingThirtytwo" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseThirtytwo"
                                        aria-expanded="false" aria-controls="collapseThirtytwo"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        32. Is My Boat Booker a safe platform?</button>
                                </h2>
                            </div>
                            <div id="collapseThirtytwo" aria-labelledby="headingThirtytwo"
                                data-parent="#accordionExample" class="collapse">
                                <div class="card-body">
                                    <p class="m-0">
                                        Yes! My Boat Booker verifies boat owners and secures all transactions. To ensure
                                        a safe experience:</p>
                                    <ul>
                                        <li>Always communicate through the platform.</li>
                                        <li>Never make direct payments outside My Boat Booker</li>
                                        <li>Read reviews and boat details carefully before booking.</li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- End -->
                    </div>
                    <div class="mt-5 text-center read_more_btn">
                        <a href="javascript:;" id="see-more-faq">See More</a>
                    </div>
                </div><!-- End -->
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