  <!-- start section -->
  <section class="section section--gutter section--base-bg">
    <div class="container">
        <!-- start counters -->
        <div class="counter">
            <div class="__inner">
                <div class="row justify-content-sm-center">
                    <!-- start item -->
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3">
                        <div class="__item" data-aos="zoom-in" data-aos-duration="350" data-aos-delay="150">
                            <div class="d-table">
                                <div class="d-table-cell align-middle">
                                    <i class="__ico">
                                        <img class="img-fluid  lazy"
                                            src="{{ asset('frontassets/img/blank.gif') }}"
                                            data-src="{{ asset('frontassets/img/ico/ico_count_1.png') }}"
                                            alt="demo" />
                                    </i>
                                </div>

                                <div class="d-table-cell align-middle">
                                    <p class="__count js-count" data-from="0" data-to="{{ \App\Models\Product::count() }}">{{ \App\Models\Product::count() }}</p>

                                    <p class="__title">{{ __('Admin/site.products') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end item -->

                    <!-- start item -->
                    {{-- <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3">
                        <div class="__item" data-aos="zoom-in" data-aos-duration="350" data-aos-delay="300">
                            <div class="d-table">
                                <div class="d-table-cell align-middle">
                                    <i class="__ico">
                                        <img class="img-fluid  lazy"
                                            src="{{ asset('frontassets/img/blank.gif') }}"
                                            data-src="{{ asset('frontassets/img/ico/ico_count_2.png') }}"
                                            alt="demo" />
                                    </i>
                                </div>

                                <div class="d-table-cell align-middle">
                                    <p class="__count js-count" data-from="0" data-to="{{ \App\Models\Department::count() }}">{{ \App\Models\Department::count() }}</p>

                                    <p class="__title">{{ trans('Admin/categories.departments') }}</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- end item -->

                    <!-- start item -->
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3">
                        <div class="__item" data-aos="zoom-in" data-aos-duration="350" data-aos-delay="450">
                            <div class="d-table">
                                <div class="d-table-cell align-middle">
                                    <i class="__ico">
                                        <img class="img-fluid  lazy"
                                            src="{{ asset('frontassets/img/blank.gif') }}"
                                            data-src="{{ asset('frontassets/img/ico/ico_count_3.png') }}"
                                            alt="demo" />
                                    </i>
                                </div>

                                <div class="d-table-cell align-middle">
                                    <p class="__count js-count" data-from="0" data-to="{{ \App\Models\FarmerService::count() }}">{{ \App\Models\FarmerService::count() }}</p>

                                    <p class="__title">{{ trans('Admin/services.farmerServicePageTitle') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end item -->

                    <!-- start item -->
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3">
                        <div class="__item" data-aos="zoom-in" data-aos-duration="350" data-aos-delay="600">
                            <div class="d-table">
                                <div class="d-table-cell align-middle">
                                    <i class="__ico">
                                        <img class="img-fluid  lazy"
                                            src="{{ asset('frontassets/img/blank.gif') }}"
                                            data-src="{{ asset('frontassets/img/ico/ico_count_4.png') }}"
                                            alt="demo" />
                                    </i>
                                </div>

                                <div class="d-table-cell align-middle">
                                    <p class="__count js-count" data-from="0" data-to="{{ \App\Models\Category::count() }}">{{ \App\Models\Category::count() }}</p>

                                    <p class="__title">{{ trans('Admin/categories.departmentPageTitle') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end item -->
                    <!-- start item -->
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3">
                        <div class="__item" data-aos="zoom-in" data-aos-duration="350" data-aos-delay="600">
                            <div class="d-table">
                                <div class="d-table-cell align-middle">
                                    <i class="__ico">
                                        <img class="img-fluid  lazy"
                                            src="{{ asset('frontassets/img/blank.gif') }}"
                                            data-src="{{ asset('frontassets/img/ico/ico_count_4.png') }}"
                                            alt="demo" />
                                    </i>
                                </div>

                                <div class="d-table-cell align-middle">
                                    <p class="__count js-count" data-from="0" data-to="{{ \App\Models\Category::whereNotNull('parent_id')->count() }}">{{ \App\Models\Category::count() }}</p>

                                    <p class="__title">{{ trans('Admin/categories.department_sub') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end item -->
                </div>
            </div>
        </div>
        <!-- end counters -->
    </div>
</section>
<!-- end section -->
