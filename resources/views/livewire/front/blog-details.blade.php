@section('title', __('website\home.blogdetails'))
@section('css')

@endsection
<div>
    	<!-- start section -->
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-9" id="blog_data">
                        <div class="content-container">
                            <!-- start posts -->
                            <div class="posts">
                                <!-- start item -->
                                <div class="__item">
                                    <img  width="100%" src="{{ asset('Dashboard/img/blogs/'.$blog->image->filename) }}"
                                    data-src="{{ asset('Dashboard/img/blogs/'.$blog->image->filename) }}" alt="demo" />

                                    <div class="__content">
                                        <div class="mb-6 mb-md-8">
                                            <time class="__date-post">{{ $blog->created_at->diffforhumans() }}</time>

                                            <p class="__category"><a href="#">{{ $blog->title }}</a></p>

                                            <h3 class="__title h5">{{ $blog->admin->firstname }}{{ $blog->admin->lastname }}</h3>
                                        </div>

                                        <p>{{ $blog->body }}</p>

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
                            <div class="widget widget--categories">
                                <h4 class="h6 widget-title">CAtegories</h4>
                                <ul class="list" id="blog_cates">
                                   @foreach($blog->categories as $cate)
                                        @if($cate->parent_id==Null)
                                            <li class="list__item" id="{{$cate->id}}">
                                                <a class="list__item__link" href="#">{{$cate->name}}</a>
                                                <span>(3)</span>
                                            </li>
                                            @if(count($cate->childs)>0)
                                                <?php
                                                $new = [
                                                    'childs' => $cate->childs,
                                                    'padding' => 20,
                                                ];
                                                ?>
                                                @include('livewire.front.categoryChilds', $new)
                                            @endif
                                        @endif
                                    @endforeach
                                   
                                </ul>
                            </div>
                            <!-- end widget -->

                            <!-- start widget -->
                            <div class="widget widget--tags">
                                <h4 class="h6 widget-title">Popular Tags</h4>

                                <ul id="all_tags">
                                    @foreach($blog->tags as $tag)
                                    <li id="{{$tag->id}}"><a href="">{{$tag->name}}</a></li>
                                    @endforeach
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
@endsection
