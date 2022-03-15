<?php
/**
 * Created By: Amit Sarker
 * Created Date: 21-08-2020
 */
?>

@extends('layouts.master')
@section('content')
    <div id="banner-area">
        <img src="{{asset('assets/images/banner/banner1.jpg')}}" alt=""/>
        <div class="parallax-overlay"></div>
        <!-- Subpage title start -->
        <div class="banner-title-content">
            <div class="text-center">
                <h2>{{$pageTitle}}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item text-white" aria-current="page">{{$pageTitle}}</li>
                    </ol>
                </nav>
            </div>
        </div><!-- Subpage title end -->
    </div><!-- Banner area end -->
    <section id="main-container">
        <div class="container">
            <div class="w-100 text-justify">
                <h3 class="title-border">{{$pageTitle}}</h3>
            </div>
            <div class="w-100 text-justify">
                <p><strong>Professional Service Level</strong></p>
                <p>At very competitive rates, we provide high quality services. We collaborate with our customers to
                    understand their individual needs and efficiently and effectively provide solutions. We make sure
                    that we tailor our plan to meet the individual needs of our customer.</p>
                <p><strong>Cost-effective fees</strong></p>
                <p>For all programs, we offer fixed and affordable fees. We believe in fairness and transparency, and
                    there are no secret accusations or nasty surprises.</p>
                <p><strong>Availability</strong></p>
                <p>It is always easy to approach our committed and welcoming team members. To minimize your tax burden
                    and increase your earnings, we give practical advice. By offering the best possible guidance to
                    respond to their accounting needs, we seek to meet our customers' standards.</p>
                <p><strong>Specialism in tax</strong></p>
                <p>We are very proud of the integrity of our work and are committed to upholding our levels of
                    professionalism. We specialize in tax savings guidance for sole traders and small limited firms.</p>
                <p><strong>Online Processing</strong></p>
                <p>We offer accountancy services online. You don&rsquo;t have to visit our office. We use technology to
                    capture and process data, which makes life much simpler for our customers.</p>
                <p><strong>Always meet deadlines</strong></p>
                <p>We make sure that our client's deadline is never missed. Work is done at all times, on time. This is
                    why our client ranks us as one of the most reliable methods of accounting.</p>
                <p>&nbsp;</p>
            </div>
        </div>
    </section>
@endsection
