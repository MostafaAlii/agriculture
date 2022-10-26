<?php
namespace  App\Http\Repositories\Admin;
use App\Traits\HasImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\NewFarmer;
use Yajra\DataTables\DataTables;
use App\Models\{Farmer, Admin, Product};
use App\Http\Interfaces\Admin\FarmerInterface;
use Illuminate\Support\Facades\{DB, Notification, Auth, Crypt};

class FarmerRepository implements FarmerInterface{
    use HasImage;
    public function index() {
        return view('dashboard.admin.farmers.index');
    }
    public function farmerFront() {
        return view('dashboard.admin.farmers.farmer_front');
    }

    public function data() {
        $adminID = Auth::guard('admin')->user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == 'employee') {
            $farmers = Farmer::orderByDesc('created_at')
                ->where('state_id', $admin->state_id)
                ->where('department_id','!=' ,null)
                ->get();
        }
        elseif($admin->type == 'admin_area'){

            $farmers = Farmer::orderByDesc('created_at')
                ->where('area_id', $admin->area_id)
                ->where('department_id','!=' ,null)
                ->get();

        }
        else {
            $farmers = Farmer::orderByDesc('created_at')->where('department_id','!=' ,null)->get();

        }

        return DataTables::of($farmers)
            ->addColumn('record_select', 'dashboard.admin.farmers.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Farmer $farmer) {
                return $farmer->created_at->format('Y-m-d');
            })
            ->addColumn('image', function (Farmer $farmer) {
                return view('dashboard.admin.farmers.data_table.image', compact('farmer'));
            })
            ->addColumn('state', function (Farmer $farmer) {
                return $farmer->state->name ?? null;
            })
            ->addColumn('area', function (Farmer $farmer) {
                return $farmer->area->name ?? null;
            })
            ->addColumn('village', function (Farmer $farmer) {
                return $farmer->village->name ?? null;
            })
            ->addColumn('productcount', function (Farmer $farmer) {

                return view('dashboard.admin.farmers.data_table.related', compact('farmer'));
            })
            ->addColumn('actions', 'dashboard.admin.farmers.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }
    public function datafront() {
        $farmers = Farmer::with('image')->orderByDesc('created_at')->where('department_id', null)->get();
        return DataTables::of($farmers)
            ->addColumn('record_select', 'dashboard.admin.farmers.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Farmer $farmer) {
                return $farmer->created_at->format('Y-m-d');
            })
            ->addColumn('image', function (Farmer $farmer) {
                return view('dashboard.admin.farmers.data_table.image', compact('farmer'));
            })
            ->addColumn('state', function (Farmer $farmer) {
                return $farmer->state->name ?? null;
            })
            ->addColumn('area', function (Farmer $farmer) {
                return $farmer->area->name ?? null;
            })
            ->addColumn('village', function (Farmer $farmer) {
                return $farmer->village->name ?? null;
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
            if($request->hasFile('image')) {
                    $image = $request->file('image');
                    $name = 'farmer-'.time().Str::slug($request->input('firstname') . '_' . $request->input('lastname'));
                    $filename = $name .'.'.$image->getClientOriginalName();
                    $farmer->storeImage($image->storeAs('farmers', $filename, 'public'));
                }
            //Notification::send($farmer, new NewFarmer($farmer));
            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('farmers.index');
         } catch (\Exception $e) {
            DB::rollBack();
           toastr()->error(__('Admin/site.sorry'));
           return redirect()->back();
         }
    }

    public function edit($id) {
        $farmerID = Crypt::decrypt($id);
        $farmer=Farmer::findorfail($farmerID);
        return view('dashboard.admin.farmers.profile.profiledit', compact('farmer'));
    }

    public function update($request,$id) {
        try{
            DB::beginTransaction();
            $farmerID = Crypt::decrypt($id);
            $farmer=Farmer::findorfail($farmerID);
            $requestData = $request->validated();
            $farmer->update($requestData);
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'farmer-'.time().Str::slug($request->input('firstname') . '_' . $request->input('lastname'));
                $filename = $name .'.'.$image->getClientOriginalName();
                $farmer->updateImage($image->storeAs('farmers', $filename, 'public'));
            }
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
            $farmer->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('farmers.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.cant_delete'));
            return redirect()->back();
        }
    }

    public function bulkDelete($request) {
        try{
                if($request->delete_select_id){
                    $delete_select_id = explode(",",$request->delete_select_id);
                    foreach($delete_select_id as $farmers_ids){
                    $farmer = Farmer::findorfail($farmers_ids);
                    if($farmer->image && $farmer->image->filename != 'default_farmer.jpg'){
                        $old_photo = $farmer->image->filename;
                        $farmer->deleteImage();
                    }
                    }
                }else{
                    toastr()->error(__('Admin/site.no_data_found'));
                    return redirect()->route('farmers.index');
                }
                Farmer::destroy( $delete_select_id );
                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('farmers.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.cant_delete_all'));
            return redirect()->back();
            // return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }

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
            $farmerpassword = $farmer->password;
            $requestData = $request->validated();
            if($request->password){
                $requestData['password'] = bcrypt($request->password);
            }else{
                $requestData['password'] = $farmerpassword ;
            }
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'farmer-'.time().Str::slug($request->input('firstname') . '_' . $request->input('lastname'));
                $filename = $name .'.'.$image->getClientOriginalName();
                $farmer->updateImage($image->storeAs('farmers', $filename, 'public'));
            }

            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('farmers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
            //    return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
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