<?php
namespace App\Http\Repositories\Admin;
use App\Models\Country;
use App\Models\Area;
use App\Models\State;
use App\Http\Interfaces\Admin\StateInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
class StateRepository implements StateInterface{
    public function index() {
        return view('dashboard.admin.state.index');
    }

    public function data() {
        $states = State::query();

        return DataTables::of($states)
            ->editColumn('created_at', function (State $state) {
                return $state->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'dashboard.admin.state.data_table.actions')
            ->rawColumns([ 'actions'])
            ->toJson();
    }


    public function create() {
        $states = State::all();
        return view('dashboard\admin\state.create');

    }

    public function store($request) {

        DB::beginTransaction();
        try{
            $requestData = $request->validated();



            $state = State::create($requestData);
            $state->name = $request->name;
            $state->save();
            DB::commit();

            toastr()->success(__('Admin/province.added_successfully'));
            return redirect()->route('states.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function edit($id) {
        $id_state  = Crypt::decrypt($id);
        $state = State::findorfail($id_state)->first();
        $areas = Area::all();
        return view('dashboard.admin.state.edit', compact('areas','state'));
    }

    public function update( $request,$id) {
        try{
            $state=State::findorfail($id);
            $requestData = $request->validated();
            $requestData['name'] = $request->name;
            $state->update($requestData);
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('states.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id) {
        $state=State::findorfail($id);
        $state->delete();
        toastr()->error(__('Admin/state.deleted_successfully'));
        return redirect()->route('states.index');
    }
}