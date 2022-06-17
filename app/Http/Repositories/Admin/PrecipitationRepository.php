<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\PrecipitationInterface;
use App\Models\Precipitation;
use App\Models\Admin;
use App\Models\Area;
use App\Models\AreaTranslation;
use App\Models\StateTranslation;
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

class PrecipitationRepository implements PrecipitationInterface
{
    public function index()
    {
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        return view('dashboard.admin.precipitations.index',
            compact('area_name', 'state_name', 'admin'));
    }

    public function data()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);

        if ($admin->type == 'employee') {
            $precipitations = Precipitation::with('admin', 'area', 'state')
                ->where('admin_id',  $admin->id)->get();
        } else {
            $precipitations = Precipitation::with('admin', 'area', 'state')->get();
        }
        return DataTables::of($precipitations)
            ->addColumn('record_select', 'dashboard.admin.precipitations.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Precipitation $precipitation) {
                return $precipitation->created_at->diffforhumans();
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

    public function create()
    {
        $areas = Area::all();
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        $units = Unit::all();


        return view('dashboard.admin.precipitations.create',
            compact('area_name', 'areas', 'state_name', 'units', 'admin','adminId'));
    }

    public function store($request)
    {
        try {
            $requestData = $request->validated();
            $precipitation = new Precipitation();
            $precipitation->admin_id = $requestData['admin_id'];
            $precipitation->area_id = $requestData['area_id'];
            $precipitation->state_id = $requestData['state_id'];
            $precipitation->precipitation_rate = $requestData['precipitation_rate'];
            $precipitation->date = $requestData['date'];
            $precipitation->unit_id = $requestData['unit_id'];


            $precipitation->save($requestData);

            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Precipitations.index');


        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));
            return redirect()->back();
        }
    }

    public function show($id)
    {
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
            compact('areas', 'state_name', 'area_name', 'admin','adminId', 'units', 'precipitation'));
    }


    public function update($request, $id)
    {
        try {
            $preID = Crypt::decrypt($id);
            $requestData = $request->validated();
            $precipitation = Precipitation::findorfail($preID);
            $precipitation->admin_id = $requestData['admin_id'];
            $precipitation->area_id = $requestData['area_id'];
            $precipitation->state_id = $requestData['state_id'];
            $precipitation->precipitation_rate = $requestData['precipitation_rate'];
            $precipitation->date = $requestData['date'];
            $precipitation->unit_id = $requestData['unit_id'];


            $precipitation->update($requestData);

            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Precipitations.index');


        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try{
            $precipitationID = Crypt::decrypt($id);
            $precipitation = Precipitation::findorfail($precipitationID);


            $precipitation->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('Precipitations.index');
        }catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.delete_wrong'));
            return redirect()->back();
        }


    }

    public function bulkDelete($request)
    {
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
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }// end of bulkDelete

    public function index_statistic()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);

        return view('dashboard.admin.precipitations.statistics',compact('admin'));

    }

    public function get_custom_statistics($request)
    {
        $validated = $request->validate([
            'area_id' => 'sometimes|nullable|exists:areas,id',

            'start_date' => 'sometimes|nullable|date|before:end_date',
            'end_date' => 'sometimes|nullable|date|after:start_date',
        ],[
            'area_id.exists'=>trans('Admin/validation.exists'),
            'start_date.date'=>trans('Admin/validation.date'),
            'start_date.before'=>trans('Admin/validation.before'),
            'end_date.date'=>trans('Admin/validation.date'),
            'end_date.after'=>trans('Admin/validation.after'),
        ]);

        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);

        if (!empty($request->area_id)) {
            $area_name = AreaTranslation::where('area_id', '=', $request->area_id)->pluck('name');

        }
        if (!empty($request->state_id)) {
            $state_name = StateTranslation::where('state_id', '=', $request->state_id)->pluck('name');
        }

        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);

        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        $state_id = (!empty($_GET["state_id"])) ? ($_GET["state_id"]) : ('');
        $area_id = (!empty($_GET["area_id"])) ? ($_GET["area_id"]) : ('');

        $latests = \DB::table('precipitations')->orderBy('date','desc')->first();
        $oldest = \DB::table('precipitations')->orderBy('date','asc')->first();

if($admin->type == 'admin'){
    if ($start_date!=null  && $start_date>=$oldest && $end_date!= null && $end_date<=$latests &&
        $request->area_id !=null && $request->state_id !=null ) {
        $precipitationQuery1 = Precipitation::query();

        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        $precipitationQuery = $precipitationQuery1->whereRaw("date(precipitations.date) >= '" . $start_date . "'
             AND date(precipitations.date) <= '" . $end_date . "'");

        $precipitations = $precipitationQuery->select(
            'state_translations.name AS state','area_translations.name AS area',
            'precipitations.date as date',
            DB::raw('AVG(precipitations.precipitation_rate) As precipitation_rate')
        )
            ->join('area_translations', 'precipitations.area_id', '=', 'area_translations.id')
            ->join('state_translations', 'precipitations.state_id', '=', 'state_translations.id')
            ->where('area_translations.name',$area_name)
            ->where('state_translations.name',$state_name)
            ->groupBy ('area','state','date')->get();
        return view('dashboard.admin.precipitations.statistics',compact('admin','precipitations'));
    }
    elseif ($start_date!=null  && $start_date>=$oldest && $end_date!= null && $end_date<=$latests && $request->area_id !=null && $request->state_id ==null) {
        $precipitationQuery1 = Precipitation::query();

        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        $precipitationQuery = $precipitationQuery1->whereRaw("date(precipitations.date) >= '" . $start_date . "'
             AND date(precipitations.date) <= '" . $end_date . "'");
        $precipitations = $precipitationQuery->select(
            'state_translations.name AS state','area_translations.name AS area',
            'precipitations.date as date',
            DB::raw('AVG(precipitations.precipitation_rate) As precipitation_rate')
        )
            ->join('area_translations', 'precipitations.area_id', '=', 'area_translations.id')
            ->join('state_translations', 'precipitations.state_id', '=', 'state_translations.id')
            ->where('area_translations.name',$area_name)
            ->groupBy ('area','state','date')->get();
        return view('dashboard.admin.precipitations.statistics',compact('admin','precipitations'));
    }
    elseif ($start_date==null  && $end_date == null &&  $request->area_id !=null && $request->state_id !=null) {

        $precipitations = Precipitation::select(
            'state_translations.name AS state','area_translations.name AS area',
            'precipitations.date as date',
            DB::raw('AVG(precipitations.precipitation_rate) As precipitation_rate')
        )
            ->join('area_translations', 'precipitations.area_id', '=', 'area_translations.id')
            ->join('state_translations', 'precipitations.state_id', '=', 'state_translations.id')
            ->where('area_translations.name',$area_name)
            ->where('state_translations.name',$state_name)
            ->groupBy ('area','state','date')->get();
        return view('dashboard.admin.precipitations.statistics',compact('admin','precipitations'));
    }
    elseif ($start_date==null  && $end_date == null &&  $request->area_id !=null && $request->state_id ==null) {

        $precipitations = Precipitation::select(
            'state_translations.name AS state','area_translations.name AS area',
            'precipitations.date as date',
            DB::raw('AVG(precipitations.precipitation_rate) As precipitation_rate')
        )
            ->join('area_translations', 'precipitations.area_id', '=', 'area_translations.id')
            ->join('state_translations', 'precipitations.state_id', '=', 'state_translations.id')
            ->where('area_translations.name',$area_name)
            ->groupBy ('area','state','date')->get();
        return view('dashboard.admin.precipitations.statistics',compact('admin','precipitations'));
    }

}elseif($admin->type == 'employee'){
    if ($start_date!=null  && $start_date>=$oldest && $end_date!= null && $end_date<=$latests && $request->state_id !=null) {
        $precipitationQuery1 = Precipitation::query();

        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        $precipitationQuery = $precipitationQuery1->whereRaw("date(precipitations.date) >= '" . $start_date . "'
             AND date(precipitations.date) <= '" . $end_date . "'");

        $precipitations = $precipitationQuery->select(
            'state_translations.name AS state','area_translations.name AS area',
            'precipitations.date as date',
            DB::raw('AVG(precipitations.precipitation_rate) As precipitation_rate')
        )
            ->join('area_translations', 'precipitations.area_id', '=', 'area_translations.id')
            ->join('state_translations', 'precipitations.state_id', '=', 'state_translations.id')
            ->where('state_translations.name',$state_name)
            ->groupBy ('area','state','date')->get();
        return view('dashboard.admin.precipitations.statistics',compact('admin','precipitations'));
    }
    elseif ($start_date!=null  && $start_date>=$oldest && $end_date!= null && $end_date<=$latests  && $request->state_id ==null) {
        $precipitationQuery1 = Precipitation::query();

        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        $precipitationQuery = $precipitationQuery1->whereRaw("date(precipitations.date) >= '" . $start_date . "'
             AND date(precipitations.date) <= '" . $end_date . "'");

        $precipitations = $precipitationQuery->select(
            'state_translations.name AS state','area_translations.name AS area',
            'precipitations.date as date',
            DB::raw('AVG(precipitations.precipitation_rate) As precipitation_rate')
        )
            ->join('area_translations', 'precipitations.area_id', '=', 'area_translations.id')
            ->join('state_translations', 'precipitations.state_id', '=', 'state_translations.id')
            ->groupBy ('area','state','date')->get();
        return view('dashboard.admin.precipitations.statistics',compact('admin','precipitations'));
    }
    elseif ($start_date==null  && $end_date == null &&   $request->state_id !=null) {

        $precipitations = Precipitation::select(
            'state_translations.name AS state','area_translations.name AS area',
            'precipitations.date as date',
            DB::raw('AVG(precipitations.precipitation_rate) As precipitation_rate')
        )
            ->join('area_translations', 'precipitations.area_id', '=', 'area_translations.id')
            ->join('state_translations', 'precipitations.state_id', '=', 'state_translations.id')
            ->where('state_translations.name',$state_name)
            ->groupBy ('area','state','date')->get();
        return view('dashboard.admin.precipitations.statistics',compact('admin','precipitations'));
    }

}


    }

}