@extends('front.layouts.master5')
@section('title',  __('Admin/products.farmereditproduct'))
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/forms/selects/select2.min.css')}}">
@endsection
@section('content')
<div>
	<!-- start section -->
    <section class="section">
        <div class="decor-el decor-el--1" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="286" height="280" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_1.jpg') }}" alt="demo"/>
        </div>

        <div class="decor-el decor-el--2" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="99" height="88" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_2.jpg') }}" alt="demo"/>
        </div>

        <div class="decor-el decor-el--3" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="115" height="117" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_3.jpg') }}" alt="demo"/>
        </div>

        <div class="decor-el decor-el--4" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="84" height="76" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_4.jpg') }}" alt="demo"/>
        </div>

        <div class="decor-el decor-el--5" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="248" height="309" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_5.jpg') }}" alt="demo"/>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- start checkout -->
                    <div class="checkout">
                        <h2>{{ __('Admin/products.farmereditproduct') }}</h2>
                        <h1> <a href="{{ route('farmer.product') }}" class="btn btn-primary btn-lg"> <i class="fa fa-plus"></i> {{ __('Admin/site.back') }}</a></h1>
                        <div class="spacer py-3"></div>

                        <form class="checkout__form" method="post" action="{{ route('farmer.updateproduct') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('put')
                            <div class="row justify-content-xl-between">
                                <div class="col-12 col-md-5 col-lg-6">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                            <div class="input-wrp">
                                                <img class="mr-2 users-avatar-shadow rounded-circle img-preview" id="output" width="85px" height="85px"
                                                    src=" {{ $product->image_path ?
                                                    $product->image_path : URL::asset('Dashboard/img/Default/default_product.jpg') }}"
                                                    alt="{{ $product->name}}">
                                            </div>
                                            <div class="input-wrp">
                                                <input type="file" accept="image/*" name="photo" class="textfield img"  />
                                            </div>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="input-wrp">
                                                <label >{{ __('Admin/products.product_name') }} <span class="text-danger">*</span></label>
                                                <input class="textfield"
                                                placeholder="{{ __('Admin/products.product_name_placeholder') }} *"
                                                name="name" value="{{ $product->name }}" required
                                                type="text" />
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="col-12 ">
                                            <div class="input-wrp">
                                                <label >{{ __('Admin/products.product_name') }} <span class="text-danger">*</span></label>
                                                <input class="textfield"
                                                placeholder="{{ __('Admin/products.product_name_placeholder') }} *"
                                                name="slug"
                                                value="{{ $product->slug }}" readonly
                                                type="text" />
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="input-wrp">
                                                <label >
                                                    {{ trans('Admin\products.product_category_select') }} <span class="text-danger">*</span>
                                                </label>
                                                <div >
                                                    <?php
                                                    $selected_department=array();
                                                    foreach ($product->categories as $department_select){
                                                         array_push($selected_department,$department_select->id);
                                                    }
                                                    ?>
                                                    <select name="categories[]" class="select2 form-control" multiple>
                                                        <optgroup label="{{ trans('Admin\products.product_category_select_placeholder') }}">
                                                            @if($categories && $categories->count() > 0)
                                                                @foreach($categories as $category)
                                                                    <option value="{{$category->id}}" <?php if(in_array($category->id,$selected_department)){echo'selected';}?>>{{$category->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                    </select>
                                                    @error('categories.0')
                                                    <span class="text-danger"> {{$message}}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-wrp">
                                                <label >
                                                    {{ trans('Admin\products.product_tags_select') }}
                                                </label>
                                                <div>
                                                    <?php
                                                    $selected_tags=array();
                                                    foreach ($product->tags as $tags_select){
                                                         array_push($selected_tags,$tags_select->id);
                                                    }
                                                    ?>
                                                    <select name="tags[]" class="select2 form-control" multiple>
                                                        <optgroup label="{{ trans('Admin\products.product_tags_select_placeholder') }}">
                                                            @if($tags && $tags->count() > 0)
                                                                @foreach($tags as $tag)
                                                                    <option value="{{$tag->id}}" <?php if(in_array($tag->id,$selected_tags)){echo'selected';}?>>{{$tag->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                    </select>
                                                    @error('tags.0')
                                                    <span class="text-danger"> {{$message}}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 " class="qty">
                                            <div class="input-wrp">
                                                <label for="projectinput1">
                                                    {{ trans('Admin\products.product_enterqty') }} <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="number" name="qty" class="textfield"
                                                    placeholder="{{ trans('Admin/products.product_enterqty') }} *"
                                                    value="{{ $product->qty }}"required />
                                                @error('qty')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-wrp">
                                                <label>
                                                    {{ trans('Admin\products.product_units_select') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div >
                                                    <select class="select2 textfield wide js-select" id="units"  name="unit_id"
                                                       style="width: 38.75em;" required >
                                                        @if($units && $units->count() > 0)
                                                            <optgroup label="--{{ trans('Admin\products.product_units_select') }}--">
                                                                @foreach($units as $unit)
                                                                <option value="{{ $unit->id }}" {{$product->getUnit()->Name == $unit->Name ? 'selected':'' }}>{{ $unit->Name ??null}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endif
                                                    </select>
                                                    @error('unit_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="input-wrp">
                                                <label for="projectinput1">
                                                    {{ trans('Admin\products.product_main_price') }}
                                                </label>
                                                <input type="number" name="price" value="{{ $product->special_price ?? $product->getPrice()}}"
                                                class="textfield"
                                                placeholder="{{ trans('Admin/products.product_main_price_placeholder') }}"
                                               />
                                                @error('price')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-wrp">
                                                <label for="projectinput1">
                                                    {{ trans('Admin\products.product_description') }}
                                                </label>
                                                <textarea name="description" class="textfield"
                                                placeholder="{{ trans('Admin\products.product_description_placeholder') }}">
                                                {{$product->description}}
                                                </textarea>
                                                @error('description')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="spacer py-6"></div>
                                    <input type="hidden" value="{{$product->id}}" name="id"/>
                                    <button class="custom-btn custom-btn--medium custom-btn--style-1"
                                            type="submit" role="button">{{ __('Admin/site.edit') }}
                                    </button>
                                    <div class="spacer py-6 d-md-none"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end checkout -->
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
</div>
@endsection
@push('js')
<script src="{{ asset('assets/admin/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/scripts/forms/select/form-select2.js')}}"></script>
<script>
    $(".img").change(function(){
        if(this.files && this.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $(".img-preview").attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>

{{-- <script>
    $(document).ready(function () {
        $('#category-dropdown').select2();
        $('#category-dropdown').on('change', function (e) {
            let data = $(this).val();
             @this.set('cat', data);
        });
    });
</script>

 <script>
    $(document).ready(function () {
        $('#tags').select2();
        $('#tags').on('change', function (e) {
            let data = $(this).val();
             @this.set('tag', data);
        });
    });
</script> --}}

@endpush
