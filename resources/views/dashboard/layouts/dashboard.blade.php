@include('dashboard.common.includes._tpl_start')
@include('dashboard.common.includes._header')
@include('dashboard.common.includes._sidebar')

<!-- BEGIN: Content-->
<div class="app-content content">
    @yield('content')
</div>

@include('dashboard.common.includes._footer')
@include('dashboard.common.includes._tpl_end')