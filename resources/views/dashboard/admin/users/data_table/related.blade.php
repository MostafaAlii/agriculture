<a href="">
    <span class="font-weight-bold badge badge-pill badge-{{
        $user->orders->count() == 0 ? 'danger' : 'success'  }}">
         {{ $user->orders->count()}}
     </span>
</a>
