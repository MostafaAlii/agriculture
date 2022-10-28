@extends('front.layouts.master7')
@section('title', __('website\home.farmer'))

@section('css')

@endsection
@section('content')
<div>
    <section class="section">
        <div class="container">
            <div class="goods-catalog mb-3">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-3">
                        <aside class="sidebar goods-filter">
                            <span class="goods-filter-btn-close js-toggle-filter"><i class="fontello-cancel"></i></span>
                            <div class="goods-filter__inner">
                                <livewire:front.search-farmer-component />
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
            <div class="posts posts--style-1">

                <div class="__inner">
                    <div class="row">
                        @foreach($farmers as $farmer)
                            <!-- start item -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="__item __item--preview">
                                    <figure class="__image">
                                        <img class="mr-2 users-avatar-shadow rounded-circle img-preview" width="35%" src=" {{ $farmer->image_path ?
                                            $farmer->image_path : URL::asset('Dashboard/img/Default/default_farmer.jpg') }}"
                                            alt="{{ $farmer->name }}">
                                    </figure>
                                    <div class="__content">
                                        <p class="__category"><a href="{{ route('farmer_detail',encrypt($farmer->id) ) }}">{{ $farmer->firstname.'  '.$farmer->lastname  }}</a></p>

                                    </div>
                                </div>
                            </div>
                            <!-- end item -->
                        @endforeach
                    </div>
                    {{$farmers->links('page-links_nowire')}}
                </div>
            </div>
        </div>
    </section>
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
