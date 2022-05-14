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
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        return view('dashboard.admin.precipitations.index',
            compact('area_name','state_name','admin')) ;
    }

    public function data()
    {
        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);
        $precipitationQuery = Precipitation::query();

        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');

        if($start_date && $end_date){

            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));

            $precipitationQuery->whereRaw("date(precipitations.date ) >= '" . $start_date . "' AND date(precipitations.date) <= '" . $end_date . "'");
        }
        $precipitations = $precipitationQuery->select('*');
        if ($admin->type == 'employee') {
            $precipitations->where('admin_id','==',$admin->id );}

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
            ->addColumn('admin', function (Precipitation $precipitation) {
                return $precipitation->admin->firstname;
            })


            ->addColumn('actions', 'dashboard.admin.precipitations.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }

    public function create() {
        $areas = Area::all();
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        $units = Unit::all();


        return view('dashboard.admin.precipitations.create',
            compact( 'area_name', 'areas','state_name', 'units','admin'));
    }

    public function store($request) {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $precipitation = new Precipitation();
            $precipitation->admin_id = Auth::user()->id;
            $precipitation->area_id = $requestData['area_id'];
            $precipitation->state_id = $requestData['state_id'];
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
        $precipitation = Precipitation::findorfail($preID);
        $areas = Area::all();
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        $units = Unit::all();



        return view('dashboard.admin.precipitations.edit',
            compact( 'areas','state_name' ,'area_name','admin','units', 'precipitation'));
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
    public function statistics(){

        $statistics = Precipitation::select('area_translations.name AS Area','state_translations.name AS State',
            DB::raw("EXTRACT(DAY FROM precipitations.date) As Day") ,
            DB::raw("EXTRACT(MONTH FROM precipitations.date) AS Month") ,
            DB::raw("EXTRACT(YEAR FROM precipitations.date) AS Year") ,
            DB::raw('SUM(precipitations.precipitation_rate) As precipitation_rate'))

            ->join('area_translations', 'precipitations.area_id', '=', 'area_translations.id')
            ->join('state_translations', 'precipitations.state_id', '=', 'state_translations.id')
            ->GroupBy('Area','State','Month','Year','Day')->get();

        return view('dashboard.admin.precipitations.statistics',compact('statistics'));}
}