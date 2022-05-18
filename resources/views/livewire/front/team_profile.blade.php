@extends('front.layouts.master7')
@section('title', __('website\home.team_datail'))

@section('content')
<div>
    <!-- start section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12" id="blog_data">
                    <div class="content-container">
                        <?php
                        $teams= Illuminate\Support\Facades\Cache::get('teams');
                        ?>
                        @foreach($teams as $t)
                            @if(request()->route('id')==$t->id)
                            <!-- start posts -->
                            <div class="posts">
                                <!-- start item -->
                                <div class="__item">
                                @if($t->image)
                                    <a class="mr-2" href="#">
                                            <center><img src="{{ asset('Dashboard/img/team/'. $t->image) }}"
                                            alt="{{ asset('Dashboard/img/team/'. $t->image) }}"
                                            class="users-avatar-shadow rounded-circle img-preview"  width="30%"></center>
                                    </a>
                                @else
                                    <a class="mr-2" href="#">
                                        <img src="{{ asset('Dashboard/img/farmers/avatar.jpg') }}"
                                        alt="{{ asset('Dashboard/img/farmers/avatar.jpg') }}"
                                        class="users-avatar-shadow rounded-circle img-preview"  width="30%">
                                    </a>
                                @endif

                                    <div class="__content">
                                        <div class="mb-6 mb-md-8">
                                        <center><h3 class="__title h5">{{ $t->name }}</h3></center>
                                        <center><p>{{ $t->position }}</p></center>
                                    </div>

                                        <!-- start form -->
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <p>{{ $t->description }}</p>
                                            </div>
                                        </div>
                                    
                                        <!-- end form -->
                                    </div>
                                </div>
                                <!-- end item -->
                            </div>
                            <!-- end posts -->
                            @endif
                        @endforeach
                    </div>

                </div>

                <div class="col-12 my-6 d-md-none"></div>

            </div>
        </div>
    </section>
    <!-- end section -->


    @include('livewire.front._review_form')


    <!-- start section -->
    <section class="section section--no-pt section--no-pb">
        <!-- this is demo key "AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" -->
        <div class="g_map" data-api-key="AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" data-longitude="44.958309" data-latitude="34.109925" data-marker="img/marker.png" style="min-height: 255px"></div>
    </section>
    <!-- end section -->

</div>
@endsection
