@section('title', __('website\home.aboutus'))
@section('css')

@endsection
<br>
<br>
<div>
    @foreach($about_us as $info)
        @if(app()->getLocale()=='ar' || app()->getLocale()=='ku')
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

@include('livewire.front._team')

@include('livewire.front._brand')

@include('livewire.front._review_form')

    <!-- start section -->
    <section class="section section--no-pt section--no-pb">
        <!-- this is demo key "AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" -->
        <div class="g_map" data-api-key="AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" data-longitude="44.958309" data-latitude="34.109925" data-marker="img/marker.png') }}" style="min-height: 255px"></div>
    </section>
    <!-- end section -->
</div>
