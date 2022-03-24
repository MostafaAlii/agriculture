<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\AttributeInterface;
use App\Models\Attribute;
use Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use App\Traits\UploadT;


class AttributeRepository implements AttributeInterface{
    use UploadT;
    public function index() {
        $attributes = Attribute::get();
        return view('dashboard.admin.attributes.index', compact('attributes'));
    }

    public function data() {
        $attr = Attribute::all();
        return DataTables::of($attr)
            ->addColumn('record_select', 'dashboard.admin.attributes.data_table.record_select')
            ->editColumn('created_at', function (Attribute $attr) {
                return $attr->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.attributes.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store($request) {
      
        try{
            $validated = $request->validated();
           
            $attr=new Attribute;

            $attr->name=$request->name;
            
            $attr->save();

            toastr()->success(__('Admin/attributes.added_done'));
            return redirect()->route('Attributes.index');
            
         } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }

    public function edit($id) {
        $real_id = decrypt($id);
        $attributes=Attribute::findOrfail($real_id);
        return view('dashboard.admin.attributes.edit', compact('attributes'));
    }

    public function update($request,$id) {
        $real_id = decrypt($id);

        $attr=Attribute::findOrfail($real_id);
        $attr->name=$request->name;
        $attr->save();
        
        toastr()->success(__('Admin/attributes.updated_done'));
        return redirect()->route('Attributes.index');
    }

    public function destroy($id) {
    //   
    }
}
