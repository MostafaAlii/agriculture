<?php
namespace App\Http\Repositories\Admin;

use App\Models\Admin;
use App\Models\State;
use App\Models\Farmer;
use App\Models\Country;
use App\Models\User;

use App\Models\Department;
use Yajra\DataTables\DataTables;

use App\Http\Interfaces\Admin\DepartmentInterface;

class DepartmentRepository implements DepartmentInterface {
    
    public function index() {
        $departments = Department::get();
        return view('dashboard.admin.departments.index', compact('departments'));
    }

    public function data() {
        //get all departments data
        $departments = Department::orderBy('id','DESC')->get();
      // dd($departments);

        //use datatables (yajra) to handel this data
        return DataTables::of($departments)
            ->addColumn('record_select',function (Department $departments) {
                return view('dashboard.admin.departments.data_table.record_select', compact('departments'));
            })
            ->addColumn('country_name', function (Department $departments) {
                return $departments->department_country->name;
            })
            ->addColumn('state_name', function (Department $departments) {
                return $departments->department_state->name;
            })
            ->editColumn('created_at', function (Department $departments) {
                return $departments->created_at->format('Y-m-d');
            })
            ->addColumn('type', function (Department $departments) {
                //return if this depart is main or sub
                return view('dashboard.admin.departments.data_table.types', compact('departments'));
                // return "$admin->type";
            })
            ->addColumn('actions',function (Department $departments) {
                return view('dashboard.admin.departments.data_table.actions', compact('departments'));
            })
            ->rawColumns(['record_select','actions'])
            ->toJson();
    }

    public function create()
    {
        //return only main departments
        $main_departments = Department::where('parent_id',Null)->get();
        $country =Country::all();
        $state=State::all();
        return view('dashboard.admin.departments.create', compact('main_departments','country','state'));
    }
//DepartmentRequest
    public function store($request) {
        
       // dd('inside repo');
       //dd($request);
         
        try{
            $validated = $request->validated();
           
            $depart=new Department;
           
            $depart->country_id=$request->country_id;
            $depart->state_id=$request->state_id;
            //$depart->slug=$request->slug;
            ($request->parent_id!='0')?$depart->parent_id=$request->parent_id:'';
            $depart->created_by=auth()->user()->name;//----------------------------------------------------------------------------
            
            $depart->save();

            $depart->name=$request->name;
            $depart->slug=str_replace(' ', '_',$request->name);
            $depart->description=$request->description;
            $depart->keyword=$request->keyword;

            $depart->save();
            
            toastr()->success(__('Admin/departments.depart_add_done'));
            return redirect()->route('Departments.index');
            
         } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
        
               
            
         
        
         
    }

    public function edit($id)
    {
        //dd($id);
        $real_id= decrypt($id);
        $depart = Department::findOrfail($real_id);
        $main_departments = Department::where('parent_id',Null)->where('id','!=',$real_id)->get();

        $country =Country::all();
        $state =State::all();
        return view('dashboard.admin.departments.edit', compact('depart','main_departments','country','state'));
    }


    public function update($request) {
        // dd('inside repo'); 
          
         try{
             $validated = $request->validated();
            
             $depart= Department::findOrfail($request->id);
            
             $depart->country_id=$request->country_id;
             $depart->state_id=$request->state_id;
             $depart->slug=$request->slug;
             ($request->parent_id!='0')?$depart->parent_id=$request->parent_id:'';
             $depart->updated_by=auth()->user()->id;//----------------------------------------------------------------------------
             
             $depart->save();
 
             $depart->name=$request->name;
             $depart->description=$request->description;
             $depart->keyword=$request->keyword;
 
             $depart->save();
             
             toastr()->success(__('Admin/departments.depart_edit_done'));
             return redirect()->route('Departments.index');
             
          } catch (\Exception $e) {
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
          }
     }
 


     public function destroy($id) {
        try{
            $real_id = decrypt($id);
            

            $data['admin'] = Admin::where('department_id', $real_id)->pluck('department_id');
            $data['farmer'] = Farmer::where('department_id', $real_id)->pluck('department_id');
            $data['user'] = User::where('department_id', $real_id)->pluck('department_id'); 
            if($data['admin']->count() == 0  && $data['farmer']->count() == 0 && $data['user']->count() == 0) {
                Department::findorfail($real_id)->delete();
                toastr()->error(__('Admin/departments.depart_delete_done'));
                return redirect()->route('Departments.index');
            }else{
                toastr()->error(__('Admin/departments.depart_cant_delete'));
                return redirect()->route('Departments.index');
            }
            
            
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function bulkDelete($request)
    {         
        if($request->delete_select_id){
            $all_ids = explode(',',$request->delete_select_id);
            // Department::whereIn('id',$all_ids)->delete();

            // dd($all_ids);
            foreach($all_ids as $depart_ids){
                $delete_or_no=0;
                $data['admin'] = Admin::where('department_id', $depart_ids)->pluck('department_id');
                $data['farmer'] = Farmer::where('department_id', $depart_ids)->pluck('department_id');
                $data['user'] = User::where('department_id', $depart_ids)->pluck('department_id'); 

                if($data['admin']->count() == 0  && $data['farmer']->count() == 0 && $data['user']->count() == 0) {
                    Department::findOrfail($depart_ids)->delete();
                    $delete_or_no++;
                }
                if($delete_or_no==0){
                    toastr()->error(__('Admin/departments.depart_cant_delete'));
                    return redirect()->route('Departments.index');
                }else{
                    toastr()->error(__('Admin/departments.depart_delete_done'));
                    return redirect()->route('Departments.index');
                }
            }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('Departments.index');
        }
    }// end of bulkDelete
}