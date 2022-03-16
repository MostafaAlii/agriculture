<?php
namespace App\Http\Repositories\Admin;
use App\Models\Area;
use App\Models\Province;
use App\Http\Interfaces\Admin\AreaInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
class AreaRepository implements AreaInterface{
    public function index() {
        return view('dashboard.admin.areas.index');
    }

    public function data() {
        $areas = Area::query();

        return DataTables::of($areas)
            ->editColumn('created_at', function (Area $area) {
                return $area->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'dashboard.admin.areas.data_table.actions')
            ->rawColumns([ 'actions'])
            ->toJson();
    }


    public function create() {
        $provinces = Province::all();
        return view('dashboard\admin\areas.create');

    }

    public function store($request) {

        DB::beginTransaction();
        try{
            $requestData = $request->validated();



            $area = Area::create($requestData);
            $area->name = $request->name;
            $area->save();
            DB::commit();

            toastr()->success(__('Admin/area.added_successfully'));
            return redirect()->route('areas.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function edit($id) {
        $id_area  = Crypt::decrypt($id);
        $area = Area::findorfail($id_area)->first();
        $provinces = Province::all();
        return view('dashboard.admin.areas.edit', compact('provinces','area'));
    }

    public function update( $request,$id) {
        try{
            $area=Area::findorfail($id);
            $requestData = $request->validated();
            $requestData['name'] = $request->name;
            $area->update($requestData);
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('areas.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id) {
        $area=Area::findorfail($id);
        $area->delete();
        toastr()->error(__('Admin/province.deleted_successfully'));
        return redirect()->route('areas.index');
    }
}