<?php
namespace  App\Http\Repositories\Admin;
use App\Models\AdminDepartment;
use App\Http\Interfaces\Admin\AdminDepartmentInterface;
use App\Http\Requests\Dashboard\AdminDepartmentRequest;
use DB;
use Image;
class AdminDepartmentRepository implements AdminDepartmentInterface{
    public function index() {

        return view('dashboard.admin.admin_department.index');

    }
    public function create() {

        return view('dashboard.admin.admin_department.create');

    }


    public function store($request) {
        {
            $dataRequest = $request->validated();
            try {

                $admin_department = new AdminDepartment();
                $admin_department->dep_name_ar = $dataRequest['dep_name_ar'];
                $admin_department->dep_name_en = $dataRequest['dep_name_en'];

                $admin_department->keys = $dataRequest['keys'];
                $admin_department->desc = $dataRequest['desc'];
                if (isset($dataRequest['parent'])) {
                    $admin_department->parent = $dataRequest['parent'];
                }



                $admin_department->save($dataRequest);

                toastr()->success(__('Admin/general.success_update'));
                return redirect()->route('AdminDepartments.index');

            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);

            }
        }


    }


    public function edit($id) {

        $admin_department = AdminDepartment::findorfail($id);

        return view('dashboard/admin/admin_department.edit',compact('admin_department'));

    }


    public function update($request,$id) {
        {

            try {
                $validated = $request->validated();
                $admin_department = AdminDepartment::findorfail($id);

                $admin_department->dep_name_ar = $validated['dep_name_ar'];
                $admin_department->dep_name_en = $validated['dep_name_en'];

                $admin_department->parent = $validated['parent'];
                $admin_department->keys = $validated['keys'];
                $admin_department->desc = $validated['desc'];


                $admin_department->update();

                toastr()->success(__('Admin/general.success_update'));
                return redirect()->route('AdminDepartments.index');

            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);

            }
        }

    }
    public static function delete_parent($id){

        $admin_dep_parent = AdminDepartment::where('parent',$id)->get();
        foreach($admin_dep_parent as $sub){
            self::delete_parent($sub->id);

            $admin_dep=  AdminDepartment::find($sub->id);
            return $admin_dep ;
        }
         AdminDepartment::find($id)->delete();

    }

    public function destroy($id) {

        self::delete_parent($id);
        toastr()->error(__('Admin/departments.depart_delete_done'));
        return redirect()->route('AdminDepartments.index');

    }


}