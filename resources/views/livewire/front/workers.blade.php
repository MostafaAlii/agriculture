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
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="__item __item--preview">
                                    <figure class="__image">
                                        
                                        <img class="mr-2 users-avatar-shadow rounded-circle img-preview" width="35%"
                                            src=" {{ $worker->image_path ?
                                            $worker->image_path : URL::asset('Dashboard/img/Default/default_worker.jpg') }}" alt="{{ $worker->firstname .' '. $worker->lastname }}">
                                    </figure>
                                    <div class="__content">
                                        <p class="__category"><a href="{{ route('worker_details',encrypt($worker->id) ) }}">{{ $worker->firstname.'  '.$worker->lastname  }}</a></p>

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


    @include('livewire.front._review_form')


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
