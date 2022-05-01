<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\AdminInterface;
use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Traits\UploadT;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
class AdminRepository implements AdminInterface{
    use UploadT;
    public function index() {
        return view('dashboard.admin.admins.index');
    }
    public function data() {
        $admins = Admin::get()->except(auth()->user()->id);

        return DataTables::of($admins)
            ->addColumn('record_select', 'dashboard.admin.admins.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Admin $admin) {
                return $admin->created_at->format('Y-m-d');
            })
            ->addColumn('type', function (Admin $admin) {
                return view('dashboard.admin.admins.data_table.types', compact('admin'));
            })
            ->addColumn('image', function (Admin $admin) {
                return view('dashboard.admin.admins.data_table.image', compact('admin'));
            })
             ->addColumn('country', function (Admin $admin) {
                return $admin->country->name??null;
                    // return $admin->country->name??null != null ? $admin->country->name:null;
                })
            ->addColumn('actions', 'dashboard.admin.admins.data_table.actions')
            // test for ralation in yagra
                // ->addColumn('example', function (Admin $admin) {
                //     return $admin->profile != null ? $admin->profile->address:null;
                // })
            // test for ralation in yagra
            ->rawColumns([ 'record_select','actions'])
            ->toJson();

    }

    public function create() {
        return view('dashboard.admin.admins.create');
    }
    public function store($request) {
        DB::beginTransaction();
        try{
            $requestData = $request->validated();
            $requestData['password'] = bcrypt($request->password);
            $requestData['type'] = $request->type;
//            $requestData['latitude']=$request->latitude;
//            $requestData['longitude']= $request->longitude;
            Admin::create($requestData);
            $admin = Admin::latest()->first();
            $this->addImage($request, 'image' , 'admins' , 'upload_image',$admin->id, 'App\Models\Admin');

            // $admin = Admin::latest()->first();
//         Notification::send($admin, new \App\Notifications\NewAdmin($admin));

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Admins.index');
         } catch (\Exception $e) {
            DB::rollBack();
//            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
//            return redirect()->back();
         }
    }

    public function edit($id) {
        $adminID = Crypt::decrypt($id);
        // dd($adminID);
        $admin=Admin::findorfail($adminID);

        // return view('dashboard.admin.admins.edit', compact('admin'));
        return view('dashboard.admin.admins.profile.profiledit', compact('admin'));
    }

    public function update( $request,$id) {
        try{
            DB::beginTransaction();
            $adminID = Crypt::decrypt($id);
            $admin=Admin::findorfail($adminID);
            $requestData = $request->validated();
            $requestData['type'] = $request->type;
            $admin->update($requestData);

            if($request->image){
                $this->deleteImage('upload_image','/admins/' . $admin->image->filename,$admin->id);
            }
            $this->addImage($request, 'image' , 'admins' , 'upload_image',$admin->id, 'App\Models\Admin');

            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('Admins.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }

    public function destroy($id) {
        try{
            $adminID = Crypt::decrypt($id);
            //  dd($adminID);
            $admin=Admin::findorfail($adminID);
            $this->deleteImage('upload_image','/admins/' . $admin->image->filename,$admin->id);
            $admin->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('Admins.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }
    public function bulkDelete($request) {
        if($request->delete_select_id){
            $delete_select_id = explode(",",$request->delete_select_id);
            foreach($delete_select_id as $admins_ids){
               $admin = Admin::findorfail($admins_ids);
               if($admin->image){
                $this->deleteImage('upload_image','/admins/' . $admin->image->filename,$admin->id);
               }
            }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('Admins.index');
        }
        Admin::destroy( $delete_select_id );
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('Admins.index');

    }// end of bulkDelete

    public function showProfile($id){
        $adminID = Crypt::decrypt($id);
        // dd($adminID);
        // dd($id);
        $admin=Admin::findorfail($adminID);

        return view('dashboard.admin.admins.profile.profileview', compact('admin'));
    }

    public function updateAccount($request,$id) {
        try{
            DB::beginTransaction();
            $adminID = Crypt::decrypt($id);
            $admin=Admin::findorfail($adminID);
            $requestData = $request->validated();
            // $requestData['type'] = $request->type;
            $admin->update($requestData);

            if($request->image){
                $this->deleteImage('upload_image','/admins/' . $admin->image->filename,$admin->id);
            }
            $this->addImage($request, 'image' , 'admins' , 'upload_image',$admin->id, 'App\Models\Admin');

            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('Admins.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }// end of update
    public function updateInformation($request,$id) {
        try{
            $adminID = Crypt::decrypt($id);
            $admin=Admin::findorfail($adminID);
            $requestData = $request->validated();
            $admin->update($requestData);
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('Admins.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }

    }// end of update
}
