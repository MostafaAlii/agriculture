<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\PrecipitationInterface;
use App\Models\Precipitation;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Unit;

use App\Models\AdminDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\DataTables;

class PrecipitationRepository implements PrecipitationInterface {
    public function index() {
        return view('dashboard.admin.precipitations.index') ;
    }

    public function data()
    {
        $precipitations = Precipitation::with('area', 'state');

        return DataTables::of($precipitations)
            ->addColumn('record_select', 'dashboard.admin.precipitations.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Precipitation $precipitation) {
                return $precipitation ->created_at->diffforhumans();
            })
            ->addColumn('area', function (Precipitation $precipitation) {
                return $precipitation->area->name;
            })
            ->addColumn('state', function (Precipitation $precipitation) {
                return $precipitation->state->name;
            })


            ->addColumn('actions', 'dashboard.admin.precipitations.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }

    public function create() {
        $areas = Area::all();
        $states = State::all();

        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();

        $units = Unit::all();


        return view('dashboard.admin.precipitations.create',
            compact( 'admin_dpartments', 'areas', 'states', 'units'));
    }

    public function store($request) {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $precipitation = new Precipitation();
            $precipitation->admin_id = Auth::user()->id;
            $precipitation->area_id = $requestData['area_id'];
            $precipitation->state_id = $requestData['state_id'];
//            $orchard->admin_department_id = $requestData['admin_department_id'];
            $precipitation->admin_department_id = 1;
            $precipitation->precipitation_rate = $requestData['precipitation_rate'];
            $precipitation->date = $requestData['date'];
            $precipitation->unit_id = $requestData['unit_id'];



            $precipitation->save($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Precipitations.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }
    }

    public function show($id) {
        //
    }

    public function edit($id)
    {
        $preID = Crypt::decrypt($id);
        $areas = Area::all();
        $states = State::all();
        $precipitation = Precipitation::findorfail($preID);
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();
        $units = Unit::all();


        return view('dashboard.admin.precipitations.edit',
            compact('admin_dpartments', 'areas', 'states', 'units', 'precipitation'));
    }



    public function update( $request, $id) {
        DB::beginTransaction();
        try {
            $preID = Crypt::decrypt($id);
            $requestData = $request->validated();
            $precipitation = Precipitation::findorfail($preID);
            $precipitation->admin_id = Auth::user()->id;
            $precipitation->area_id = $requestData['area_id'];
            $precipitation->state_id = $requestData['state_id'];
//            $orchard->admin_department_id = $requestData['admin_department_id'];
            $precipitation->admin_department_id = 1;
            $precipitation->precipitation_rate = $requestData['precipitation_rate'];
            $precipitation->date = $requestData['date'];
            $precipitation->unit_id = $requestData['unit_id'];



            $precipitation->update($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Precipitations.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }
    }

    public function destroy($id) {
        $precipitationID = Crypt::decrypt($id);
        $precipitation = Precipitation::findorfail($precipitationID);


        $precipitation->delete();
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('Precipitations.index');

    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $precipitation_ids) {

                    $precipitation = Precipitation::findorfail($precipitation_ids);


                    Precipitation::destroy($precipitation_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('Precipitations.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('Precipitations.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete
}