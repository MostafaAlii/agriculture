<?php

namespace App\Http\Repositories\Admin;

use App\Models\AdminDepartment;
use App\Http\Interfaces\Admin\AdminDepartmentInterface;
use App\Http\Requests\Dashboard\AdminDepartmentRequest;
use DB;
use Image;

class AdminDepartmentRepository implements AdminDepartmentInterface
{
    public function index()
    {

        return view('dashboard.admin.admin_department.index');

    }

    public function create()
    {

        return view('dashboard.admin.admin_department.create');

    }


    public function store($request)
    {
        {
            $dataRequest = $request->validated();
            try {

                $admin_department = new AdminDepartment();
                $admin_department->dep_name_ar = $dataRequest['dep_name_ar'];
                $admin_department->dep_name_en = $dataRequest['dep_name_en'];
                $admin_department->dep_name_ku = $dataRequest['dep_name_ku'];

//                $admin_department->name = $dataRequest['name'];

                $admin_department->keys = $dataRequest['keys'];
                $admin_department->desc = $dataRequest['desc'];
                if (isset($dataRequest['parent'])) {
                    $admin_department->parent = $dataRequest['parent'];
                }


                $admin_department->save($dataRequest);

                toastr()->success(__('Admin/general.success_update'));
                return redirect()->route('AdminDepartments.index');

            } catch (\Exception $e) {
                toastr()->success(__('Admin/attributes.add_wrong'));
                return redirect()->back();

            }
        }


    }


    public function edit($id)
    {

        $admin_department = AdminDepartment::findorfail($id);
//dd($admin_department);
        return view('dashboard/admin/admin_department.edit', compact('admin_department'));

    }


    public function update($request, $id)
    {

            try {
                $dataRequest = $request->validated();
                $admin_department = AdminDepartment::findorfail($id);

                $admin_department->dep_name_ar = $dataRequest['dep_name_ar'];
                $admin_department->dep_name_en = $dataRequest['dep_name_en'];
                $admin_department->dep_name_ku = $dataRequest['dep_name_ku'];
                $admin_department->parent = $dataRequest['parent'];
                $admin_department->keys = $dataRequest['keys'];
                $admin_department->desc = $dataRequest['desc'];
                $admin_department->save();

                toastr()->success(__('Admin/general.success_update'));
                return redirect()->route('AdminDepartments.index');

            } catch (\Exception $e) {
                toastr()->success(__('Admin/attributes.edit_wrong'));

                return redirect()->back();

            }


    }

    public function destroy($id)
    {
        try {
            self::delete_parent($id);
            toastr()->error(__('Admin/departments.depart_delete_done'));
            return redirect()->route('AdminDepartments.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }

    public static function delete_parent($id)
    {

        $admin_dep_parent = AdminDepartment::where('parent', $id)->get();
        foreach ($admin_dep_parent as $sub) {
            self::delete_parent($sub->id);

            $admin_dep = AdminDepartment::find($sub->id);
            return $admin_dep;
        }
        AdminDepartment::find($id)->delete();

    }


}