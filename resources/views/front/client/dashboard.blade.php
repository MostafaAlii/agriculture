@extends('front.layouts.master5')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('title')
    {{ trans('Website/vendor/dashboard.dashboardPageTitle') }}
@endsection

@section('content')
    @include('dashboard.common._partials.messages')
    <!-- Start Content Wrapper -->
    <div class="content-wrapper py-3">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pt-lg-3 mt-5">
                        <h4 class="card-title shadow p-3 mb-5 bg-white rounded">
                            <i class="fa fa-tachometer" aria-hidden="true"> </i> 
                            {{ trans('Website/vendor/dashboard.dashboardPageTitle') . ' / ' . \Auth::user()->firstname . ' ' .\Auth::user()->lastname }}
                        </h4>
                        <hr>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <section class="py-3">
                                <div class="row">
                                    <div class="col-lg-4" style="width: 35%;float:left !important;">
                                        @include('front.layouts.include.client.sidebar')
                                    </div>
                                    <div class="col-lg-8 shadow p-3 mb-5 bg-white rounded" style="min-height:35%;width: 65%;float:right !important;">
                                        <div class="container shadow p-3 mb-5 bg-white rounded">
                                            <h4>
                                                <i class="fa fa-line-chart" aria-hidden="true"> </i> 
                                                {{ trans('Website/vendor/dashboard.dashboardInSidebar') }} :
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

