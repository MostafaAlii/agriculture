

<h3 class="font-weight-bold badge badge-pill badge-{{
    $worker->salary == 'perday' ? 'success' : 'info'  }}" style="font-size: 15px;">
   {{$worker->salary == 'perday' ?  __('Admin/site.perday') : __('Admin/site.perhour')}}
</h3>
