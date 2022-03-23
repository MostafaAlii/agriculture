<div>
    @section('title', __('website\home.blog'))
    @section('css')

    @endsection

    <!-- start section -->
    <section class="section">
        <div class="container">
            <!-- start posts -->
            <div class="posts posts--style-1">
                <div class="__inner">
                    <div class="row">
                        @foreach(App\Models\Blog::limit(6)->latest()->get() as $blog)
                            <!-- start item -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="__item __item--preview">
                                    <figure class="__image">
                                        @if($blog->image->filename)
                                            <img class="lazy" src="{{ asset('Dashboard/img/blogs/'.$blog->image->filename) }}"
                                            data-src="{{ asset('Dashboard/img/blogs/'.$blog->image->filename) }}"
                                            alt="demo" />
                                        @else
                                           <img class="lazy" src="{{ asset('frontassets/img/blank.gif') }}"
                                           data-src="{{ asset('frontassets/img/posts_img/1.jpg') }}" alt="demo" />
                                        @endif
                                    </figure>
                                    <div class="__content">
                                        <p class="__category"><a href="#">{{ $blog->title }}</a></p>
                                        <h3 class="__title h5"><a href="#">{{ $blog->title }}</a></h3>
                                        <p>{{ $blog->body }}</p>
                                    </div>
                                    <span class="__date-post">
                                        <strong>{{ $blog->created_at->diffforhumans() }}</p></strong>
                                    </span>
                                </div>
                            </div>
                            <!-- end item -->
                        @endforeach
                        {{-- <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/posts_img/1.jpg') }}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <p class="__category"><a href="#">DIET/ORGANIC FOOD</a></p>

                                    <h3 class="__title h5"><a href="blog_details.html">Health Benefits of a Raw Food</a></h3>

                                    <p>
                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                    </p>
                                </div>

                                <span class="__date-post">
                                    <strong>03</strong>Nov
                                </span>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/posts_img/1.jpg') }}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <p class="__category"><a href="#">DIET/ORGANIC FOOD</a></p>

                                    <h3 class="__title h5"><a href="blog_details.html">Superfoods you should be eating</a></h3>

                                    <p>
                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                    </p>
                                </div>

                                <span class="__date-post">
                                    <strong>25</strong>Oct
                                </span>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/posts_img/1.jpg') }}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <p class="__category"><a href="#">ORGANIC FOOD/TIPS & GUIDES</a></p>

                                    <h3 class="__title h5"><a href="blog_details.html">Tips for Ripening your Fruit</a></h3>

                                    <p>
                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                    </p>
                                </div>

                                <span class="__date-post">
                                    <strong>07</strong>Nov
                                </span>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/posts_img/1.jpg') }}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <p class="__category"><a href="#">DIET/ORGANIC FOOD</a></p>

                                    <h3 class="__title h5"><a href="blog_details.html">Health Benefits of a Raw Food</a></h3>

                                    <p>
                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                    </p>
                                </div>

                                <span class="__date-post">
                                    <strong>03</strong>Nov
                                </span>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/posts_img/1.jpg') }}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <p class="__category"><a href="#">DIET/ORGANIC FOOD</a></p>

                                    <h3 class="__title h5"><a href="blog_details.html">Superfoods you should be eating</a></h3>

                                    <p>
                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                    </p>
                                </div>

                                <span class="__date-post">
                                    <strong>25</strong>oct
                                </span>
                            </div>
                        </div>
                        <!-- end item --> --}}
                    </div>
                </div>
            </div>
            <!-- end posts -->
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--no-pt">
        <div class="container">
            <ul class="page-nav">
                <li class="page-nav__item">
                    <a href="#" class="page-nav__link page-nav__link--prev"><i class="ico fontello-left-1"></i>Older post</a>
                </li>
                <li class="page-nav__item">
                    <a href="#" class="page-nav__link page-nav__link--next">Newer post<i class="ico fontello-right-1"></i></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--dark-bg">
        <div class="container">
            <div class="section-heading section-heading--center section-heading--white" data-aos="fade">
                <h2 class="__title">Get <span>in touch</span></h2>

                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
            </div>

            <form class="contact-form js-contact-form" action="#" data-aos="fade">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="input-wrp">
                            <input class="textfield" name="name" type="text" placeholder="Name" />
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="input-wrp">
                            <input class="textfield" name="email" type="text" placeholder="E-mail" />
                        </div>
                    </div>
                </div>

                <div class="input-wrp">
                    <textarea class="textfield" name="message" placeholder="Comments"></textarea>
                </div>

                <button class="custom-btn custom-btn--medium custom-btn--style-3 wide" type="submit" role="button">Send</button>

                <div class="form__note"></div>
            </form>
        </div>
    </section>
    <!-- end section -->

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
