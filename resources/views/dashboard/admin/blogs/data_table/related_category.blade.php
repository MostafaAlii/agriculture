@if($blog->categories->count()>0)
    @foreach ($blog->categories as $category)
        <div class="text-primary text-bold">
            <span>{{$category->name}}</span>
        </div>
    @endforeach
@else
-
@endif