<?php

namespace App\Http\Livewire\Front;

use Cart;
use App\Models\Tag;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\ProductTranslation;
use App\Models\Unit;
use App\Models\UnitTranslation;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Shop extends Component
{
    use WithPagination;
    public $sorting;
    public $pagesize;
    public $min_price;
    public $max_price;
    public $isDisabled;
    public $addtocart;
    public function mount(){
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->min_price = 1;
        $this->max_price = 10000;
        $this->isDisabled = false;
        $this->addtocart = __('Admin/site.addtocart');
    }

    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        $this->emitTo('front.cart-count-component','refreshComponent');
        // $x=Cart::instance('cart')->content()->where('id',$product_id)->pluck('id')->first();
        // $x=Cart::instance('cart')->content()->where('id',$product_id)->first();
        //  dd($x);
        // $xx = Cart::instance('cart')->content()->pluck('id')->all();
        // $xx = Cart::instance('cart')->content()->all();
        // dd($xx);
        // $xxx= Cart::instance('cart')->content()->where('id',$x)->first();
        // dd($xxx);
        // $x=Cart::instance('cart')->content()->first()->id;
        // if($xxx){
        //     // dd($xxx);
        //     $this->isDisabled = true;
        //     $this->addtocart = __('Admin/site.addedtocart');
        // }
    }
    public function addToWishlist($product_id,$product_name,$product_price){
        Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        $this->emitTo('front.wishlist-count-component','refreshComponent');
    }
    public function removeWishlist($product_id){
        foreach(Cart::instance('wishlist')->content() as $item){
          if($item->id == $product_id){
             Cart::instance('wishlist')->remove($item->rowId);
             $this->emitTo('front.wishlist-count-component','refreshComponent');
             return;
          }
        }
     }
    public function render()
    {
        $data['tags']=Tag::get();
        $data['newProducts'] = Product::where('status',1)->where('stock',1)->where('qty','>',0)->latest()->limit(3)->get();

        if($this->sorting=='new_to_old'){
            $data['products'] = Product::where('status',1)->where('stock',1)
                                ->orderByDesc('created_at')
                                ->where('qty','>',0)
                                ->paginate($this->pagesize);
          }elseif($this->sorting=='old_to_new'){
              $data['products'] = Product::where('status',1)->where('stock',1)
                                  ->orderBy('created_at')
                                  ->where('qty','>',0)
                                //   ->whereBetween('special_price',[$this->min_price,$this->max_price])
                                  ->paginate($this->pagesize);
          }elseif($this->sorting=='price_high_to_low'){
              $data['products'] = Product::where('status',1)->where('stock',1)
                                  ->where('qty','>',0)
                                  ->where('special_price', 0)
                                  ->whereHas('units', function($q){
                                    $q->orderByDesc('price');
                                 })
                                //   ->where('special_price','>',0)
                                //   ->whereBetween('special_price',[$this->min_price,$this->max_price])
                                //   ->orderBy('special_price')
                                  ->paginate($this->pagesize);
          }elseif($this->sorting=='price_low_to_high'){
              $data['products'] = Product::where('status',1)->where('stock',1)
                                    ->where('qty','>',0)
                                    ->where('special_price', 0)
                                    ->whereHas('units', function($q){
                                        $q->orderBy('price');
                                     })
                                    // ->whereHas('units', function($q){
                                    //     $q->whereBetween('price',[$this->min_price,$this->max_price]);
                                    //  })
                                //   ->whereBetween('special_price',[$this->min_price,$this->max_price])
                                //   ->orderBy('special_price')
                                  ->paginate($this->pagesize);
          }elseif($this->sorting=='newoffer_from_low_to_high'){
              $data['products'] = Product::where('status',1)->where('stock',1)
                                  ->where('special_price','>',0)
                                  ->orderBy('special_price')
                                //   ->whereBetween('special_price',[$this->min_price,$this->max_price])
                                  ->where('qty','>',0)
                                  ->paginate($this->pagesize);
          }elseif($this->sorting=='newoffer_from_high_to_low'){
              $data['products'] = Product::where('status',1)->where('stock',1)
                                ->where('special_price','>',0)
                                ->orderByDesc('special_price')
                                //   ->whereBetween('special_price',[$this->min_price,$this->max_price])
                                ->where('qty','>',0)
                                ->paginate($this->pagesize);
          }else{
              $data['products'] = Product::where('status',1)->where('stock',1)
                                  ->orderBy('created_at')
                                  ->paginate($this->pagesize);
          }

        // $data['products'] = Product::orderByDesc('created_at')->get();
          if(Auth::guard('vendor')->check()){
            Cart::instance('cart')->store(Auth::guard('vendor')->user()->email);
            Cart::instance('wishlist')->store(Auth::guard('vendor')->user()->email);
          }
          $data['home_category']=Category::whereNotNull('parent_id')->inRandomOrder()->get();

        return view('livewire.front.shop',$data)
        ->layout('front.layouts.master2');
    }

}
