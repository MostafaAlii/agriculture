
<h4 class="{{ $tag->status =='1' ? 'badge badge-success' : 'badge badge-danger' }}" style="font-size: 15px;">
    {{$tag->status =='1' ?  __('Admin/site.active') : __('Admin/site.unactive')}}
</h4>
