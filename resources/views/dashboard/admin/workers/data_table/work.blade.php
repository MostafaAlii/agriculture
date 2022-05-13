

<h3 class="font-weight-bold badge badge-pill badge-{{
    $worker->work == 'alone' ? 'success' : 'info'  }}" style="font-size: 15px;">
   {{$worker->work == 'alone' ?  __('Admin/site.alone') : __('Admin/site.team')}}
</h3>
