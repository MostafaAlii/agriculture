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
            DB::beginTransaction();
            try {

                $admin_department = new AdminDepartment();
                $dataRequest = $request->except(['image']);
                $admin_department->name = $dataRequest['name'];
                if (isset($dataRequest['parent'])) {
                    $admin_department->parent = $dataRequest['parent'];
                }


                if($request->hasFile('image')) {

                    Image::make($request->image)->resize(70, 70, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('Dashboard/img/adminDepartment/' . $request->image->hashName()));
                    $dataRequest['image'] = $request->file('image')->hashName();


                }

                $admin_department->save($dataRequest);
                $admin_department->keys = $dataRequest['keys'];
                $admin_department->desc = $dataRequest['desc'];

                $admin_department->save($dataRequest);

                DB::commit();
                toastr()->success(__('Admin/general.success_update'));
                return redirect()->route('adminDepartments');

            } catch (\Exception $e) {
                DB::rollBack();
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

            DB::beginTransaction();
            try {
                $validated = $request->validated();
            $admin_department = AdminDepartment::findorfail($id);

                $dataRequest = $request->except(['image']);
               $admin_department->name = $dataRequest['name'];
               $admin_department->parent = $dataRequest['parent'];

                if($request->fasFile('image')) {

                    if(File::exists(public_path('Dashboard/img/adminDepartment/' . $admin_department->image)))
                    {
                        File::delete(public_path('Dashboard/img/adminDepartment/'. $admin_department->image));
                    }
                    Image::make($request->icon)->resize(70, 70, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('Dashboard/img/adminDepartment/' . $request->icon->hashName()));

                    $dataRequest['image'] = $request->icon->hashName();
                }

                $admin_department->update($dataRequest);
                $admin_department->keys = $dataRequest['keys'];
                $admin_department->desc = $dataRequest['desc'];

                $admin_department->update($dataRequest);

                DB::commit();
                toastr()->success(__('Admin/general.success_update'));
                return redirect()->route('AdminDepartments.index');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);

            }
        }

    }
    public static function delete_parent($id){

        $admin_dep_parent = AdminDepartment::where('parent',$id)->get();
        foreach($admin_dep_parent as $sub){
            self::delete_parent($sub->id);
            if(!empty($sub->id)){
                if(File::exists(public_path('Dashboard/img/adminDepartment/' . $sub->image)))
                {
                    File::delete(public_path('Dashboard/img/adminDepartment/' . $sub->$sub));
                }
            }
            AdminDepartment::find($sub->id)->delete();
        }
        $dep=AdminDepartment::find($id);
        if(!empty($dep->id)){
            if(File::exists(public_path('Dashboard/img/adminDepartment/' . $dep->image)))
            {
                File::delete(public_path('Dashboard/img/adminDepartment/' . $dep->$sub));
            }
        }
        $dep->delete();
    }

    public function destroy($request) {
        self::delete_parent($request->id);
        toastr()->error(__('Admin/departments.depart_delete_done'));
        return redirect()->route('adminDepartments.index');

    }
}