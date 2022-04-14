<?php
namespace App\Http\Livewire\Front;
use App\Models\Farmer;
use Livewire\Component;
use App\Models\PaymentMethod;
use App\Models\ProductCoupon;

class Checkout extends Component {
    public $haveCouponCode; 
    public $cart_subtotal;
    public $cart_tax;
    public $cart_total;
    public $cart_coupon;
    public $coupon_code;
    public $cart_discount;
    public $user_address;
    public $user_email;
    public $user_firstname;
    public $user_lastname;
    public $payment_methods;
    public $payment_method_id = 0;
    public $payment_method_code;
    public function mount(){
        $this->payment_method_id = session()->has('saved_payment_method_id') ? session()->get('saved_payment_method_id') : '';
        $this->cart_subtotal = getCalcDiscountNumbers()->get('subtotal');
        $this->cart_tax = getCalcDiscountNumbers()->get('tax');
        $this->cart_total = getCalcDiscountNumbers()->get('total');
        $this->cart_discount = getCalcDiscountNumbers()->get('discount');
        $this->user_address = auth()->user()->address1;
        $this->user_email = auth()->user()->email;
        $this->user_phone = auth()->user()->phone;
        $this->user_firstname = auth()->user()->firstname;
        $this->user_lastname = auth()->user()->lastname;
        $this->payment_methods = PaymentMethod::whereStatus(true)->get();
    }
    public function applyDiscount() {
        if(getCalcDiscountNumbers()->get('subtotal') > 0) {
            $coupon = ProductCoupon::whereCode($this->coupon_code)->whereStatus(true)->first();
            if(!$coupon) {
                $this->cart_coupon = '';
                $this->alert('error', 'Coupon is invalid!');
            } else {
                $couponValue = $coupon->discount($this->cart_subtotal);
                if ($couponValue > 0) {
                    session()->put('coupon', [
                        'code' => $coupon->code,
                        'value' => $coupon->value,
                        'discount' => $couponValue,
                    ]);
                    $this->coupon_code = session()->get('coupon')['code'];
                    $this->emit('updateCart');
                    $this->alert('success', 'coupon is applied successfully');
                } else {
                    $this->alert('error', 'product coupon is invalid');
                }
            }
        } else {
            $this->cart_coupon = '';
            $this->alert('error', 'No Product Available In Your Cart');
        }
    }
    public function removeCoupon() {
        session()->remove('coupon');
        $this->coupon_code = '';
        $this->emit('updateCart');
        $this->alert('success', 'Coupon is removed');
    }
    public function render() {
        return view('livewire.front.checkout')->layout('front.layouts.master2');
    }

    public function updatePaymentMethod(){
        $payment_method = PaymentMethod::whereId($this->payment_method_id)->first();
        //$this->payment_method_code = $payment_method->code;
    }
}
