<?php
namespace  App\Http\Repositories\Admin;
use App\Models\Option;
use App\Traits\UploadT;
use App\Models\Attribute;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use App\Http\Interfaces\Admin\OptionInterface;
use App\Models\Department;

class OptionRepository implements OptionInterface{
    use UploadT;
    
    public function index($attr_id) {
        //dd('index');
        $real_id=Crypt::decrypt($attr_id);
        $options = Option::where('attribute_id',$real_id)->get();

        $attributes= Attribute::all();
        $departments= Department::all();
        $products= Department::all(); //changes to be products
        return view('dashboard.admin.options.index', compact('options','real_id','attributes','departments','products'));
        
    }
    


    public function show($attr_id) {
        
         $real_id=Crypt::decrypt($attr_id);
      //   dd($real_id);
        $options = Option::where('attribute_id',$real_id)->get();
        
        $attributes= Attribute::all();
        $departments= Department::all();
        $products= Department::all(); //changes to be products
        
        return view('dashboard.admin.options.index', compact('options','real_id','attributes','departments','products'));
        
    }

    public function data($attr_id) {
       
        //$options = Option::where('attribute_id',$attr_id)->get();
        $options = Option::with(['attribute']);
        //dd($options);
        return DataTables::of($options)
            ->addColumn('record_select', 'dashboard.admin.options.data_table.record_select')
            ->editColumn('created_at', function (Attribute $attr) {
                return $attr->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.options.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store($request) {
      //dd($request->all());
        try{
            $validated = $request->validated();
           
            $options=new Option();

            $options->attribute_id=$request->attribute_id;
            $options->type=$request->type;
            ($request->type==1)?($options->type_id=$request->depart_id):($options->type_id=$request->product_id);
            $options->save();
           
            $options->name=$request->name;
            $options->save();
 //dd('done');
            toastr()->success(__('Admin/options.added_done'));
          //  return redirect()->back();
            return redirect()->route('Options.show',$request->attribute_id);
            
         } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // toastr()->error(__('Admin/options.error_occure'));
            // return redirect()->back();
         }
    }

    public function edit($id) {
        $real_id = Crypt::decrypt($id);
        $options=Option::findOrfail($real_id);
        return view('dashboard.admin.options.edit', compact('options'));
    }

    public function update($request,$id) {
        // $real_id = decrypt($id);

        // $attr=Attribute::findOrfail($real_id);
        // $attr->name=$request->name;
        // $attr->save();
        
        // toastr()->success(__('Admin/attributes.updated_done'));
        // return redirect()->route('Attributes.index');
    }

    public function destroy($id) {
    //   
    }

}
