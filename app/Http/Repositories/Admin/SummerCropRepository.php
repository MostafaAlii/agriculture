<?php

namespace App\Http\Repositories\Admin;

use App\Models\SummerCrop;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\Admin\SummerCropInterface;

class SummerCropRepository implements SummerCropInterface
{
    public function index()
    {
        return view('dashboard.admin.summer_crops.index');

    }

    public function data()
    {

        $summer_crops = SummerCrop::query()->get();
        return DataTables::of($summer_crops)
            ->addColumn('record_select', 'dashboard.admin.summer_crops.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (SummerCrop $summer_crop) {
                return $summer_crop->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.summer_crops.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();
    }

    public function store($request)
    {
        try {
            $validated = $request->validated();

            $summer_crop =  SummerCrop::create([
                'name'=>$validated['name']
            ]);


            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('SummerCrops.index');
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

            $summer_crop = SummerCrop::findorfail($WcropID);
            $summer_crop->name = $validated['name'];

            $summer_crop->update($validated);

            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('SummerCrops.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));
            return redirect()->back();

        }


    }


    public function destroy($id)
    {
        try {
            $wcropID = Crypt::decrypt($id);
            $summer_crop = SummerCrop::findorfail($wcropID);
            $summer_crop->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('SummerCrops.index');
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

                    SummerCrop::destroy($crop_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('SummerCrops.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('SummerCrops.index');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }// end of bulkDelete

}