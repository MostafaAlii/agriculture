<?php
namespace App\Http\Livewire\Front;
use Livewire\Component;
use App\Models\ProductCoupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
class CartComponent extends Component {
  public $cart_subtotal, $cart_tax, $cart_total, $cartCount;
  public $haveCouponCode;
  public $couponCode;
  public $discount;
  public $subtotalAfterDiscount;
  public $taxAfterDiscount;
  public $totalAfterDiscount;
  public function mount(){
        $this->cart_subtotal = Cart::instance('cart')->subtotal();
        $this->cart_tax = Cart::instance('cart')->tax();
        $this->cart_total = Cart::instance('cart')->total();
        $this->cartCount = Cart::instance('cart')->count();
  }
  public function increaseQuntity($rowID) {
    $product = Cart::instance('cart')->get($rowID);
    $qty = $product->qty +1;
    Cart::instance('cart')->update($rowID , $qty);
    $this->emitTo('front.cart-count-component','refreshComponent');
  }

  public function decreaseQuntity($rowID) {
    $product = Cart::instance('cart')->get($rowID);
    $qty = $product->qty -1;
    Cart::instance('cart')->update($rowID , $qty);
    $this->emitTo('front.cart-count-component','refreshComponent');
  }

  public function destroy($rowID) {
      Cart::instance('cart')->remove($rowID);
      $this->emitTo('front.cart-count-component','refreshComponent');
      session()->flash('success_message','Item has been removed');
  }

  public function destroyAll() {
      Cart::instance('cart')->destroy();
      $this->emitTo('front.cart-count-component','refreshComponent');
      session()->flash('success_message','All Item has been removed');
  }

  public function SaveForLater($rowId) {
      $item = Cart::instance('cart')->get($rowId);
      Cart::instance('cart')->remove($rowId);
      Cart::instance('saveforlater')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
      $this->emitTo('front.cart-count-component','refreshComponent');
      session()->flash('success_message','Item has been saved for later');
  }

  public function moveProductFromSaveForLaterToCart($rowId) {
      $item = Cart::instance('saveforlater')->get($rowId);
      Cart::instance('saveforlater')->remove($rowId);
      Cart::instance('cart')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
      $this->emitTo('front.cart-count-component','refreshComponent');
      session()->flash('s_success_message','item has been moved to cart successfully');
  }

  public function DeleteFromSaveForLater($rowId) {
      Cart::instance('saveforlater')->remove($rowId);
      session()->flash('s_success_message','Item has been removed from saved for later');
  }

  public function applyCouponCode() {
    //$coupon = ProductCoupon::whereIn(['code', $this->couponCode],['status', 1])->whereIn('value', '<=', Cart::instance('cart')->subtotal())->first();
    $coupon = ProductCoupon::where('code', $this->couponCode)->where('value', '<=', Cart::instance('cart')->subtotal())->first();
    if(!$coupon) {
        session()->flash('coupon_msg', 'Coupon Is Invalid !');
        return;
    }
    session()->put('coupon',[
      'code'  =>  $coupon->code,
      'type'  =>  $coupon->type,
      'value'  =>  $coupon->value,
      'geater_than'  =>  $coupon->geater_than,
    ]);
  }

  public function calculateDiscounts() {
    if(session()->has('coupon')) {
      if(session()->get('coupon')['type'] == 'fixed') {
        $this->discount = session()->get('coupon')['value'];
      } else {
        $this->discount = (Cart::instance('cart')->subtotal() * session()->get('coupon')['value']) / 100;
      }
      $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;
      $this->taxAfterDiscount = ($this->subtotalAfterDiscount * config('cart.tax')) / 100;
      $this->totalAfterDiscount = $this->subtotalAfterDiscount * $this->taxAfterDiscount;
    }
  }
  
  public function update_cart() {
      $this->cartCount = Cart::instance('default')->count();
      $this->wishlistCount = Cart::instance('wishlist')->count();
  }
/******************************************************************************************* */
  public function checkout() {
    if(Auth::guard('vendor')->check()){
        return redirect()->route('checkout');
    } else {
      return redirect()->route('front');
    }
  }

  public function setAmountForCheckout()
  {
    if(session()->has('coupon')) {
      session()->put('checkout',[
        'discount' => $this->discount,
        'subtotal' => $this->subtotalAfterDiscount,
        'tax' => $this->taxAfterDiscount,
        'total' => $this->totalAfterDiscount
      ]);
    } else {
      session()->put('checkout',[
        'discount' => 0,
        'subtotal' => Cart::instance('cart')->subtotal(),
        'tax' => Cart::instance('cart')->tax(),
        'total' => Cart::instance('cart')->total()
      ]);
    }
    /*if(!Cart::instance('cart')->count > 0) {
      session()->forget('checkout');
      return;
    }*/
  }
/********************************************************************************************* */
  public function render() {
      if(Auth::guard('vendor')->check()){
          Cart::instance('cart')->store(Auth::guard('vendor')->user()->email);
      }
      $this->setAmountForCheckout();
      return view('livewire.front.cartComponent')->layout('front.layouts.master2');
  }
}
