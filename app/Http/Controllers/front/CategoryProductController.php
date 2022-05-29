<?php

namespace App\Http\Controllers\front;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryProductController extends Controller
{
    public function showCategoryProduct($cat_id)
    {
        $real_id=decrypt($cat_id);
        $cat=Category::find($real_id);
        $new=array();
        foreach ($cat->products as $products) {
            array_push($new,$products->pivot->product_id);
        }
   
        $data['products']= Product::whereIn('id',$new)->paginate(12);
           //dd($data['products']); 
       return view('livewire.front.category_products',$data);
    }
}