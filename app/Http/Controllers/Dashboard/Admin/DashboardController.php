<?php
namespace App\Http\Controllers\Dashboard\Admin;
use Illuminate\Http\Request;
use App\Events\Dashboard\MyEvent;
use App\Http\Controllers\Controller;
use App\Models\Precipitation;
use App\Models\Area;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {

    public function index(Request $request) {

        event(new MyEvent('agricultre project', auth()->user()->firstname . ' ' . auth()->user()->lastname));

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
        
        $area_id = (!empty($_GET["area_id"])) ? ($_GET["area_id"]) : ('');
        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');


        if($area_id && $start_date && $end_date){
            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));
            $precipitationQueryfirst = Precipitation::select(
                'state_translations.name AS State','area_translations.name AS area',
                DB::raw('AVG(precipitations.precipitation_rate) As precipitation_rate'))
                ->join('state_translations', 'precipitations.state_id', '=', 'state_translations.id')
                ->join('area_translations', 'precipitations.area_id', '=', 'area_translations.id')
                ->where('precipitations.area_id',$area_id)
                ->whereRaw("date(precipitations.date) >= '" . $start_date . "' AND date(precipitations.date) <= '" . $end_date . "'")
                ->groupBy ('State','area')->get();
        }elseif($area_id ){
            $precipitationQueryfirst = Precipitation::select(
                'state_translations.name AS State',
                DB::raw('AVG(precipitations.precipitation_rate) As precipitation_rate'))
                ->join('state_translations', 'precipitations.state_id', '=', 'state_translations.id')
                ->where('precipitations.area_id',$area_id)
                ->groupBy ('State')->get();
        }elseif($start_date && $end_date){
            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));
            $precipitationQueryfirst = Precipitation::select(
                'state_translations.name AS State',
                DB::raw('AVG(precipitations.precipitation_rate) As precipitation_rate'))
                ->join('state_translations', 'precipitations.state_id', '=', 'state_translations.id')
                ->whereRaw("date(precipitations.date) >= '" . $start_date . "' AND date(precipitations.date) <= '" . $end_date . "'")
                ->groupBy ('State')->get();
        }else{
            $precipitationQueryfirst = Precipitation::select(
                'state_translations.name AS State',
                DB::raw('AVG(precipitations.precipitation_rate) As precipitation_rate'))
                ->join('state_translations', 'precipitations.state_id', '=', 'state_translations.id')
                ->groupBy ('State')->get();
        }
        $data = [];

        foreach($precipitationQueryfirst as $row) {
            $data['label'][] = $row->State;
            $data['data'][] = (int) $row->precipitation_rate;
        }

        $data['chart_data'] = json_encode($data);
        return view('dashboard.admin.dashboard_index',$data);
    }
}
