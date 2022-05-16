<?php
namespace App\Http\Repositories\Admin;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Interfaces\Admin\RoleRepositoryInterface;
class RoleRepository implements RoleRepositoryInterface {
    public function index() {
        /*$roles = Role::orderBy('id','DESC')->paginate(5);
        return view('dashboard.admin.roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);*/
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
            //->addIndexColumn()
            ->toJson();
    }
}