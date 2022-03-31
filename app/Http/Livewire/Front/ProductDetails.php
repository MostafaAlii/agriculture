<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product_id;
    public function mount($product_id){
        $this->product_id = $product_id;
    }
    public function render()
    {
        $product = Product::findorfail($this->product_id);
        return view('livewire.front.product-details',compact('product'))
                   ->layout('front.layouts.master2');
    }
}
