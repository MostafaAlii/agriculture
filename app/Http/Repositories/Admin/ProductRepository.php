<?php
namespace App\Http\Repositories\Admin;
use App\Models\Product;
use App\Models\Country;
use App\Models\Farmer;
use App\Models\Province;
use App\Models\Area;
use App\Models\State;
use App\Models\Village;
use App\Http\Interfaces\Admin\ProductInterface;
use App\Models\Department;
use App\Models\Tag;
use Yajra\DataTables\DataTables;
use App\Traits\UploadT;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class ProductRepository implements ProductInterface {

    use UploadT;

    public function index() {
        return view('dashboard.admin.products.index');
    }

    public function data() {
        //get all Products data
        $products = Product::withoutTrashed()->orderBy('id','DESC')->get();

        //use datatables (yajra) to handel this data
        return DataTables::of($products)
            ->addColumn('record_select',function (Product $products) {
                return view('dashboard.admin.products.data_table.record_select', compact('products'));
            })
            ->addColumn('farmer_name', function (Product $products) {
                return $products->farmer->firstname.' '.$products->farmer->lastname;
            })
            ->addColumn('depart_name', function (Product $products) {
                $all= $products->departments->whereNull('parent_id');
                $x='';
                foreach($all as $a){
                    $x.=$a->name.' ';
                }
                return $x;
            })
            ->addColumn('category_name', function (Product $products) {
                $all= $products->departments->whereNotNull('parent_id');
                $x='';
                foreach($all as $a){
                    $x.=$a->name.' ';
                }
                return $x;
            })
            ->editColumn('created_at', function (Product $products) {
                return $products->created_at->diffforhumans();
            })
            ->addColumn('image', function (Product $products) {
                return view('dashboard.admin.products.data_table.image', compact('products'));
            })
            ->addColumn('actions',function (Product $products) {
                return view('dashboard.admin.products.data_table.actions', compact('products'));
            })
            ->rawColumns(['record_select','actions'])
            ->toJson();
    }

    
    public function generalInformation($request) {
        $method = $request->method();
        if($request->isMethod('POST')){
            DB::beginTransaction();
            try{
                if (!$request->has('status'))
                    $request->request->add(['status' => 0]);
                else
                    $request->request->add(['status' => 1]);
                
                $product = Product::create([
                    'farmer_id' => $request->farmer_id,
                    'country_id' => $request->country_id,
                    'province_id' => $request->province_id,
                    'area_id' => $request->area_id,
                    'state_id' => $request->state_id,
                    'village_id' => $request->village_id,
                    'price' => $request->price,
                    'status' => $request->status,
                ]);
                $product->save();
                // Save Translation ::
                $product->name = $request->name;
                $product->description = $request->description;
                $product->save();
                // Attach Department ::
                $product->departments()->attach($request->departments);
                $product->tags()->attach($request->tags);
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
        
        if($request->isMethod('GET')) {
            $data = [];
            $data['farmers']        =       Farmer::select('id', 'firstname', 'lastname')->get();
            $data['countries']      =       Country::select('id')->without('created_at', 'updated_at')->get();
            $data['provinces']      =       Province::select('id')->without('created_at', 'updated_at')->get();
            $data['areas']          =       Area::select('id')->without('created_at', 'updated_at')->get();
            $data['states']         =       State::select('id')->without('created_at', 'updated_at')->get();
            $data['villages']       =       Village::select('id')->without('created_at', 'updated_at')->get();
            $data['tags']           =       Tag::select('id')->without('created_at', 'updated_at')->get();
            $data['departments']    =       Department::select('id')->without('created_at', 'updated_at')->get();
            
            return view('dashboard.admin.products.generalInformation.create', $data);
        }
    }


    public function edit($id)
    {
        //dd($id);
         $real_id= decrypt($id); 
        
            $data = [];
            $data['product']        =       Product::findOrfail($real_id);
            $data['farmers']        =       Farmer::select('id', 'firstname', 'lastname')->get();
            $data['countries']      =       Country::select('id')->without('created_at', 'updated_at')->get();
            $data['provinces']      =       Province::select('id')->without('created_at', 'updated_at')->get();
            $data['areas']          =       Area::select('id')->without('created_at', 'updated_at')->get();
            $data['states']         =       State::select('id')->without('created_at', 'updated_at')->get();
            $data['villages']       =       Village::select('id')->without('created_at', 'updated_at')->get();
            $data['tags']           =       Tag::select('id')->without('created_at', 'updated_at')->get();
            $data['departments']    =       Department::select('id')->without('created_at', 'updated_at')->get();
 
        return view('dashboard.admin.products.edit', $data);
       
    }


    public function update($request) {
        DB::beginTransaction();
            try{
                if (!$request->has('status'))
                    $request->request->add(['status' => 0]);
                else
                    $request->request->add(['status' => 1]);
                
                $product = Product::findOrfail($request->id);
                  
                    $product->farmer_id     = $request->farmer_id;
                    $product->country_id    = $request->country_id;
                    $product->province_id   = $request->province_id;
                    $product->area_id       = $request->area_id;
                    $product->state_id      = $request->state_id;
                    $product->village_id    = $request->village_id;
                    $product->price         = $request->price;
                    $product->status    = $request->status;
                
                $product->save();
                
                // Save Translation ::
                $product->name = $request->name;
                $product->description = $request->description;
                $product->save();
                
                // sync Department ::
                $product->departments()->sync($request->departments);
                $product->tags()->sync($request->tags);
                
                // Save Product Main Photo ::
                $this->verifyAndStoreImage($request, 'photo', 'products', 'upload_image', $product->id, 'App\Models\Product');

                DB::commit();

                toastr()->success(__('Admin/products.product_updated_successfully'));
                return redirect()->route('products');   

            } catch(\Exception $ex){

                DB::rollBack();

                return redirect()->back()->withErrors(['error' => $ex->getMessage()]);

                toastr()->error(__('Admin/general.wrong'));
                return redirect()->route('products');
            }
    }
    
    public function destroy($id) {
        
        try{
            $real_id = decrypt($id);
           
            Product::where('id',$real_id)->delete(); //soft_delete

            toastr()->error(__('Admin/products.delete_done'));
            return redirect()->route('products');
           
        } catch (\Exception $e) {
           // return redirect()->back()->withErrors(['error' => $e->getMessage()]);
           toastr()->error(__('Admin/products.delete_not_allowed'));
           return redirect()->route('products');
        }
    }
    
    public function bulkDelete($request)
    {
        try{
            if($request->delete_select_id){
                $all_ids = explode(',',$request->delete_select_id);
                Product::whereIn('id',$all_ids)->delete(); //soft_delete
                
                
                toastr()->error(__('Admin/products.delete_done'));
                return redirect()->route('products');
            
            }else{
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('products');
            }
        }catch (\Exception $e) {
            //return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            toastr()->error(__('Admin/products.delete_not_allowed'));
            return redirect()->route('products');
        }
    }// end of bulkDelete
}