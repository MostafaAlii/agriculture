<?php
namespace App\Http\Repositories\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Village;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
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
        State::create([
            'name'  => $request->input('name'),
            'area_id'    =>  $request->area_id,
        ]);
        toastr()->success(__('Admin/site.added_successfully'));
        return redirect()->route('States.index');
    }

    public function edit($id) {
        $stateID = Crypt::decrypt($id);
        $state=State::findorfail($stateID);
        $areas = Area::get();
        return view('dashboard.admin.states.data_table.edit', compact('state', 'areas'));
    }

    public function update($request,$id) {
        $stateID = Crypt::decrypt($id);
        $state=State::findorfail($stateID);
        $state->update([
            'name'  => $request->input('name'),
            'area_id'    =>  $request->area_id,
        ]);
        toastr()->success(__('Admin/site.added_successfully'));
        return redirect()->route('States.index');
    }

    public function destroy($id) {
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
    }
}