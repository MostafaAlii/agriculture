<?php
namespace  App\Http\Repositories\Admin;
use App\Models\Option;
use App\Models\Attribute;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use App\Http\Interfaces\Admin\OptionInterface;
use App\Models\Product;

class OptionRepository implements OptionInterface{
    
    public function index() {
     
        $attributes= Attribute::all(); 
        $products= Product::withTrashed()->get(); 
        return view('dashboard.admin.options.index', compact('attributes','products'));
        
    }
    

      public function data() {
        //return 'dddd';
        $options = Option::get();

        // return $options->attribute->name;
        // return($options);
        
        return DataTables::of($options)
            ->addColumn('record_select', 'dashboard.admin.options.data_table.record_select')
            ->editColumn('created_at', function (Option $options) {
                return $options->created_at->diffforhumans();
            })
            ->addColumn('attribute', function (Option $options) {
                return $options->attribute->name;
            })
            ->addColumn('product', function (Option $options) {
                return $options->product->name;
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
            $options->product_id=$request->product_id;
            $options->save();
           
            $options->name=$request->name;
            $options->save();
 //dd('done');
            toastr()->success(__('Admin/options.added_done'));
           return redirect()->back();
            
         } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // toastr()->error(__('Admin/options.error_occure'));
            // return redirect()->back();
         }
     }

    public function edit($id) {
        
        $real_id = Crypt::decrypt($id);
        $options=Option::findOrfail($real_id);

        $attributes= Attribute::all();
       
        $products= Product::withTrashed()->get();
       // dd($products);
        return view('dashboard.admin.options.edit', compact('options','attributes','products'));
    }

    public function update($request,$id) {
        $real_id = decrypt($id);

        $options=Option::findOrfail($real_id);
        $options->attribute_id=$request->attribute_id;
            $options->product_id=$request->product_id;
            $options->save();
           
            $options->name=$request->name;
            $options->save();
        
        toastr()->success(__('Admin/options.updated_done'));
        return redirect()->route('Options.index');
    }

    public function destroy($id) {
        try{
            $real_id = decrypt($id);
                Option::findorfail($real_id)->delete();
                toastr()->error(__('Admin/options.delete_done'));
                return redirect()->route('Options.index');
           
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function bulkDelete($request)
    {
        //dd($request->delete_select_id);
        
        if($request->delete_select_id){
            $all_ids = explode(',',$request->delete_select_id);

            $delete_or_no=0;
            
            foreach($all_ids as $ids){
                Option::findorfail($ids)->delete();
                $delete_or_no++;
                
            }
            if($delete_or_no==0){
                toastr()->error(__('Admin/options.cant_delete'));
                return redirect()->route('Options.index');
            }else{
                toastr()->error(__('Admin/options.delete_done'));
                return redirect()->route('Options.index');
            }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('Options.index');
        }
    }// end of bulkDelete
}
