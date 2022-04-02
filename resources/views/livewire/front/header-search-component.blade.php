<div class="widget widget--search">
    <form class="form--horizontal"
          action="{{ route('product.search') }}"
          {{-- method="get" --}}
          >
        <div class="input-wrp">
            <input class="textfield"
                   name="search"
                   type="text"
                   value="{{ $search }}"
                   placeholder="Search" />
        </div>

        <button class="custom-btn custom-btn--tiny custom-btn--style-1"
                 type="submit"
                 role="button">
                 Find
        </button>
    </form>
</div>


{{-- <div class="wrap-search center-section">
    <div class="wrap-search-form">
        <form action="{{ route('product.search') }}" id="form-search-top" name="form-search-top">
            <input type="text" name="search" value="{{ $search }}" placeholder="Search here...">
            <button form="form-search-top" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
            <div class="wrap-list-cate">
                <input type="hidden" name="product_cate" value="{{ $product_cate }}" id="product-cate">
                <input type="hidden" name="product_cate_id" value="{{ $product_cate_id }}" id="product-cate-id">
                <a href="#" class="link-control">{{ str_split($product_cate,12)[0] }}</a>
                <ul class="list-cate">
                    <li class="level-0">All Category</li>
                    @foreach($sections as $section)
                     <li class="level-1" data-id="{{ $section->id }}">{{ $section->section_name }}</li>
                    @endforeach

                </ul>
            </div>
        </form>
    </div>
</div> --}}

