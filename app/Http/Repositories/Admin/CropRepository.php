<?php
namespace  App\Http\Repositories\Admin;
use App\Models\Crop;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\Admin\CropInterface;
class CropRepository implements CropInterface{
    public function index() {
        return view('dashboard.admin.crops.index');

    }
    public function data() {

        $crops = Crop::query();
        return DataTables::of($crops)

            ->addColumn('record_select', 'dashboard.admin.crops.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Crop $crop) {
                return $crop->created_at->diffforhumans();
            })

            ->addColumn('actions', 'dashboard.admin.crops.data_table.actions')

            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store( $request) {
        DB::beginTransaction();
        try{
            $validated = $request->validated();
            $crop= Crop::create([
                'crop_type'=>$validated['type'],

            ]);


            $crop->name = $validated['name'];
            $crop->save();

            DB::commit();

            toastr()->success(__('Admin/crops.added_successfully'));
            return redirect()->route('Crops.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }



    }
    public function update( $request,$id) {

        try{
            DB::beginTransaction();

           $cropID = Crypt::decrypt($id);
            $validated = $request->validated();

            $crop=Crop::findorfail($cropID);
            $crop->crop_type = $validated['type'];
            $crop->name = $validated['name'];

            $crop->update($validated);

            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('Crops.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }



    public function destroy($id) {

        $cropID = Crypt::decrypt($id);
        $crop = Crop::findorfail($cropID)->first();
        Crop::destroy($cropID);
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('Crops.index');


    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $crop_ids) {

                    Crop::destroy($crop_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('Crops.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('Crops.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete

}