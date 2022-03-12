<?php
namespace  App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\AdminInterface;
use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminRepository implements AdminInterface{

    public function index() {
        return view('dashboard.admin.admins.index');
    }
    public function data() {
        $admins = Admin::limit(1)->get();
        // dd($admins->id);
        return DataTables::of($admins)
            ->editColumn('created_at', function (Admin $admin) {
                return $admin->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'dashboard.admin.admins.data_table.actions')
            ->rawColumns([ 'actions'])
            ->toJson();
    }

    public function create() {
        return view('dashboard.admin.admins.create');
    }
    public function store($request) {
        try{
            $requestData = $request->validated();
            $requestData['password'] = bcrypt($request->password);
            Admin::create($requestData);
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Admins.index');
         } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }

    public function edit($admin) {

        return view('dashboard.admin.admins.edit', compact('admin'));
    }

    public function update( $request,$admin) {
        try{
            $admin->update($request->validated());
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('Admins.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($admin) {
        $admin->delete();
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('Admins.index');
    }
}
