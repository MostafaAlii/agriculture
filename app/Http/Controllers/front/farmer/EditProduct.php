<?php

namespace App\Http\Controllers\front\farmer;

use App\Models\Tag;
use App\Models\Unit;
use App\Models\Image;
use App\Models\Farmer;
use App\Models\Product;
use App\Traits\UploadT;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Dashboard\Product\GeneralRequest;
use App\Http\Requests\Dashboard\Product\farmerProductRequest;

class EditProduct extends Controller
{
    use UploadT;
    public function edit($product_id)
    {
        // dd('hello');
        // return 'hello';
        $real_id= Crypt::decrypt($product_id);
        $data = [];
        $data['product']        =       Product::findOrfail($real_id);
        $data['farmers']        =       Farmer::select('id', 'firstname', 'lastname')->get();
        $data['tags']           =       Tag::select('id')->without('created_at', 'updated_at')->get();
        $data['categories']     =       Category::select('id')->without('created_at', 'updated_at')->get();
        $data['units']          =       Unit::productVisability()->select('id')->get();
       return view('front.farmer.editproduct',$data);
    }

    public function update(farmerProductRequest $request) {
        // dd('hello');
        // return 'hello';
       // return $request;
        DB::beginTransaction();
            try{
                $product = Product::findOrfail($request->id);
                $product->name = $request->name;
                $product->farmer_id      = Auth::guard('web')->user()->id;
                $product->is_qty         = 1;
                $product->qty            = $request->qty;
                $product->description = $request->description;
                $product->save();
                // $product->slug=str_replace(' ', '_',$request->name);
                $product->categories()->sync($request->categories);
                $product->tags()->sync($request->tags);
                $product->units()->syncWithPivotValues([$request->unit_id],['price'=>$request->price]);
                if($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = 'product-'.time().Str::slug($request->input('name'));
                $filename = $name .'.'.$image->getClientOriginalName();
                $product->updateImage($image->storeAs('products', $filename, 'public'));
            }
                DB::commit();
                session()->flash('Edit',__('Admin/products.product_updated_successfully'));
                return redirect()->route('farmer.product');
            } catch(\Exception $ex){
                DB::rollBack();
                // session()->flash('error',__('Admin/site.sorry'));
                // return redirect()->back();
                return $ex->getMessage();
            }
    }
}