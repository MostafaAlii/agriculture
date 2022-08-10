@section('title', __('website\home.aboutus'))
@section('css')

@endsection
<br>
<br>
<div>
    @foreach($about_us as $info)
   	<!-- start section -->
<<<<<<< HEAD
       <section class="section section--no-pb section--custom-01" style="background-image: url('<?php echo asset('Dashboard/img/about/'.$info->image);?>');">
=======

       <section class="section section--no-pb " >
>>>>>>> 0c8600301304f45ac0969f13a779b26329fafb1b
        <div class="container">
           
            <div class="section-heading">
                <h2 class="__title">{{$info->title}}</h2>
            </div>

<<<<<<< HEAD
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-8">
                    <p>{!! $info->description !!} </p>

                </div>
=======
            <div class="row" style="height: 40rem;">
                <div class="col-md-6 col-sm-8 ">
                    <p>{!! $info->description !!} </p>

                </div>
                <div class="col-md-6 col-sm-8 section--custom-01" style="background-image: url('<?php echo asset('Dashboard/img/about/'.$info->image);?>');">
                    
                </div>
>>>>>>> 0c8600301304f45ac0969f13a779b26329fafb1b
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
