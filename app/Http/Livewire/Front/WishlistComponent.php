<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Cart;
class WishlistComponent extends Component
{
    public function removeWishlist($product_id){
        foreach(Cart::instance('wishlist')->content() as $item){
          if($item->id == $product_id){
             Cart::instance('wishlist')->remove($item->rowId);
             $this->emitTo('front.wishlist-count-component','refreshComponent');
             return;
          }
        }
     }

     public function moveProductFromWishlistToCart($rowId){
         $item = Cart::instance('wishlist')->get($rowId);
         Cart::instance('wishlist')->remove($rowId);
         Cart::instance('cart')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
         $this->emitTo('front.wishlist-count-component','refreshComponent');
         $this->emitTo('front.cart-count-component','refreshComponent');
     }
    public function render()
    {
        return view('livewire.front.wishlist-component')->layout('front.layouts.master2');
    }
}
