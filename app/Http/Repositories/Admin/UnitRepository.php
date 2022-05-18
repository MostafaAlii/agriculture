<?php
namespace  App\Http\Repositories\Admin;
use App\Models\BeeKeeper;
use App\Models\Unit;
use App\Http\Interfaces\Admin\UnitInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class UnitRepository implements UnitInterface{

    public function index() {

           return view('dashboard.admin.units.index');
    }
    public function data() {

        $units = Unit::query();
        return DataTables::of($units)

            ->addColumn('record_select', 'dashboard.admin.units.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Unit $unit) {
                return $unit->created_at->diffforhumans();
            })

            ->addColumn('actions', 'dashboard.admin.units.data_table.actions')

            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }
    public function store($request) {
        DB::beginTransaction();
        try{
            $validated = $request->validated();

            Unit::create([
                'Name'=>$validated['Name']
            ]);

            DB::commit();

            toastr()->success(__('Admin/country.added_successfully'));
            return redirect()->route('Units.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function update( $request,$id) {

        try{
            DB::beginTransaction();

            $unitID = Crypt::decrypt($id);
            $unit=Unit::findorfail($unitID);
            $unit->Name = $request->Name;

            $unit->update();

            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('Units.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }

//    public function destroy($id) {
//        $data = [];
//
//        $unitID = Crypt::decrypt($id);
//
//        $data['beekeeper'] = BeeKeeper::where('unit_id', $unitID)->pluck('unit_id');
//        if($data['beekeeper']->count() == 0) {
//            $unit =Unit::findorfail($unitID);
//
//            $unit->delete();
//            toastr()->success(__('Admin/site.deleted_successfully'));
//            return redirect()->route('Units.index');
//        } else {
//            toastr()->error(__('Admin/site.cant_delete'));
//            return redirect()->route('Units.index');
//        }
//
//    }
//
//
//    public function bulkDelete($request)
//    {
//        try {
//            DB::beginTransaction();
//            if ($request->delete_select_id) {
//                $delete_select_id = explode(",", $request->delete_select_id);
//                foreach ($delete_select_id as $unit_ids) {
//                    $unit = Unit::findorfail($unit_ids);
//                    $beekeeper = $unit->beekeepers->count();
//                    if ($beekeeper > 0) {
//                        toastr()->error(__('Admin/countries.delete_related_trees'));
//                        return redirect()->route('Units.index');
//                    }
//
//                    Unit::destroy($unit_ids);
//                }
//                DB::commit();
//
//                toastr()->error(__('Admin/site.deleted_successfully'));
//                return redirect()->route('Units.index');
//            } else {
//                toastr()->error(__('Admin/site.no_data_found'));
//                return redirect()->route('Units.index');
//            }
//        } catch (\Exception $e) {
//            DB::rollBack();
//            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
//
//        }
//    }

}