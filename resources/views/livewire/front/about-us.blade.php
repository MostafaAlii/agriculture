@section('title', __('website\home.aboutus'))
@section('css')

@endsection
<br>
<br>
<div>
    @foreach($about_us as $info)
   	<!-- start section -->
       <section class="section section--no-pb section--custom-01" style="background-image: url('<?php echo asset('Dashboard/img/about/'.$info->image);?>');">
        <div class="container">
           
            <div class="section-heading">
                <h2 class="__title">{{$info->title}}</h2>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6 col-xl-8">
                    <p>{!! $info->description !!} </p>

                </div>
            </div>
            
        </div>
        <br>
    </section>
    <!-- end section -->
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
