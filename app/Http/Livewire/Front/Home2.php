<?php

namespace App\Http\Livewire\Front;

use Cart;
use App\Models\Review;
use App\Models\Product;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Home2 extends Component
{
    public function render()
    {
        if(Auth::guard('vendor')->check()){
            Cart::instance('cart')->restore(Auth::guard('vendor')->user()->email);
            Cart::instance('wishlist')->restore(Auth::guard('vendor')->user()->email);
          }

          $data['home_category']=Category::whereNotNull('parent_id')->inRandomOrder()->get();
          $data['category_count']=Category::childCategory()->count();

          $data['about_us']=Cache::get('about_us');

          $data['reviews']=Review::where('show_or_hide','1')->get();
          $data['ar_logo']=Setting::select('ar_site_logo')->first();
          $data['en_logo']=Setting::select('en_site_logo')->first();

          $data['offer_product']=Product::whereNotNull('special_price')->where('in_stock',1)->where('special_price_type','=','fixed')->first();

        return view('livewire.front.home2',$data)->layout('front.layouts.master');
    }
}
