<div>
    @section('title', __('website\home.blogdetails'))
    @section('css')

    @endsection
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

                        <br>
                       <center>
                        <h3> Leave Comment</h3>
                        <hr>
                        
                        <form class="auth-form" name="form-login" method="POST" action="/blogs/{{ $blog->id }}/comments">
                            @csrf
                            <div class="input-wrp">
                                <input class="textfield"  name="author" value="{{ old('author')}}" required
                                     autofocus placeholder=" author name" />
                            </div>
                            @error('author')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="input-wrp">
                              <textarea name="text" class="textfield" cols="30" rows="5" placeholder="comments" required>{{ old('text')}}</textarea> 
                                
                            </div>
                            @error('text')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                                <input type="hidden" name="from" value="add">
                            <div class="d-table mt-8">
                                <div class="d-table-cell align-middle">
                                    <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit"
                                        role="button">نشر</button>
                                </div>
                            </div>
                        </form>
                        </center>
                        <hr>

                        <!-- {{$blog->comments_count}} -->
                        <h2> Comments</h2>
                        
                        <table>
                            @foreach ($comments as $comment)
                            
                                <tr>
                                    <td width="100%">
                                        <time class="comment__date-post">{{$comment->created_at}}</time>
                                        <br>
                                        <span class="comment__author-name">{{ $comment->author }}</span>
                                        <p>{{ $comment->text }}</p>
                                        <div class="text-right">
                                            <a class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1" href="#">REPLY</a>
                                        </div>
                                    </td>
                                </tr>


                                <!-- start replay form -->
                                <div id="replay_{{$comment->id}}" style="display:none">
                                    <form class="auth-form" name="form-login" method="POST" action="/blogs/{{ $blog->id }}/comments">
                                        @csrf
                                        <div class="input-wrp">
                                            <input class="textfield"  name="author" value="{{ old('author')}}" required
                                                autofocus placeholder=" author name" />
                                        </div>
                                        @error('author')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <div class="input-wrp">
                                        <textarea name="text" class="textfield" cols="30" rows="5" placeholder="comments" required>{{ old('text')}}</textarea> 
                                            
                                        </div>
                                        @error('text')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                            <input type="hidden" name="from" value="replay">
                                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                        <div class="d-table mt-8">
                                            <div class="d-table-cell align-middle">
                                                <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit"
                                                    role="button">نشر</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end replay form -->


                                <!-- if there are replays for this comment ,show them -->
                                @if(count($comment->childs))
                                    <?php
                                    $new=[
                                        'childs' => $comment->childs,
                                        'padding'=>50,
                                        'color'=>'#99ebaf',
                                        'number'=>2,
                                        'blod_id'=>$blog->id,
                                    ];
                                    ?>
                                    @include('livewire.front.mangeCommentReplay',$new)
                                @endif
                                <!-- end of replays for this comment -->
                                
                                
                            @endforeach
                        </table>

                        ............................................................
                       
                        ............................................................
                        <!-- start posts feedback -->
                        <div class="posts-feedback">
                            <h6>4 Comments</h6>

                            <ul class="comments-list">
                                <li class="comment">

                                    <table>
                                        <tr>
                                            <td>
                                                <div class="d-none d-lg-block">

                                                    <div class="comment__author-img">
                                                        <img class="img-fluid lazy" width="70" src="img/blank.gif" data-src="img/avatar.jpg" alt="demo" />
                                                    </div>

                                                </div>
                                            </td>

                                            <td width="100%">
                                                <time class="comment__date-post">April 12, 2017</time>

                                                <div class="d-flex align-items-center mb-3 mb-lg-0">
                                                    <div class="d-block d-lg-none">

                                                        <div class="comment__author-img">
                                                            <img class="img-fluid lazy" width="70" src="img/blank.gif" data-src="img/avatar.jpg" alt="demo" />
                                                        </div>

                                                    </div>

                                                    <span class="comment__author-name">Terens Smith</span>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td>
                                                <p>
                                                    Our team has a passion for making things with real value. This has led us to assemble a multi-talented group that can do just about anything: from building sets to photographing food, crafting websites to developing apps, beautiful design to adventure cinematography. Designers, engineers, creatives, makers, developers, artists, unite.
                                                </p>

                                                <div class="text-right">
                                                    <a class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1" href="#">REPLY</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                    <ul>
                                        <li class="comment">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <div class="d-none d-lg-block">

                                                            <div class="comment__author-img">
                                                                <img class="img-fluid lazy" width="70" src="img/blank.gif" data-src="img/avatar.jpg" alt="demo" />
                                                            </div>

                                                        </div>
                                                    </td>

                                                    <td width="100%">
                                                        <time class="comment__date-post">April 12, 2017</time>

                                                        <div class="d-flex align-items-center mb-3 mb-lg-0">
                                                            <div class="d-block d-lg-none">

                                                                <div class="comment__author-img">
                                                                    <img class="img-fluid lazy" width="70" src="img/blank.gif" data-src="img/avatar.jpg" alt="demo" />
                                                                </div>

                                                            </div>

                                                            <span class="comment__author-name">Terens Smith</span>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <p>
                                                            Our team has a passion for making things with real value. This has led us to assemble a multi-talented group that can do just about anything: from building sets to photographing food, crafting websites to developing apps, beautiful design to adventure cinematography. Designers, engineers, creatives, makers, developers, artists, unite.
                                                        </p>

                                                        <div class="text-right">
                                                            <a class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1" href="#">REPLY</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>

                                            <ul>
                                                <li class="comment">
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <div class="d-none d-lg-block">

                                                                    <div class="comment__author-img">
                                                                        <img class="img-fluid lazy" width="70" src="img/blank.gif" data-src="img/avatar.jpg" alt="demo" />
                                                                    </div>

                                                                </div>
                                                            </td>

                                                            <td width="100%">
                                                                <time class="comment__date-post">April 12, 2017</time>

                                                                <div class="d-flex align-items-center mb-3 mb-lg-0">
                                                                    <div class="d-block d-lg-none">

                                                                        <div class="comment__author-img">
                                                                            <img class="img-fluid lazy" width="70" src="img/blank.gif" data-src="img/avatar.jpg" alt="demo" />
                                                                        </div>

                                                                    </div>

                                                                    <span class="comment__author-name">Terens Smith</span>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td></td>
                                                            <td>
                                                                <p>
                                                                    Our team has a passion for making things with real value. This has led us to assemble a multi-talented group that can do just about anything: from building sets to photographing food, crafting websites to developing apps, beautiful design to adventure cinematography. Designers, engineers, creatives, makers, developers, artists, unite.
                                                                </p>

                                                                <div class="text-right">
                                                                    <a class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1" href="#">REPLY</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="comment">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <div class="d-none d-lg-block">

                                                            <div class="comment__author-img">
                                                                <img class="img-fluid lazy" width="70" src="img/blank.gif" data-src="img/avatar.jpg" alt="demo" />
                                                            </div>

                                                        </div>
                                                    </td>

                                                    <td width="100%">
                                                        <time class="comment__date-post">April 12, 2017</time>

                                                        <div class="d-flex align-items-center mb-3 mb-lg-0">
                                                            <div class="d-block d-lg-none">

                                                                <div class="comment__author-img">
                                                                    <img class="img-fluid lazy" width="70" src="img/blank.gif" data-src="img/avatar.jpg" alt="demo" />
                                                                </div>

                                                            </div>

                                                            <span class="comment__author-name">Terens Smith</span>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <p>
                                                            Our team has a passion for making things with real value. This has led us to assemble a multi-talented group that can do just about anything: from building sets to photographing food, crafting websites to developing apps, beautiful design to adventure cinematography. Designers, engineers, creatives, makers, developers, artists, unite.
                                                        </p>

                                                        <div class="text-right">
                                                            <a class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1" href="#">REPLY</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </li>
                                    </ul>
                                </li>

                                <li class="comment">
                                    <table>
                                        <tr>
                                            <td>
                                                <div class="d-none d-lg-block">

                                                    <div class="comment__author-img">
                                                        <img class="img-fluid lazy" width="70" src="img/blank.gif" data-src="img/avatar.jpg" alt="demo" />
                                                    </div>

                                                </div>
                                            </td>

                                            <td width="100%">
                                                <time class="comment__date-post">April 12, 2017</time>

                                                <div class="d-flex align-items-center mb-3 mb-lg-0">
                                                    <div class="d-block d-lg-none">

                                                        <div class="comment__author-img">
                                                            <img class="img-fluid lazy" width="70" src="img/blank.gif" data-src="img/avatar.jpg" alt="demo" />
                                                        </div>

                                                    </div>

                                                    <span class="comment__author-name">Terens Smith</span>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td>
                                                <p>
                                                    Our team has a passion for making things with real value. This has led us to assemble a multi-talented group that can do just about anything: from building sets to photographing food, crafting websites to developing apps, beautiful design to adventure cinematography. Designers, engineers, creatives, makers, developers, artists, unite.
                                                </p>

                                                <div class="text-right">
                                                    <a class="comment__reply custom-btn custom-btn--tiny custom-btn--style-1" href="#">REPLY</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </li>
                            </ul>

                            <div class="mt-6 mt-lg-10 mb-lg-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-12 col-md-auto mb-6">
                                        <div class="post-author">
                                            <div class="d-table">
                                                <div class="d-table-cell align-middle">
                                                    <div class="post-author__img">
                                                        <img class="img-fluid lazy" width="70" src="img/blank.gif" data-src="img/avatar.jpg" alt="demo" />
                                                    </div>
                                                </div>

                                                <div class="d-table-cell align-middle">
                                                    <span>Posted by</span>
                                                    <span class="post-author__name">Terens Smith</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-auto mb-6">
                                        <div class="share-btns">
                                            <ul>
                                                <li><a class="fb" href="#"><i class="fontello-facebook"></i>facebook</a></li>
                                                <li><a class="tw" href="#"><i class="fontello-twitter"></i>twitter</a></li>
                                                <li><a class="ggl" href="#"><i class="fontello-gplus"></i>google plus</a></li>
                                                <li><a class="pt" href="#"><i class="fontello-pinterest-circled"></i>pinterest</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6>Leave a Reply</h6>

                            <form action="#">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="input-wrp">
                                            <input class="textfield" type="text" value="" placeholder="Name" />
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="input-wrp">
                                            <input class="textfield" type="text" value="" placeholder="E-mail" />
                                        </div>
                                    </div>
                                </div>

                                <div class="input-wrp">
                                    <textarea class="textfield" placeholder="Comments"></textarea>
                                </div>

                                <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit" role="button">post comment</button>
                            </form>
                        </div>
                        <!-- end posts feedback -->
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