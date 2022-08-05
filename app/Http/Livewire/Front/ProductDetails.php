<?php

namespace App\Http\Livewire\Front;

use auth;
use Cart;
use App\Models\Tag;
use App\Models\Option;
use App\Models\Rating;
use App\Models\Product;
use Livewire\Component;
use App\Models\Attribute;
use Illuminate\Support\Facades\Crypt;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Securities\Rates;

class ProductDetails extends Component
{
    public $product_id;
    public $qty=1;
    public $qtymax;
    public function mount($product_id){
        $this->product_id = Crypt::decrypt($product_id);
        $this->qtymax = Product::find($this->product_id)->qty;
    }
    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,$this->qty,$product_price)->associate('App\Models\Product');
        session()->flash('success_message',__('Website/home.item_added_to_cart'));
        return redirect()->route('product.cart');
    }
    public function increaseQty(){
        $this->qty++;
    }
    public function decreaseQty(){
        if($this->qty > 1){
            $this->qty--;
        }
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
        // $tags=Tag::get();
        $data['product'] = Product::findorfail($this->product_id);
        $data['newProducts'] = Product::where('status',1)->where('stock',1)->where('qty','>',0)->latest()->limit(3)->get();
        $data['popProducts'] = Product::where('status',1)->where('stock',1)->where('qty','>',0)->inRandomOrder()->get()->take(3);

        // $data['options0']=$data['product']->options()->pluck('id');
        // $data['options1']=Option::whereIn('id',$data['options0'])->get();

        //retreive product comments
        $data['comments'] = $data['product']->comments()->whereNull('parent_id')->orderby('id','desc')->simplePaginate(5);

        $data['avg']=$data['product']->ProductRate();

        return view('livewire.front.product-details',$data)->layout('front.layouts.master2');
    }
}
