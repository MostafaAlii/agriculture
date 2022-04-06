<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

use Cart;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{

    public function increaseQuntity($rowID)
    {
      $product = Cart::instance('cart')->get($rowID);
      $qty = $product->qty +1;
      Cart::instance('cart')->update($rowID , $qty);
      $this->emitTo('front.cart-count-component','refreshComponent');
    }
    public function decreaseQuntity($rowID)
    {
      $product = Cart::instance('cart')->get($rowID);
      $qty = $product->qty -1;
      Cart::instance('cart')->update($rowID , $qty);
      $this->emitTo('front.cart-count-component','refreshComponent');
    }
    public function destroy($rowID)
    {
       Cart::instance('cart')->remove($rowID);
       $this->emitTo('front.cart-count-component','refreshComponent');
       session()->flash('success_message','Item has been removed');
    }
    public function render()
    {
        if(Auth::guard('vendor')->check()){
            Cart::instance('cart')->store(Auth::guard('vendor')->user()->email);
          }
        return view('livewire.front.cartComponent')
        ->layout('front.layouts.master2');
    }
}
