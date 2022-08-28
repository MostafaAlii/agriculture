@extends('dashboard.layouts.dashboard')
@section('css')

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="my-auto mb-0 content-title">Pages</h4><span
                        class="mt-1 mb-0 mr-2 text-muted tx-13">/ Empty</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="ml-2 btn btn-info btn-icon"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="ml-2 btn btn-danger btn-icon"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="ml-2 btn btn-warning btn-icon"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                            id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                         data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="news-container" id='news-container'>
        <ul>
            <li>
                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}  {{ __('Admin/site.again') }}
            </li>
        </ul>
    </div>
    <div class="content-overlay"></div>

    <div class="content-wrapper">

        <div class="content-header row">

        </div>


        <!-- eCommerce statistic -->
        <!-- Start First Row Admin -->
        <div class="row" style="margin-top: 50px">
            <!-- Start Admin -->
            @can('moderator-list')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('Admins.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="info">{{ \App\Models\Admin::where('type','admin')->count() }}</h3>
                                            <h6>{{ __('Admin/site.admins') }}</h6>
                                        </div>
                                        <div>
                                            <i class="float-right icon-home info font-large-2"></i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-info" role="progressbar"
                                             style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- End Admin -->
                <!-- Start Employee -->
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('Admins.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="info">{{ \App\Models\Admin::where('type','employee')->count() }}</h3>
                                            <h6>{{ __('Admin/site.employees') }}</h6>
                                        </div>
                                        <div>
                                            <i class="float-right icon-emoticon-smile info font-large-2"></i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-info" role="progressbar"
                                             style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- End Employee -->
            @endcan
        <!-- Start Farmer -->
            @can('farmer-list')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('farmers.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="warning">{{ \App\Models\Farmer::where('department_id','!=' ,null)->count() }}</h3>
                                            <h6>{{ __('Admin/site.farmer_created_from_dashboard') }}</h6>
                                        </div>
                                        <div>
                                            <i class="float-right icon-users warning font-large-2"></i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar"
                                             style="width: 65%" aria-valuenow="65" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        <!-- End Farmer -->
            <!-- Start Vendor -->
            @can('vendor-list')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('users.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="success">{{ \App\Models\User::count() }}</h3>
                                            <h6>{{ __('Admin/site.users') }}</h6>
                                        </div>
                                        <div>
                                            <i class="float-right icon-user-follow success font-large-2"></i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar"
                                             style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        <!-- End Vendor -->
        <!-- Start Worker -->
        @can('worker-list')
            <div class="col-xl-3 col-lg-6 col-12">
                <a href="{{ route('workers.index') }}">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="text-left media-body">
                                        <h3 class="success">{{ \App\Models\Worker::count() }}</h3>
                                        <h6>{{ __('Admin/site.workers') }}</h6>
                                    </div>
                                    <div>
                                        <i class="float-right icon-user-follow success font-large-2"></i>
                                    </div>
                                </div>
                                <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-success" role="progressbar"
                                            style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        <!-- End Worker -->
        </div>
        <!-- End First Row Admin -->

        <!-- Start Second Row Country -->
        <div class="row">
            <!-- Start Countries -->
            @can('country-managment')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('Countries.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="info">{{ \App\Models\Country::count() }}</h3>
                                            <h6> {{ trans('Admin/countries.countryPageTitle') }}</h6>
                                        </div>
                                        <div>
                                            <i class="float-right material-icons info font-large-2">flag</i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-info" role="progressbar"
                                             style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End Countries -->
            <!-- Start Proviences -->
            @can('provience-managment')
                <div class="col-xl-2 col-lg-6 col-12">
                    <a href="{{ route('Proviences.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="success">{{ \App\Models\Province::count() }}</h3>
                                            <h6>  {{ trans('Admin/proviences.proviencePageTitle') }}</h6>
                                        </div>
                                        <div>
                                            {{-- <i class="float-right icon-user-follow success font-large-2"></i> --}}
                                            <i class="float-right material-icons success font-large-2">flag</i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar"
                                             style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End Proviences -->
            <!-- Start Area -->
            @can('area-managment')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('Areas.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="warning">{{ \App\Models\Area::count() }}</h3>
                                            <h6>   {{ trans('Admin/areas.areaPageTitle') }}</h6>
                                        </div>
                                        <div>
                                            <i class="float-right material-icons warning font-large-2">flag</i>
                                            {{-- <i class="float-right icon-users warning font-large-2"></i> --}}
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar"
                                             style="width: 65%" aria-valuenow="65" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End Area -->
            <!-- Start States -->
            @can('state-managment')
                <div class="col-xl-2 col-lg-6 col-12">
                    <a href="{{ route('States.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="danger">{{ \App\Models\State::count() }}</h3>
                                            <h6>   {{ trans('Admin/states.statePageTitle') }}</h6>
                                        </div>
                                        <div>
                                            <i class="float-right material-icons danger font-large-2">flag</i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar"
                                             style="width: 85%" aria-valuenow="85" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End States -->
            <!-- Start Villages -->
            @can('village-managment')
                <div class="col-xl-2 col-lg-6 col-12">
                    <a href="{{ route('Villages.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="info">{{ \App\Models\Village::count() }}</h3>
                                            <h6>  {{ trans('Admin/villages.villagePageTitle') }}</h6>
                                        </div>
                                        <div>
                                            <i class="float-right material-icons info font-large-2">flag</i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-info" role="progressbar"
                                             style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End Villages -->
        </div>
        <!-- End Second Row Country -->

        <!-- Start Row Blog -->
        <div class="row">
            <!-- Start Departments -->
            @can('department-managment')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('Departments.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="danger">{{ \App\Models\Department::count() }}</h3>
                                            <h6>{{ __('Admin/site.departments') }}</h6>
                                        </div>
                                        <div>
                                            <i class="float-right material-icons danger font-large-2">account_balance</i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar"
                                             style="width: 85%" aria-valuenow="85" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End Departments -->
            <!-- Start Categories -->
            @can('category-managment')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('Categories.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="danger">{{ \App\Models\Category::count() }}</h3>
                                            <h6>{{ __('Admin/categories.categories_title_in_sidebar') }}</h6>
                                        </div>
                                        <div>
                                            <i class="material-icons danger font-large-2">account_balance</i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar"
                                             style="width: 85%" aria-valuenow="85" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End Categories -->
            <!-- Start Blogs -->
            @can('blogs')
                <div class="col-xl-2 col-lg-6 col-12">
                    <a href="{{ route('blogs.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="warning">{{ \App\Models\Blog::count() }}</h3>
                                            <h6> {{ trans('Admin/site.blog') }}</h6>
                                        </div>
                                        <div>
                                            <i class="float-right icon-globe warning font-large-2"></i>
                                            {{-- <i class="float-right icon-users warning font-large-2"></i> --}}
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar"
                                             style="width: 65%" aria-valuenow="65" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End Blogs -->
            <!-- Start Tags -->
            @can('tags')
                <div class="col-xl-2 col-lg-6 col-12">
                    <a href="{{ route('tags.data') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="success">{{ \App\Models\Tag::count() }}</h3>
                                            <h6>  {{ trans('Admin/site.tag') }}</h6>
                                        </div>
                                        <div>
                                            <i class="float-right icon-speech success font-large-2"></i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar"
                                             style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        <!-- End Tags -->
        </div>
        <!-- End Row Blog -->

        <!-- Start Row Admin Department -->
        <div class="row">
            <!-- Start AdminDepartments -->
            @can('admin-department-managment')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('AdminDepartments.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="info">{{ \App\Models\AdminDepartment::count() }}</h3>
                                            <h6> {{ trans('Admin/admin_departments.adminDepartmentPageTitle') }}</h6>
                                        </div>
                                        <div>
                                            <i class="float-right icon-list info font-large-2"></i>
                                            {{-- <i class="float-right icon-users warning font-large-2"></i> --}}
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-info" role="progressbar"
                                             style="width: 65%" aria-valuenow="65" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End AdminDepartments -->
            <!-- Start Orchards -->
            @can('orchard')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('orchards.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="success">{{ \App\Models\Orchard::count() }}</h3>
                                            <h6>  {{ trans('Admin/orchards.orchards') }}</h6>
                                        </div>
                                        <div>
                                            {{-- <i class="float-right icon-user-follow success font-large-2"></i> --}}
                                            <i class="fas fa-tree fa-2x success"></i>
                                            <i class="float-right icon-box-item success font-large-2"></i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar"
                                             style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End Orchards -->
            <!-- Start ProtectedHouse -->
            @can('protect-house')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('ProtectedHouse.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="pink">{{ \App\Models\ProtectedHouse::count() }}</h3>
                                            <h6>  {{ trans('Admin/p_houses.protectedHousePageTitle') }}</h6>
                                        </div>
                                        <div>
                                            <i class="fas fa-warehouse fa-2x " style="color:deeppink;"></i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-pink" role="progressbar"
                                             style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End ProtectedHouse -->
            <!-- Start FarmerServices -->
            @can('farmer-service')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('FarmerServices.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="yellow"
                                                style="color:greenyellow">{{ \App\Models\FarmerService::count() }}</h3>
                                            <h6>  {{ trans('Admin/services.farmerServicePageTitle') }}</h6>
                                        </div>
                                        <div>
                                            {{-- <i class="float-right icon-user-follow success font-large-2"></i> --}}
                                            <i class="fas fa-tractor fa-2x " style="color:yellow;"></i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-yellow" role="progressbar"
                                             style=" width: 75%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        <!-- End FarmerServices -->
        </div>
        <!-- End Row Admin Department -->

        <!-- Start Row Precipitations -->
        <div class="row">
            <!-- Start Precipitations -->
            @can('precipitation')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('Precipitations.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="gray"
                                                style="color:gray">{{ \App\Models\Precipitation::count() }}</h3>
                                            <h6> {{ trans('Admin/precipitations.precipitationsPageTitle') }}</h6>
                                        </div>
                                        <div>
                                            <i class="fas fa-cloud-showers-heavy fa-2x "
                                               style="color:grey"></i> {{-- <i class="float-right icon-users warning font-large-2"></i> --}}
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x2-grey-blue" role="progressbar"
                                             style="width: 65%" aria-valuenow="65" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End Precipitations -->
            <!-- Start Land Area -->
            @can('land-area')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('LandAreas.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="gray-bg"
                                                style="color: #0B0D0F;">{{ \App\Models\LandArea::count() }}</h3>
                                            <h6>  {{ trans('Admin/land_areas.landAreaPageTitle') }}</h6>
                                        </div>
                                        <div>
                                            {{-- <i class="float-right icon-user-follow success font-large-2"></i> --}}
                                            <i class="fas fa-adjust fa-2x" style="color: #0B0D0F"></i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-blue-grey" role="progressbar"
                                             style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End Land Area -->
            <!-- Start FarmerCrops -->
            @can('farmer-crop')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('FarmerCrops.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="green"
                                                style="color:green;">{{ \App\Models\FarmerCrop::count() }}</h3>
                                            <h6>  {{ trans('Admin/crops.farmerCropsPageTitle') }}</h6>
                                        </div>
                                        <div>
                                            {{-- <i class="float-right icon-user-follow success font-large-2"></i> --}}
                                            <i class="fas fa-crop-simple fa-2x " style="color:green;"></i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar"
                                             style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End FarmerCrops -->
            <!-- Start Caws Project -->
            @can('caws-project')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('Animals.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="yellow"
                                                style="color:greenyellow">{{ \App\Models\CawProject::count() }}</h3>
                                            <h6>  {{ trans('Admin/animals.animalsPageTitle') }}</h6>
                                        </div>
                                        <div>
                                            {{-- <i class="float-right icon-user-follow success font-large-2"></i> --}}
                                            <i class="fas fa-democrat fa-2x " style="color:blue;"></i>
                                            <i class="fas fa-fish fa-2x " style="color:yellow;"></i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-yellow" role="progressbar"
                                             style=" width: 75%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        <!-- End Caws Project -->
        </div>
        <!-- End Row Precipitations -->

        <!-- Start Row Chicken -->
        <div class="row">
            <!-- Start Row Chicken Project -->
            @can('chicken-project')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('Chickens.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="gray-bg"
                                                style="color: purple;">{{ \App\Models\ChickenProject::count() }}</h3>
                                            <h6>  {{ trans('Admin/animals.chickensPageTitle') }}</h6>
                                        </div>
                                        <div>
                                            {{-- <i class="float-right icon-user-follow success font-large-2"></i> --}}
                                            <i class="fas fa-kiwi-bird fa-2x" style="color:purple"></i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-purple" role="progressbar"
                                             style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End Row Chicken Project -->
            @can('bee-keepers')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('BeeKeepers.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="gray-bg"
                                                style="color:yellow;">{{ \App\Models\Beekeeper::count() }}</h3>
                                            <h6>  {{ trans('Admin/bees.beekeeperPageTitle') }}</h6>
                                        </div>
                                        <div>
                                            <i class="fab fa-forumbee fa-2x" style="color:yellow"></i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-yellow" role="progressbar"
                                             style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- Start OutcomeProducts -->
            @can('outcome-products')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('OutcomeProducts.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="gray-bg"
                                                style="color:blue;">{{ \App\Models\OutcomeProduct::count() }}</h3>
                                            <h6>  {{ trans('Admin/outcome_products.outcome_productPageTitle') }}</h6>
                                        </div>
                                        <div>
                                            <i class="fas fa-plane-departure fa-2x " style="color:blue;"></i>
                                            <i class="fab fa-pagelines fa-2x " style="color:green;"></i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-green" role="progressbar"
                                             style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <!-- End OutcomeProducts -->
            <!-- Start IncomeProducts -->
            @can('income-products')
                <div class="col-xl-3 col-lg-6 col-12">
                    <a href="{{ route('IncomeProducts.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="green"
                                                style="color:green">{{ \App\Models\IncomeProduct::count() }}</h3>
                                            <h6>  {{ trans('Admin/income_products.income_productPageTitle') }}</h6>
                                        </div>
                                        <div>
                                            <i class="fas fa-plane-arrival fa-2x " style="color:blue;"></i>
                                            <i class="fas fa-leaf fa-2x " style="color:green;"></i>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar"
                                             style=" width: 75%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        <!-- End IncomeProducts -->
        </div>
        <!-- End Row Chicken -->
        <hr/>


        <!--End Precipitation Graph-->
        @can('precipitation-graph')
            <div class="card-body">
                <div class="form-body">
                    <form action="{{route('precipitation.graph')}}" method="get">
                        @csrf
                        <div class="mt-3 row">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="area_id"
                                           style="float: right">{{ __('Admin/precipitations.area') }}</label>
                                    <select name="area_id" id="area_id" class="form-control"
                                            required>
                                        <option value="">{{ __('Admin/site.select') }}</option>
                                        </option>
                                        @foreach (\App\Models\Area::all() as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('area_id')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror

                                </div>
                                <div class="form-group col-md-3">
                                    <h5 style="float: right">{{__('Admin\precipitations.from_date')}}<span
                                                class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="date" name="start_date" id="start_date"
                                               class="form-control datepicker-autoclose"
                                               placeholder="Please select start date">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('start_date')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <h5 style="float: right">{{__('Admin\precipitations.to_date')}}<span
                                                class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="date" name="end_date" id="end_date"
                                               class="form-control datepicker-autoclose"
                                               placeholder="Please select end date">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('end_date')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <br>
                                    <button type="submit" id=""
                                            class="btn btn-info">{{trans('Admin\Site.Get_chart')}}</button>
                                </div>
                            </div>
                            <div class="col col-md-12">
                                <div class="pie-chart-container">
                                    <canvas id="pie-chart" height="75"></canvas>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endcan
        <!--End Precipitation Graph-->
        <hr>
        <!--------------------------------------------------------- Start Report -------------------------------------------------------------->

        <!--------------------------------------------------------- End Report -------------------------------------------------------------->


        {{--start test report--}}

        <div class="accordion" id="accordionExample">
            {{--start animal_welth--}}
            @can('animal-reports')
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne">
                            <i class="fa fa-plus "></i> {{__('Admin\site.reporting')}} / {{__('Admin\site.animal_wealth')}}
                        </button>
                    </div>

                    <div class="collapse show" id="collapseOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <!-- Start Animal Statistics -->
                                @can('statistics-report')
                                    <div class="col-xl-3 col-lg-6 col-12">
                                        <a href="{{ route('animals.caw_index_statistics') }}">
                                            <div class="card pull-up">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media d-flex">
                                                            <div class="text-left media-body">
                                                                <h3 class="gray-bg"
                                                                    style="color: purple;">{{ \App\Models\CawProject::where('marketing_side','like','private')->count() }}</h3>
                                                                <h6>  {{ trans('Admin/animals.animals_projects_report') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true"
                                                                style="color: purple;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-purple"
                                                                role="progressbar" style="width: 75%" aria-valuenow="75"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
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
                                                            <div class="text-left media-body">
                                                                <h3 class="gray-bg"
                                                                    style="color: green;">{{ \App\Models\ChickenProject::where('marketing_side','like','govermental')->count() }}</h3>
                                                                <h6>  {{ trans('Admin/animals.chicken_statistic_report') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true"
                                                                style="color: green;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-success"
                                                                role="progressbar" style="width: 75%" aria-valuenow="75"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            @endcan
                            <!-- End Chicken Startstics Report -->

                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            {{--end animal_welth--}}
            
            {{--start Horticulture--}}
            @can('horticulture-reports')
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo">
                            <i class="fa fa-plus "></i>
                            {{__('Admin\site.reporting')}} / {{__('Admin\site.Horticulture')}}
                        </button>
                    </div>
                    <div class="collapse" id="collapseTwo" data-parent="#accordionExample">
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
                                                            <div class="text-left media-body">
                                                                <h3 class="gray-bg"
                                                                    style="color: purple;">{{ \App\Models\Orchard::count() }}</h3>
                                                                <h6>  {{ trans('Admin/orchards.Report_on_the_lands_planted_with_trees') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true"
                                                                style="color: purple;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-purple"
                                                                role="progressbar" style="width: 75%" aria-valuenow="75"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
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
                                                            <div class="text-left media-body">
                                                                <h3 class="gray-bg"
                                                                    style="color: deeppink;">{{ \App\Models\ProtectedHouse::count() }}</h3>
                                                                <h6>  {{ trans('Admin/p_houses.report_on_the_number_of_greenhouses') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true"
                                                                style="color: deeppink;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-pink" role="progressbar"
                                                                style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            @endcan
                            <!-- End Protect House Statistics -->


                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            {{--end Horticulture--}}

            {{--start planet_protection--}}
            @can('beekeeper-reports')
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree">
                            <i class="fa fa-plus "></i>
                            {{__('Admin\site.reporting')}} / {{__('Admin\site.planet_protection')}}
                        </button>
                    </div>
                    <div class="collapse" id="collapseThree" data-parent="#accordionExample">
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
                                                            <div class="text-left media-body">

                                                                <h3 class="gray-bg"
                                                                    style="color: green;">{{ \App\Models\BeeKeeper::count() }}</h3>
                                                                <h6>  {{ trans('Admin/bees.Apiaries_report_to_the_judiciary') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true"
                                                                style="color: green;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-purple"
                                                                role="progressbar" style="width: 75%" aria-valuenow="75"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            @endcan
                            <!-- End Beekepper Statistics -->

                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            {{--end planet_protection--}}

            {{--start services--}}
            @can('service-reports')
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour">
                            <i class="fa fa-plus "></i>
                            {{__('Admin\site.reporting')}} / {{__('Admin\site.services')}}
                        </button>
                    </div>
                    <div class="collapse" id="collapseFour" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <!-- Start farmer-service-statistics -->
                                @can('farmer-service-statistics')
                                    <div class="col-xl-3 col-lg-6 col-12">
                                        <a href="{{ route('farmer_service_index_statistics') }}">
                                            <div class="card pull-up">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media d-flex">
                                                            <div class="text-left media-body">
                                                                <h3 class="gray-bg"
                                                                    style="color: blue;">{{ \App\Models\FarmerService::count() }}</h3>
                                                                <h6>  {{ trans('Admin/services.farmer_services_report') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true"
                                                                style="color: blue;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-info" role="progressbar"
                                                                style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
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
                                                            <div class="text-left media-body">
                                                                <h3 class="gray-bg"
                                                                    style="color: deeppink;">{{ \App\Models\Precipitation::count() }}</h3>
                                                                <h6>  {{ trans('Admin/precipitations.precipitation_report') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true"
                                                                style="color: deeppink;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-pink" role="progressbar"
                                                                style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
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
                            {{--<div class="text-left media-body">--}}
                            {{--<h3 class="gray-bg" style="color: orange;">{{ \App\Models\Precipitation::count() }}</h3>--}}
                            {{--<h6>  {{ trans('Admin/precipitations.precipitation_details_report') }}</h6>--}}
                            {{--</div>--}}
                            {{--<div>--}}
                            {{--<i class="fa fa-list-alt" aria-hidden="true" style="color: orange;"></i>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="mt-1 mb-0 progress progress-sm box-shadow-2">--}}
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
                        </div>
                    </div>
                </div>
            @endcan
            {{--start services--}}

            {{--start planning--}}
            @can('planning-reports')
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive">
                            <i class="fa fa-plus "></i>
                            {{__('Admin\site.reporting')}} / {{__('Admin\site.planning')}}
                        </button>
                    </div>
                    <div class="collapse" id="collapseFive" data-parent="#accordionExample">
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
                                                            <div class="text-left media-body">

                                                                <h3 class="gray-bg"
                                                                    style="color: blue;">{{ \App\Models\LandArea::count() }}</h3>
                                                                <h6>  {{ trans('Admin/land_areas.land_areas_report') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true"
                                                                style="color: blue;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-info" role="progressbar"
                                                                style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endcan
                            <!-- End land_areas_report -->


                                <!-- Start farmer-crop-statistics -->
                                @can('farmer-crop-statistics')
                                    <div class="col-xl-3 col-lg-6 col-12">
                                        <a href="{{ route('statistics_index') }}">
                                            <div class="card pull-up">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media d-flex">
                                                            <div class="text-left media-body">

                                                                <h3 class="gray-bg"
                                                                    style="color: yellow;">{{ \App\Models\FarmerCrop::count() }}</h3>
                                                                <h6>  {{ trans('Admin/crops.farmer_crops_report') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true"
                                                                style="color: yellow;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-yellow"
                                                                role="progressbar" style="width: 75%" aria-valuenow="75"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
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
                        </div>
                    </div>
                </div>
            @endcan
            {{--end planning--}}

            {{--start wholesale--}}
            @can('wholesale-reports')
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSix">
                            <i class="fa fa-plus "></i>
                            {{__('Admin\site.reporting')}} / {{__('Admin\site.wholesale')}}
                        </button>
                    </div>
                    <div class="collapse" id="collapseSix" data-parent="#accordionExample">
                        <div class="card-body">

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
                                                            <div class="text-left media-body">

                                                                <h3 class="gray-bg"
                                                                    style="color: blue;">{{ \App\Models\IncomeProduct::count() }}</h3>
                                                                <h6>  {{ trans('Admin/income_products.income_products_report') }}</h6>
                                                            </div>
                                                            <div>
                                                                <i class="fa fa-list-alt" aria-hidden="true"
                                                                style="color: blue;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                                            <div class="progress-bar bg-gradient-x-info" role="progressbar"
                                                                style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
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
                                                        <div class="text-left media-body">

                                                            <h3 class="gray-bg"
                                                                style="color: purple;">{{ \App\Models\OutcomeProduct::count() }}</h3>
                                                            <h6>  {{ trans('Admin/outcome_products.outcome_products_report') }}</h6>
                                                        </div>
                                                        <div>
                                                            <i class="fa fa-list-alt" aria-hidden="true"
                                                            style="color: purple;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="mt-1 mb-0 progress progress-sm box-shadow-2">
                                                        <div class="progress-bar bg-gradient-x-purple" role="progressbar"
                                                            style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
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
                    </div>
                </div>
            @endcan
            {{--end wholesale--}}
        </div>
        <!-- .accordion -->

        {{--test report--}}
        @can('products-managment')
        @includeWhen($latest_products,'dashboard.admin.recent_product')
        @endcan
        <br>
        <hr>
        @can('orders-managment')
            @includeWhen($orders,'dashboard.admin.orders')
        @endcan

    </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        $(function () {
            //get the pie chart canvas
            var cData = JSON.parse(`<?php echo $chart_data; ?>`);
            var ctx = $("#pie-chart");

            //pie chart data
            var data = {
                labels: cData.label,
                datasets: [
                    {
                        label: "Precipitation Rate",
                        data: cData.data,
                        backgroundColor: [
                            "#DEB887",
                            "#A9A9A9",
                            "#DC143C",
                            "#F4A460",
                            "#2E8B57",
                            "#1D7A46",
                            "#CDA776",
                        ],
                        borderColor: [
                            "#CDA776",
                            "#989898",
                            "#CB252B",
                            "#E39371",
                            "#1D7A46",
                            "#F4A460",
                            "#CDA776",
                        ],
                        borderWidth: [1, 1, 1, 1, 1, 1, 1]
                    }
                ]
            };

            //options
            var options = {
                responsive: true,
                title: {
                    display: true,
                    position: "top",
                    text: "{{trans('Admin\site.precipitation_rate_in_state_for_spatial_area')}}",
                    fontSize: 18,
                    fontColor: "#111"
                },
                legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontColor: "#333",
                        fontSize: 16
                    }
                }
            };

            //create Pie Chart class object
            var chart1 = new Chart(ctx, {
                type: "pie",
                data: data,
                options: options
            });

        });
    </script>

    <script>
        $(document).ready(function () {
            //Add a minus icon to the collapse element that is open by default
            $('.collapse.show').each(function () {
                $(this).parent().find(".fa").removeClass("fa-plus").addClass("fa-minus");
            });

            //Toggle plus/minus icon on show/hide of collapse element
            $('.collapse').on('shown.bs.collapse', function () {
                $(this).parent().find(".fa").removeClass("fa-plus").addClass("fa-minus");
            }).on('hidden.bs.collapse', function () {
                $(this).parent().find(".fa").removeClass("fa-minus").addClass("fa-plus");
            });
        });
    </script>
@endsection
