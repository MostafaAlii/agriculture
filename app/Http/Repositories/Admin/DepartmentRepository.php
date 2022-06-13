<?php

namespace App\Http\Repositories\Admin;

use App\Events\Dashboard\DeleteEvent;
use App\Models\Area;
use App\Models\State;
use App\Models\Country;
use App\Models\Village;
use App\Models\Province;
use App\Traits\Keywords;
use App\Models\Department;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\Auth;
use App\Http\Interfaces\Admin\DepartmentInterface;

class DepartmentRepository implements DepartmentInterface
{

    use Keywords;

    public function index()
    {
        $departments = Department::get();
        return view('dashboard.admin.departments.index', compact('departments'));
    }

//------------------------------------------------------------------------------------------
    public function data()
    {
        //get all departments data
        $departments = Department::orderBy('id', 'DESC')->get();

        //use datatables (yajra) to handel this data
        return DataTables::of($departments)
            ->addColumn('record_select', function (Department $departments) {
                return view('dashboard.admin.departments.data_table.record_select', compact('departments'));
            })
            ->addColumn('country_name', function (Department $departments) {
                return $departments->department_country->name;
            })
            ->addColumn('province_name', function (Department $departments) {
                return $departments->department_province->name;
            })
            ->addColumn('area_name', function (Department $departments) {
                return $departments->department_area->name;
            })
            ->addColumn('state_name', function (Department $departments) {
                if ($departments->state_id == NULL) {
                    return '-';
                } else {
                    return $departments->department_state->name;
                }
            })
            ->addColumn('village_name', function (Department $departments) {
                if ($departments->village_id == NULL) {
                    return '-';
                } else {
                    return $departments->department_village->name;
                }
            })
            ->editColumn('created_at', function (Department $departments) {
                return $departments->created_at->format('Y-m-d');
            })
            ->addColumn('type', function (Department $departments) {
                //return if this depart is main or sub
                return view('dashboard.admin.departments.data_table.types', compact('departments'));
                // return "$admin->type";
            })
            ->addColumn('actions', function (Department $departments) {
                return view('dashboard.admin.departments.data_table.actions', compact('departments'));
            })
            ->rawColumns(['record_select', 'actions'])
            ->toJson();
    }

//------------------------------------------------------------------------------------------
    public function create()
    {

        //return only main departments
        $data['main_departments']=Department::whereNull('parent_id')->get();
        $data['country']=Country::all();
        $data['province']=Province::all();
        $data['area']=Area::all();
        $data['state']=State::all();
        $data['village']=Village::all();
       
        return view('dashboard.admin.departments.create', $data);
    }
//------------------------------------------------------------------------------------------
    public function store($request) {
      
        try{            
            Department::Create(
                [
                    'parent_id'  => ($request->parent_id!='0')?$request->parent_id:Null,
                    'country_id' => $request->country_id,
                    'province_id'=> $request->province_id,
                    'area_id'    => $request->area_id,
                    'state_id'   => ($request->state_id)??$request->state_id,
                    'village_id' => ($request->village_id)??$request->village_id,
                   // 'created_by' => Auth::guard('admin')->user()->id,
                    'name'       => $request->name,
                    'slug'       => str_replace(' ', '_', $request->name),
                    'description'=> $request->description,
                    'keyword'    => $this->handel_keyword($request->keyword),
                ]
            );
            
            toastr()->success(__('Admin/departments.depart_add_done'));
            return redirect()->route('Departments.index');

        } catch (\Exception $e) {
            //dd($e->getMessage());
            toastr()->success(__('Admin/attributes.add_wrong'));
            return redirect()->back();
        }

    }

//------------------------------------------------------------------------------------------
    public function edit($id)
    {
        //dd($id);
        $real_id= decrypt($id);
        $data['depart']=Department::findOrfail($real_id);
        $data['main_departments']=Department::whereNull('parent_id')->where('id','!=',$real_id)->get();
        $data['country']=Country::all();
        $data['province']=Province::all();
        $data['area']=Area::all();
        $data['state']=State::all();
        $data['village']=Village::all();
        return view('dashboard.admin.departments.edit',$data);
    }

//------------------------------------------------------------------------------------------
    public function update($request)
    {
         try{            
             $depart= Department::findOrfail($request->id);
            
             ($request->parent_id!='0')?$depart->parent_id=$request->parent_id:$depart->parent_id=Null;
             ($request->state_id)?$depart->state_id=$request->state_id:$depart->state_id=NULL;
             ($request->village_id)?$depart->village_id=$request->village_id:$depart->village_id=NULL;
             $depart->country_id    = $request->country_id;
             $depart->province_id   = $request->province_id;
             $depart->area_id       = $request->area_id;
            // $depart->updated_by    = auth()->user()->id;
             $depart->name          = $request->name;
             $depart->slug          = str_replace(' ', '_',$request->name);
             $depart->description   = $request->description;
            // call to keyword fun
            $depart->keyword        = $this->handel_keyword($request->keyword);
            $depart->save();

            toastr()->success(__('Admin/departments.depart_edit_done'));
            return redirect()->route('Departments.index');

        } catch (\Exception $e) {
            toastr()->success(__('Admin/attributes.edit_wrong'));
            return redirect()->back();
        }
    }


//------------------------------------------------------------------------------------------
    public function destroy($id)
    {
        try {
            $real_id = decrypt($id);
            Department::findorfail($real_id)->delete(); //soft_delete

            //--------------this event for delete related records------------------------------
            //id,column names[],other models[]
            $models=[
                'App\Models\Admin',
                'App\Models\Farmer',
                'App\Models\User',
                'App\Models\Category',
                'App\Models\Department'
            ];
            $columns=[
                'department_id',
                'department_id',
                'department_id',
                'department_id',
                'parent_id'
            ];
            event(new DeleteEvent($real_id,$columns,$models));
            //-----------------------------------------------------------------------------
                
                toastr()->error(__('Admin/departments.depart_delete_done'));
                return redirect()->route('Departments.index');
        } catch (\Exception $e) {
             dd($e->getMessage());
            toastr()->success(__('Admin/attributes.delelte_wrong'));
            return redirect()->back();
        }
    }

    //----------------delete selected department-----------------------
    public function bulkDelete($request)
    {
        if ($request->delete_select_id) {
            $all_ids = explode(',', $request->delete_select_id);
            // Department::whereIn('id',$all_ids)->delete();

            // dd($all_ids);
            $delete_or_no = 0;
            foreach ($all_ids as $depart_ids) {

                Department::findOrfail($depart_ids)->delete();
                //--------------this event for delete related records------------------------------
                //id,column names[],other models[]
                $models=[
                    'App\Models\Admin',
                    'App\Models\Farmer',
                    'App\Models\User',
                    'App\Models\Category',
                    'App\Models\Department'
                ];
                $columns=[
                    'department_id',
                    'department_id',
                    'department_id',
                    'department_id',
                    'parent_id'
                ];
                event(new DeleteEvent($depart_ids,$columns,$models));
                //-----------------------------------------------------------------------------
                $delete_or_no++;
            
            }

            if ($delete_or_no == 0) {
                toastr()->error(__('Admin/departments.depart_cant_delete'));
                return redirect()->route('Departments.index');
            } else {
                toastr()->error(__('Admin/departments.depart_delete_done'));
                return redirect()->route('Departments.index');
            }
        } else {
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('Departments.index');
        }
    }// end of bulkDelete
}