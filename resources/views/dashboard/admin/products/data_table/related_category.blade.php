@foreach ($product->categories as $category)
    <div class="text-primary text-bold">
        <span>{{$category->name}}</span>
    </div>
@endforeach