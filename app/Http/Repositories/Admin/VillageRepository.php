<?php

namespace App\Http\Repositories\Admin;

use App\Models\Admin;
use App\Models\State;
use App\Models\Village;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Interfaces\Admin\VillageInterface;

class VillageRepository implements VillageInterface
{
    public function index()
    {
        $states = State::get();
        return view('dashboard.admin.villages.index', compact('states'));
    }

    public function data()
    {
        $villages = Village::with('state')->get();
        return DataTables::of($villages)
            ->addColumn('state', function (Village $village) {
                return $village->state->name;
            })
            ->addColumn('record_select', 'dashboard.admin.villages.data_table.record_select')
            ->editColumn('created_at', function (Village $village) {
                return $village->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.villages.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();
    }

    public function store($request)
    {
        try {
            Village::create([
                'name' => $request->input('name'),
                'state_id' => $request->state_id,
            ]);
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Villages.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));
            return redirect()->back();
        }

    }

    public function edit($id)
    {
        $villageID = Crypt::decrypt($id);
        $village = Village::findorfail($villageID);
        $states = State::get();
        return view('dashboard.admin.villages.data_table.edit', compact('village', 'states'));
    }

    public function update($request, $id)
    {
        try {
            $villageID = Crypt::decrypt($id);
            $village = Village::findorfail($villageID);
            $village->update([
                'name' => $request->input('name'),
                'state_id' => $request->state_id,
            ]);
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Villages.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));
            return redirect()->back();
        }

    }

    public function destroy($id)
    {
        try {
            $data = [];
            $villageID = Crypt::decrypt($id);
            $data['admin'] = Admin::where('village_id', $villageID)->pluck('village_id');
            if ($data['admin']->count() == 0) {
                $village = Village::findorfail($villageID);
                $village->delete();
                toastr()->success(__('Admin/site.deleted_successfully'));
                return redirect()->route('Villages.index');
            } else {
                toastr()->error(__('Admin/villages.cant_delete'));
                return redirect()->route('Villages.index');
            }
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.delete_related'));
            return redirect()->back();
        }


    }

    public function bulkDelete($request)
    {


        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $village_ids) {
//                    $village_ids = Crypt::decrypt($village_ids);

                    $village = Village::findorfail($village_ids);
                    $state = $village->state->count();
                    if ($state > 0) {
                        toastr()->error(__('Admin/site.delete_related'));
                        return redirect()->route('Villages.index');
                    }

                    Village::destroy($village_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('Villages.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('Villages.index');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/site.cant_delete_all'));

            return redirect()->back();

        }


    }// end of bulkDelete
}