<div>
    @if(count(\App\Models\Category::get())>0)
    <!-- start widget -->
        <div class="widget widget--categories">
            <h4 class="h6 widget-title">{{ __('website\search.Categories') }}</h4>
            <ul class="list" id="blog_cates">
            @foreach(\App\Models\Category::get() as $cate)
                @if($cate->products()->count()>0)
                    @if($cate->parent_id==Null)
                        <li class="list__item" id="{{$cate->id}}" onclick="javascript:search_result('products',this.id,'Category')" >
                            <a class="list__item__link" >{{$cate->name}}</a>
                            <span>({{count($cate->products)}})</span>
                        </li>
                        @if(count($cate->childs)>0)
                            <?php
                            $new = [
                                'page_name'=>'products',
                                'childs' => $cate->childs,
                                'padding' => 20,
                            ];
                            ?>
                            @include('livewire.front.categoryChilds', $new)
                        @endif
                    @endif
                @endif
            @endforeach
            </ul>
        </div>
    <!-- end widget -->
    @endif
</div>
