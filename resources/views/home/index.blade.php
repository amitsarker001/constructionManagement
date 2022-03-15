<?php
/**
 * Created By: Amit Sarker
 * Created Date: 20-08-2020
 */
?>

@extends('layouts.master')
@section('content')
    <!-- Slider start -->
    <section id="home" class="p-0">
        <div id="main-slide" class="cd-hero">
            <ul class="cd-hero-slider">
                <li class="selected">
                    <div class="overlay2">
                        <img class="" src="{{asset('assets/images/slider/banner_image.jpg')}}" alt="slider">
                    </div>
                    <div class="cd-full-width">
                        {{--                    <h2>Need To Invent The Future!</h2>--}}
                        {{--                    <h3>We Making Difference To Great Things Possible</h3>--}}
                        <?php
                        $customerObj = new \App\Customer();
                        $customerId = $customerObj->getLoggedinCustomerId();
                        ?>
                        @if(intval($customerId) <= 0)
                            <a href="{{URL::to('signup')}}" class="btn btn-primary solid cd-btn">Register Now</a>
                        @endif
                        <a href="{{URL::to('assessment/instruction')}}"
                           class="btn btn-primary solid cd-btn">Instruction</a>
                    </div> <!-- .cd-full-width -->
                </li>
                <li>
                    <div class="overlay2">
                        <img class="" src="{{asset('assets/images/slider/bg2.jpg')}}" alt="slider">
                    </div>
                    <div class="cd-half-width">
                        <h2></h2>
                        <p></p>
                        <a href="#0" class="cd-btn btn btn-primary solid"></a>
                    </div> <!-- .cd-half-width -->

                    <div class="cd-half-width cd-img-container">
                        <img src="{{asset('assets/images/slider/bg-thumb1.png')}}" alt="">
                    </div> <!-- .cd-half-width.cd-img-container -->
                </li>
                <li>
                    <div class="overlay2">
                        <img class="" src="{{asset('assets/images/slider/bg3.jpg')}}" alt="slider">
                    </div>
                    <div class="cd-half-width cd-img-container img-right">
                        <img src="{{asset('assets/images/slider/bg-thumb2.png')}}" alt="">
                    </div> <!-- .cd-half-width.cd-img-container -->
                    <div class="cd-half-width">
                        <h2></h2>
                        <p></p>
                        <a href="#0" class="cd-btn btn btn-primary white"></a>
                        <a href="#0" class="cd-btn btn secondary btn-primary solid"></a>
                    </div> <!-- .cd-half-width -->
                </li>
                <li class="cd-bg-video">
                    <div class="cd-full-width">
                        <h2></h2>
                        <h3></h3>

                        <a href="#0" class="cd-btn btn btn-primary solid"></a>
                    </div> <!-- .cd-full-width -->

                    <div class="cd-bg-video-wrapper" data-video="videos/video">
                        <!-- video element will be loaded using jQuery -->
                    </div> <!-- .cd-bg-video-wrapper -->
                </li>
            </ul>
            <!--/ cd-hero-slider -->

        {{--            <div class="cd-slider-nav">--}}
        {{--                <nav>--}}
        {{--                    <span class="cd-marker item-1"></span>--}}
        {{--                    <ul>--}}
        {{--                        <li class="selected"><a href="#0"><i class="fa fa-bicycle"></i> Invent</a></li>--}}
        {{--                        <li><a href="#0"><i class="fa fa-hotel"></i> Dream</a></li>--}}
        {{--                        <li><a href="#0"><i class="fa fa-android"></i> Tech</a></li>--}}
        {{--                        <li class="video"><a href="#0"><i class="fa fa-video-camera"></i> Video</a></li>--}}
        {{--                    </ul>--}}
        {{--                </nav>--}}
        {{--            </div> --}}
        <!-- .cd-slider-nav -->

        </div>
        @if (session()->has('customerSession'))

        @else
            <video class="promotional-video" width="320" poster="{{asset(('assets/images/logo.png'))}}" height="240" controls autoplay>
                <source src="{{asset('assets/videos/promotional')}}.mp4" type="video/mp4">
                <source src="{{asset('assets/videos/promotional')}}.ogg" type="video/ogg">
                Your browser does not support the video tag.
            </video>
    @endif
    {{--controls--}}
    <!--/ Main slider end -->
    </section>
    <!--/ Slider end -->

    <!-- Team start -->
    <section id="team" class="team">
        <div class="container">
            <div class="row">
                <div class="col-md-12 heading">
                    <span class="title-icon float-left"><i class="fa fa-handshake-o"></i></span>
                    <h2 class="title">Pricing</h2>
                </div>
            </div><!-- Title row end -->

            <div class="row">
                <!-- plan start -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay=".5s"
                     style="visibility: hidden; -webkit-animation-name: none; -moz-animation-name: none; animation-name: none;-webkit-animation-delay: .5s; -moz-animation-delay: .5s; animation-delay: .5s;">
                    <div class="plan text-center">
                        <span class="plan-name">Submit By Yourself <small></small></span>
                        <p class="plan-price"><strong>{{getArrayValueByKey(1, getPaymentPlanWiseAmount())}}</strong><sup
                                class="currency">{{getCurrencyIsoCode()}}</sup>
                        </p>
                        <ul class="list-unstyled">
                            <li>Pay Now And <strong>Download</strong> Your Tax Return</li>
                        </ul>
                        <a class="btn btn-primary" href="{{URL::to('assessment/assessmentSteps')}}">Assessment Now</a>
                    </div>
                </div><!-- plan end -->

                <!-- plan start -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="1s"
                     style="visibility: hidden; -webkit-animation-name: none; -moz-animation-name: none; animation-name: none;-webkit-animation-delay: 1s; -moz-animation-delay: 1s; animation-delay: 1s;">
                    <div class="plan text-center">
                        <span class="plan-name">Submit By One Point <small></small></span>
                        <p class="plan-price"><strong>{{getArrayValueByKey(2, getPaymentPlanWiseAmount())}}</strong><sup
                                class="currency">{{getCurrencyIsoCode()}}</sup>
                        </p>
                        <ul class="list-unstyled">
                            <li>Pay Now And <strong>Download</strong> Your Tax Return</li>
                        </ul>
                        <a class="btn btn-primary" href="{{URL::to('assessment/assessmentSteps')}}">Assessment Now</a>
                    </div>
                </div><!-- plan end -->
            </div>
            <!--/ Content row end -->
        </div>
        <!--/ Container end -->
    </section>
    <!--/ Team end -->

    <section id="image-block" class="image-block p-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 ts-padding"
                     style="height:650px;background:url({{asset('assets/images/image-block-bg.jpg')}}) 50% 50% / cover no-repeat;">
                </div>
                <div class="col-md-6 ts-padding img-block-right">
                    <div class="img-block-head text-justify">
                        <h2>Know More About Our Company</h2>
                        <h3>Why Choose Us</h3>
                        <p><strong>Professional Service Level</strong></p>
                        <p>At very competitive rates, we provide high quality services. We collaborate with our
                            customers to understand their individual needs and efficiently and effectively provide
                            solutions. We make sure that we tailor our plan to meet the individual needs of our
                            customer.</p>
                        <p><strong>Cost-effective fees</strong></p>
                        <p>For all programs, we offer fixed and affordable fees. We believe in fairness and
                            transparency, and there are no secret accusations or nasty surprises.</p>
                        <p><strong>Availability</strong></p>
                        <p>It is always easy to approach our committed and welcoming team members. To minimize your tax
                            burden and increase your earnings, we give practical advice. By offering the best possible
                            guidance to respond to their accounting needs, we seek to meet our customers' standards.</p>
                        <p><strong>Specialism in tax</strong></p>
                        <p>We are very proud of the integrity of our work and are committed to upholding our levels of
                            professionalism. We specialize in tax savings guidance for sole traders and small limited
                            firms.</p>
                    </div>
                    <div class="gap-30"></div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Image block end -->

    <!-- Parallax 1 start -->
    <section class="parallax parallax1">
        <div class="parallax-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Do you want to prepare and complete return ?
                        <br/>review return with our expert tax consultant ?
                        <br/>submit return
                        by {{getCompanyName()}}</h3>
                    <p>
                        <a class="btn btn-primary" href="{{URL::to('assessment/assessmentSteps')}}"><span
                                class="blinking font-weight-bold">Assessment Now</span>
                        </a>
                    </p>
                </div>
            </div>
        </div><!-- Container end -->
    </section><!-- Parallax 1 end -->


    <!-- Clients start -->
    <section id="clients" class="clients payment-method">
        <div class="container">
            <div class="row">
                <div class="col-md-12 heading">
                    <span class="title-icon float-left"><i class="fa fa-handshake-o"></i></span>
                    <h2 class="title" style="color: #323232">We Accept</h2>
                </div>
            </div>
            <div class="row wow fadeInLeft">
                <div id="client-carousel" class="col-sm-12 owl-carousel owl-theme text-center client-carousel">
                    <figure class="m-0 item client_logo">
                        <a>
                            <img src="{{asset('assets/images/payment/visa.png')}}" alt="Visa">
                        </a>
                    </figure>
                    <figure class="m-0 item client_logo">
                        <a>
                            <img src="{{asset('assets/images/payment/master.png')}}" alt="Master">
                        </a>
                    </figure>
                    <figure class="m-0 item client_logo">
                        <a>
                            <img src="{{asset('assets/images/payment/bkash.png')}}" alt="bKash">
                        </a>
                    </figure>
                    <figure class="m-0 item client_logo">
                        <a>
                            <img src="{{asset('assets/images/payment/nagad.png')}}" alt="Nagad">
                        </a>
                    </figure>
                </div><!-- Owl carousel end -->
            </div><!-- Main row end -->
        </div>
        <!--/ Container end -->
    </section>
    <!--/ Clients end -->
@endsection
