@section('title', __('website\home.blogdetails'))
@section('css')

@endsection
<div>
    	<!-- start section -->
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-9">
                        <div class="content-container">
                            <!-- start posts -->
                            <div class="posts">
                                <!-- start item -->
                                <div class="__item">
                                    <img class="lazy" width="100%" src="{{ asset('Dashboard/img/blogs/'.$blog->image->filename) }}"
                                    data-src="{{ asset('Dashboard/img/blogs/'.$blog->image->filename) }}" alt="demo" />

                                    <div class="__content">
                                        <div class="mb-6 mb-md-8">
                                            <time class="__date-post">{{ $blog->created_at->diffforhumans() }}</time>

                                            <p class="__category"><a href="#">{{ $blog->title }}</a></p>

                                            <h3 class="__title h5">{{ $blog->admin->firstname }}{{ $blog->admin->lastname }}</h3>
                                        </div>

                                        <p>{{ $blog->body }}</p>

                                        <!-- <p>
                                            Our team has a passion for making things with real value. This has led us to assemble a multi-talented group that can do just about anything: from building sets to photographing food, crafting websites to developing apps, beautiful design to adventure cinematography. Designers, engineers, creatives, makers, developers, artists, unite. Let’s do something real-special together.Our team has a passion for making things with real value. This has led us to assemble a multi-talented group that can do just about anything: from building sets to photographing food, crafting websites to developing apps, beautiful design to adventure cinematography.
                                        </p>

                                        <blockquote class="blockquot">
                                            <p>
                                                <i>This has led us to assemble a multi-talented group that can do just about anything: from building sets to photographing food, crafting websites to developing apps, beautiful design to adventure cinematography. Designers, engineers, creatives,</i>
                                            </p>
                                        </blockquote>

                                        <p>
                                            We believe in helping brands create through strategy, story-telling, digital products, and integrated experiences on web, mobile, and in the world. And you're here, friends, because you also believe.
                                        </p>

                                        <p>
                                            Our team has a passion for making things with real value. This has led us to assemble a multi-talented group that can do just about anything: from building sets to photographing food, crafting websites to developing apps, beautiful design to adventure cinematography. Designers, engineers, creatives, makers, developers, artists, unite. Let’s do something real-special together. Our team has a passion for making things with real value. This has led us to assemble a multi-talented group that can do just about anything: from building sets to photographing food, crafting websites to developing apps, beautiful design to adventure cinematography.
                                        </p>-->
                                    </div>
                                </div>
                                <!-- end item -->
                            </div>
                            <!-- end posts -->
                        </div>

                        <!-- ###################################################################3 -->
                            <?php
                            $type='blogs';
                            $type_id=$blog->id;
                            ?>
                            @include('livewire.front.comments')
                        <!-- ###################################################################3 -->

                    </div>

                    <div class="col-12 my-6 d-md-none"></div>

                    <div class="col-12 col-md-4 col-lg-3">
                        <aside class="sidebar">
                            <!-- start widget -->
                            <div class="widget widget--text">
                                <h4 class="h6 widget-title">About</h4>

                                <p>
                                    We believe in helping brands create through strategy, story-telling, digital products, and integrated experiences on web, mobile, and in the world.
                                </p>
                            </div>
                            <!-- end widget -->

                            <!-- start widget -->
                            <div class="widget widget--categories">
                                <h4 class="h6 widget-title">CAtegories</h4>

                                <ul class="list">
                                    <li class="list__item">
                                        <a class="list__item__link" href="#">Strategy</a>
                                        <span>(3)</span>
                                    </li>

                                    <li class="list__item">
                                        <a class="list__item__link" href="#">Technology</a>
                                        <span>(5)</span>
                                    </li>

                                    <li class="list__item">
                                        <a class="list__item__link" href="#">Creative</a>
                                        <span>(2)</span>
                                    </li>

                                    <li class="list__item">
                                        <a class="list__item__link" href="#">Content</a>
                                        <span>(8)</span>
                                    </li>
                                </ul>
                            </div>
                            <!-- end widget -->

                            <!-- start widget -->
                            <div class="widget widget--search">
                                <form class="form--horizontal" action="#" method="get">
                                    <div class="input-wrp">
                                        <input class="textfield" name="s" type="text" placeholder="Search" />
                                    </div>

                                    <button class="custom-btn custom-btn--tiny custom-btn--style-1" type="submit" role="button">Find</button>
                                </form>
                            </div>
                            <!-- end widget -->

                            <!-- start widget -->
                            <div class="widget widget--posts">
                                <h4 class="h6 widget-title">Features Posts</h4>

                                <div>
                                    <article>
                                        <a class="link" href="#">
                                            <img class="lazy" width="100" height="75" src="img/blank.gif" data-src="img/posts_img/1s.jpg" alt="demo" />
                                        </a>

                                        <div>
                                            This has led us to assemble a multi

                                            <span class="date-post">April 12, 2017</span>
                                        </div>
                                    </article>

                                    <article>
                                        <a class="link" href="#">
                                            <img class="lazy" width="100" height="75" src="img/blank.gif" data-src="img/posts_img/2s.jpg" alt="demo" />
                                        </a>

                                        <div>
                                            Our team has a passion for making things with

                                            <span class="date-post">April 12, 2017</span>
                                        </div>
                                    </article>
                                </div>
                            </div>
                            <!-- end widget -->

                            <!-- start widget -->
                            <div class="widget widget--tags">
                                <h4 class="h6 widget-title">Popular Tags</h4>

                                <ul>
                                    <li><a href="#">Art</a></li>
                                    <li><a href="#">design</a></li>
                                    <li><a href="#">concept</a></li>
                                    <li><a href="#">Media</a></li>
                                    <li><a href="#">Photography</a></li>
                                    <li><a href="#">UI</a></li>
                                </ul>
                            </div>
                            <!-- end widget -->

                            <!-- start widget -->
                            <div class="widget widget--banner">
                                <a href="#"><img class="img-fluid  lazy" src="img/blank.gif" data-src="img/widget_banner.jpg" alt="demo" /></a>
                            </div>
                            <!-- end widget -->
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->

        <!-- start section -->
        <section class="section section--no-pt">
            <div class="container">
                <ul class="post-nav">
                    <li class="post-nav__item">
                        <a class="post-nav__link post-nav__link--prev" href="#">
                            <span class="d-table">
                                <span class="d-table-cell align-middle"><i class="ico fontello-left-1"></i></span>
                                <span class="d-table-cell align-middle">
                                    Previous reading
                                    <span class="name">Health Benefits of a Raw Food</span>
                                </span>
                            </span>
                        </a>
                    </li>

                    <li class="post-nav__item">
                        <a class="post-nav__link post-nav__link--next" href="#">
                            <span class="d-table">
                                <span class="d-table-cell align-middle">
                                    next reading
                                    <span class="name">Tips for Ripening your Fruit</span>
                                </span>
                                <span class="d-table-cell align-middle"><i class="ico fontello-right-1"></i></span>
                            </span>
                        </a>
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
            <div class="g_map" data-api-key="AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" data-longitude="44.958309" data-latitude="34.109925" data-marker="img/marker.png" style="min-height: 255px"></div>
        </section>
        <!-- end section -->

</div>
@section('js')
<script>
     function show_form(comment_id){
        alert(comment_id);
    }
</script>

@endsection
