@extends('front.layouts.master7')
@section('title', __('Admin\site.worker'))

@section('css')

@endsection
@section('content')
<div>
    <!-- start section -->
    <section class="section">

        <div class="container">
            <!-- start posts -->
            <div class="posts posts--style-1">
                <div class="__inner">
                    <div class="row">
                        @foreach($workers as $worker)
                            <!-- start item -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="__item __item--preview">
                                    <figure class="__image">
                                        @if($worker->image->filename)
                                            <img  src="{{ asset('Dashboard/img/workers/'.$worker->image->filename) }}"
                                            data-src="{{ asset('Dashboard/img/workers/'.$worker->image->filename) }}"
                                            alt="demo" />
                                        @else
                                           <img  src="{{ asset('Dashboard/img/images/blogs-img/blog-article-1.jpg') }}"
                                           data-src="{{ asset('Dashboard/img/images/blogs-img/blog-article-1.jpg') }}" alt="demo" />
                                        @endif
                                    </figure>
                                    <div class="__content">
                                        <p class="__category"><a href="{{ route('worker_detail',encrypt($worker->id) ) }}">{{ $worker->firstname.'  '.$worker->lastname  }}</a></p>

                                    </div>
                                </div>
                            </div>
                            <!-- end item -->
                        @endforeach


                    </div>
                    {{$workers->links('page-links_nowire')}}
                </div>
            </div>
            <!-- end posts -->
        </div>
    </section>
    <!-- end section -->


    <!-- start section -->
    <section class="section section--dark-bg">
        <div class="container">
            <div class="section-heading section-heading--center section-heading--white" data-aos="fade">
                <h2 class="__title">Get <span>in touch</span></h2>

                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
            </div>

            <form class="contact-form js-contact-form" action="#" data-aos="fade">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="input-wrp">
                            <input class="textfield" name="name" type="text" placeholder="Name" />
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="input-wrp">
                            <input class="textfield" name="email" type="text" placeholder="E-mail" />
                        </div>
                    </div>
                </div>

                <div class="input-wrp">
                    <textarea class="textfield" name="message" placeholder="Comments"></textarea>
                </div>

                <button class="custom-btn custom-btn--medium custom-btn--style-3 wide" type="submit" role="button">Send</button>

                <div class="form__note"></div>
            </form>
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--no-pt section--no-pb">
        <!-- this is demo key "AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" -->
        <div class="g_map"
        data-api-key="AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U"
        data-longitude="44.958309"
        data-latitude="34.109925"
        data-marker="img/marker.png"
        style="min-height: 255px"></div>
    </section>
    <!-- end section -->
</div>
@endsection
