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
    public function destroyAll()
    {
       Cart::instance('cart')->destroy();
       $this->emitTo('front.cart-count-component','refreshComponent');
       session()->flash('success_message','All Item has been removed');
    }

    public function SaveForLater($rowId)
    {
       $item = Cart::instance('cart')->get($rowId);
       Cart::instance('cart')->remove($rowId);
       Cart::instance('saveforlater')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
       $this->emitTo('front.cart-count-component','refreshComponent');
       session()->flash('success_message','Item has been saved for later');
    }
    public function moveProductFromSaveForLaterToCart($rowId)
    {
        $item = Cart::instance('saveforlater')->get($rowId);
        Cart::instance('saveforlater')->remove($rowId);
        Cart::instance('cart')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        $this->emitTo('front.cart-count-component','refreshComponent');
        session()->flash('s_success_message','item has been moved to cart successfully');
    }
    public function DeleteFromSaveForLater($rowId)
    {
        Cart::instance('saveforlater')->remove($rowId);
        session()->flash('s_success_message','Item has been removed from saved for later');
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
