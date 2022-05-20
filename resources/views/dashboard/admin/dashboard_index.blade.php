@extends('dashboard.layouts.dashboard')
@section('css')

@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
			</div>
		</div>
		<div class="d-flex my-xl-auto right-content">
			<div class="pr-1 mb-3 mb-xl-0">
				<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
			</div>
			<div class="pr-1 mb-3 mb-xl-0">
				<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
			</div>
			<div class="pr-1 mb-3 mb-xl-0">
				<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
			</div>
			<div class="mb-3 mb-xl-0">
				<div class="btn-group dropdown">
					<button type="button" class="btn btn-primary">14 Aug 2019</button>
					<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
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
<div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- eCommerce statistic -->
                    <!-- Start Forst Row -->
                    <div class="row">
                        <!-- Start Admin -->
                        <div class="col-xl-3 col-lg-6 col-12">
                            <a href="{{ route('Admins.index') }}">
                                <div class="card pull-up">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left">
                                                    <h3 class="info">{{ \App\Models\Admin::where('type','admin')->count() }}</h3>
                                                    <h6>{{ __('Admin/site.admins') }}</h6>
                                                </div>
                                                <div>
                                                    <i class="icon-home info font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
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
                                                <div class="media-body text-left">
                                                    <h3 class="info">{{ \App\Models\Admin::where('type','employee')->count() }}</h3>
                                                    <h6>{{ __('Admin/site.employees') }}</h6>
                                                </div>
                                                <div>
                                                    <i class="icon-emoticon-smile info font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- End Employee -->
                        <!-- Start Farmer -->
                        <div class="col-xl-3 col-lg-6 col-12">
                            <a href="{{ route('farmers.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="warning">{{ \App\Models\Farmer::count() }}</h3>
                                                <h6>{{ __('Admin/site.farmer') }}</h6>
                                            </div>
                                            <div>
                                                <i class="icon-users warning font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <!-- End Farmer -->
                        <!-- Start Vendor -->
                        <div class="col-xl-3 col-lg-6 col-12">
                            <a href="{{ route('users.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="success">{{ \App\Models\User::count() }}</h3>
                                                <h6>{{ __('Admin/site.users') }}</h6>
                                            </div>
                                            <div>
                                                <i class="icon-user-follow success font-large-2 float-right"></i>
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
                        <!-- End Vendor -->
                        <!-- Start Worker -->
                        <div class="col-xl-3 col-lg-6 col-12">
                            <a href="{{ route('workers.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="success">{{ \App\Models\Worker::count() }}</h3>
                                                <h6>{{ __('Admin/site.workers') }}</h6>
                                            </div>
                                            <div>
                                                <i class="icon-user-follow success font-large-2 float-right"></i>
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
                        <!-- End Worker -->
                    </div>
                    <!-- End Forst Row -->
                <div class="row">
                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('Countries.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="info">{{ \App\Models\Country::count() }}</h3>
                                                <h6> {{ trans('Admin/countries.countryPageTitle') }}</h6>
                                            </div>
                                            <div>
                                                <i class="material-icons info font-large-2 float-right">flag</i>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('Areas.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="warning">{{ \App\Models\Area::count() }}</h3>
                                            <h6>   {{ trans('Admin/areas.areaPageTitle') }}</h6>
                                        </div>
                                        <div>
                                            <i class="material-icons warning font-large-2 float-right">flag</i>
                                            {{-- <i class="icon-users warning font-large-2 float-right"></i> --}}
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('Proviences.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="success">{{ \App\Models\Province::count() }}</h3>
                                            <h6>  {{ trans('Admin/proviences.proviencePageTitle') }}</h6>
                                        </div>
                                        <div>
                                            {{-- <i class="icon-user-follow success font-large-2 float-right"></i> --}}
                                            <i class="material-icons success font-large-2 float-right">flag</i>
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
                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('States.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="danger">{{ \App\Models\State::count() }}</h3>
                                            <h6>   {{ trans('Admin/states.statePageTitle') }}</h6>
                                        </div>
                                        <div>
                                            <i class="material-icons danger font-large-2 float-right">flag</i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('Villages.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="info">{{ \App\Models\Village::count() }}</h3>
                                                <h6>  {{ trans('Admin/villages.villagePageTitle') }}</h6>
                                            </div>
                                            <div>
                                                <i class="material-icons info font-large-2 float-right">flag</i>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('Departments.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="danger">{{ \App\Models\Department::count() }}</h3>
                                            <h6>{{ __('Admin/site.departments') }}</h6>
                                        </div>
                                        <div>
                                            <i class="icon-graduation danger font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('blogs.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="warning">{{ \App\Models\Blog::count() }}</h3>
                                            <h6> {{ trans('Admin/site.blog') }}</h6>
                                        </div>
                                        <div>
                                            <i class="icon-globe warning font-large-2 float-right"></i>
                                            {{-- <i class="icon-users warning font-large-2 float-right"></i> --}}
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('tags.data') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="success">{{ \App\Models\Tag::count() }}</h3>
                                            <h6>  {{ trans('Admin/site.tag') }}</h6>
                                        </div>
                                        <div>
                                            {{-- <i class="icon-user-follow success font-large-2 float-right"></i> --}}
                                            <i class="icon-speech success font-large-2 float-right"></i>
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
                    {{-- <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('States.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="danger">{{ \App\Models\State::count() }}</h3>
                                            <h6>   {{ trans('Admin/states.statePageTitle') }}</h6>
                                        </div>
                                        <div>
                                            <i class="material-icons danger font-large-2 float-right">flag</i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div> --}}
                </div>
                <div class="row">

                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('AdminDepartments.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="info">{{ \App\Models\AdminDepartment::count() }}</h3>
                                                <h6> {{ trans('Admin/admin_departments.adminDepartmentPageTitle') }}</h6>
                                            </div>
                                            <div>
                                                <i class="icon-list info font-large-2 float-right"></i>
                                                {{-- <i class="icon-users warning font-large-2 float-right"></i> --}}
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('orchards.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="success">{{ \App\Models\Orchard::count() }}</h3>
                                                <h6>  {{ trans('Admin/orchards.orchards') }}</h6>
                                            </div>
                                            <div>
                                                {{-- <i class="icon-user-follow success font-large-2 float-right"></i> --}}
                                                <i class="fas fa-tree fa-2x success"></i>
                                                <i class="icon-box-item success font-large-2 float-right"></i>
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
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('ProtectedHouse.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="pink">{{ \App\Models\ProtectedHouse::count() }}</h3>
                                                <h6>  {{ trans('Admin/p_houses.protectedHousePageTitle') }}</h6>
                                            </div>
                                            <div>
                                                {{-- <i class="icon-user-follow success font-large-2 float-right"></i> --}}
                                                <i class="fas fa-warehouse fa-2x " style="color:deeppink;"></i>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-pink"  role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('FarmerServices.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="yellow" style="color:greenyellow">{{ \App\Models\FarmerService::count() }}</h3>
                                                <h6>  {{ trans('Admin/services.farmerServicePageTitle') }}</h6>
                                            </div>
                                            <div>
                                                {{-- <i class="icon-user-follow success font-large-2 float-right"></i> --}}
                                                <i class="fas fa-tractor fa-2x " style="color:yellow;"></i>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-yellow"  role="progressbar" style=" width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    {{-- <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('States.index') }}">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="danger">{{ \App\Models\State::count() }}</h3>
                                            <h6>   {{ trans('Admin/states.statePageTitle') }}</h6>
                                        </div>
                                        <div>
                                            <i class="material-icons danger font-large-2 float-right">flag</i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div> --}}
                </div>
                <div class="row">

                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('Precipitations.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="gray" style="color:gray">{{ \App\Models\Precipitation::count() }}</h3>
                                                <h6> {{ trans('Admin/precipitations.precipitationsPageTitle') }}</h6>
                                            </div>
                                            <div>
                                                <i class="fas fa-cloud-showers-heavy fa-2x " style="color:grey"></i>                                                {{-- <i class="icon-users warning font-large-2 float-right"></i> --}}
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x2-grey-blue"  role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('LandAreas.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="gray-bg" style="color: #0B0D0F;">{{ \App\Models\LandArea::count() }}</h3>
                                                <h6>  {{ trans('Admin/land_areas.landAreaPageTitle') }}</h6>
                                            </div>
                                            <div>
                                                {{-- <i class="icon-user-follow success font-large-2 float-right"></i> --}}
                                                <i class="fas fa-adjust fa-2x" style="color: #0B0D0F"></i>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-blue-grey" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('FarmerCrops.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="green"  style="color:green;">{{ \App\Models\FarmerCrop::count() }}</h3>
                                                <h6>  {{ trans('Admin/crops.farmerCropsPageTitle') }}</h6>
                                            </div>
                                            <div>
                                                {{-- <i class="icon-user-follow success font-large-2 float-right"></i> --}}
                                                <i class="fas fa-crop-simple fa-2x " style="color:green;"></i>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-success"  role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('Animals.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="yellow" style="color:greenyellow">{{ \App\Models\CawProject::count() }}</h3>
                                                <h6>  {{ trans('Admin/animals.animalsPageTitle') }}</h6>
                                            </div>
                                            <div>
                                                {{-- <i class="icon-user-follow success font-large-2 float-right"></i> --}}
                                                <i class="fas fa-democrat fa-2x " style="color:blue;"></i>
                                                <i class="fas fa-fish fa-2x " style="color:yellow;"></i>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-yellow"  role="progressbar" style=" width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


                </div>
                <div class="row">

                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('Chickens.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="gray-bg" style="color: purple;">{{ \App\Models\ChickenProject::count() }}</h3>
                                                <h6>  {{ trans('Admin/animals.chickensPageTitle') }}</h6>
                                            </div>
                                            <div>
                                                {{-- <i class="icon-user-follow success font-large-2 float-right"></i> --}}
                                                <i class="fas fa-kiwi-bird fa-2x" style="color:purple"></i>
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
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('BeeKeepers.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="gray-bg" style="color:yellow;">{{ \App\Models\Beekeeper::count() }}</h3>
                                                <h6>  {{ trans('Admin/bees.beekeeperPageTitle') }}</h6>
                                            </div>
                                            <div>
                                                <i class="fab fa-forumbee fa-2x" style="color:yellow"></i>
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
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('OutcomeProducts.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="green"  style="color:blue;">{{ \App\Models\OutcomeProduct::count() }}</h3>
                                                <h6>  {{ trans('Admin/outcome_products.outcome_productPageTitle') }}</h6>
                                            </div>
                                            <div>
                                                <i class="fas fa-plane-departure fa-2x " style="color:blue;"></i>
                                                <i class="fab fa-pagelines fa-2x " style="color:green;"></i>
                                            </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-info"  role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('IncomeProducts.index') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="green" style="color:green">{{ \App\Models\IncomeProduct::count() }}</h3>
                                                <h6>  {{ trans('Admin/income_products.income_productPageTitle') }}</h6>
                                            </div>
                                            <div>
                                                <i class="fas fa-plane-arrival fa-2x " style="color:blue;"></i>
                                                <i class="fas fa-leaf fa-2x " style="color:green;"></i>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-success"  role="progressbar" style=" width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


                </div>
            <br>
                <h1 class="bold; color:green;center">{{__('Admin\site.reporting')}}:</h1>
                <h1>{{__('Admin\site.animal_wealth')}}</h1>

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('animals.statistics') }}">
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
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('ship.statistics') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="gray-bg" style="color:yellow;">{{ \App\Models\CawProject::where('type','like','ship')
                                                ->where('marketing_side','like','govermental')->count() }}</h3>
                                                <h5>  {{ trans('Admin/animals.ship_govermental_supported_report') }}</h5>
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
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('caw.statistics') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="green" style="color:blue">{{ \App\Models\CawProject::where('type','like','caw')
                                                ->where('marketing_side','like','govermental')->count() }}</h3>
                                                <h6>  {{ trans('Admin/animals.caw_govermental_supported_report') }}</h6>
                                            </div>
                                            <div>
                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: blue;"></i>

                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-info"  role="progressbar" style=" width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('fish.statistics') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="green" style="color:green">{{ \App\Models\CawProject::where('type','like','fish')
                                                ->where('marketing_side','like','govermental')->count() }}</h3>
                                                <h6>  {{ trans('Admin/animals.fish_govermental_supported_report') }}</h6>
                                            </div>
                                            <div>
                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: red;"></i>

                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-danger"  role="progressbar" style=" width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('chicken.statistics') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="gray-bg" style="color: green;">{{ \App\Models\ChickenProject::where('marketing_side','like','govermental')->count() }}</h3>
                                                <h6>  {{ trans('Admin/animals.chicken_govermental_supported_report') }}</h6>
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

                </div>
                <h1>{{__('Admin\site.Horticulture')}} </h1>

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('orchards.statistics') }}">
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
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('protected_house.statistic') }}">
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
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('protected_house_g.statistic') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="gray-bg" style="color: yellow;">{{ \App\Models\ProtectedHouse::where('supported_side','like','govermental')->count() }}</h3>
                                                <h6>  {{ trans('Admin/p_houses.report_on_the_number_of_greenhouses_govermental_supported') }}</h6>
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
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('protected_house_p.statistic') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="gray-bg" style="color: red;">{{ \App\Models\ProtectedHouse::where('supported_side','like','private')->count() }}</h3>
                                                <h6>  {{ trans('Admin/p_houses.report_on_the_number_of_greenhouses_private_supported') }}</h6>
                                            </div>
                                            <div>
                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: red;"></i>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
                <h1>{{__('Admin\site.planet_protection')}}</h1>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('beekeepers.statistics') }}">
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
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('details_beekeeper.statistics') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="gray-bg" style="color: gray;">{{ \App\Models\BeeKeeper::count() }}</h3>
                                                <h6>  {{ trans('Admin/bees.Apiaries_report') }}</h6>
                                            </div>
                                            <div>
                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: gray;"></i>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x2-blue-grey" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


                </div>

                <h1>{{__('Admin\site.services')}}</h1>
                <div class="row">

                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('farmer_service.statistics') }}">
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
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('precipitations.index_details_statistic') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="gray-bg" style="color: orange;">{{ \App\Models\Precipitation::count() }}</h3>
                                                <h6>  {{ trans('Admin/precipitations.precipitation_details_report') }}</h6>
                                            </div>
                                            <div>
                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: orange;"></i>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-red" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

                <h1>{{__('Admin\site.planning')}}</h1>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('landAreas.getStatisticaldata') }}">
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
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('land_area_details.statistic') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">

                                                <h3 class="gray-bg" style="color: purple;">{{ \App\Models\LandArea::count() }}</h3>
                                                <h6>  {{ trans('Admin/land_areas.land_areas_details_report') }}</h6>
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
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('land_area_state.statistic') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">

                                                <h3 class="gray-bg" style="color: green;">{{ \App\Models\LandArea::count() }}</h3>
                                                <h6>  {{ trans('Admin/land_areas.land_areas_state_report') }}</h6>
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
                    <div class="col-xl-3 col-lg-6 col-12">
                        <a href="{{ route('farmer_crops.statistics') }}">
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


                </div>
                <h1> {{__('Admin\site.whole_sale_market')}} </h1>

                <div class="row">
                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('income_product.statistics') }}">
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
                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('index_income_products') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">

                                                <h3 class="gray-bg" style="color: green;">{{ \App\Models\IncomeProduct::count() }}</h3>
                                                <h6>  {{ trans('Admin/income_products.income_products_details_in_date_report') }}</h6>
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
                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('index_income_local_products') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">

                                                <h3 class="gray-bg" style="color: red;">{{ \App\Models\IncomeProduct::count() }}</h3>
                                                <h6>  {{ trans('Admin/income_products.income_local_products_database_details_in_date_report') }}</h6>
                                            </div>
                                            <div>
                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: red;"></i>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('index_income_imported_products') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">

                                                <h3 class="gray-bg" style="color: purple;">{{ \App\Models\IncomeProduct::count() }}</h3>
                                                <h6>  {{ trans('Admin/income_products.income_imported_products_details_in_date_report') }}</h6>
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
                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('index_income_iraq_products') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">

                                                <h3 class="gray-bg" style="color: yellow;">{{ \App\Models\IncomeProduct::count() }}</h3>
                                                <h6>  {{ trans('Admin/income_products.income_iraq_products_details_in_date_report') }}</h6>
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


                </div>
                <div class="row">


                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('outcome_product.statistics') }}">
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
                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('index_outcome_products') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">

                                                <h3 class="gray-bg" style="color: yellow;">{{ \App\Models\OutcomeProduct::count() }}</h3>
                                                <h6>  {{ trans('Admin/outcome_products.outcome_products_details_in_date_report') }}</h6>
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

                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('index_outcome_local_products') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">

                                                <h3 class="gray-bg" style="color: yellow;">{{ \App\Models\OutcomeProduct::count() }}</h3>
                                                <h6>  {{ trans('Admin/outcome_products.outcome_local_products_details_in_date_report') }}</h6>
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
                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('index_outcome_imported_products') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">

                                                <h3 class="gray-bg" style="color: red;">{{ \App\Models\OutcomeProduct::count() }}</h3>
                                                <h6>  {{ trans('Admin/outcome_products.outcome_imported_products_details_in_date_report') }}</h6>
                                            </div>
                                            <div>
                                                <i class="fa fa-list-alt" aria-hidden="true" style="color: red;"></i>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-12">
                        <a href="{{ route('index_outcome_iraq_products') }}">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">

                                                <h3 class="gray-bg" style="color: blue;">{{ \App\Models\OutcomeProduct::count() }}</h3>
                                                <h6>  {{ trans('Admin/outcome_products.outcome_iraq_products_details_in_date_report') }}</h6>
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


                </div>










                <!--/ eCommerce statistic -->

                <!-- Products sell and New Orders -->
                {{-- <div class="row match-height">
                    <div class="col-xl-8 col-12" id="ecommerceChartView">
                        <div class="card card-shadow">
                            <div class="card-header card-header-transparent py-20">
                                <div class="btn-group dropdown">
                                    <a href="#" class="text-body dropdown-toggle blue-grey-700" data-toggle="dropdown">PRODUCTS SALES</a>
                                    <div class="dropdown-menu animate" role="menu">
                                        <a class="dropdown-item" href="#" role="menuitem">Sales</a>
                                        <a class="dropdown-item" href="#" role="menuitem">Total sales</a>
                                        <a class="dropdown-item" href="#" role="menuitem">profit</a>
                                    </div>
                                </div>
                                <ul class="nav nav-pills nav-pills-rounded chart-action float-right btn-group" role="group">
                                    <li class="nav-item"><a class="active nav-link" data-toggle="tab" href="#scoreLineToDay">Day</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToWeek">Week</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToMonth">Month</a></li>
                                </ul>
                            </div>
                            <div class="widget-content tab-content bg-white p-20">
                                <div class="ct-chart tab-pane active scoreLineShadow" id="scoreLineToDay"></div>
                                <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToWeek"></div>
                                <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToMonth"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">New Orders</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div id="new-orders" class="media-list position-relative">
                                    <div class="table-responsive">
                                        <table id="new-orders-table" class="table table-hover table-xl mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="border-top-0">Product</th>
                                                    <th class="border-top-0">Customers</th>
                                                    <th class="border-top-0">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-truncate">iPhone X</td>
                                                    <td class="text-truncate p-1">
                                                        <ul class="list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-19.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-18.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joseph Weaver" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-17.png" alt="Avatar">
                                                            </li>
                                                            <li class="avatar avatar-sm">
                                                                <span class="badge badge-info">+4 more</span>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td class="text-truncate">$8999</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-truncate">Pixel 2</td>
                                                    <td class="text-truncate p-1">
                                                        <ul class="list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Alice Scott" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-16.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Charles Miller" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-15.png" alt="Avatar">
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td class="text-truncate">$5550</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-truncate">OnePlus</td>
                                                    <td class="text-truncate p-1">
                                                        <ul class="list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Christine Ramos" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-11.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Thomas Brewer" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-10.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Alice Chapman" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-9.png" alt="Avatar">
                                                            </li>
                                                            <li class="avatar avatar-sm">
                                                                <span class="badge badge-info">+3 more</span>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td class="text-truncate">$9000</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-truncate">Galaxy</td>
                                                    <td class="text-truncate p-1">
                                                        <ul class="list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Ryan Schneider" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-14.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Tiffany Oliver" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-13.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joan Reid" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-12.png" alt="Avatar">
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td class="text-truncate">$7500</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-truncate">Moto Z2</td>
                                                    <td class="text-truncate p-1">
                                                        <ul class="list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-8.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-7.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Rebecca Jones" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-6.png" alt="Avatar">
                                                            </li>
                                                            <li class="avatar avatar-sm">
                                                                <span class="badge badge-info">+1 more</span>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td class="text-truncate">$8500</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!--/ Products sell and New Orders -->

                <!-- Recent Transactions -->
                {{-- <div class="row">
                    <div id="recent-transactions" class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Recent Transactions</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right" href="invoice-summary.html" target="_blank">Invoice Summary</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table id="recent-orders" class="table table-hover table-xl mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Status</th>
                                                <th class="border-top-0">Invoice#</th>
                                                <th class="border-top-0">Customer Name</th>
                                                <th class="border-top-0">Products</th>
                                                <th class="border-top-0">Categories</th>
                                                <th class="border-top-0">Shipping</th>
                                                <th class="border-top-0">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-truncate"><i class="la la-dot-circle-o success font-medium-1 mr-1"></i> Paid</td>
                                                <td class="text-truncate"><a href="#">INV-001001</a></td>
                                                <td class="text-truncate">
                                                    <span class="avatar avatar-xs">
                                                        <img class="box-shadow-2" src="../../../app-assets/images/portrait/small/avatar-s-4.png" alt="avatar">
                                                    </span>
                                                    <span>Elizabeth W.</span>
                                                </td>
                                                <td class="text-truncate p-1">
                                                    <ul class="list-unstyled users-list m-0">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../../../app-assets/images/portfolio/portfolio-1.jpg" alt="Avatar">
                                                        </li>
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../../../app-assets/images/portfolio/portfolio-2.jpg" alt="Avatar">
                                                        </li>
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Rebecca Jones" class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../../../app-assets/images/portfolio/portfolio-4.jpg" alt="Avatar">
                                                        </li>
                                                        <li class="avatar avatar-sm">
                                                            <span class="badge badge-info">+1 more</span>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-danger round">Food</button>
                                                </td>
                                                <td>
                                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td class="text-truncate">$ 1200.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><i class="la la-dot-circle-o danger font-medium-1 mr-1"></i> Declined</td>
                                                <td class="text-truncate"><a href="#">INV-001002</a></td>
                                                <td class="text-truncate">
                                                    <span class="avatar avatar-xs">
                                                        <img class="box-shadow-2" src="../../../app-assets/images/portrait/small/avatar-s-5.png" alt="avatar">
                                                    </span>
                                                    <span>Doris R.</span>
                                                </td>
                                                <td class="text-truncate p-1">
                                                    <ul class="list-unstyled users-list m-0">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../../../app-assets/images/portfolio/portfolio-5.jpg" alt="Avatar">
                                                        </li>
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../../../app-assets/images/portfolio/portfolio-6.jpg" alt="Avatar">
                                                        </li>
                                                        <li class="avatar avatar-sm">
                                                            <span class="badge badge-info">+2 more</span>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-warning round">Electronics</button>
                                                </td>
                                                <td>
                                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td class="text-truncate">$ 1850.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><i class="la la-dot-circle-o warning font-medium-1 mr-1"></i> Pending</td>
                                                <td class="text-truncate"><a href="#">INV-001003</a></td>
                                                <td class="text-truncate">
                                                    <span class="avatar avatar-xs">
                                                        <img class="box-shadow-2" src="../../../app-assets/images/portrait/small/avatar-s-6.png" alt="avatar">
                                                    </span>
                                                    <span>Megan S.</span>
                                                </td>
                                                <td class="text-truncate p-1">
                                                    <ul class="list-unstyled users-list m-0">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../../../app-assets/images/portfolio/portfolio-2.jpg" alt="Avatar">
                                                        </li>
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../../../app-assets/images/portfolio/portfolio-5.jpg" alt="Avatar">
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-success round">Groceries</button>
                                                </td>
                                                <td>
                                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                        <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td class="text-truncate">$ 3200.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><i class="la la-dot-circle-o success font-medium-1 mr-1"></i> Paid</td>
                                                <td class="text-truncate"><a href="#">INV-001004</a></td>
                                                <td class="text-truncate">
                                                    <span class="avatar avatar-xs">
                                                        <img class="box-shadow-2" src="../../../app-assets/images/portrait/small/avatar-s-7.png" alt="avatar">
                                                    </span>
                                                    <span>Andrew D.</span>
                                                </td>
                                                <td class="text-truncate p-1">
                                                    <ul class="list-unstyled users-list m-0">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../../../app-assets/images/portfolio/portfolio-6.jpg" alt="Avatar">
                                                        </li>
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../../../app-assets/images/portfolio/portfolio-1.jpg" alt="Avatar">
                                                        </li>
                                                        <li class="avatar avatar-sm">
                                                            <span class="badge badge-info">+1 more</span>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-info round">Apparels</button>
                                                </td>
                                                <td>
                                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td class="text-truncate">$ 4500.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate"><i class="la la-dot-circle-o success font-medium-1 mr-1"></i> Paid</td>
                                                <td class="text-truncate"><a href="#">INV-001005</a></td>
                                                <td class="text-truncate">
                                                    <span class="avatar avatar-xs">
                                                        <img class="box-shadow-2" src="../../../app-assets/images/portrait/small/avatar-s-9.png" alt="avatar">
                                                    </span>
                                                    <span>Walter R.</span>
                                                </td>
                                                <td class="text-truncate p-1">
                                                    <ul class="list-unstyled users-list m-0">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../../../app-assets/images/portfolio/portfolio-5.jpg" alt="Avatar">
                                                        </li>
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="../../../app-assets/images/portfolio/portfolio-3.jpg" alt="Avatar">
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-danger round">Food</button>
                                                </td>
                                                <td>
                                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td class="text-truncate">$ 1500.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!--/ Recent Transactions -->

                <!--Recent Orders & Monthly Sales -->
                {{-- <div class="row match-height">
                    <div class="col-xl-8 col-lg-12">
                        <div class="card">
                            <div class="card-content ">
                                <div id="cost-revenue" class="height-250 position-relative"></div>
                            </div>
                            <div class="card-footer">
                                <div class="row mt-1">
                                    <div class="col-3 text-center">
                                        <h6 class="text-muted">Total Products</h6>
                                        <h2 class="block font-weight-normal">18.6 k</h2>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-center">
                                        <h6 class="text-muted">Total Sales</h6>
                                        <h2 class="block font-weight-normal">64.54 M</h2>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-center">
                                        <h6 class="text-muted">Total Cost</h6>
                                        <h2 class="block font-weight-normal">24.38 B</h2>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-center">
                                        <h6 class="text-muted">Total Revenue</h6>
                                        <h2 class="block font-weight-normal">36.72 M</h2>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body sales-growth-chart">
                                    <div id="monthly-sales" class="height-250"></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="chart-title mb-1 text-center">
                                    <h6>Total monthly Sales.</h6>
                                </div>
                                <div class="chart-stats text-center">
                                    <a href="#" class="btn btn-sm btn-danger box-shadow-2 mr-1">Statistics <i class="ft-bar-chart"></i></a> <span class="text-muted">for the last year.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!--/Recent Orders & Monthly Sales -->

                <!-- Basic Horizontal Timeline -->
                {{-- <div class="row match-height">
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Basic Card</h4>
                            </div>
                            <div class="card-content">
                                <img class="img-fluid" src="../../../app-assets/images/carousel/05.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="card-link">Card link</a>
                                    <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>
                            <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                <span class="float-left">3 hours ago</span>
                                <span class="float-right">
                                    <a href="#" class="card-link">Read More <i class="fa fa-angle-right"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Horizontal Timeline</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="card-text">
                                        <section class="cd-horizontal-timeline">
                                            <div class="timeline">
                                                <div class="events-wrapper">
                                                    <div class="events">
                                                        <ol>
                                                            <li><a href="#0" data-date="16/01/2015" class="selected">16 Jan</a></li>
                                                            <li><a href="#0" data-date="28/02/2015">28 Feb</a></li>
                                                            <li><a href="#0" data-date="20/04/2015">20 Mar</a></li>
                                                            <li><a href="#0" data-date="20/05/2015">20 May</a></li>
                                                            <li><a href="#0" data-date="09/07/2015">09 Jul</a></li>
                                                            <li><a href="#0" data-date="30/08/2015">30 Aug</a></li>
                                                            <li><a href="#0" data-date="15/09/2015">15 Sep</a></li>
                                                        </ol>
                                                        <span class="filling-line" aria-hidden="true"></span>
                                                    </div>
                                                    <!-- .events -->
                                                </div>
                                                <!-- .events-wrapper -->
                                                <ul class="cd-timeline-navigation">
                                                    <li><a href="#0" class="prev inactive">Prev</a></li>
                                                    <li><a href="#0" class="next">Next</a></li>
                                                </ul>
                                                <!-- .cd-timeline-navigation -->
                                            </div>
                                            <!-- .timeline -->
                                            <div class="events-content">
                                                <ol>
                                                    <li class="selected" data-date="16/01/2015">
                                                        <blockquote class="blockquote border-0">
                                                            <div class="media">
                                                                <div class="media-left">
                                                                    <img class="media-object img-xl mr-1" src="../../../app-assets/images/portrait/small/avatar-s-5.png" alt="Generic placeholder image">
                                                                </div>
                                                                <div class="media-body">
                                                                    Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                                                </div>
                                                            </div>
                                                            <footer class="blockquote-footer text-right">Steve Jobs
                                                                <cite title="Source Title">Entrepreneur</cite>
                                                            </footer>
                                                        </blockquote>
                                                        <p class="lead mt-2">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at.
                                                        </p>
                                                    </li>
                                                    <li data-date="28/02/2015">
                                                        <blockquote class="blockquote border-0">
                                                            <div class="media">
                                                                <div class="media-left">
                                                                    <img class="media-object img-xl mr-1" src="../../../app-assets/images/portrait/small/avatar-s-6.png" alt="Generic placeholder image">
                                                                </div>
                                                                <div class="media-body">
                                                                    Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                                                </div>
                                                            </div>
                                                            <footer class="blockquote-footer text-right">Steve Jobs
                                                                <cite title="Source Title">Entrepreneur</cite>
                                                            </footer>
                                                        </blockquote>
                                                        <p class="lead mt-2">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at.
                                                        </p>
                                                    </li>
                                                    <li data-date="20/04/2015">
                                                        <blockquote class="blockquote border-0">
                                                            <div class="media">
                                                                <div class="media-left">
                                                                    <img class="media-object img-xl mr-1" src="../../../app-assets/images/portrait/small/avatar-s-7.png" alt="Generic placeholder image">
                                                                </div>
                                                                <div class="media-body">
                                                                    Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                                                </div>
                                                            </div>
                                                            <footer class="blockquote-footer text-right">Steve Jobs
                                                                <cite title="Source Title">Entrepreneur</cite>
                                                            </footer>
                                                        </blockquote>
                                                        <p class="lead mt-2">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at.
                                                        </p>
                                                    </li>
                                                    <li data-date="20/05/2015">
                                                        <blockquote class="blockquote border-0">
                                                            <div class="media">
                                                                <div class="media-left">
                                                                    <img class="media-object img-xl mr-1" src="../../../app-assets/images/portrait/small/avatar-s-8.png" alt="Generic placeholder image">
                                                                </div>
                                                                <div class="media-body">
                                                                    Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                                                </div>
                                                            </div>
                                                            <footer class="blockquote-footer text-right">Steve Jobs
                                                                <cite title="Source Title">Entrepreneur</cite>
                                                            </footer>
                                                        </blockquote>
                                                        <p class="lead mt-2">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at.
                                                        </p>
                                                    </li>
                                                    <li data-date="09/07/2015">
                                                        <blockquote class="blockquote border-0">
                                                            <div class="media">
                                                                <div class="media-left">
                                                                    <img class="media-object img-xl mr-1" src="../../../app-assets/images/portrait/small/avatar-s-9.png" alt="Generic placeholder image">
                                                                </div>
                                                                <div class="media-body">
                                                                    Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                                                </div>
                                                            </div>
                                                            <footer class="blockquote-footer text-right">Steve Jobs
                                                                <cite title="Source Title">Entrepreneur</cite>
                                                            </footer>
                                                        </blockquote>
                                                        <p class="lead mt-2">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at.
                                                        </p>
                                                    </li>
                                                    <li data-date="30/08/2015">
                                                        <blockquote class="blockquote border-0">
                                                            <div class="media">
                                                                <div class="media-left">
                                                                    <img class="media-object img-xl mr-1" src="../../../app-assets/images/portrait/small/avatar-s-6.png" alt="Generic placeholder image">
                                                                </div>
                                                                <div class="media-body">
                                                                    Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                                                </div>
                                                            </div>
                                                            <footer class="blockquote-footer text-right">Steve Jobs
                                                                <cite title="Source Title">Entrepreneur</cite>
                                                            </footer>
                                                        </blockquote>
                                                        <p class="lead mt-2">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at.
                                                        </p>
                                                    </li>
                                                    <li data-date="15/09/2015">
                                                        <blockquote class="blockquote border-0">
                                                            <div class="media">
                                                                <div class="media-left">
                                                                    <img class="media-object img-xl mr-1" src="../../../app-assets/images/portrait/small/avatar-s-7.png" alt="Generic placeholder image">
                                                                </div>
                                                                <div class="media-body">
                                                                    Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                                                </div>
                                                            </div>
                                                            <footer class="blockquote-footer text-right">Steve Jobs
                                                                <cite title="Source Title">Entrepreneur</cite>
                                                            </footer>
                                                        </blockquote>
                                                        <p class="lead mt-2">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at.
                                                        </p>
                                                    </li>
                                                </ol>
                                            </div>
                                            <!-- .events-content -->
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!--/ Basic Horizontal Timeline -->
            </div>
        </div>
@endsection
@section('js')
@endsection
