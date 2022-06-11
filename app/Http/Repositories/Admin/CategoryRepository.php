<?php
namespace App\Http\Repositories\Admin;

use Yajra\DataTables\DataTables;

use App\Http\Interfaces\Admin\CategoryInterface;
use App\Models\Department;
use App\Models\Category;

use App\Traits\Keywords;

class CategoryRepository implements CategoryInterface {
    
    use Keywords;

    public function index() {
        $categories = Category::get();
        return view('dashboard.admin.categories.index', compact('categories'));
    }

//------------------------------------------------------------------------------------------
    public function data() {
        //get all categories data
        $categories = Category::orderBy('id','DESC')->get();

        //use datatables (yajra) to handel this data
        return DataTables::of($categories)
            ->addColumn('record_select',function (Category $categories) {
                return view('dashboard.admin.categories.data_table.record_select', compact('categories'));
            })
            ->addColumn('department_name', function (Category $categories) {
                return $categories->Category_department->name;
            })
            ->editColumn('created_at', function (Category $categories) {
                return $categories->created_at->format('Y-m-d');
            })
            ->addColumn('type', function (Category $categories) {
                //return if this depart is main or sub
                return view('dashboard.admin.categories.data_table.types', compact('categories'));
                // return "$admin->type";
            })
            ->addColumn('actions',function (Category $categories) {
                return view('dashboard.admin.categories.data_table.actions', compact('categories'));
            })
            ->rawColumns(['record_select','actions'])
            ->toJson();
    }

//------------------------------------------------------------------------------------------
    public function create()
    {
       
        //return only main categories
        $data['main_categories']=Category::where('parent_id',Null)->get();
        $data['main_departments']=Department::where('parent_id',Null)->get();
       

       // return view('dashboard.admin.categories.create', compact('main_categories','country','state'));
        return view('dashboard.admin.categories.create', $data);
    }
    
//------------------------------------------------------------------------------------------
//CategoryRequest
    public function store($request) {
                   
        try{
           
            $cate=new Category;

            ($request->parent_id!='0')?$cate->parent_id=$request->parent_id:NULL;

            $cate->department_id=$request->department_id;
            $cate->created_by=auth()->user()->firstname;//----------------------------------------------------------------------------
            
           // $cate->save();

            $cate->name=$request->name;
            $cate->slug=str_replace(' ', '_',$request->name);
            $cate->description=$request->description;

              // call to keyword fun
              $cate->keyword=$this->handel_keyword($request->keyword);
            
            $cate->save();
            
            toastr()->success(__('Admin/categories.depart_add_done'));
            return redirect()->route('Categories.index');
            
         } catch (\Exception $e) {
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            //toastr()->success(__('Admin/attributes.add_wrong'));
            return redirect()->back();
         }
    }

//------------------------------------------------------------------------------------------
    public function edit($id)
    {
        //dd($id);
        $real_id= decrypt($id);
        
        $data['cate']=Category::findOrfail($real_id);
        $data['main_categories']=Category::where('parent_id',Null)->where('id','!=',$real_id)->get();
        $data['main_departments']=Department::where('parent_id',Null)->get();

        
        return view('dashboard.admin.categories.edit',$data);
    }

//------------------------------------------------------------------------------------------
    public function update($request) {
        // dd('inside repo'); 
          
         try{
            
             $cate= Category::findOrfail($request->id);
             ($request->parent_id!='0')?$cate->parent_id=$request->parent_id:$cate->parent_id=Null;
             $cate->department_id=$request->department_id;
             $cate->updated_by=auth()->user()->firstname;//----------------------------------------------------------------------------
             $cate->save();

             $cate->name=$request->name;
             $cate->slug=str_replace(' ', '_',$request->name);
             $cate->description=$request->description;
 
            // call to keyword fun
            $cate->keyword=$this->handel_keyword($request->keyword);
             
             $cate->save();
             
             toastr()->success(__('Admin/categories.depart_edit_done'));
             return redirect()->route('Categories.index');
             
          } catch (\Exception $e) {
            toastr()->success(__('Admin/attributes.edit_wrong'));
            return redirect()->back();          }
     }
 

//------------------------------------------------------------------------------------------
     public function destroy($id) {
        try{
            $real_id = decrypt($id);

            //check category products
            $d=Category::find($real_id);
            $data['product']= $d->products();

            //check if there are sub cate for this cate
            $data['sub_cate']=Category::where('parent_id',$real_id);

            if($data['product']->count() == 0  && $data['sub_cate']->count() == 0 ) {
                Category::findorfail($real_id)->delete();
                toastr()->error(__('Admin/categories.depart_delete_done'));
                return redirect()->route('Categories.index');
            }else{
                toastr()->error(__('Admin/categories.depart_cant_delete'));
                return redirect()->route('Categories.index');
            }
            
            
        } catch (\Exception $e) {
            toastr()->success(__('Admin/attributes.delete_wrong'));
            return redirect()->back();         }
    }

    //----------------delete selected categories-----------------------
    public function bulkDelete($request)
    {         
        if($request->delete_select_id){
            $all_ids = explode(',',$request->delete_select_id);
            $delete_or_no=0;
            foreach($all_ids as $cate_ids){
  
                 //check category products
                $d=Category::find($cate_ids);
                $data['product']= $d->products();//->withTrashed()

                //check if there are sub cate for this cate
                $data['sub_cate']=Category::where('parent_id',$cate_ids);
                
                if($data['product']->count() == 0 && $data['sub_cate']->count() == 0) {
                    Category::findOrfail($cate_ids)->delete();
                    $delete_or_no++;
                }
            }
            
            if($delete_or_no==0){
                toastr()->error(__('Admin/categories.depart_cant_delete'));
                return redirect()->route('Categories.index');
            }else{
                toastr()->error(__('Admin/categories.depart_delete_done'));
                return redirect()->route('Categories.index');
            }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('Categories.index');
        }
    }// end of bulkDelete
}