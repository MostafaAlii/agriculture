<!-- start section -->
<section class="section">
    <div class="container">
        <div class="partners-list">
            <div class="js-slick" data-slick='{
                            "autoplay": true,
                            "arrows": false,
                            "dots": true,
                            "speed": 1000,
                            "responsive": [
                            {
                                "breakpoint":576,
                                "settings":{
                                    "slidesToShow": 2
                                }
                            },
                            {
                                "breakpoint":767,
                                "settings":{
                                    "slidesToShow": 3
                                }
                            },
                            {
                                "breakpoint":991,
                                "settings":{
                                    "slidesToShow": 4
                                }
                            },
                            {
                                "breakpoint":1199,
                                "settings":{
                                    "autoplay": false,
                                    "dots": false,
                                    "slidesToShow": 5
                                }
                            }
                        ]}'>
                @forelse (Brand::orderByDesc('created_at')->limit(5)->get() as $brand)
                    @if (isset($brand->image_path))
                    <img src="{{ $brand->image_path }}"
                        data-src="{{ $brand->image_path }}" alt="{{ $brand->title }}" />
                    @else
                    <img src="{{ asset('Dashboard/img/Default/default_brand.jpg') }}"
                        data-src="{{ asset('Dashboard/img/Default/default_brand.jpg') }}" alt="demo" />
                    @endif
                @empty
                    <div>
                        <h6 class="text-danger">{{ trans('Admin\general.brands_not_found') }}</h6>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
<!-- end section -->
