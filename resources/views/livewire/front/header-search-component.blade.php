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


