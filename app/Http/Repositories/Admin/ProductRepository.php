<?php
namespace App\Http\Repositories\Admin;
use App\Traits\UploadT;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\{DB, Crypt};
use App\Http\Interfaces\Admin\ProductInterface;
use App\Models\{Tag, Farmer, Product, Category, Unit};
class ProductRepository implements ProductInterface {
    use UploadT;
    public function index() {
        return view('dashboard.admin.products.index');
    }

    public function data() {
        $products = Product::orderByDesc('created_at')->productWithOutTrashed();
        //use datatables (yajra) to handel this data
        return DataTables::of($products)
            ->addColumn('record_select',function (Product $products) {
                return view('dashboard.admin.products.data_table.record_select', compact('products'));
            })
            ->addColumn('farmer_name', function (Product $product) {
                return $product->farmer->firstname.' '.$product->farmer->lastname;
            })
            ->editColumn('status', function (Product $product) {
                return view('dashboard.admin.products.data_table.status', compact('product'));
            })
             ->addColumn('category_name', function (Product $product) {
                return view('dashboard.admin.products.data_table.related_category', compact('product'));
             })
            ->addColumn('price', function (Product $product) {
                return view('dashboard.admin.products.data_table.price_formated', compact('product'));
            })
            ->editColumn('created_at', function (Product $product) {
                return $product->created_at->diffforhumans();
            })
            ->addColumn('image', function (Product $product) {
                return view('dashboard.admin.products.data_table.image', compact('product'));
            })
            ->addColumn('actions',function (Product $product) {
                return view('dashboard.admin.products.data_table.actions', compact('product'));
            })
            ->rawColumns(['record_select','actions'])
            ->toJson();
    }

    public function trashed_data() {
        $products = Product::productTrashed();
        //use datatables (yajra) to handel this data
        return DataTables::of($products)
            ->addColumn('record_select',function (Product $products) {
                return view('dashboard.admin.products.data_table.record_select', compact('products'));
            })
            ->addColumn('farmer_name', function (Product $product) {
                return $product->farmer->firstname.' '.$product->farmer->lastname;
            })
            ->editColumn('status', function (Product $product) {
                return view('dashboard.admin.products.data_table.status', compact('product'));
            })
             ->addColumn('category_name', function (Product $product) {
                return view('dashboard.admin.products.data_table.related_category', compact('product'));
             })
             ->addColumn('price', function (Product $product) {
                return view('dashboard.admin.products.data_table.price_formated', compact('product'));
            })
            ->addColumn('image', function (Product $product) {
                return view('dashboard.admin.products.data_table.image', compact('product'));
            })
            ->addColumn('actions',function (Product $product) {
                return view('dashboard.admin.products.data_table.trashed_actions', compact('product'));
            })
            ->rawColumns(['record_select','actions'])
            ->toJson();
    }
    public function generalInformation() {
        $data = [];
        $data['farmers']        =       Farmer::select('id', 'firstname', 'lastname')->get();
        $data['tags']           =       Tag::select('id')->without('created_at', 'updated_at')->get();
        $data['categories']    =       Category::select('id')->without('created_at', 'updated_at')->get();
        $data['units']        =       Unit::productVisability()->select('id')->get();
        return view('dashboard.admin.products.generalInformation.create', $data);
    }

    public function generalInformationStore($request) {
        //dd($request->all());
        DB::beginTransaction();
            //return $request;
            try{
                if (!$request->has('status'))
                    $request->request->add(['status' => 0]);
                else
                    $request->request->add(['status' => 1]);

                $product = Product::create([
                    'farmer_id' => $request->farmer_id,
                    'status' => $request->status,
                    'product_location' => $request->product_location,
                    'sku'            =>  'PRO-' . Str::random(8),
                ]);
                $product->save();
                // Save Translation ::
                $product->name = $request->name;
                $product->description = $request->description;
                $product->save();
                // Attach Category ::
                $product->categories()->attach($request->categories);
                // Attach Tag ::
                $product->tags()->attach($request->tags);
                // Attach Unit ::
                $product->units()->syncWithPivotValues([$request->units],['price'=>$request->price]);
                // Save Product Main Photo ::
                $this->verifyAndStoreImage($request, 'photo', 'products', 'upload_image', $product->id, 'App\Models\Product');
                DB::commit();
                toastr()->success(__('Admin/products.product_store_successfully'));
                return redirect()->route('products');
            } catch(\Exception $ex){
                DB::rollBack();
                toastr()->error(__('Admin/general.wrong'));
                return redirect()->route('products');
            }
    }

    public function additionalPriceStore($request) {

        try {
            $productPrice  = productPrice($request->product_id,$request->special_price);
            if ($productPrice) {
                Product::findorfail($request->product_id)->update($request->only([
                    'special_price_type', 'special_price', 'special_price_start', 'special_price_end'
                ]));
                toastr()->success(__('Admin/products.product_add_special_price_successfully'));
                return redirect()->route('products');
            }else{
                toastr()->error(__('Admin/products.special_price_must_be_less_than_main_price'));
                return redirect()->route('products');
            }
        } catch(\Exception $ex){
            toastr()->error(__('Admin/general.wrong'));
            return redirect()->route('products');
        }
    }

    public function edit($id) {
        $real_id= Crypt::decrypt($id);
        $data = [];
        $data['product']        =       Product::findOrfail($real_id);
        $data['farmers']        =       Farmer::select('id', 'firstname', 'lastname')->get();
        $data['tags']           =       Tag::select('id')->without('created_at', 'updated_at')->get();
        $data['categories']     =       Category::select('id')->without('created_at', 'updated_at')->get();
        $data['units']          =       Unit::productVisability()->select('id')->get();
        return view('dashboard.admin.products.edit', $data);
    }

    public function update($request) {
        //dd($request->all());
        DB::beginTransaction();
            try{
                $product = Product::findOrfail($request->id);
                $product->farmer_id     = $request->farmer_id;
                $product->save();
                // Save Translation ::
                $product->name = $request->name;
                $product->description = $request->description;
                $product->save();
                // sync Categories ::
                $product->categories()->sync($request->categories);
                $product->tags()->sync($request->tags);
                $product->units()->syncWithPivotValues([$request->units],['price'=>$request->price]);
                // Save Product Main Photo ::
                if ($request->photo) {
                    $this->deleteImage('upload_image', '/products/' . $product->photo, $product->id);
                }
                $this->verifyAndStoreImage($request, 'photo', 'products', 'upload_image', $product->id, 'App\Models\Product');
                DB::commit();
                toastr()->success(__('Admin/products.product_updated_successfully'));
                return redirect()->route('products');
            } catch(\Exception $ex){
                DB::rollBack();
                toastr()->error(__('Admin/general.wrong'));
                return redirect()->route('products');
            }
    }

    public function additionalStockStore($request) {
        //return $request;
        try {
            $real_id= $request->product_id;
            Product::whereId($real_id)->update($request->only([
                'stock', 'qty'
            ]));
            toastr()->success(__('Admin/products.product_update_product_stock_qty_successfully'));
            return redirect()->route('products');
        } catch(\Exception $ex){
            toastr()->error(__('Admin/general.wrong'));
            return redirect()->route('products');
        }
    }

    public function restore() {
        return view('dashboard.admin.products.restore');
    }

    public function changeStatus($request) {
        //return $request;
        try {
            $real_id= $request->product_id;
            Product::whereId($real_id)->update($request->only(['status']));
            toastr()->success(__('Admin/products.product_update_product_status_successfully'));
            return redirect()->route('products');
        } catch(\Exception $ex){
            toastr()->error(__('Admin/general.wrong'));
            return redirect()->route('products');
        }
    }

    public function updateRestore($request, $id) {
        try {
            $real_id= Crypt::decrypt($request->id);
            Product::withTrashed()->whereId($real_id)->restore();
            toastr()->success(__('Admin/products.product_restore_successfully'));
            return redirect()->route('products');
        } catch(\Exception $ex){
            toastr()->error(__('Admin/general.wrong'));
            return redirect()->route('products.trashed');
        }
    }

    public function destroy($id) {
        try{
            $real_id= Crypt::decrypt($id);
            Product::where('id',$real_id)->delete(); //soft_delete
            toastr()->error(__('Admin/products.delete_done'));
            return redirect()->route('products');
        } catch (\Exception $e) {
           toastr()->error(__('Admin/products.delete_not_allowed'));
           return redirect()->route('products');
        }
    }

    public function forceDestroy($id) {
        try{
            $real_id= Crypt::decrypt($id);
            Product::where('id',$real_id)->forceDelete(); //force_delete
            toastr()->error(__('Admin/products.delete_done'));
            return redirect()->route('products.trashed');
        } catch (\Exception $e) {
           toastr()->error(__('Admin/products.delete_not_allowed'));
           return redirect()->route('products.trashed');
        }
    }

    public function bulkDelete($request){
        try{
            if($request->delete_select_id){
                $all_ids = explode(',',$request->delete_select_id);
                Product::whereIn('id',$all_ids)->forceDelete(); //soft_delete
                toastr()->error(__('Admin/products.delete_done'));
                return redirect()->route('products');
            }else{
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('products');
            }
        }catch (\Exception $e) {
            toastr()->error(__('Admin/products.delete_not_allowed'));
            return redirect()->route('products');
        }
    }
}
