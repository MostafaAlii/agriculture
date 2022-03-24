<?php
namespace App\Http\Repositories\Admin;
use App\Models\Attribute;
use Yajra\DataTables\DataTables;
use App\Http\Interfaces\Admin\AttributeInterface;
use Illuminate\Support\Facades\Crypt;
class AttributeRepository implements AttributeInterface {
    public function index() {
        return view('dashboard.admin.attributes.index');
    }

    public function data() {
        $attr = Attribute::select();
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
         } catch (\Exception $ex) {
            toastr()->success(__('Admin/attributes.wrong'));
            return redirect()->route('Attributes.index');
         }
    }

    public function edit($id) {
        $real_id = Crypt::decrypt($id);
        $attributes = Attribute::orderBy('id', 'DESC')->find($real_id);
        if (!$attributes)
            return redirect()->route('admin.maincategories')->with(['error' => __('Admin/attributes.wrong')]);
        return view('dashboard.admin.attributes.edit', compact('attributes'));
        /*$real_id = Crypt::decrypt($id);
        $attributes=Attribute::findOrfail($real_id);
        return view('dashboard.admin.attributes.edit', compact('attributes'));*/
    }

    public function update($request,$id) {
        $real_id = Crypt::decrypt($id);

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