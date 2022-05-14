

<h3 class="font-weight-bold badge badge-pill badge-{{
    $worker->status == 1 ? 'success' : 'danger'  }}" style="font-size: 15px;">
   {{$worker->status == 1 ?  __('Admin/site.active') : __('Admin/site.unactive')}}
</h3>
