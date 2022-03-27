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
}