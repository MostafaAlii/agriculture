<?php
namespace App\Http\Repositories\Admin;

use App\Models\Area;
use App\Models\State;
use App\Models\Village;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Interfaces\Admin\StateInterface;

class StateRepository implements StateInterface {
    public function index() {
        $areas = Area::get();
        return view('dashboard.admin.states.index', compact('areas'));
    }

    public function data() {
        $states = State::with(['area','villages']);
        return DataTables::of($states)
            ->addColumn('area', function (State $state) {
                return $state->area->name;
            })
            ->addColumn('villages', function (State $state) {
                return view('dashboard.admin.states.btn.related', compact('state'));
            })
            ->addColumn('record_select', 'dashboard.admin.states.data_table.record_select')
            ->editColumn('created_at', function (State $state) {
                return $state->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.states.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store($request) {
        try{
            State::create([
                'name'  => $request->input('name'),
                'area_id'    =>  $request->area_id,
            ]);
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('States.index');
        }catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.add_wrong'));

            return redirect()->back();

        }

    }

    public function edit($id) {
        $stateID = Crypt::decrypt($id);
        $state=State::findorfail($stateID);
        $areas = Area::get();
        return view('dashboard.admin.states.data_table.edit', compact('state', 'areas'));
    }

    public function update($request,$id) {
        try{
            $stateID = Crypt::decrypt($id);
            $state=State::findorfail($stateID);
            $state->update([
                'name'  => $request->input('name'),
                'area_id'    =>  $request->area_id,
            ]);
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('States.index');
        }catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));

            return redirect()->back();

        }

    }

    public function destroy($id) {
        try{
            $data = [];
            $stateID = Crypt::decrypt($id);
            $data['village'] = Village::where('state_id', $stateID)->pluck('state_id');
            if($data['village']->count() == 0) {
                $state=State::findorfail($stateID);
                $state->delete();
                toastr()->success(__('Admin/site.deleted_successfully'));
                return redirect()->route('States.index');
            } else {
                toastr()->error(__('Admin/states.cant_delete'));
                return redirect()->route('States.index');
            }

} catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $state_ids) {
//                    $state_ids = Crypt::decrypt($state_ids);
                    $state = State::findorfail($state_ids);
                    $villages = $state->villages->count();
                    if ($villages > 0) {
                        toastr()->error(__('Admin/site.delete_related_villages'));
                        return redirect()->route('States.index');
                    }

                    State::destroy($state_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('States.index');
            }
            else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('States.index');
            }

        }catch (\Exception $e) {
            DB::rollBack();
            toastr()->success(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }// end of bulkDelete
}