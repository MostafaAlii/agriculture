<div class="wrap-icon-section minicart">
    <i class="fontello-shopping-bag"></i>
    <a href="{{ route('product.cart') }}">
        @if(Cart::instance('cart')->count() > 0)
             <span class="total">{{ Cart::instance('cart')->count() }}</span>
        @else
             <span class="total">{{ Cart::instance('cart')->count() }}</span>
        @endif
    </a>
</div>




