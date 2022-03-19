<?php
namespace App\Http\Repositories\Admin;
use App\Models\Village;
use App\Models\State;
use App\Http\Interfaces\Admin\VillageInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
class VillageRepository implements VillageInterface{
    public function index() {
        return view('dashboard.admin.village.index');
    }

    public function data() {
        $villages = Village::query();

        return DataTables::of($villages)
            ->editColumn('created_at', function (Village $village) {
                return $village->created_at->format('Y-m-d');
            })
            ->addColumn('state', function (Village $village) {
                return $village->state->name;
            })
            ->addColumn('actions', 'dashboard.admin.village.data_table.actions')
            ->rawColumns([ 'actions'])
            ->toJson();
    }


    public function create() {
        $states = State::all();
        return view('dashboard\admin\village.create');

    }

    public function store($request) {

        DB::beginTransaction();
        try{
            $requestData = $request->validated();



            $village = Village::create($requestData);
            $village->name = $request->name;
            $village->save();
            DB::commit();

            toastr()->success(__('Admin/province.added_successfully'));
            return redirect()->route('villages.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function edit($id) {
        $id_village  = Crypt::decrypt($id);
        $village = Village::findorfail($id_village)->first();
        $states = State::all();
        return view('dashboard.admin.village.edit', compact('village','states'));
    }

    public function update( $request,$id) {
        try{
            $village=Village::findorfail($id);
            $requestData = $request->validated();
            $requestData['name'] = $request->name;
            $village->update($requestData);
            toastr()->success( __('Admin/village.updated_successfully'));
            return redirect()->route('villages.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id) {
        $village=Village::findorfail($id);
        $village->delete();
        toastr()->error(__('Admin/village.deleted_successfully'));
        return redirect()->route('villages.index');
    }
}