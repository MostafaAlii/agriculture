<div class="card border-0 rounded-0 p-lg-4 bg-light">
    <div class="card-body">
        <h5 class="text-uppercase mb-4"></h5>
        <div class="py-2 px-4 mb-3 {{ Route::currentRouteName() == 'vendor.dashboard' ? 'bg-dark text-white' : 'bg-light' }}">
            <a href="{{ route('vendor.dashboard') }}">
                <strong class="small text-uppercase font-weight-bold">{{ trans('Website/vendor/dashboard.dashboardInSidebar') }}</strong>
            </a>
        </div>
        <div class="py-2 px-4 mb-3 {{ Route::currentRouteName()=='vendor.orders'?'bg-dark text-white':'bg-light' }}">
            <a href="{{ route('vendor.orders') }}">
                <strong class="small text-uppercase font-weight-bold">{{ trans('Website/vendor/dashboard.my_orders') }}</strong>
            </a>
        </div>
    </div>
</div>
