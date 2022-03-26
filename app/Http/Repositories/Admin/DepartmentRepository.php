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
use App\Models\Area;
use App\Models\Product;
use App\Models\Province;
use App\Models\Village;

use App\Traits\Keywords;
class DepartmentRepository implements DepartmentInterface {
    use Keywords;
    public function index() {
        $departments = Department::get();
        return view('dashboard.admin.departments.index', compact('departments'));
    }

    public function data() {
        //get all departments data
        $departments = Department::orderBy('id','DESC')->get();

        //use datatables (yajra) to handel this data
        return DataTables::of($departments)
            ->addColumn('record_select',function (Department $departments) {
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
                if($departments->state_id == NULL){
                    return '-';
                }
                else{
                    return $departments->department_state->name;
                }
            })
            ->addColumn('village_name', function (Department $departments) {
                if($departments->village_id == NULL){
                    return '-';
                }
                else{
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
            ->addColumn('actions',function (Department $departments) {
                return view('dashboard.admin.departments.data_table.actions', compact('departments'));
            })
            ->rawColumns(['record_select','actions'])
            ->toJson();
    }

    public function create()
    {
       
        //return only main departments
        $data['main_departments']=Department::where('parent_id',Null)->get();
        $data['country']=Country::all();
        $data['province']=Province::all();
        $data['area']=Area::all();
        $data['state']=State::all();
        $data['village']=Village::all();
       

       // return view('dashboard.admin.departments.create', compact('main_departments','country','state'));
        return view('dashboard.admin.departments.create', $data);
    }
//DepartmentRequest
    public function store($request) {
        
       // dd('inside repo');
       //dd($request);
     
            
        try{
            $validated = $request->validated();
           
            $depart=new Department;

            ($request->parent_id!='0')?$depart->parent_id=$request->parent_id:'';

            $depart->country_id=$request->country_id;
            $depart->province_id=$request->province_id;
            $depart->area_id=$request->area_id;
            ($request->state_id)?$depart->state_id=$request->state_id:'';
            ($request->village_id)?$depart->village_id=$request->village_id:'';
            $depart->created_by=auth()->user()->name;//----------------------------------------------------------------------------
            
            $depart->save();

            $depart->name=$request->name;
            $depart->slug=str_replace(' ', '_',$request->name);
            $depart->description=$request->description;

              // call to keyword fun
              $depart->keyword=$this->handel_keyword($request->keyword);
            
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
        
        $data['depart']=Department::findOrfail($real_id);
        $data['main_departments']=Department::where('parent_id',Null)->where('id','!=',$real_id)->get();
        $data['country']=Country::all();
        $data['province']=Province::all();
        $data['area']=Area::all();
        $data['state']=State::all();
        $data['village']=Village::all();
        
        return view('dashboard.admin.departments.edit',$data);
    }


    public function update($request) {
        // dd('inside repo'); 
          
         try{
             $validated = $request->validated();
            
             $depart= Department::findOrfail($request->id);
            
             ($request->parent_id!='0')?$depart->parent_id=$request->parent_id:$depart->parent_id=Null;

             $depart->country_id=$request->country_id;
             $depart->province_id=$request->province_id;
             $depart->area_id=$request->area_id;
             ($request->state_id)?$depart->state_id=$request->state_id:$depart->state_id=Null;
             ($request->village_id)?$depart->village_id=$request->village_id:$depart->village_id=NULL;
             
             $depart->updated_by=auth()->user()->id;//----------------------------------------------------------------------------
             
             $depart->save();

             $depart->name=$request->name;
             $depart->slug=str_replace(' ', '_',$request->name);
             $depart->description=$request->description;
 
            // call to keyword fun
            $depart->keyword=$this->handel_keyword($request->keyword);
             
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

            $d=Department::find($real_id);
            $data['product']= $d->products();//->withTrashed()

            if($data['admin']->count() == 0  && $data['farmer']->count() == 0 && $data['user']->count() == 0 && $data['product']->count() == 0) {
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
            $delete_or_no=0;
            foreach($all_ids as $depart_ids){
                
                $data['admin'] = Admin::where('department_id', $depart_ids)->pluck('department_id');
                $data['farmer'] = Farmer::where('department_id', $depart_ids)->pluck('department_id');
                $data['user'] = User::where('department_id', $depart_ids)->pluck('department_id'); 

                $d=Department::find($depart_ids);
                $data['product']= $d->products();//->withTrashed()
                
                if($data['admin']->count() == 0  && $data['farmer']->count() == 0 && $data['user']->count() == 0 && $data['product']->count() == 0) {
                    Department::findOrfail($depart_ids)->delete();
                    $delete_or_no++;
                }
            }
            
            if($delete_or_no==0){
                toastr()->error(__('Admin/departments.depart_cant_delete'));
                return redirect()->route('Departments.index');
            }else{
                toastr()->error(__('Admin/departments.depart_delete_done'));
                return redirect()->route('Departments.index');
            }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('Departments.index');
        }
    }// end of bulkDelete
}