<?php
namespace  App\Http\Repositories\Admin;
use App\Models\SummerCrop;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\Admin\SummerCropInterface;
class SummerCropRepository implements SummerCropInterface{
    public function index() {
        return view('dashboard.admin.summer_crops.index');

    }
    public function data() {

        $summer_crops = SummerCrop::query();
        return DataTables::of($summer_crops)

            ->addColumn('record_select', 'dashboard.admin.summer_crops.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (SummerCrop $summer_crop) {
                return $summer_crop->created_at->diffforhumans();
            })

            ->addColumn('actions', 'dashboard.admin.summer_crops.data_table.actions')

            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store( $request) {
        DB::beginTransaction();
        try{
            $validated = $request->validated();

            $summer_crop = new SummerCrop();
            $summer_crop->name = $validated['name'];
            $summer_crop->save();

            DB::commit();

            toastr()->success(__('Admin/summer_crops.added_successfully'));
            return redirect()->route('SummerCrops.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }



    }
    public function update( $request,$id) {

        try{
            DB::beginTransaction();

           $WcropID = Crypt::decrypt($id);
            $validated = $request->validated();

            $summer_crop=SummerCrop::findorfail($WcropID);
            $summer_crop->name = $validated['name'];

            $summer_crop->update($validated);

            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('SummerCrops.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }



    public function destroy($id) {

        $wcropID = Crypt::decrypt($id);
        $summer_crop = SummerCrop::findorfail($wcropID)->first();
        SummerCrop::destroy($wcropID);
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('SummerCrops.index');


    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $crop_ids) {

                    SummerCrop::destroy($crop_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('SummerCrops.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('SummerCrops.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete

}