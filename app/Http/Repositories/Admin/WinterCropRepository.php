<?php

namespace App\Http\Repositories\Admin;

use App\Models\WinterCrop;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\Admin\WinterCropInterface;

class WinterCropRepository implements WinterCropInterface
{
    public function index()
    {
        return view('dashboard.admin.winter_crops.index');

    }

    public function data()
    {

        $winter_crops = WinterCrop::query();
        return DataTables::of($winter_crops)
            ->addColumn('record_select', 'dashboard.admin.winter_crops.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (WinterCrop $winter_crop) {
                return $winter_crop->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.winter_crops.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();
    }

    public function store($request)
    {
        try {
            $validated = $request->validated();

            $winter_crop = new WinterCrop();
            $winter_crop->name = $validated['name'];
            $winter_crop->save();


            toastr()->success(__('Admin/winter_crops.added_successfully'));
            return redirect()->route('WinterCrops.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));
            return redirect()->back();
        }


    }

    public function update($request, $id)
    {

        try {
            $WcropID = Crypt::decrypt($id);
            $validated = $request->validated();

            $winter_crop = WinterCrop::findorfail($WcropID);
            $winter_crop->name = $validated['name'];

            $winter_crop->update($validated);

            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('WinterCrops.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));
            return redirect()->back();

        }


    }


    public function destroy($id)
    {
        try {
            $wcropID = Crypt::decrypt($id);
            $winter_crop = WinterCrop::findorfail($wcropID);
            $winter_crop->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('WinterCrops.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.delete_wrong'));
            return redirect()->back();

        }


    }

    public function bulkDelete($request)
    {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $crop_ids) {

                    WinterCrop::destroy($crop_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('WinterCrops.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('WinterCrops.index');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }// end of bulkDelete

}