<?php
namespace App\Http\Repositories\Admin;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Interfaces\Admin\RoleRepositoryInterface;
class RoleRepository implements RoleRepositoryInterface {
    public function index() {
        return view('dashboard.admin.roles.index');
    }

    public function data() {
        $roles = Role::get();
        return DataTables::of($roles)
            ->addColumn('record_select',function (Role $roles) {
                return view('dashboard.admin.roles.data_table.record_select', compact('roles'));
            })
            ->editColumn('created_at', function (Role $role) {
                return $role->created_at->diffforhumans();
            })
            ->addColumn('actions',function (Role $role) {
                return view('dashboard.admin.roles.data_table.actions', compact('role'));
            })
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function create() {
        $permission = Permission::get();
        return view('dashboard.admin.roles.create', compact('permission'));
    }

    public function store($request) {
        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions([$request->input('permission')]);
            DB::commit();
            toastr()->success(__('Admin/roles.add_roles_successfuly'));
            return redirect()->route('Roles.index');
        } catch(\Exception $ex) {
            DB::rollBack();
            toastr()->error(__('Admin/general.wrong'));
            return redirect()->route('Roles.index');
        }
    }

    public function edit($id) {
        $real_id = Crypt::decrypt($id);
        $role = Role::find($real_id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$real_id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('dashboard.admin.roles.edit',compact('role','permission','rolePermissions'));
    }

    public function update($request, $id) {
        $real_id = Crypt::decrypt($id);
        $role = Role::find($real_id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        toastr()->success( __('Admin/site.updated_successfully'));
        return view('dashboard.admin.roles.index');
    }

    public function show($id) {
        $real_id = Crypt::decrypt($id);
        $role=Role::findOrfail($real_id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$real_id)
            ->get();
        return view('dashboard.admin.roles.show',compact('role','rolePermissions'));
    }

    public function destroy($id) {
        try{
            $real_id = decrypt($id);
            DB::table("roles")->whereId($real_id)->delete();
            toastr()->error(__('Admin/attributes.delete_done'));
            return redirect()->route('Roles.index');
        } catch (\Exception $e) {
            toastr()->success(__('Admin/attributes.delete_wrong'));
            return redirect()->route('Roles.index');
        }
    }

    public function bulkDelete($request) {
        if($request->delete_select_id){
            $delete_select_id = explode(",",$request->delete_select_id);
            foreach($delete_select_id as $datas_ids){
               $admin = Role::findorfail($datas_ids);
            }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('Roles.index');
        }
        Role::destroy( $delete_select_id );
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('Roles.index');
    }// end of bulkDelete
}