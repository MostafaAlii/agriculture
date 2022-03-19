<?php
namespace App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\AreaInterface;
use App\Models\Province;
use App\Models\Area;
use App\Models\State;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
class AreaRepository implements AreaInterface {
    public function index() {
        $provencies = Province::get();
        return view('dashboard.admin.areas.index', compact('provencies'));
    }

    public function data() {
        $areas = Area::with(['province','states']);
        return DataTables::of($areas)
            ->addColumn('province', function (Area $area) {
                return $area->province->name;
            })
            ->addColumn('states', function (Area $area) {
                return view('dashboard.admin.areas.btn.related', compact('area'));
            })
            ->addColumn('record_select', 'dashboard.admin.areas.data_table.record_select')
            ->editColumn('created_at', function (Area $area) {
                return $area->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.areas.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store($request) {
        Area::create([
            'name'  => $request->input('name'),
            'province_id'    =>  $request->province_id,
        ]);
        toastr()->success(__('Admin/site.added_successfully'));
        return redirect()->route('Areas.index');
    }

    public function edit($id) {
        $areaID = Crypt::decrypt($id);
        $area=Area::findorfail($areaID);
        $proviences = Province::get();
        return view('dashboard.admin.areas.data_table.edit', compact('area', 'proviences'));
    }

    public function update($request,$id) {
        $areaID = Crypt::decrypt($id);
        $area=Area::findorfail($areaID);
        $area->update([
            'name'  => $request->input('name'),
            'province_id'    =>  $request->province_id,
        ]);
        toastr()->success(__('Admin/site.added_successfully'));
        return redirect()->route('Areas.index');
    }

    public function destroy($id) {
        $data = [];
        $areaID = Crypt::decrypt($id);
        $data['state'] = State::where('area_id', $areaID)->pluck('area_id'); 
        if($data['state']->count() == 0) {
            $area=Area::findorfail($areaID);
            $area->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('Areas.index');
        } else {
            toastr()->error(__('Admin/areas.cant_delete'));
            return redirect()->route('Areas.index');
        }
    }
}