<?php
namespace  App\Http\Repositories\Admin;
use App\Models\Farmer;
use App\Http\Interfaces\Admin\FarmerInterface;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use App\Traits\UploadT;
use Illuminate\Support\Facades\Notification;
class FarmerRepository implements FarmerInterface{
    use UploadT;
    public function index() {
        return view('dashboard.admin.farmers.index');
    }

    public function data() {
        $farmers = Farmer::select();

        return DataTables::of($farmers)
            ->addColumn('record_select', 'dashboard.admin.farmers.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Farmer $farmer) {
                return $farmer->created_at->format('Y-m-d');
            })
            ->addColumn('image', function (Farmer $farmer) {
                return view('dashboard.admin.farmers.data_table.image', compact('farmer'));
            })
            ->addColumn('country', function (Farmer $farmer) {
                return $farmer->country->name != null ? $farmer->country->name:null;
            })
            ->addColumn('productcount', function (Farmer $farmer) {

                return view('dashboard.admin.farmers.data_table.related', compact('farmer'));
            })
            ->addColumn('actions', 'dashboard.admin.farmers.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function create() {
        return view('dashboard.admin.farmers.create');
    }

    public function store($request) {
        try{
            DB::beginTransaction();
            $requestData = $request->validated();
            $requestData['password'] = bcrypt($request->password);
            Farmer::create($requestData);
            $farmer = Farmer::latest()->first();
            $this->addImage($request, 'image' , 'farmers' , 'upload_image',$farmer->id, 'App\Models\Farmer');

            Notification::send($farmer, new \App\Notifications\NewFarmer($farmer));
            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('farmers.index');
         } catch (\Exception $e) {
            DB::rollBack();
//            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
//            return redirect()->back();
         }
    }

    public function edit($id) {
        $farmerID = Crypt::decrypt($id);
        $farmer=Farmer::findorfail($farmerID);
        // return view('dashboard.admin.farmers.edit', compact('farmer'));
        return view('dashboard.admin.farmers.profile.profiledit', compact('farmer'));
    }

    public function update($request,$id) {
        try{
            DB::beginTransaction();
            $farmerID = Crypt::decrypt($id);
            $farmer=Farmer::findorfail($farmerID);
            $requestData = $request->validated();
            $farmer->update($requestData);
            if($request->image){
                $this->deleteImage('upload_image','/farmers/' . $farmer->image->filename,$farmer->id);
            }
            $this->addImage($request, 'image' , 'farmers' , 'upload_image',$farmer->id, 'App\Models\Farmer');
            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('farmers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }

    public function destroy($id) {
        try{
            $farmerID = Crypt::decrypt($id);
            $farmer=Farmer::findorfail($farmerID);
            $this->deleteImage('upload_image','/farmers/' . $farmer->image->filename,$farmer->id);
            $farmer->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('farmers.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }

    public function bulkDelete($request) {
        if($request->delete_select_id){
            // dd($request->delete_select_id);
            $delete_select_id = explode(",",$request->delete_select_id);
            foreach($delete_select_id as $farmers_ids){
            $farmer = Farmer::findorfail($farmers_ids);
            if($farmer->image){
                $this->deleteImage('upload_image','/farmers/' . $farmer->image->filename,$farmer->id);
            }
            }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('farmers.index');
        }
        Farmer::destroy( $delete_select_id );
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('farmers.index');

    }// end of bulkDelete
    public function showProfile($id){
        $farmerID = Crypt::decrypt($id);
        $farmer=Farmer::findorfail($farmerID);
        return view('dashboard.admin.farmers.profile.profileview', compact('farmer'));
    }

    public function updateAccount($request,$id) {
        try{
            DB::beginTransaction();
            $farmerID = Crypt::decrypt($id);
            $farmer=Farmer::findorfail($farmerID);
            $requestData = $request->validated();
            $farmer->update($requestData);
            if($request->image){
                $this->deleteImage('upload_image','/farmers/' . $farmer->image->filename,$farmer->id);
            }
            $this->addImage($request, 'image' , 'farmers' , 'upload_image',$farmer->id, 'App\Models\Farmer');
            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('farmers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }// end of update
    public function updateInformation($request,$id) {
        try{
            $farmerID = Crypt::decrypt($id);
            $farmer=Farmer::findorfail($farmerID);
            $requestData = $request->validated();
            $farmer->update($requestData);
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('farmers.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }

    }// end of update


    public function getProduct($id){
        $farmerID = Crypt::decrypt($id);
        $farmer = Farmer::findorfail( $farmerID);
        $far = $farmer->products()->paginate(8);
         return view('dashboard.admin.farmers.farmer_product',compact('farmer','far'));
    }
    public function getProductDetails($id){
        // return 'helloooooooooo';
        $productID = Crypt::decrypt($id);
        $product   = Product::findorfail( $productID);
         return view('dashboard.admin.farmers.farmer_product_details',compact('product'));
    }

}
