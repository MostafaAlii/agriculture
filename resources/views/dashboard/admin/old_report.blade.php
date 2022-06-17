<!-- Start Animal Collapse Section -->
@can('animal-reports')
<section id="collapsible">
    <!-- Start First Row -->
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card default-collapse collapse-icon accordion-icon-rotate">
                <a id="headingCollapse51" class="card-header bg-dark" data-toggle="collapse" href="#collapse51" aria-expanded="true" aria-controls="collapse51">
                    <div class="card-title lead white">
                        <i class="ft-activity mr-50"></i>
                        {{__('Admin\site.reporting')}} / {{__('Admin\site.animal_wealth')}}
                    </div>
                </a>
                <div id="collapse51" role="tabpanel" aria-labelledby="headingCollapse51" class="card-collapse collapse" aria-expanded="true">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <!-- Start Animal Statistics -->
                                @can('statistics-report')
                                    <div class="col-xl-3 col-lg-6 col-12">
                                        <a href="{{ route('animals.index_statistics') }}">
                                            <div class="card pull-up">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media d-flex">
                                                            <div class="media-body text-left">
                                                                <h3 class="gray-bg" style="color: purple;">{{ \App\Models\CawProject::where('marketing_side','like','private')->count() }}</h3>
                                                                <h6>  {{ trans('Admin/animals.animals_private_supported') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: purple;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-purple" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan

                            <!-- Start Chicken Statistics Report -->
                                @can('chicken-report-statistics')
                                    <div class="col-xl-3 col-lg-6 col-12">
                                        <a href="{{ route('chicken.statistic_index') }}">
                                            <div class="card pull-up">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media d-flex">
                                                            <div class="media-body text-left">
                                                                <h3 class="gray-bg" style="color: green;">{{ \App\Models\ChickenProject::where('marketing_side','like','govermental')->count() }}</h3>
                                                                <h6>  {{ trans('Admin/animals.chicken_statistic_report') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: green;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                            <!-- End Chicken Startstics Report -->

                            </div>
                            <!-- End Row -->

                        </div>
                        <!-- End Card Body -->
                    </div>
                    <!-- End Card Content -->
                </div>
                <!-- End div #colapse51 -->
            </div>
        </div>
    </div>
    <!-- End First Row -->
</section>
@endcan
<!-- End Animal Collapse Section -->

<!-- Start Horticulture البستنة -->
@can('horticulture-reports')
<section id="collapsible">
    <!-- Start First Row -->
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card default-collapse collapse-icon accordion-icon-rotate">
                <a id="headingCollapse52" class="card-header bg-dark" data-toggle="collapse" href="#collapse52" aria-expanded="true" aria-controls="collapse52">
                    <div class="card-title lead white">
                        <i class="ft-activity mr-50"></i>
                        {{__('Admin\site.reporting')}} / {{__('Admin\site.Horticulture')}}
                    </div>
                </a>
                <div id="collapse52" role="tabpanel" aria-labelledby="headingCollapse52" class="card-collapse collapse" aria-expanded="true">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <!-- Start Orchard Statistics -->
                                @can('orchard-report-statistics')
                                    <div class="col-xl-3 col-lg-6 col-12">
                                        <a href="{{ route('orchards.statistics_index') }}">
                                            <div class="card pull-up">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media d-flex">
                                                            <div class="media-body text-left">
                                                                <h3 class="gray-bg" style="color: purple;">{{ \App\Models\Orchard::count() }}</h3>
                                                                <h6>  {{ trans('Admin/orchards.Report_on_the_lands_planted_with_trees') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: purple;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-purple" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                                <!-- End Orchard Statistics -->
                                <!-- Start Protect House Statistics -->
                                @can('protected-house-statistics')
                                    <div class="col-xl-3 col-lg-6 col-12">
                                        <a href="{{ route('protected_house_index') }}">
                                            <div class="card pull-up">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media d-flex">
                                                            <div class="media-body text-left">
                                                                <h3 class="gray-bg" style="color: deeppink;">{{ \App\Models\ProtectedHouse::count() }}</h3>
                                                                <h6>  {{ trans('Admin/p_houses.report_on_the_number_of_greenhouses') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: deeppink;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-pink" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                                <!-- End Protect House Statistics -->


                            </div>
                            <!-- End Row -->
                        </div>
                        <!-- End Card Body -->
                    </div>
                    <!-- End Card Content -->
                </div>
                <!-- End div #colapse52 -->
            </div>
        </div>
    </div>
    <!-- End First Row -->
</section>
@endcan
<!-- Start Horticulture البستنة -->

<!-- Start planet_protection المناحل -->
@can('beekeeper-reports')
<section id="collapsible">
    <!-- Start First Row -->
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card default-collapse collapse-icon accordion-icon-rotate">
                <a id="headingCollapse53" class="card-header bg-dark" data-toggle="collapse" href="#collapse53" aria-expanded="true" aria-controls="collapse53">
                    <div class="card-title lead white">
                        <i class="ft-activity mr-50"></i>
                        {{__('Admin\site.reporting')}} / {{__('Admin\site.planet_protection')}}
                    </div>
                </a>
                <div id="collapse53" role="tabpanel" aria-labelledby="headingCollapse53" class="card-collapse collapse" aria-expanded="true">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <!-- Start Beekepper Statistics -->
                                @can('bee-keepers-statistics')
                                    <div class="col-xl-3 col-lg-6 col-12">
                                        <a href="{{ route('beekeepers.index_statistics') }}">
                                            <div class="card pull-up">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media d-flex">
                                                            <div class="media-body text-left">

                                                                <h3 class="gray-bg" style="color: green;">{{ \App\Models\BeeKeeper::count() }}</h3>
                                                                <h6>  {{ trans('Admin/bees.Apiaries_report_to_the_judiciary') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: green;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-purple" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                                <!-- End Beekepper Statistics -->

                            </div>
                            <!-- End Row -->
                        </div>
                        <!-- End Card Body -->
                    </div>
                    <!-- End Card Content -->
                </div>
                <!-- End div #colapse53 -->
            </div>
        </div>
    </div>
    <!-- End First Row -->
</section>
@endcan
<!-- End planet_protection المناحل -->

<!-- Start Service Report -->
@can('service-reports')
<section id="collapsible">
    <!-- Start First Row -->
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card default-collapse collapse-icon accordion-icon-rotate">
                <a id="headingCollapse54" class="card-header bg-dark" data-toggle="collapse" href="#collapse54" aria-expanded="true" aria-controls="collapse54">
                    <div class="card-title lead white">
                        <i class="ft-activity mr-50"></i>
                        {{__('Admin\site.reporting')}} / {{__('Admin\site.services')}}
                    </div>
                </a>
                <div id="collapse54" role="tabpanel" aria-labelledby="headingCollapse54" class="card-collapse collapse" aria-expanded="true">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <!-- Start farmer-service-statistics -->
                                @can('farmer-service-statistics')
                                    <div class="col-xl-3 col-lg-6 col-12">
                                        <a href="{{ route('farmer_index_statistics') }}">
                                            <div class="card pull-up">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media d-flex">
                                                            <div class="media-body text-left">
                                                                <h3 class="gray-bg" style="color: blue;">{{ \App\Models\FarmerService::count() }}</h3>
                                                                <h6>  {{ trans('Admin/services.farmer_services_report') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: blue;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                                <!-- End farmer-service-statistics -->
                                <!-- Start precipitation-statistics -->
                                @can('precipitation-statistics')
                                    <div class="col-xl-3 col-lg-6 col-12">
                                        <a href="{{ route('precipitations.index_statistic') }}">
                                            <div class="card pull-up">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media d-flex">
                                                            <div class="media-body text-left">
                                                                <h3 class="gray-bg" style="color: deeppink;">{{ \App\Models\Precipitation::count() }}</h3>
                                                                <h6>  {{ trans('Admin/precipitations.precipitation_report') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: deeppink;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-pink" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                                <!-- End precipitation-statistics -->

                                <!-- Start precipitation-details-statistics -->
                                {{--@can('precipitation-details-statistics')--}}
                                    {{--<div class="col-xl-3 col-lg-6 col-12">--}}
                                        {{--<a href="{{ route('precipitations.index_details_statistic') }}">--}}
                                            {{--<div class="card pull-up">--}}
                                                {{--<div class="card-content">--}}
                                                    {{--<div class="card-body">--}}
                                                        {{--<div class="media d-flex">--}}
                                                            {{--<div class="media-body text-left">--}}
                                                                {{--<h3 class="gray-bg" style="color: orange;">{{ \App\Models\Precipitation::count() }}</h3>--}}
                                                                {{--<h6>  {{ trans('Admin/precipitations.precipitation_details_report') }}</h6>--}}
                                                            {{--</div>--}}
                                                            {{--<div>--}}
                                                                {{--<i class="fa fa-list-alt" aria-hidden="true" style="color: orange;"></i>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="progress progress-sm mt-1 mb-0 box-shadow-2">--}}
                                                            {{--<div class="progress-bar bg-gradient-x-red" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--@endcan--}}
                                <!-- End precipitation-details-statistics -->
                            </div>
                            <!-- End Row -->
                        </div>
                        <!-- End Card Body -->
                    </div>
                    <!-- End Card Content -->
                </div>
                <!-- End div #colapse53 -->
            </div>
        </div>
    </div>
    <!-- End First Row -->
</section>
@endcan
<!-- End Service Report -->

<!-- Start planning Report التخطيط -->
@can('planning-reports')
<section id="collapsible">
    <!-- Start First Row -->
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card default-collapse collapse-icon accordion-icon-rotate">
                <a id="headingCollapse55" class="card-header bg-dark" data-toggle="collapse" href="#collapse55" aria-expanded="true" aria-controls="collapse55">
                    <div class="card-title lead white">
                        <i class="ft-activity mr-50"></i>
                        {{__('Admin\site.reporting')}} / {{__('Admin\site.planning')}}
                    </div>
                </a>
                <div id="collapse55" role="tabpanel" aria-labelledby="headingCollapse55" class="card-collapse collapse" aria-expanded="true">
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Start First Row -->
                            <div class="row">
                                <!-- Start land_areas_report -->
                                @can('land-area-report')
                                    <div class="col-xl-3 col-lg-6 col-12">
                                        <a href="{{ route('index_land_area_statistics') }}">
                                            <div class="card pull-up">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media d-flex">
                                                            <div class="media-body text-left">

                                                                <h3 class="gray-bg" style="color: blue;">{{ \App\Models\LandArea::count() }}</h3>
                                                                <h6>  {{ trans('Admin/land_areas.land_areas_report') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: blue;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                                <!-- End land_areas_report -->

                                <!-- Start land_areas_details_report -->
                                {{--@can('land-area-details-report')--}}
                                    {{--<div class="col-xl-3 col-lg-6 col-12">--}}
                                        {{--<a href="{{ route('land_area_details.statistic') }}">--}}
                                            {{--<div class="card pull-up">--}}
                                                {{--<div class="card-content">--}}
                                                    {{--<div class="card-body">--}}
                                                        {{--<div class="media d-flex">--}}
                                                            {{--<div class="media-body text-left">--}}

                                                                {{--<h3 class="gray-bg" style="color: purple;">{{ \App\Models\LandArea::count() }}</h3>--}}
                                                                {{--<h6>  {{ trans('Admin/land_areas.land_areas_details_report') }}</h6>--}}
                                                            {{--</div>--}}
                                                            {{--<div>--}}
                                                                {{--<i class="fa fa-list-alt" aria-hidden="true" style="color: purple;"></i>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="progress progress-sm mt-1 mb-0 box-shadow-2">--}}
                                                            {{--<div class="progress-bar bg-gradient-x-purple" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--@endcan--}}
                                {{--<!-- End land_areas_details_report -->--}}

                                {{--<!-- Start land_areas_state_report -->--}}
                                {{--@can('land-area-state-report')--}}
                                    {{--<div class="col-xl-3 col-lg-6 col-12">--}}
                                        {{--<a href="{{ route('land_area_state.statistic') }}">--}}
                                            {{--<div class="card pull-up">--}}
                                                {{--<div class="card-content">--}}
                                                    {{--<div class="card-body">--}}
                                                        {{--<div class="media d-flex">--}}
                                                            {{--<div class="media-body text-left">--}}

                                                                {{--<h3 class="gray-bg" style="color: green;">{{ \App\Models\LandArea::count() }}</h3>--}}
                                                                {{--<h6>  {{ trans('Admin/land_areas.land_areas_state_report') }}</h6>--}}
                                                            {{--</div>--}}
                                                            {{--<div>--}}
                                                                {{--<i class="fa fa-list-alt" aria-hidden="true" style="color: green;"></i>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="progress progress-sm mt-1 mb-0 box-shadow-2">--}}
                                                            {{--<div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--@endcan--}}
                                <!-- End land_areas_state_report -->

                                <!-- Start farmer-crop-statistics -->
                                @can('statistics_index')
                                    <div class="col-xl-3 col-lg-6 col-12">
                                        <a href="{{ route('statistics_index') }}">
                                            <div class="card pull-up">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media d-flex">
                                                            <div class="media-body text-left">

                                                                <h3 class="gray-bg" style="color: yellow;">{{ \App\Models\FarmerCrop::count() }}</h3>
                                                                <h6>  {{ trans('Admin/crops.farmer_crops_report') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: yellow;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-yellow" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                                <!-- End farmer-crop-statistics -->
                            </div>
                            <!-- End First Row -->

                            <!-- Start Second Row -->
                            <div class="row">
                                <!-- Start Income Product Statitistics -->
                                @can('income-product-statistics')
                                    <div class="col-xl-3 col-lg-6 col-12">
                                        <a href="{{ route('index_income_products') }}">
                                            <div class="card pull-up">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media d-flex">
                                                            <div class="media-body text-left">

                                                                <h3 class="gray-bg" style="color: blue;">{{ \App\Models\IncomeProduct::count() }}</h3>
                                                                <h6>  {{ trans('Admin/income_products.income_products_report') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: blue;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                            </div>

                            <div class="row">

                                {{--@can('index_outcome_products')--}}
                                    <div class="col-xl-3 col-lg-6 col-12">
                                        <a href="{{ route('index_outcome_products') }}">
                                            <div class="card pull-up">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media d-flex">
                                                            <div class="media-body text-left">

                                                                <h3 class="gray-bg" style="color: purple;">{{ \App\Models\OutcomeProduct::count() }}</h3>
                                                                <h6>  {{ trans('Admin/outcome_products.outcome_products_report') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: purple;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-purple" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                {{--@endcan--}}
                                <!-- End outcome_product_statistics -->


                            </div>
                            <!-- End Third Row -->


                        </div>
                        <!-- End Card Body -->
                    </div>
                    <!-- End Card Content -->
                </div>
                <!-- End div #colapse53 -->
            </div>
        </div>
    </div>
    <!-- End First Row -->
</section>
@endcan
<!-- End planning Report التخطيط -->
