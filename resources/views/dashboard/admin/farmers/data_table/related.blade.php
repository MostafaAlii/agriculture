<a href="{{ route('farmer.product.data',encrypt($farmer->id)) }}">
    <span class="font-weight-bold badge badge-pill badge-{{
        $farmer->products->count() == 0 ? 'danger' : 'success'  }}">
        {{ $farmer->products->count()}}
    </span>
</a>
