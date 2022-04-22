<?php

namespace App\Http\Controllers\front\farmer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\farmerProductRequest;
use App\Http\Requests\Dashboard\Product\GeneralRequest;
use App\Models\Category;
use App\Models\Farmer;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Traits\UploadT;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class EditProduct extends Controller
{
    use UploadT;
    public function edit($product_id)
    {
        $real_id= Crypt::decrypt($product_id);
        $data = [];
        $data['product']        =       Product::findOrfail($real_id);
        $data['farmers']        =       Farmer::select('id', 'firstname', 'lastname')->get();
        $data['tags']           =       Tag::select('id')->without('created_at', 'updated_at')->get();
        $data['categories']     =       Category::select('id')->without('created_at', 'updated_at')->get();
       return view('front.farmer.editproduct',$data);
    }

    public function update(farmerProductRequest $request) {
        // return 'hello';
        DB::beginTransaction();
            try{
                // if (!$request->has('status'))
                //     $request->request->add(['status' => 0]);
                // else
                //     $request->request->add(['status' => 1]);

                $product = Product::findOrfail($request->id);
                $product->farmer_id     = Auth::user()->id;
                $product->price         = $request->price;
                $product->qty           = $request->qty;
                // $product->status        = $request->status;
                // $product->product_location = $request->product_location;
                $product->save();
                // Save Translation ::
                $product->name = $request->name;
                $product->slug=str_replace(' ', '_',$request->name);
                $product->description = $request->description;
                $product->save();
                // sync Categories ::
                $product->categories()->sync($request->categories);
                $product->tags()->sync($request->tags);
                // Save Product Main Photo ::
                if($request->photo){
                    $this->deleteImage('upload_image','/products/' . $product->image->filename,$product->id);
                }
                $this->addImageProduct($request, 'photo' , 'products' , 'upload_image',$product->id, 'App\Models\Product');


                DB::commit();
                session()->flash('Edit',__('Admin/products.product_updated_successfully'));
                return redirect()->route('farmer.product');
            } catch(\Exception $ex){
                DB::rollBack();
                session()->flash('error',__('Admin/site.sorry'));
                return redirect()->back();
            }
    }
}
