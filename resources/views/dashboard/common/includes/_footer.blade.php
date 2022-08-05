<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
        <span class="float-md-left d-block d-md-inline-block">
            {{ trans('Admin/general.copyright') }} &copy; 2022 
            <a class="text-bold-800 grey darken-2">
                {{ ucfirst(setting()->site_name) }}
            </a>
        </span>
        <span class="float-md-right d-none d-lg-block">
            {{  trans('Admin/general.madeby')  }}
            @if(app()->getLocale()=='ar')
                {{ config('app.Morasoft_ar') }} 
            @elseif(app()->getLocale()=='ku')
                {{ config('app.Morasoft_ku') }}
            @else
                {{ config('app.Morasoft_en') }}
            @endif
            <i class="ft-heart pink"></i>
        </span>
    </p>
</footer>
<!-- END: Footer-->