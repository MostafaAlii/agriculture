@extends('front.layouts.master2')
@section('title', 'about us ')
@section('css')

@endsection
@section('content')
    <!-- start section -->
    <section class="section section--no-pb section--custom-01">
        <div class="container">
            <div class="section-heading">
                <h2 class="__title">We are <span>Agriculture Farm</span></h2>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6 col-xl-8">


                    <p>
                        Our team has a passion for making things with real value. This has led us to assemble a multi-talented group that can do just about anything: from building sets to photographing food, crafting websites to developing apps, beautiful design to adventure cinematography.crafting websites to developing apps, beautiful design to adventure cinematography.
                    </p>

                    <p>
                        <a class="custom-btn custom-btn--medium custom-btn--style-1" href="#">Get in Touch</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class="section">
        <div class="container">
            <!-- start counters -->
            <div class="counter">
                <div class="__inner">
                    <div class="row justify-content-sm-center">
                        <!-- start item -->
                        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3">
                            <div class="__item" data-aos="zoom-in" data-aos-duration="350" data-aos-delay="150">
                                <div class="d-table">
                                    <div class="d-table-cell align-middle">
                                        <i class="__ico">
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/ico/ico_count_1-1.png')}}" alt="demo" />
                                        </i>
                                    </div>

                                    <div class="d-table-cell align-middle">
                                        <p class="__count js-count" data-from="0" data-to="19500">19 500</p>

                                        <p class="__title">Tons of harvest</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->


                    </div>
                </div>
            </div>
            <!-- end counters -->
        </div>
    </section>
    <!-- end section -->





@endsection
@push('js')

@endpush
