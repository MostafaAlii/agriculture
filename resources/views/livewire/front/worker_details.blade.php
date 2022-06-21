@extends('front.layouts.master7')
@section('title', __('website\home.worker_datails'))

<style>
/* -------------------------------------------------- */
div.stars {
  width: 270px;
  display: inline-block;
}
input.star { display: none; }
label.star {
  float: right;
  padding: 10px;
  font-size: 20px;
  color: #444;
  transition: all .2s;
}
input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}
input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}
input.star-1:checked ~ label.star:before { color: #F62; }
label.star:hover { transform: rotate(-15deg) scale(1.3); }
label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}

/* --------------------------------- */
.score {
  display: inline-block;
  font-family: Wingdings;
  font-size: 30px;
  color: #ccc;
  position: relative;
}
.score::before,
.score span::before{
  content: "\2605\2605\2605\2605\2605";
  display: block;
}
.score span {
  color: gold;
  position: absolute;
  top: 0;
  left: 0;
  overflow: hidden;
}
</style>

@section('css')
@endsection

@section('content')
<div>
    <!-- start section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12" id="blog_data">
                    <div class="content-container">
                        <!-- start posts -->
                        <div class="posts">
                            <!-- start item -->
                            <div class="__item">
                            @if($workers->image)
                                <a class="mr-2" href="#">
                                        <center><img src="{{ asset('Dashboard/img/workers/'. $workers->image->filename) }}"
                                        alt="{{ asset('Dashboard/img/workers/'. $workers->image->filename) }}"
                                        class="users-avatar-shadow rounded-circle img-preview"  width="30%"></center>
                                </a>
                            @else
                                <a class="mr-2" href="#">
                                    <img src="{{ asset('Dashboard/img/workers/avatar.jpg') }}"
                                    alt="{{ asset('Dashboard/img/workers/avatar.jpg') }}"
                                    class="users-avatar-shadow rounded-circle img-preview"  width="30%">
                                 </a>
                             @endif
                             {{-- <center> <span class="score" id="rate_msg" ><span style="width: <?php echo $workers->workerRate();?>%"></span></span></center> --}}

                                <div class="__content">
                                    <div class="mb-6 mb-md-8">
                                       <h3 class="__title h5">{{ $workers->firstname .' '.$workers->lastname }}</h3>
                                    </div>
                                    <input type="hidden" id="farmer_id" value="{{$workers->id}}">
                                    <!-- start form -->
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <p><b>@lang('Admin/site.name')  : </b> {{ $workers->firstname }} {{ $workers->lastname }}</p>
                                            <p><b>@lang('Admin/site.email') : </b> {{ $workers->email }}</p>
                                            <p><b>@lang('Admin/site.phone') : </b> {{ $workers->phone }}</p>
                                            {{-- <p><b>@lang('Admin/site.status') : </b> {{$workers->status == 1 ?  __('Admin/site.active') : __('Admin/site.unactive')}}</p> --}}
                                            <p><b>@lang('Admin/site.worktype') : </b> {{$workers->work == 'alone' ?  __('Admin/site.alone') : __('Admin/site.team')}}</p>
                                            <p><b>@lang('Admin/site.salarytype') : </b> {{$workers->salary == 'perday' ?  __('Admin/site.perday') : __('Admin/site.perhour')}}</p>
                                            @if($workers->daily_price != null)
                                               <p><b>@lang('Admin/site.daily') : </b> $ {{number_format($workers->daily_price,2) }}</p>
                                            @else
                                              <p><b>@lang('Admin/site.hourly') : </b> $ {{number_format($workers->hourly_price,2) }}</p>
                                            @endif
                                             <p><b>@lang('Admin/site.desc') : </b> {{ $workers->desc }}</p>
                                            <p><b>@lang('Admin/site.birthday') : </b> {{ $workers->birthdate }}</p>
                                            <p><b>@lang('Admin/site.address1') : </b> {{ $workers->address1 }}</p>
                                            <p><b>@lang('Admin/site.address2') : </b> {{ $workers->address2 }}</p>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">

                                            <p><b>@lang('Admin/site.country') : </b> {{ $workers->country->name ?? null }}</p>
                                            <p><b>@lang('Admin/site.province') : </b> {{ $workers->province->name ?? null }}</p>
                                            <p><b>@lang('Admin/site.area') : </b> {{ $workers->area->name ?? null }}</p>
                                            <p><b>@lang('Admin/site.state') : </b> {{ $workers->state->name ?? null }}</p>
                                            <p><b>@lang('Admin/site.village') : </b> {{ $workers->village->name ?? null }}</p>

                                        </div>
                                    </div>

                                    <!-- end form -->
                                </div>
                            </div>
                            <!-- end item -->
                        </div>
                        <!-- end posts -->
                    </div>

                    <!-- ###################################################################3 -->
                     <!-- --------------------------------------------------- -->
                     {{-- @if (Auth::guard('vendor')->user() )
                        <h4>{{ __('Website/comments.rate_now') }}</h4>
                        <form action="" style="margin-right: 50%;">
                            <input class="star star-5" id="star-5" type="radio" name="star" onclick="javascript:add_rate(5,'farmer');"/>
                            <label class="star star-5" for="star-5"></label>
                            <input class="star star-4" id="star-4" type="radio" name="star" onclick="javascript:add_rate(4,'farmer');"/>
                            <label class="star star-4" for="star-4"></label>
                            <input class="star star-3" id="star-3" type="radio" name="star" onclick="javascript:add_rate(3,'farmer');"/>
                            <label class="star star-3" for="star-3"></label>
                            <input class="star star-2" id="star-2" type="radio" name="star" onclick="javascript:add_rate(2,'farmer');"/>
                            <label class="star star-2" for="star-2"></label>
                            <input class="star star-1" id="star-1" type="radio" name="star" onclick="javascript:add_rate(1,'farmer');"/>
                            <label class="star star-1" for="star-1"></label>
                        </form>
                        <br>
                        <br>
                    @endif --}}
                        <!-- --------------------------------------------------- -->
                    <!-- ###################################################################3 -->


                    <!-- ###################################################################3 -->

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
