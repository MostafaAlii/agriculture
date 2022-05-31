   <!-- start section -->
   <section class="section section--no-pb">
        <div class="container">
            <div class="section-heading section-heading--center" data-aos="fade">
                <h2 class="__title">{{__('Admin/team.title2')}}<span>{{__('Admin/team.title1')}}</span></h2>
            </div>

            <!-- start team -->
            <div class="team">
                <div class="__inner">
                    <div class="row">

                    @foreach($teams as $t)
                        <!-- start item -->
                        
                            <div class="col-12 col-md-6 col-lg-4">
                              <a href="{{route('team_profile',encrypt($t->id))}}">
                                  <div class="__item" data-aos="fade" data-aos-delay="100" data-aos-offset="0">
                                    <figure class="__image">
                                        <img class="lazy" src="{{ asset('Dashboard/img/team/'.$t->image) }}" data-src="{{ asset('Dashboard/img/team/'.$t->image) }}" alt="demo" />
                                    </figure>

                                    <div class="__content">
                                        <h5 class="__title">{{$t->name}}</h5>

                                        <span>{{$t->position}}</span>
                                    </div>
                                </div>
                              </a>
                            </div>
                        
                        <!-- end item -->
                    @endforeach
                    </div>
                </div>
            </div>
            <!-- end team -->
            <br>
        </div>
    </section>
    <!-- end section -->