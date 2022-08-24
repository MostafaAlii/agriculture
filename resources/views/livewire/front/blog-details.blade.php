@section('title', __('website\home.blogdetails'))
@section('css')

@endsection
<div>
    <!-- start section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9" id="search_data">
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

                                        <p class="__category" style="font-size: 20px;font-weight: bold;">
                                            <a href="#">{{ $blog->title }}</a>
                                        </p>

                                        <h3 class="__title h5">{{ $blog->admin->firstname }}{{ $blog->admin->lastname }}</h3>
                                    </div>

                                    <p>{!! $blog->body !!}</p>

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
                            <form class="form--horizontal" action="" method="get">
                                <div class="input-wrp">
                                    <input class="textfield" type="text" placeholder="{{ __('website\search.search_text') }}" name="search" id="search" required/>
                                    <input type="hidden" id="alert_txt" value="{{__('website\search.enter_txt')}}">
                                </div>

                                    <button class="custom-btn custom-btn--tiny custom-btn--style-1" type="button" role="button"  onclick="javascript:input_search_result()">{{ __('website\search.search') }}</button>
                                </form>
                            </div>
                            <!-- end widget -->

                            @if(count($blog->categories)>0)
                            <!-- start widget -->
                            <div class="widget widget--categories">
                                <h4 class="h6 widget-title">{{ __('website\search.Categories') }}</h4>
                                <ul class="list" id="blog_cates">
                                   @foreach($blog->categories as $cate)
                                        @if($cate->parent_id==Null)
                                            <li class="list__item" id="{{$cate->id}}" onclick="javascript:search_result('blogs',this.id,'Category')" >
                                                <a class="list__item__link" >{{$cate->name}}</a>
                                                <span>({{count($cate->blogs)}})</span>
                                            </li>
                                            @if(count($cate->childs)>0)
                                                <?php
                                                $new = [
                                                    'page_name'=>'blogs',
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
                            @endif

                            @if(count($blog->tags)>0)
                            <!-- start widget -->
                            <div class="widget widget--tags">
                                <h4 class="h6 widget-title">{{ __('website\search.Tags') }}</h4>

                                <ul id="all_tags">
                                    @foreach($blog->tags as $tag)
                                    <li id="{{$tag->id}}" onclick="javascript:search_result('blogs',this.id,'Tag')"><a style="color:#36df33">{{$tag->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- end widget -->
                            @endif
                            <!-- start widget -->
                            {{-- <div class="widget widget--banner">
                                <a href="#"><img class="img-fluid  lazy" src="img/blank.gif" data-src="img/widget_banner.jpg" alt="demo" /></a>
                            </div> --}}
                            <!-- end widget -->
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--no-pt">
        <div class="container">
            <ul class="post-nav">
                <?php
                $num=1;
                foreach($random_blogs as $blog2){
                if($num==1){
                    $cond='prev';
                    $cond2='<span class="d-table-cell align-middle"><i class="ico fontello-left-1"></i></span>';
                    $cond3='';
                }else{
                    $cond='next';
                    $cond2='';
                    $cond3='<span class="d-table-cell align-middle"><i class="ico fontello-right-1"></i></span>';
                }
                ?>
                <li class="post-nav__item">
                    <a class="post-nav__link post-nav__link--{{$cond}}" href="{{ route('blogdetails',encrypt($blog2->id) ) }}">
                        <span class="d-table">
                            <?php echo $cond2;?>
                            <span class="d-table-cell align-middle">
                                 <span class="name">{{$blog2->title}}</span>
                            </span>
                            <?php echo $cond3;?>
                        </span>
                    </a>
                </li>
                <?php
                $num++;
                 }
                 ?>

            </ul>
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
@section('js')
@endsection
