<?php

namespace App\Http\Livewire\Front;

use Cart;
use App\Models\Blog;
use App\Models\Review;
use App\Models\Product;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        $this->emitTo('front.cart-count-component','refreshComponent');
        // session()->flash('success_message',__('Website/home.item_added_in_cart'));
        return redirect()->route('product.cart');
    }
    public function addToWishlist($product_id,$product_name,$product_price){
        Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        $this->emitTo('front.wishlist-count-component','refreshComponent');
        return redirect()->route('front2');
    }
    public function removeWishlist($product_id){
        foreach(Cart::instance('wishlist')->content() as $item){
          if($item->id == $product_id){
             Cart::instance('wishlist')->remove($item->rowId);
             $this->emitTo('front.wishlist-count-component','refreshComponent');
             return redirect()->route('front2');
          }
        }
     }

    public function render()
    {
        $data['newProducts'] = Product::where('in_stock',1)->where('qty','>',0)->latest()->limit(12)->get();
        $data['popProducts'] = Product::where('in_stock',1)->where('qty','>',0)->inRandomOrder()->get()->take(6);
        $data['saleProducts'] = Product::where('special_price','>',0)
                                 ->where('in_stock','1')
                                 ->latest()->get()->take(4);
        if(Auth::guard('vendor')->check()){
            Cart::instance('cart')->restore(Auth::guard('vendor')->user()->email);
            Cart::instance('wishlist')->restore(Auth::guard('vendor')->user()->email);
          }

          $data['reviews']=Review::where('show_or_hide','1')->get();
          $data['home_category']=Category::whereNull('parent_id')->inRandomOrder()->limit(8)->get();
          $data['random_blog']=Blog::inRandomOrder()->limit(2)->get();
        $data['ar_logo']=Setting::select('ar_site_logo')->first();
        $data['en_logo']=Setting::select('en_site_logo')->first();
        $data['ku_logo']=Setting::select('ku_site_logo')->first();

          $data['offer_product']=Product::whereNotNull('special_price')->where('in_stock',1)->where('special_price_type','=','fixed')->first();

        return view('livewire.front.home',$data)
        ->layout('front.layouts.master1');
    }
}
