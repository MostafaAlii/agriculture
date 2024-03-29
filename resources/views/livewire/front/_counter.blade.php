  <!-- start section -->
  <section class="section section--gutter section--base-bg">
    <div class="container">
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
                                            data-src="{{ asset('frontassets/img/feature_img/11.png') }}"
                                            alt="demo" />
                                    </i>
                                </div>
                                <div class="d-table-cell align-middle">
                                    <p class="__count js-count" data-from="0" data-to="{{ Product::count() }}">{{ Product::count() }}</p>
                                    <p class="__title">{{ __('Admin/site.products') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3">
                        <div class="__item" data-aos="zoom-in" data-aos-duration="350" data-aos-delay="450">
                            <div class="d-table">
                                <div class="d-table-cell align-middle">
                                    <i class="__ico">
                                        <img class="img-fluid  lazy"
                                            src="{{ asset('frontassets/img/blank.gif') }}"
                                            data-src="{{ asset('frontassets/img/feature_img/7.png') }}"
                                            alt="demo" />
                                    </i>
                                </div>
                                <div class="d-table-cell align-middle">
                                    <p class="__count js-count" data-from="0" data-to="{{ FarmerService::count() }}">{{ FarmerService::count() }}</p>
                                    <p class="__title">{{ trans('Admin/services.farmerServicePageTitle') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3">
                        <div class="__item" data-aos="zoom-in" data-aos-duration="350" data-aos-delay="600">
                            <div class="d-table">
                                <div class="d-table-cell align-middle">
                                    <i class="__ico">
                                        <img class="img-fluid  lazy"
                                            src="{{ asset('frontassets/img/blank.gif') }}"
                                            data-src="{{ asset('frontassets/img/feature_img/8.png') }}"
                                            alt="demo" />
                                    </i>
                                </div>
                                <div class="d-table-cell align-middle">
                                    <p class="__count js-count" data-from="0" data-to="{{ Category::parentCategory()->count() }}">{{ Category::parentCategory()->count() }}</p>
                                    <p class="__title">{{ trans('Admin/categories.departmentPageTitle') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3">
                        <div class="__item" data-aos="zoom-in" data-aos-duration="350" data-aos-delay="600">
                            <div class="d-table">
                                <div class="d-table-cell align-middle">
                                    <i class="__ico">
                                        <img class="img-fluid  lazy"
                                            src="{{ asset('frontassets/img/blank.gif') }}"
                                            data-src="{{ asset('frontassets/img/feature_img/9.png') }}"
                                            alt="demo" />
                                    </i>
                                </div>
                                <div class="d-table-cell align-middle">
                                    <p class="__count js-count" data-from="0" data-to="{{ Category::childCategory()->count() }}">{{ Category::childCategory()->count() }}</p>
                                    <p class="__title">{{ trans('Admin/categories.department_sub') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
