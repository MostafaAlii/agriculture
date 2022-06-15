<?php
namespace App\Http\Repositories\Admin;

use App\Models\Category;

use App\Traits\Keywords;
use App\Models\Department;
use Yajra\DataTables\DataTables;

use App\Events\Dashboard\DeleteEvent2;
use App\Http\Interfaces\Admin\CategoryInterface;

class CategoryRepository implements CategoryInterface {
    
    use Keywords;

    public $models,$columns,$cond;
    public function __construct()
    {
        $this->models=[
            'App\Models\Product',
            'App\Models\Category',
        ];
        $this->columns=[
            'id',
            'parent_id'
        ];
        $this->cond=[
            'WhereIn',
            'Where'
        ];
       
    }
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
        $data['main_categories']=Category::whereNull('parent_id')->get();
        $data['main_departments']=Department::whereNull('parent_id')->get();
        return view('dashboard.admin.categories.create', $data);
    }
    
//------------------------------------------------------------------------------------------
//CategoryRequest
    public function store($request) {
                   
        try{
           
            Category::Create(
                [
                    'parent_id'     => ($request->parent_id!='0')?$request->parent_id:Null,
                    'department_id' => $request->department_id,
                    'name'          => $request->name,
                    'slug'          => str_replace(' ', '_', $request->name),
                    'description'   => $request->description,
                    'keyword'       => $this->handel_keyword($request->keyword),
                ]
            );
            
            
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
        $data['main_categories']=Category::whereNull('parent_id')->where('id','!=',$real_id)->get();
        $data['main_departments']=Department::whereNull('parent_id')->get();
        return view('dashboard.admin.categories.edit',$data);
    }

//------------------------------------------------------------------------------------------
    public function update($request) {
        // dd('inside repo'); 
          
         try{
            
            $cate= Category::findOrfail($request->id);
            
            $cate->parent_id       = ($request->parent_id!='0')?$request->parent_id:Null;
            $cate->department_id   = $request->department_id;
            $cate->name            = $request->name;
            $cate->slug            = str_replace(' ', '_',$request->name);
            $cate->description     = $request->description;
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
           /* $d=Category::find($real_id);
            $data['product']= $d->products();

            //check if there are sub cate for this cate
            $data['sub_cate']=Category::where('parent_id',$real_id);

            if($data['product']->count() == 0  && $data['sub_cate']->count() == 0 ) {
               */
              Category::findorfail($real_id)->delete();

                //--------------this event for delete related records------------------------------
                //id,column names[],related models[]
                // $related_id=[
                //     [Category::findorfail($real_id)->products()->pluck('id')->toArray()],
                //     $real_id
                // ];
                // //dd($ids);
                // event(new DeleteEvent2($this->models,$this->cond,$this->columns,$related_id));
                //-----------------------------------------------------------------------------
                
                toastr()->error(__('Admin/categories.depart_delete_done'));
                return redirect()->route('Categories.index');
           /* }else{
                toastr()->error(__('Admin/categories.depart_cant_delete'));
                return redirect()->route('Categories.index');
            }*/
            
            
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
               /* $d=Category::find($cate_ids);
                $data['product']= $d->products();//->withTrashed()

                //check if there are sub cate for this cate
                $data['sub_cate']=Category::where('parent_id',$cate_ids);
                
                if($data['product']->count() == 0 && $data['sub_cate']->count() == 0) {
                */
                    Category::findOrfail($cate_ids)->delete();

                    //--------------this event for delete related records------------------------------
                    //id,column names[],related models[]
                    // $related_id=[
                    //     [Category::findorfail($cate_ids)->products()->pluck('id')->toArray()],
                    //     $cate_ids
                    // ];
                    // //dd($ids);
                    // event(new DeleteEvent2($this->models,$this->cond,$this->columns,$related_id));
                    //-----------------------------------------------------------------------------
                
                    $delete_or_no++;
                //}
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