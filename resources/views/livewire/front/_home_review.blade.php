@if(count($reviews)>0)
        <!-- start section -->
        <section class="section section--review  lazy" data-src="{{ asset('frontassets/img/review_bg_1.png') }}">
            <div class="container">
                <div class="section-heading section-heading--center" data-aos="fade">
                    <h2 class="__title">{{__('Admin/about.review_title')}}</h2>
                </div>

                <!-- start review -->
                <div class="review review--slider">
                    <div class="js-slick" data-slick='{"autoplay": true, "arrows": false, "dots": true, "speed": 1000}'>
                    @foreach($reviews as $rev)
                    <!-- start item -->
                            {{-- @if(app()->getLocale() == 'ar' ) --}}
                                <div class="review__item">
                                    <div class="review__item__text">
                                        <p>
                                            <i>{{$rev->message}}</i>

                                        </p>
                                    </div>

                                    <div class="review__item__author  d-table">
                                        <div class="d-table-cell align-middle">
                                            <span class="review__item__author-name"><strong>{{$rev->name}}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            {{-- @endif --}}
                            {{-- @if(app()->getLocale() == 'en')
                            <div class="review__item">
                                <div class="review__item__text">
                                    <p>
                                        <i>{{$rev->message}}</i>
                                    </p>
                                </div>

                                <div class="review__item__author  d-table">
                                    <div class="d-table-cell align-middle">
                                        <span class="review__item__author-name"><strong>{{$rev->name}}</strong></span>
                                    </div>
                                </div>
                            </div>
                            @endif --}}
                        <!-- end item -->
                    @endforeach

                    </div>
                </div>
                <!-- start review -->
            </div>
        </section>
        <!-- end section -->
@endif
