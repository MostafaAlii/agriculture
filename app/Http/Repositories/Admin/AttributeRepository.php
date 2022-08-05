<?php
namespace App\Http\Repositories\Admin;
use App\Models\Attribute;
use Yajra\DataTables\DataTables;
use App\Http\Interfaces\Admin\AttributeInterface;
use App\Models\Option;
use Illuminate\Support\Facades\Crypt;
class AttributeRepository implements AttributeInterface {

    public function index() {
        return view('dashboard.admin.attributes.index');
    }
//------------------------------------------------------------------------------------------
    public function data() {
        $attr = Attribute::get();
        return DataTables::of($attr)
            ->addColumn('record_select', 'dashboard.admin.attributes.data_table.record_select')
            ->editColumn('created_at', function (Attribute $attr) {
                return $attr->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.attributes.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }
//------------------------------------------------------------------------------------------
    public function store($request) {

        try{
            $validated = $request->validated();
            $attr=new Attribute;
            $attr->name=$request->name;
            $attr->save();
            toastr()->success(__('Admin/attributes.added_done'));
            return redirect()->route('Attributes.index');
         } catch (\Exception $ex) {
            toastr()->success(__('Admin/attributes.add_wrong'));
            return redirect()->route('Attributes.index');
         }
    }
//------------------------------------------------------------------------------------------
    public function edit($id) {
        $real_id = Crypt::decrypt($id);
        $attributes = Attribute::findOrfail($real_id);
        return view('dashboard.admin.attributes.edit', compact('attributes'));
        /*$real_id = Crypt::decrypt($id);
        $attributes=Attribute::findOrfail($real_id);
        return view('dashboard.admin.attributes.edit', compact('attributes'));*/
    }
//------------------------------------------------------------------------------------------
    public function update($request,$id) {
        try{
            $validated = $request->validated();
            $real_id = Crypt::decrypt($id);

            $attr=Attribute::findOrfail($real_id);
            $attr->name=$request->name;
            $attr->save();

            toastr()->success(__('Admin/attributes.updated_done'));
            return redirect()->route('Attributes.index');
        } catch (\Exception $ex) {
            toastr()->success(__('Admin/attributes.edit_wrong'));
            return redirect()->route('Attributes.index');
         }
    }
//------------------------------------------------------------------------------------------
    public function destroy($id) {
        try{
            $real_id = decrypt($id);

            $data['options'] = Option::where('attribute_id', $real_id)->pluck('attribute_id');

            if($data['options']->count() == 0 ){
                Attribute::findorfail($real_id)->delete();
                toastr()->error(__('Admin/attributes.delete_done'));
                return redirect()->route('Attributes.index');
            }else{
                toastr()->error(__('Admin/attributes.cant_delete'));
                return redirect()->route('Attributes.index');
            }
        } catch (\Exception $e) {
            toastr()->success(__('Admin/attributes.delete_wrong'));
            return redirect()->route('Attributes.index');
        }
    }

//------------------------------------------------------------------------------------------
    public function bulkDelete($request)
    {
       // dd($request->delete_select_id);
        if($request->delete_select_id){
            $all_ids = explode(',',$request->delete_select_id);

            $delete_or_no=0;

            foreach($all_ids as $ids){

                $data['options'] = Option::where('attribute_id', $ids)->pluck('attribute_id');

                if($data['options']->count() == 0 ){
                    Attribute::findorfail($ids)->delete();
                    $delete_or_no++;
                }

            }
            if($delete_or_no==0){
                toastr()->error(__('Admin/attributes.cant_delete'));
                return redirect()->route('Attributes.index');
            }else{
                toastr()->error(__('Admin/attributes.delete_done'));
                return redirect()->route('Attributes.index');
            }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('Attributes.index');
        }
    }// end of bulkDelete
}
