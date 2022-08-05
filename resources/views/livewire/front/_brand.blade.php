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



                        @foreach( \App\Models\Brand::orderByDesc('created_at')->limit(5)->get() as $brand)
                            @if ($brand->image)
                                <div class="__item">
                                    <img class="img-fluid m-auto" src="{{ asset('Dashboard/img/brands/' . $brand->image->filename) }}"
                                        alt="{{ $brand->title }}" />
                                </div>
                            @else
                            <div class="__item">
                                <img class="img-fluid m-auto" src="{{ asset('Dashboard/img/images/brands/brand1.jpg') }}"
                                    alt="{{ $brand->title }}" />
                            </div>
                            @endif
                        @endforeach

                {{-- <div class="__item">
                    <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/2.jpg') }}"
                        alt="demo" />
                </div>

                <div class="__item">
                    <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/3.jpg') }}"
                        alt="demo" />
                </div>

                <div class="__item">
                    <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/4.jpg') }}"
                        alt="demo" />
                </div>

                <div class="__item">
                    <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/5.jpg') }}"
                        alt="demo" />
                </div> --}}
            </div>
        </div>
    </div>
</section>
<!-- end section -->
