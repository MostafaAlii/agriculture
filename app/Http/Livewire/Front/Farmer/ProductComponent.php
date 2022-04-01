<?php

namespace App\Http\Livewire\Front\Farmer;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
class ProductComponent extends Component
{
    use WithPagination;
    public function render()
    {
        // $products = Product::paginate(5);
        $products = Product::where( 'farmer_id',auth()->user()->id)->paginate(5);
        return view('livewire.front.farmer.product',compact('products'))
        ->layout('front.layouts.master2');
    }
}
