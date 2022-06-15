<?php
namespace App\Http\Repositories\Admin;
use App\Models\{Tag, Farmer, Product, Category, Unit};
use Illuminate\Support\Facades\{DB, Crypt};
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Traits\UploadT;
use App\Http\Interfaces\Admin\ProductInterface;
class ProductRepository implements ProductInterface {
    use UploadT;
    public function index() {
        return view('dashboard.admin.products.index');
    }

    public function create() {
    $product = Product::create(['name'=>'']);
		if (!empty($product)) {
            return redirect()->route('Products.edit', encrypt($product->id));
		}
    }

    public function edit($id) {
        $real_id= Crypt::decrypt($id);
        $data = [];
        $data['product']        =       Product::findOrfail($real_id);
        $data['farmers']        =       Farmer::select('id', 'firstname', 'lastname')->get();
        $data['tags']           =       Tag::select('id')->get();
        $data['categories']    =       Category::select('id')->get();
        $data['units']    =       Unit::select('id')->get();
        return view('dashboard.admin.products.create', $data);
    }

    public function update($request, $id) {
        DB::beginTransaction();
        try{
            $real_id= Crypt::decrypt($id);
            $product = Product::findOrfail($real_id);
            $product->farmer_id     = $request->farmer_id;
            //$product->price = $request->price;
            //dd($price);
            $product->special_price = $request->special_price;
            $product->special_price_start = $request->special_price_start;
            $product->special_price_end = $request->special_price_end;
            //$product->status = $request->status;
            $product->qty = $request->qty;
            $product->save();
            // Save Translation ::
            $product->name = $request->name;
            $product->description = $request->description;
            //$product->reason = $request->reason;
            $product->save();
            // sync Categories ::
            $product->categories()->sync($request->categories);
            // Sync Tags ::
            $product->tags()->sync($request->tags);
            // Sync Units ::
            //$product->units()->sync($request->units);
            /*$units = collect($request->input('units',[]))
                ->map(function($unit) {
                    return ['price'=>$unit];
                });*/
            $product->units()->sync([$request->units]);
            // Save Product Main Photo ::
            $this->verifyAndStoreImage($request, 'photo', 'products', 'upload_image',$product->id, 'App\Models\Product');
            DB::commit();
            //toastr()->success(__('Admin/products.product_updated_successfully'));
        } catch(\Exception $ex){
            DB::rollBack();
            //toastr()->error(__('Admin/general.wrong'));
        }
    }
}
