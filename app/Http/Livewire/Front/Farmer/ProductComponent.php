<?php

namespace App\Http\Livewire\Front\Farmer;

use App\Models\Image;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
class ProductComponent extends Component
{
    use WithPagination;
    public function delete($id){
        $product = Product::where('id',$id)->first();
        Product::destroy($id);
        session()->flash('Delete',__('Admin/products.delete_done'));
        return redirect()->route('farmer.product');
     }
     public function deleteImage($disk,$path,$id)
     {
         Storage::disk($disk)->delete($path);
         Image::where('imageable_id',$id)->delete();
     }
    public function render()
    {
        // $products = Product::paginate(5);
        $products = Product::where( 'farmer_id',auth()->user()->id)->orderByDesc('id')->paginate(5);
        return view('livewire.front.farmer.product',compact('products'))
        ->layout('front.layouts.master2');
    }
}