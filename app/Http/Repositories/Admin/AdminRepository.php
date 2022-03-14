<?php
namespace  App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\AdminInterface;
use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Traits\UploadT;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class AdminRepository implements AdminInterface{
    use UploadT;
    public function index() {
        return view('dashboard.admin.admins.index');
    }
    public function data() {
        $admins = Admin::get()->except(auth()->user()->id);
        // dd($admins->id);
        return DataTables::of($admins)
            ->addColumn('record_select', 'dashboard.admin.admins.data_table.record_select')
            ->editColumn('created_at', function (Admin $admin) {
                return $admin->created_at->format('Y-m-d');
            })
            ->addColumn('type', function (Admin $admin) {
                return view('dashboard.admin.admins.data_table.types', compact('admin'));
                // return "$admin->type";
            })
            ->addColumn('image', function (Admin $admin) {
                return view('dashboard.admin.admins.data_table.image', compact('admin'));
            })
            ->addColumn('actions', 'dashboard.admin.admins.data_table.actions')
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
            Admin::create($requestData);
            $admin = Admin::latest()->first();
            $this->addImage($request, 'image' , 'admins' , 'upload_image',$admin->id, 'App\Models\Admin');
            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Admins.index');
         } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }

    public function edit($id) {
        $adminID = Crypt::decrypt($id);
        $admin=Admin::findorfail($adminID);

        return view('dashboard.admin.admins.edit', compact('admin'));
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
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id) {
        try{
            $adminID = Crypt::decrypt($id);
            $admin=Admin::findorfail($adminID);
            $this->deleteImage('upload_image','/admins/' . $admin->image->filename,$admin->id);
            $admin->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('Admins.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function bulkDelete($request)
    {
        // dd($request->delete_select_id);
        $delete_select_id = explode(",",$request->delete_select_id);
        foreach($delete_select_id as $admins_ids){
           $admin = Admin::findorfail($admins_ids);
           if($admin->image){
            $this->deleteImage('upload_image','/admins/' . $admin->image->filename,$admin->id);
           }
        }
        Admin::destroy( $delete_select_id );
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('Admins.index');

    }// end of bulkDelete
}
