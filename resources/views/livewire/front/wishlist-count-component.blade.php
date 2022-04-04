<div class="wrap-icon-section minicart">
    <i class="fa fa-heart"></i>
    <a href="{{ route('product.wishlist') }}">
        @if(Cart::instance('wishlist')->count() > 0)
             <span class="total">{{ Cart::instance('wishlist')->count() }}</span>
        @else
             <span class="total">{{ Cart::instance('wishlist')->count() }}</span>
        @endif
    </a>
</div>

