<?php

namespace App\Http\Livewire\Front;

use Cart;
use Livewire\Component;
use App\Models\Category;
use App\Models\Review;
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
          
        return view('livewire.front.home2',$data)->layout('front.layouts.master');
    }
}
