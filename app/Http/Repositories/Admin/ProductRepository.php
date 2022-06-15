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

    public function data() {
        $products = Product::productWithOutTrashed();
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
             /*->addColumn('price', function (Product $product) {
                return view('dashboard.admin.products.data_table.price_formated', compact('product'));
            })*/
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

    public function generalInformation() {
        $data = [];
        $data['farmers']        =       Farmer::select('id', 'firstname', 'lastname')->get();
        $data['tags']           =       Tag::select('id')->without('created_at', 'updated_at')->get();
        $data['categories']    =       Category::select('id')->without('created_at', 'updated_at')->get();
        $data['units']        =       Unit::select('id')->get();
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
                    'stock'            => Product::IN_STOCK,
                ]);
                $product->save();
                //$price = $request->input('price');
                // Save Translation ::
                $product->name = $request->name;
                $product->description = $request->description;
                $product->save();
                // Attach Category ::
                $product->categories()->sync($request->categories);
                // Attach Tag ::
                $product->tags()->sync($request->tags);
                // Attach Unit ::
                $product->units()->sync($request->units);
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

}
