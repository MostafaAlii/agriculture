@section('title', __('website\home.aboutus'))
@section('css')

@endsection
<br>
<br>
<div>
    @foreach($about_us as $info)
        @if(app()->getLocale()=='ar' || app()->getLocale()=='ku')
            <section class="section section--no-pb section--custom-01"
            style="background-image: url('{{ asset('Dashboard/img/about/'.$info->image) }}');
                margin-left: 100px;
                margin-bottom: 30px;">
                    <div class="container">
                        <div class="section-heading">
                            <h2 class="__title">{{$info->title}}</h2>
                        </div>
                        <div class="row">
                            <div class="row" style="height: 30rem;">
                                <div class="col-md-6 col-sm-8 " style="flex: 0 0 80%;max-width: 80%;margin-right: -164px !important;margin-top: -40px;text-align: right;">
                                    <p>{!! $info->description !!} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
            </section>
          @else
            <section class="section section--no-pb section--custom-01"
                style="background-image: url('<?php echo asset('Dashboard/img/about/'.$info->image);?>');
                margin-left: 100px;
                margin-bottom: 30px;">
                    <div class="container">
                        <div class="section-heading">
                            <h2 class="__title">{{$info->title}}</h2>
                        </div>
                        <div class="row">
                            <div class="row" style="height: 30rem;">
                                <div class="col-md-6 col-sm-8" style="flex: 0 0 80%;max-width: 80%;margin-right: -164px !important;margin-top: -40px;text-align: right;">
                                    <p>{!! $info->description !!} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
            </section>
        @endif
    @endforeach


@include('livewire.front._counter')

{{-- @include('livewire.front._team') --}}
  <!-- start section -->
  <section class="section section--no-pb">
    <div class="container">
        <div class="col-12 col-md-8 col-lg-3" id="search_data">
            <div class="spacer py-6 d-md-none"></div>
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <style>
                        .textfield.nice-select {
                            padding-right: 177px !important;
                            /* display:inline !important; */
                            display:none !important;
                        }
                        .textfield {
                            /* display:none !important; */
                            display:inline !important;
                        }
                    </style>
                   <livewire:front.search-team-component />
                </div>
            </div>
            <div class="spacer py-6 d-md-none"></div>
        </div>
        <div class="section-heading section-heading--center" data-aos="fade">
            <h2 class="__title">{{__('Admin/team.title2')}}<span>{{__('Admin/team.title1')}}</span></h2>
        </div>
        <div class="team">
            <div class="__inner">
                <div class="row">
                    @forelse ($teams as $t)
                        <div class="col-12 col-md-6 col-lg-4">
                            <a href="{{route('team_profile',encrypt($t->id))}}">
                                <div class="__item" data-aos="fade" data-aos-delay="100" data-aos-offset="0">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('Dashboard/img/team/'.$t->image) }}"
                                    data-src="{{ asset('Dashboard/img/team/'.$t->image) }}" alt="demo" />
                                </figure>
                                <div class="__content">
                                    <h5 class="__title">{{$t->name}}</h5>
                                    <span>{{$t->position}}</span>
                                </div>
                            </div>
                            </a>
                        </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <strong>{{ __('website/home.nodata') }}</strong>
                        </div>
                    </div>
                    @endforelse
                </div>
                {{$teams->links('page-links_nowire')}}
            </div>
        </div>
        <br>
    </div>
  </section>
<!-- end section -->

@include('livewire.front._brand')

@include('livewire.front._review_form')

    <!-- start section -->
    <section class="section section--no-pt section--no-pb">
        <!-- this is demo key "AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" -->
        <div class="g_map" data-api-key="AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" data-longitude="44.958309" data-latitude="34.109925" data-marker="img/marker.png') }}" style="min-height: 255px"></div>
    </section>
    <!-- end section -->
</div>

