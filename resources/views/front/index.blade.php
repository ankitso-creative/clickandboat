@extends('layouts.front.common')

@section('meta')
    <title>Manage Users</title>
@endsection
@section('css')
    
@endsection
@section('js')
    
@endsection
@section('content')
        <div class="b-main-slider slider-pro" id="main-slider" data-slider-width="100%" data-slider-height="920px" data-slider-arrows="false" data-slider-buttons="false">
            <div class="sp-slides">
                <!-- Slide 1-->
                <div class="b-main-slider__slide b-main-slider__slide-1 sp-slide"><img class="sp-image" src="{{ asset('app-assets/site_assets/img/home-banner-07.jpg') }}" alt="slider" />
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="sp-layer" data-width="100%" data-show-transition="left" data-hide-transition="left" data-show-duration="800" data-show-delay="400" data-hide-delay="400">
                                    <div class="b-main-slider__title-wrap">
                                        <!-- <div class="b-main-slider__slogan">Your Dream Boats</div> -->
                                        <div class="b-main-slider__title">The best solution for your boat hire</div>
                                        <p>More than 55,000 private yacht rentals and bareboat charters worldwide for your next boating trip</p>
                                        <div class="b-main-slider__label text-secondary">Explore Now</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide 1-->
                <div class="b-main-slider__slide b-main-slider__slide-1 sp-slide"><img class="sp-image" src="{{ asset('app-assets/site_assets/img/home-banner-08.jpg') }}" alt="slider" />
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="sp-layer" data-width="100%" data-show-transition="left" data-hide-transition="left" data-show-duration="800" data-show-delay="400" data-hide-delay="400">
                                    <div class="b-main-slider__title-wrap">
                                        <!-- <div class="b-main-slider__slogan">Your Dream Boats</div> -->
                                        <div class="b-main-slider__title">The best solution for your boat hire</div>
                                        <p>More than 55,000 private yacht rentals and bareboat charters worldwide for your next boating trip</p>
                                        <div class="b-main-slider__label text-secondary">Explore Now</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end .b-main-slider-->
        <div class="b-about">
            <div class="ui-decor ui-decor_down"></div>
            <div class="container">
                <div class="b-main-filter-content tab-content" id="findTabContent">
                    <div class="tab-pane fade show active" id="content-allCar">
                        <div class="row align-items-end no-gutters">
                            <div class="b-main-filter__main col-lg">
                                <div class="b-main-filter__inner row no-gutters">
                                    <div class="b-main-filter__item col-md-3">
                                        <div class="b-main-filter__label">Place of Departure</div>
                                        <div class="b-main-filter__selector">
                                            <!-- <input id="search" class="goole-map" type="text" name="where" placeholder="Ibiza, Croatia, Sardinia..."> -->
                                            <div class="has-search">
                                               <span class="fa fa-search form-control-feedback"></span>
                                               <input type="text" class="form-control" placeholder="Ibiza, Croatia...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="b-main-filter__item col-md-3">
                                        <div class="b-main-filter__label">Starting date</div>
                                         <input type="date" id="starting-date" name="date">
                                    </div>
                                    <div class="b-main-filter__item col-md-3">
                                        <div class="b-main-filter__label">Ending date</div>
                                        <input type="date" id="ending-date" name="date">
                                    </div>
                                    <div class="b-main-filter__item col-md-3">
                                        <div class="b-main-filter__label">Boat type</div>
                                        <div class="b-main-filter__selector">
                                            <select class="selectpicker" data-width="100%" data-style="ui-select">
                                                <option>Max $50 per day</option>
                                                <option>Max $100 per day</option>
                                                <option>Max $150 per day</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-auto">
                                <button class="b-main-filter__btn btn btn-secondary">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="content-newCars">
                        <div class="row align-items-end no-gutters">
                            <div class="b-main-filter__main col-lg">
                                <div class="b-main-filter__inner row no-gutters">
                                    <div class="b-main-filter__item col-md-4">
                                        <div class="b-main-filter__label">Select Make</div>
                                        <div class="b-main-filter__selector">
                                            <select class="selectpicker" data-width="100%" data-style="ui-select">
                                                <option>Audi</option>
                                                <option>BMV</option>
                                                <option>Opel</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="b-main-filter__item col-md-4">
                                        <div class="b-main-filter__label">Select a Model</div>
                                        <div class="b-main-filter__selector">
                                            <select class="selectpicker" data-width="100%" data-style="ui-select">
                                                <option>Model 1</option>
                                                <option>Model 2</option>
                                                <option>Model 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="b-main-filter__item col-md-4">
                                        <div class="b-main-filter__label">Price Range</div>
                                        <div class="b-main-filter__selector">
                                            <select class="selectpicker" data-width="100%" data-style="ui-select">
                                                <option>Max $5000</option>
                                                <option>Max $15000</option>
                                                <option>Max $25000</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-auto">
                                <button class="b-main-filter__btn btn btn-secondary">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="content-usedCars">
                        <div class="row align-items-end no-gutters">
                            <div class="b-main-filter__main col-lg">
                                <div class="b-main-filter__inner row no-gutters">
                                    <div class="b-main-filter__item col-md-4">
                                        <div class="b-main-filter__label">Select Make</div>
                                        <div class="b-main-filter__selector">
                                            <select class="selectpicker" data-width="100%" data-style="ui-select">
                                                <option>Audi</option>
                                                <option>BMV</option>
                                                <option>Opel</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="b-main-filter__item col-md-4">
                                        <div class="b-main-filter__label">Select a Model</div>
                                        <div class="b-main-filter__selector">
                                            <select class="selectpicker" data-width="100%" data-style="ui-select">
                                                <option>Model 1</option>
                                                <option>Model 2</option>
                                                <option>Model 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="b-main-filter__item col-md-4">
                                        <div class="b-main-filter__label">Price Range</div>
                                        <div class="b-main-filter__selector">
                                            <select class="selectpicker" data-width="100%" data-style="ui-select">
                                                <option>Max $5000</option>
                                                <option>Max $15000</option>
                                                <option>Max $25000</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-auto">
                                <button class="b-main-filter__btn btn btn-secondary">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 ">
                        <div class="text-left">
                            <h2 class="ui-title">Providing a large fleet
                                of Boats for a perfect
                                and dreamy experience</h2>
                            <div class="ui-content">
                                <p>Eorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor
                                    <br> et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                    <br> aliquip ex ea commodo consequat. Duis aute irure dolorin reprehenderits vol
                                    <br> dolore fugiat nulla pariatur excepteur sint occaecat.</p>
                                <ul class="arrow-list">
                                    <li><i class="fas fa-long-arrow-alt-right"></i>Stunning Cruise Paths You Follow</li>
                                    <li><i class="fas fa-long-arrow-alt-right"></i>Premium Boats & Yachts</li>
                                    <li><i class="fas fa-long-arrow-alt-right"></i>Our Professional Approach</li>
                                    <li><i class="fas fa-long-arrow-alt-right"></i>Quality Service Guaranteed</li>
                                </ul>
                                <div class="gap25"></div> </div>
                        </div>
                    </div>
                    <div class="col-lg-6"> <img src="{{ asset('app-assets/site_assets/img/about-image-new-2.png') }}" alt="photo" class="about-image"> </div>
                </div>
            </div>
        </div>
        <!-- end .b-services-->
        <div class="section-advantages">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="b-advantages">
                            <div class="ic flaticon-rudder-1 text-secondary"></div>
                            <div class="b-advantages__main">
                                <div class="b-advantages__title">Priceless Experience</div>
                                <div class="decore01"></div>
                                <div class="b-advantages__info">Asmod tempor incididunt labore magna ust enim sed veniams quis nostrud sed commodo ipsum duals.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="b-advantages">
                            <div class="ic flaticon-snorkel text-secondary"></div>
                            <div class="b-advantages__main">
                                <div class="b-advantages__title">Custom Packages</div>
                                <div class="decore01"></div>
                                <div class="b-advantages__info">Asmod tempor incididunt labore magna ust enim sed veniams quis nostrud sed commodo ipsum duals.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="b-advantages">
                            <div class="ic flaticon-sailor text-secondary"></div>
                            <div class="b-advantages__main">
                                <div class="b-advantages__title">Peoples Oriented </div>
                                <div class="decore01"></div>
                                <div class="b-advantages__info">Asmod tempor incididunt labore magna ust enim sed veniams quis nostrud sed commodo ipsum duals.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="section-goods">
            <div class="section-default section-goods__inner bg-dark">
                <div class="ui-decor ui-decor_mirror ui-decor_center"></div>
                <div class="container">
                    <div class="text-center">
                        <h2 class="ui-title ui-title_light">Fleet of Luxury Boats</h2>
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <p>Dolore magna aliqua enim ad minim veniam, quis nostrud exercitation aliquip duis aute irure dolorin  <br>  reprehenderits vol dolore fugiat nulla pariatur excepteur sint occaecat cupidatat.</p><img src="{{ asset('app-assets/site_assets/img/decore03.png') }}" alt="photo"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="section-goods__list">
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="b-goods">
                                <a class="b-goods__img" href="#"><img class="img-scale" src="{{ asset('app-assets/site_assets/img/y001.jpg') }}" alt="photo" /></a>
                                <div class="b-goods__main">
                                    <div class="row no-gutters">
                                        <div class="col"><a class="b-goods__title" href="#">Golden Odyssey</a>
                                            <div class="b-goods__info">Stock#: 45098ES - 4 door, White, 2.5L, FWD, Automatic 6-Speed, 2.5L 5 cyls, Florida CA</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="b-goods__price text-primary"><span class="b-goods__price-title">DEALER<br>PRICE</span><span class="b-goods__price-number">$140
                                                    <span class="b-goods__price-after-price">Per Day</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="b-goods-descrip_nev_wrap">
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-user"></i> <span class="b-goods-descrip__info">12 Guests</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-bed"></i> <span class="b-goods-descrip__info">2 Master Bedroom</span> </div>
                                        </div>
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-arrows-alt-h"></i> <span class="b-goods-descrip__info"> 44 Feet</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-columns"></i> <span class="b-goods-descrip__info"> Sun Deck, Kitchen ...</span> </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="b-goods">
                                <a class="b-goods__img" href="#"><img class="img-scale" src="{{ asset('app-assets/site_assets/img/y002.jpg') }}" alt="photo" /></a>
                                <div class="b-goods__main">
                                    <div class="row no-gutters">
                                        <div class="col"><a class="b-goods__title" href="#">Black pearl</a>
                                            <div class="b-goods__info">Stock#: 45098ES - 4 door, White, 2.5L, FWD, Automatic 6-Speed, 2.5L 5 cyls, Florida CA</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="b-goods__price text-primary"><span class="b-goods__price-title">DEALER<br>PRICE</span><span class="b-goods__price-number">$325
                                                    <span class="b-goods__price-after-price">Per Day</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="b-goods-descrip_nev_wrap">
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-user"></i> <span class="b-goods-descrip__info">12 Guests</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-bed"></i> <span class="b-goods-descrip__info">2 Master Bedroom</span> </div>
                                        </div>
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-arrows-alt-h"></i> <span class="b-goods-descrip__info"> 44 Feet</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-columns"></i> <span class="b-goods-descrip__info"> Sun Deck, Kitchen ...</span> </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="b-goods">
                                    <a class="b-goods__img" href="#"><img class="img-scale" src="{{ asset('app-assets/site_assets/img/y003.jpg') }}" alt="photo" /></a>
                                <div class="b-goods__main">
                                    <div class="row no-gutters">
                                        <div class="col"><a class="b-goods__title" href="#">Sea Senora</a>
                                            <div class="b-goods__info">Stock#: 45098ES - 4 door, White, 2.5L, FWD, Automatic 6-Speed, 2.5L 5 cyls, Florida CA</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="b-goods__price text-primary"><span class="b-goods__price-title">DEALER<br>PRICE</span><span class="b-goods__price-number">$450
                                                    <span class="b-goods__price-after-price">Per Day</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="b-goods-descrip_nev_wrap">
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-user"></i> <span class="b-goods-descrip__info">12 Guests</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-bed"></i> <span class="b-goods-descrip__info">2 Master Bedroom</span> </div>
                                        </div>
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-arrows-alt-h"></i> <span class="b-goods-descrip__info"> 44 Feet</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-columns"></i> <span class="b-goods-descrip__info"> Sun Deck, Kitchen ...</span> </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="b-goods">
                                <a class="b-goods__img" href="#"><img class="img-scale" src="{{ asset('app-assets/site_assets/img/y004.jpg') }}" alt="photo" /></a>
                                <div class="b-goods__main">
                                    <div class="row no-gutters">
                                        <div class="col"><a class="b-goods__title" href="#">Fish Tales</a>
                                            <div class="b-goods__info">Stock#: 45098ES - 4 door, White, 2.5L, FWD, Automatic 6-Speed, 2.5L 5 cyls, Florida CA</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="b-goods__price text-primary"><span class="b-goods__price-title">DEALER<br>PRICE</span><span class="b-goods__price-number">$160
                                                    <span class="b-goods__price-after-price">Per Day</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="b-goods-descrip_nev_wrap">
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-user"></i> <span class="b-goods-descrip__info">12 Guests</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-bed"></i> <span class="b-goods-descrip__info">2 Master Bedroom</span> </div>
                                        </div>
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-arrows-alt-h"></i> <span class="b-goods-descrip__info"> 44 Feet</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-columns"></i> <span class="b-goods-descrip__info"> Sun Deck, Kitchen ...</span> </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="b-goods">
                                <a class="b-goods__img" href="#"><img class="img-scale" src="{{ asset('app-assets/site_assets/img/y005.jpg') }}" alt="photo" /></a>
                                <div class="b-goods__main">
                                    <div class="row no-gutters">
                                        <div class="col"><a class="b-goods__title" href="#">Island Time</a>
                                            <div class="b-goods__info">Stock#: 45098ES - 4 door, White, 2.5L, FWD, Automatic 6-Speed, 2.5L 5 cyls, Florida CA</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="b-goods__price text-primary"><span class="b-goods__price-title">DEALER<br>PRICE</span><span class="b-goods__price-number">$150
                                                    <span class="b-goods__price-after-price">Per Day</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="b-goods-descrip_nev_wrap">
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-user"></i> <span class="b-goods-descrip__info">12 Guests</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-bed"></i> <span class="b-goods-descrip__info">2 Master Bedroom</span> </div>
                                        </div>
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-arrows-alt-h"></i> <span class="b-goods-descrip__info"> 44 Feet</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-columns"></i> <span class="b-goods-descrip__info"> Sun Deck, Kitchen ...</span> </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="b-goods">
                                <a class="b-goods__img" href="#"><img class="img-scale" src="{{ asset('app-assets/site_assets/img/y006.jpg') }}" alt="photo" /></a>
                                <div class="b-goods__main">
                                    <div class="row no-gutters">
                                        <div class="col"><a class="b-goods__title" href="#">Cozmic Sunny</a>
                                            <div class="b-goods__info">Stock#: 45098ES - 4 door, White, 2.5L, FWD, Automatic 6-Speed, 2.5L 5 cyls, Florida CA</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="b-goods__price text-primary"><span class="b-goods__price-title">DEALER<br>PRICE</span><span class="b-goods__price-number">$470
                                                    <span class="b-goods__price-after-price">Per Day</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="b-goods-descrip_nev_wrap">
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-user"></i> <span class="b-goods-descrip__info">12 Guests</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-bed"></i> <span class="b-goods-descrip__info">2 Master Bedroom</span> </div>
                                        </div>
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-arrows-alt-h"></i> <span class="b-goods-descrip__info"> 44 Feet</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-columns"></i> <span class="b-goods-descrip__info"> Sun Deck, Kitchen ...</span> </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="b-goods">
                                <a class="b-goods__img" href="#"><img class="img-scale" src="{{ asset('app-assets/site_assets/img/y007.jpg') }}" alt="photo" /></a>
                                <div class="b-goods__main">
                                    <div class="row no-gutters">
                                        <div class="col"><a class="b-goods__title" href="#">Fast Serenity</a>
                                            <div class="b-goods__info">Stock#: 45098ES - 4 door, White, 2.5L, FWD, Automatic 6-Speed, 2.5L 5 cyls, Florida CA</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="b-goods__price text-primary"><span class="b-goods__price-title">DEALER<br>PRICE</span><span class="b-goods__price-number">$155
                                                    <span class="b-goods__price-after-price">Per Day</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="b-goods-descrip_nev_wrap">
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-user"></i> <span class="b-goods-descrip__info">12 Guests</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-bed"></i> <span class="b-goods-descrip__info">2 Master Bedroom</span> </div>
                                        </div>
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-arrows-alt-h"></i> <span class="b-goods-descrip__info"> 44 Feet</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-columns"></i> <span class="b-goods-descrip__info"> Sun Deck, Kitchen ...</span> </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="b-goods">
                                <a class="b-goods__img" href="#"><img class="img-scale" src="{{ asset('app-assets/site_assets/img/y008.jpg') }}" alt="photo" /></a>
                                <div class="b-goods__main">
                                    <div class="row no-gutters">
                                        <div class="col"><a class="b-goods__title" href="#">Cozmic Sunny</a>
                                            <div class="b-goods__info">Stock#: 45098ES - 4 door, White, 2.5L, FWD, Automatic 6-Speed, 2.5L 5 cyls, Florida CA</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="b-goods__price text-primary"><span class="b-goods__price-title">DEALER<br>PRICE</span><span class="b-goods__price-number">$230
                                                    <span class="b-goods__price-after-price">Per Day</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="b-goods-descrip_nev_wrap">
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-user"></i> <span class="b-goods-descrip__info">12 Guests</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-bed"></i> <span class="b-goods-descrip__info">2 Master Bedroom</span> </div>
                                        </div>
                                        <div class="b-goods-descrip_nev">
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-arrows-alt-h"></i> <span class="b-goods-descrip__info"> 44 Feet</span> </div>
                                            <div class="b-goods-descrip__nev"> <i class="fas fa-columns"></i> <span class="b-goods-descrip__info"> Sun Deck, Kitchen ...</span> </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3"><a class="btn btn-border view-all-boats" href="#">view all boats</a></div>
                </div>
            </div>
        </section>
        <section class="section-progress  ">
            <div class="text-center">
                <h2 class="ui-title">The selection from the community</h2>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                    <img src="{{ asset('app-assets/site_assets/img/decore04.png') }}" alt="photo"> </div>
                </div>
            </div>
            <div class="container community_section">
                <div class="row">
                    <div class="col-md-4 comm_col_1">
                        <div class="community_box">
                            <a href="#">
                                <img src="{{ asset('app-assets/site_assets/img/Sailing-Boat.jpg') }}">
                                <h3>Sailing Boat</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="community_box">
                            <a href="#">
                                <img src="{{ asset('app-assets/site_assets/img/Italy.jpg') }}">
                                <h3>Italy</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 comm_col_1">
                        <div class="community_box">
                            <a href="#">
                                <img src="{{ asset('app-assets/site_assets/img/Carotia.jpg') }}">
                                <h3>Carotia</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 comm_col_1">
                        <div class="community_box">
                            <a href="#">
                                <img src="{{ asset('app-assets/site_assets/img/Motorboat.jpg') }}">
                                <h3>Motorboat</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="community_box">
                            <a href="#">
                                <img src="{{ asset('app-assets/site_assets/img/Dubai.jpg') }}">
                                <h3>Dubai</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 comm_col_1">
                        <div class="community_box">
                            <a href="#">
                                <img src="{{ asset('app-assets/site_assets/img/Greece.jpg') }}">
                                <h3>Greece</h3>
                            </a>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </section>
        <section class="section-goods-offers">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="text-left offers-left">
                        <h2 class="ui-title">Our favourite destinations</h2> <img src="{{ asset('app-assets/site_assets/img/decore02.png') }}" alt="photo">
                        <div class="offers-left-text">
                            <p>Eorem ipsum dolor amet consectetur sed adipisicing elit sed eiusmod tempor et dolore magna aliqua minim veniam, quis nostrud exercitation aliquip ex ea consequat duis aute irure dolorin.</p>  </div>
                        
                        <a class="btn btn-primary" href="#">view more</a>
                        
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="b-offers-slider ui-slider_arr-prim js-slider" data-slick="{&quot;slidesToShow&quot;: 3, &quot;slidesToScroll&quot;: 1, &quot;dots&quot;: false, &quot;arrows&quot;: true, &quot;autoplay&quot;: true,   &quot;responsive&quot;: [{&quot;breakpoint&quot;: 992, &quot;settings&quot;: {&quot;slidesToShow&quot;: 1, &quot;slidesToScroll&quot;: 1}}]}">
                        <div class="b-offers-nevica">
                            <div class="b-offers-nevica-photo"> <img src="{{ asset('app-assets/site_assets/img/offers001.jpg') }}" alt="photo"> </div>
                            <h6><a href="">Guadeloupe</a></h6>
                            <div class="decore01"></div>
                            <p>Adipisicing eiusmod tempor incidids labore dolore magna aliqa ust enim ad minim veniams quis nostrs sed citation ullam coy laboris nisit.</p>
                        </div>
                        <!-- end .b-offers-->
                        <div class="b-offers-nevica">
                            <div class="b-offers-nevica-photo"> <img src="{{ asset('app-assets/site_assets/img/offers002.jpg') }}" alt="photo"> </div>
                            <h6><a href="#">Ibiza</a></h6>
                            <div class="decore01"></div>
                            <p>Adipisicing eiusmod tempor incidids labore dolore magna aliqa ust enim ad minim veniams quis nostrs sed citation ullam coy laboris nisit.</p>
                        </div>
                        <!-- end .b-offers-->
                        <div class="b-offers-nevica">
                            <div class="b-offers-nevica-photo"> <img src="{{ asset('app-assets/site_assets/img/offers003.jpg') }}" alt="photo"> </div>
                            <h6><a href="#">French Riviera</a></h6>
                            <div class="decore01"></div>
                            <p>Adipisicing eiusmod tempor incidids labore dolore magna aliqa ust enim ad minim veniams quis nostrs sed citation ullam coy laboris nisit.</p>
                        </div>
                        <!-- end .b-offers-->
                        <!-- end .b-offers-->
                    </div>
                </div>
            </div>
        </section>
        <section class="section-video section-default section-goods__inner bg-dark ">
            
            <div class="ui-decor ui-decor_mirror ui-decor_center"></div>
            
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-10">
                        <div class="video-info">
                            <p><img src="{{ asset('app-assets/site_assets/img/decore02.png') }}" alt="decore"></p>
                            <h4>Mallorca</h4>
                            <h5>Enjoy our sailboat offers</h5>
                            <!-- <ul>
                                <li><i class="fas fa-phone-square"></i> Call Us Today: +1 755 302 8549</li>
                                <li><i class="fas fa-envelope-square"></i> Email: <a href="mailto:name@rmy-domain.com">support@my-domain.com</a></li>
                            </ul> -->
                            <a class="discover_btn">Discover</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 col-lg-2"> 
                        <!-- <a class="video-btn venobox ternary-video-btn-style vbox-item popup-youtube" data-vbtype="video" data-autoplay="true" href="#"><i class="fa fa-play"></i>
                            <div class="pulsing-bg"></div>
                               <span>Watch A Tour</span> 
                        </a>  -->
                    </div>
                </div>
            </div>
        </section>
        <section class="section-form">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="text-left">
                            <h2 class="ui-title">Booking Form</h2>
                            <p>Dolore magna aliqua enim ad minim veniam, quis nostrudreprehenderits
                                <br> dolore fugiat nulla pariatur lorem ipsum dolor sit amet. </p> <img src="{{ asset('app-assets/site_assets/img/decore03.png') }}" alt="photo">
                            <form action="#">
                                
                                <div class="row row-form-b">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="First Name"> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Last Name"> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Email"> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Phone"> </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Subject"> </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="6" placeholder="Message"></textarea>
                                    </div>
                                </div>
                            <div class="col-md-12">
                                <button class="b-main-filter__btn btn btn-secondary">Submit</button>
                            </div>
                            </div>
                          </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="text-left title-padding-m-top">
                            <h2 class="ui-title">FAQ’s</h2>
                            <!-- <p>Dolore magna aliqua enim ad minim veniam, quis nostrudreprehenderits
                                <br> dolore fugiat nulla pariatur lorem ipsum dolor sit amet. </p> <img src="assets/img/decore03.png" alt="photo"> </div> -->
                        
                           <div class="ui-accordion accordion" id="accordion-1">
                  <div class="card">
                    <div class="card-header" id="heading1">
                      <h3 class="mb-0">
                        <button class="ui-accordion__link collapsed" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1"><span class="ui-accordion__number">01</span>How can I charter a yacht with Click&Boat?<i class="ic fas fa-chevron-down"></i></button>
                      </h3>
                    </div>
                    <div class="collapse show" id="collapse1" data-aria-labelledby="heading1" data-parent="#accordion-1">
                      <div class="card-body">Create a free account and fill out your nautical profile and CV. You can search on the website or app and use the filters: destination, dates, type of boat, number of passengers, planned activities, etc. to find the boat that best fits your needs. If you're still unsure, you can get help from the Click&Boat cruise advisors free of charge. Once you find a boat you like, you can request a quote and/or immediate reservation, including the extras of your choice (insurance and services)! If necessary, Click&Boat or the boat owner will check the final details with you together. You can then validate the reservation, and after that, all you have to do is set sail!</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="heading2">
                      <h3 class="mb-0">
                        <button class="ui-accordion__link collapsed" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2"><span class="ui-accordion__number">02</span>What types of yachts are available for charter?<i class="ic fas fa-chevron-down"></i></button>
                      </h3>
                    </div>
                    <div class="collapse" id="collapse2" data-aria-labelledby="heading2" data-parent="#accordion-1">
                      <div class="card-body">On Click&Boat, you can rent all types of boats: license-free boats, RIBs (Rigid Inflatable Boats), motor boats, sailing or motor yachts, sailboats, catamarans, houseboats, jet skis... All you have to do is choose.</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="heading3">
                      <h3 class="mb-0">
                        <button class="ui-accordion__link collapsed" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3"><span class="ui-accordion__number">03</span>Is a sailing license required to charter a yacht?<i class="ic fas fa-chevron-down"></i></button>
                      </h3>
                    </div>
                    <div class="collapse" id="collapse3" data-aria-labelledby="heading3" data-parent="#accordion-1">
                      <div class="card-bodyFood">In many regions, the options for renting a boat without a license are often limited to those with smaller engines. For example, boats with engines less than 15 horsepower are frequently exempt from license requirements. Always check local laws to understand any limitations that might apply. If you do not have a license, you can opt to rent a boat with a skipper.</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="heading4">
                      <h3 class="mb-0">
                        <button class="ui-accordion__link collapsed" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4"><span class="ui-accordion__number">04</span>What are the costs of yacht charter?<i class="ic fas fa-chevron-down"></i></button>
                      </h3>
                    </div>
                    <div class="collapse" id="collapse4" data-aria-labelledby="heading4" data-parent="#accordion-1">
                      <div class="card-body">The cost of chartering a yacht on Click&Boat vary by location, type of boat, and season. Additional costs can include fuel, skipper fees, and extra equipment. Smaller boats start from €100 per day with larger, more luxurious yachts costing a few thousand euro per day. Always confirm inclusions with the the owner or our sales advisors.</div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="heading5">
                      <h3 class="mb-0">
                        <button class="ui-accordion__link collapsed" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5"><span class="ui-accordion__number">05</span>What services are included in the yacht charter?<i class="ic fas fa-chevron-down"></i></button>
                      </h3>
                    </div>
                    <div class="collapse" id="collapse5" data-aria-labelledby="heading5" data-parent="#accordion-1">
                      <div class="card-body">When you rent a boat via Click&Boat, the bareboat and insurance are included (note that cancellation insurance is optional). As for additional services, such as the skipper, fuel, sports equipment, meal care, the presence of staff or provisioning, it is recommended to check the advertisement carefully and request a quote from the owner, to be sure you have everything you need on board!</div>
                    </div>
                  </div>
                               
                </div>
                <!-- end .accordion-->

                        
                    </div>
                </div>
            </div>
        </section>
        <section class="section-reviews area-bg area-bg_dark area-bg_op_90">
            <div class="area-bg__inner section-default">
                <div class="container text-center">
                    <div class="text-center">
                        <h2 class="ui-title ui-title_light">Fellow sailors share their amazing experiences</h2>
                        <div class="row">
                            <div class="col-md-8 offset-md-2"> <img src="{{ asset('app-assets/site_assets/img/decore03.png') }}" alt="photo"> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="b-reviews-slider js-slider" data-slick="{&quot;slidesToShow&quot;: 1, &quot;slidesToScroll&quot;: 1, &quot;autoplay&quot;: true, &quot;dots&quot;: false, &quot;arrows&quot;: false}">
                                <blockquote class="b-reviews">
                                    <div class="b-seller__img"><img class="img-scale" src="{{ asset('app-assets/site_assets/img/avatar.jpg') }}" alt="foto"></div>
                                    <div class="b-reviews__text">Exercit ullamco laboris nisiut aliquip ex ea com irure dolor reprehs tempor incididunt ut labore dolore magna aliqua quis nostrud sed exercitation ullamco laboris nisiut duis aute irure sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </div>
                                    <div class="b-reviews__footer">
                                        <div class="b-reviews__name">Donald James</div>
                                        <div class="b-reviews__category">Customer</div>
                                    </div>
                                </blockquote>
                                <!-- end .b-reviews-->
                                <blockquote class="b-reviews">
                                    <div class="b-seller__img"><img class="img-scale" src="{{ asset('app-assets/site_assets/img/avatar.jpg') }}" alt="foto"></div>
                                    <div class="b-reviews__text">Exercit ullamco laboris nisiut aliquip ex ea com irure dolor reprehs tempor incididunt ut labore dolore magna aliqua quis nostrud sed exercitation ullamco laboris nisiut duis aute irure sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </div>
                                    <div class="b-reviews__footer">
                                        <div class="b-reviews__name">Donald James</div>
                                        <div class="b-reviews__category">Customer</div>
                                    </div>
                                </blockquote>
                                <!-- end .b-reviews-->
                                <blockquote class="b-reviews">
                                    <div class="b-seller__img"><img class="img-scale" src="{{ asset('app-assets/site_assets/img/avatar.jpg') }}" alt="foto"></div>
                                    <div class="b-reviews__text">Exercit ullamco laboris nisiut aliquip ex ea com irure dolor reprehs tempor incididunt ut labore dolore magna aliqua quis nostrud sed exercitation ullamco laboris nisiut duis aute irure sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </div>
                                    <div class="b-reviews__footer">
                                        <div class="b-reviews__name">Donald James</div>
                                        <div class="b-reviews__category">Customer</div>
                                    </div>
                                </blockquote>
                                <!-- end .b-reviews-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-article section-default">
            <div class="container">
                <div class="text-center">
                    <h2 class="ui-title">Get inspiration for your next trip</h2>
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                             <img src="{{ asset('app-assets/site_assets/img/decore04.png') }}" alt="photo"> </div>
                    </div>
                </div>
                <div class="pt-2 row">
                    <div class="col-xl-4 col-md-4">
                        <section class="b-post b-post-3">
                            <div class="entry-media">
                                <a href="post.html"><img class="img-scale" src="{{ asset('app-assets/site_assets/img/sailing-on-vacation-EUT5FWG.jpg') }}" alt="photo" /></a>
                            </div>
                            <div class="entry-meta">
                                <time class="entry-meta__item" datetime="2019-01-31">June 15, 2020</time> <span class="entry-meta__item">
                                    by
                                    <a class="entry-meta__link text-primary" href="blog.html">Nevica</a></span> </div>
                            <div class="entry-main">
                                <div class="entry-header">
                                    <h2 class="entry-title"><a href="post.html">[VIDEO]: François Gabart, our sailing advisor</a></h2> </div>
                                <div class="entry-content">Click&Boat exclusive interview with our partner François Gabart, founder of MerConcept! Sharing their new trimaran SVR Lazartingue, favourite places to sail and more,</div>
                            </div> <a class="btn-post" href="#">Read More</a> </section>
                        <!-- end .b-post-->
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <section class="b-post b-post-3">
                            <div class="entry-media">
                                <a href="post.html"><img class="img-scale" src="{{ asset('app-assets/site_assets/img/326576456534.jpg') }}" alt="photo" /></a>
                            </div>
                            <div class="entry-meta">
                                <time class="entry-meta__item" datetime="2019-01-31">June 12, 2020</time> <span class="entry-meta__item">
                                    by
                                    <a class="entry-meta__link text-primary" href="blog.html">Nevica</a></span> </div>
                            <div class="entry-main">
                                <div class="entry-header">
                                    <h2 class="entry-title"><a href="post.html">Beautiful towns for your Mallorca holidays on board</a></h2> </div>
                                <div class="entry-content">Thinking about your next getaway with Click&Boat? The Balearic Islands is a better option than ever since being added to the UK’s Green List for travel!</div>
                            </div> <a class="btn-post" href="#">Read More</a> </section>
                        <!-- end .b-post-->
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <section class="b-post b-post-3">
                            <div class="entry-media">
                                <a href="post.html"><img class="img-scale" src="{{ asset('app-assets/site_assets/img/sailing-on-vacation-EUT5FWG34.jpg') }}" alt="photo" /></a>
                            </div>
                            <div class="entry-meta">
                                <time class="entry-meta__item" datetime="2019-01-31">June 3, 2020</time> <span class="entry-meta__item">
                                    by
                                    <a class="entry-meta__link text-primary" href="blog.html">Nevica</a></span> </div>
                            <div class="entry-main">
                                <div class="entry-header">
                                    <h2 class="entry-title"><a href="post.html">Sail Through the Islands and Anchorages of La Maddalena</a></h2> </div>
                                <div class="entry-content">Located in the north-east of the Italian island of Sardinia, off the Costa Smeralda, the La Maddalena archipelago is the ideal destination for a Mediterranean cruise with Click&Boat!</div>
                            </div> <a class="btn-post" href="#">Read More</a> </section>
                        <!-- end .b-post-->
                    </div>
                </div>
                <div class="text-center mt-3"><a class="btn btn-border view-all-boats" href="#">Visit Our Blog</a></div>
            </div>
        </section>
        <section class="section-default section-banners">
            <div class="container text-center">
                <h2 class="press_logo_title">Press mentions</h2>
                <img class="press_line" src="{{ asset('app-assets/site_assets/img/decore03.png') }}" alt="photo">
                <div class="press_logo_img text-center"> <img src="{{ asset('app-assets/site_assets/img/banners.webp') }}" alt="photo"> </div>
            </div>
        </section>

@endsection