<?php

namespace App\Http\Repositories\Admin;

use Illuminate\Http\Request;
use App\Models\BeeDisaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Auth;
use Yajra\DataTables\DataTables;
use App\Http\Interfaces\Admin\BeeDisasterInterface;

class BeeDisasterRepository implements BeeDisasterInterface
{
    public function index()
    {
        return view('dashboard.admin.bee_disasters.index');
    }

    public function data()
    {

        $bDisaster = BeeDisaster::query();
        return DataTables::of($bDisaster)
            ->addColumn('record_select', 'dashboard.admin.bee_disasters.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (BeeDisaster $bDisaster) {
                return $bDisaster->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.bee_disasters.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();
    }

    public function store($request)
    {
        try {
            $validated = $request->validated();
            $bDisaster = new BeeDisaster();
            $bDisaster->name = $validated['name'];
            $bDisaster->desc = $validated['desc'];
            $bDisaster->save();


            toastr()->success(__('Admin/country.added_successfully'));
            return redirect()->route('BeeDisasters.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));

            return redirect()->back();
        }


    }

    public function update($request, $id)
    {
        try {
            $validated = $request->validated();

            $bDisasterID = Crypt::decrypt($id);
            $bDisaster = BeeDisaster::findorfail($bDisasterID);

            $bDisaster->name = $validated['name'];
            $bDisaster->desc = $validated['desc'];
            $bDisaster->update();

            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('BeeDisasters.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));

            return redirect()->back();

        }


    }

    public function destroy($id)
    {
        try {
            $bDisasterID = Crypt::decrypt($id);
            $bDisaster = BeeDisaster::findorfail($bDisasterID);

            $bDisaster->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('BeeDisasters.index');
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
                foreach ($delete_select_id as $bee_disaster_ids) {
                    $bDisaster = BeeDisaster::findorfail($bee_disaster_ids);

                    $bDisaster->delete();
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('BeeDisasters.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('BeeDisasters.index');
            }
        } catch (\Exception $e) {
            DB::rollBack();

            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();


        }


    }// end of bulkDelete
}