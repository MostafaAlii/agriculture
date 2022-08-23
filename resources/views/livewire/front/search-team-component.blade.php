{{-- <div class="input-wrp" > --}}
    <div class="widget widget--search">
        <form class="form--horizontal" action="{{ route('team.search') }}" >
            <div class="input-wrp" >
                <input class="textfield"
                    name="search"
                    type="text"
                    value="{{ $search }}"
                    placeholder="{{ __('Admin/site.search') }}"
                    autocomplete="off" />
            </div>

            <button class="custom-btn custom-btn--tiny custom-btn--style-1"
                    type="submit"
                    role="button">
                    {{ __('Admin/site.find') }}
            </button>
        </form>
    </div>
{{-- </div> --}}

