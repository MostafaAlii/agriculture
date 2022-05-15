<?php
namespace  App\Http\Repositories\Admin;
use App\Models\BeeKeeper;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Village;
use App\Models\CourseBee;
use App\Models\BeeDisaster;
use App\Models\Unit;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Auth;
use Yajra\DataTables\DataTables;
use App\Http\Interfaces\Admin\BeekeeperInterface;
class BeekeeperRepository implements BeekeeperInterface {
    public function index(){
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        return view('dashboard.admin.beekeepers.index',
                    compact('admin','area_name','state_name'));


    }


    public function data()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == 'employee') {
            $beekeepers = BeeKeeper::with('admin','farmer', 'village', 'coursebees', 'beedisasters','area','state')
                ->where('admin_id','==',$admin->id )

            ->selectRaw('distinct bee_keepers.*')->get();
        }else{
            $beekeepers = BeeKeeper::with('admin','farmer', 'village', 'coursebees', 'beedisasters')
                ->selectRaw('distinct bee_keepers.*')->get();
        }
        return DataTables::of($beekeepers)
            ->addColumn('record_select', 'dashboard.admin.beekeepers.data_table.record_select')
            ->addIndexColumn()

            ->editColumn('created_at', function (BeeKeeper $beekeeper) {
                return $beekeeper ->created_at->diffforhumans();
            })
            ->editColumn('supported_side', function (BeeKeeper $beekeeper) {
                return view('dashboard.admin.beekeepers.data_table.supported_side', compact('beekeeper'));
            })

            ->editColumn('supported_side', function (BeeKeeper $beekeeper) {
                return view('dashboard.admin.beekeepers.data_table.supported_side', compact('beekeeper'));
            })
            ->addColumn('farmer', function (BeeKeeper $beekeeper) {
                return $beekeeper ->farmer->email;
            })
            ->addColumn('admin', function (BeeKeeper $beekeeper) {
                return $beekeeper ->admin->firstname;
            })

            ->addColumn('area', function (BeeKeeper $beekeeper) {
                return $beekeeper->area->name;

            })

            ->addColumn('state', function (BeeKeeper $beekeeper) {
                return $beekeeper->state->name;

            })

            ->addColumn('village', function (BeeKeeper $beekeeper) {
                return $beekeeper->village->name;

            })

            ->addColumn('c_name', function ($beekeeper) {
                return implode(', ', $beekeeper->coursebees->pluck('name')->toArray());
            })->rawColumns(['c_name'])

            ->addColumn('d_name', function ($beekeeper) {
                return implode(', ', $beekeeper->beedisasters->pluck('name')->toArray());
            }) ->rawColumns(['d_name'])
            ->addColumn('actions', 'dashboard.admin.beekeepers.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }
    public function create()
    {
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;

        $villages = Village::where('state_id',$stateID)->get();
        $courses = CourseBee::all();
        $disasters = BeeDisaster::all();
        $units = Unit::all();

        return view('dashboard.admin.beekeepers.create',
            compact( 'admin', 'villages','area_name','areaID','stateID','state_name',
                'disasters', 'courses', 'units'));
    }



    public function store(  $request)

    {
        DB::beginTransaction();
        try {
            $adminId = Auth::user()->id;
            $admin = Admin::findorfail($adminId);
            $areaID = $admin->area->id;
            $area_name = $admin->area->name;
            $stateID = $admin->state->id;
            $requestData = $request->validated();
            $beekeeper = new BeeKeeper();
            $beekeeper->admin_id = $admin->id;
            $beekeeper->farmer_id = $requestData['farmer_id'];
            $beekeeper->state_id = $stateID;
            $beekeeper->area_id = $areaID;
            $beekeeper->village_id = $requestData['village_id'];
            $beekeeper->died_beehive_count = $requestData['died_beehive_count'];
            $beekeeper->annual_new_product_beehive = $requestData['annual_new_product_beehive'];
            $beekeeper->annual_old_product_beehive = $requestData['annual_old_product_beehive'];
            $beekeeper->new_beehive_count = $requestData['new_beehive_count'];
            $beekeeper->old_beehive_count = $requestData['old_beehive_count'];
            $beekeeper->unit_id = $requestData['unit_id'];
            $beekeeper->supported_side = $requestData['supported_side'];
            $beekeeper->cost = $requestData['cost'];
            $beekeeper->phone = $requestData['phone'];
            $beekeeper->email = $requestData['email'];


            $beekeeper->save($requestData);
            $beekeeper->beedisasters()->attach($request->disasters);
            $beekeeper->coursebees()->attach($request->courses);


            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('BeeKeepers.index');


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
        $beekeeper = BeeKeeper::findorfail($id);

        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;

        $villages = Village::where('state_id',$stateID)->get();
        $courses = CourseBee::all();
        $disasters = BeeDisaster::all();
        $units = Unit::all();
        return view('dashboard.admin.beekeepers.edit',
            compact('villages', 'admin', 'areaID','area_name','state_name','stateID',
                'disasters', 'courses', 'units','beekeeper'));
    }

    public function update( $request, $id) {
        DB::beginTransaction();
        try {
            $adminId = Auth::user()->id;
            $admin = Admin::findorfail($adminId);
            $areaID = $admin->area->id;
            $stateID = $admin->state->id;
            $requestData = $request->validated();
            $beekeeper =  BeeKeeper::findorfail($id);
            $beekeeper->admin_id =  $admin->id;
            $beekeeper->farmer_id = $requestData['farmer_id'];
            $beekeeper->area_id = $areaID;
            $beekeeper->state_id = $stateID;
            $beekeeper->village_id = $requestData['village_id'];
            $beekeeper->died_beehive_count = $requestData['died_beehive_count'];
            $beekeeper->annual_new_product_beehive = $requestData['annual_new_product_beehive'];
            $beekeeper->annual_old_product_beehive = $requestData['annual_old_product_beehive'];
            $beekeeper->new_beehive_count = $requestData['new_beehive_count'];
            $beekeeper->old_beehive_count = $requestData['old_beehive_count'];
            $beekeeper->unit_id = $requestData['unit_id'];
            $beekeeper->supported_side= $requestData['supported_side'];
            $beekeeper->cost = $requestData['cost'];
            $beekeeper->phone = $requestData['phone'];
            $beekeeper->email = $requestData['email'];


            $beekeeper->update($requestData);
            $beekeeper->beedisasters()->sync($request->disasters);
            $beekeeper->coursebees()->sync($request->courses);


            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('BeeKeepers.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $beekeeperlID = Crypt::decrypt($id);
        $beekeeper = BeeKeeper::findorfail($beekeeperlID);

        $beekeeper->delete();
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('BeeKeepers.index');



    }

    public function bulkDelete( $request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $beekeeper_ids) {

                    $beekeeper = BeeKeeper::findorfail($beekeeper_ids);


                    BeeKeeper::destroy($beekeeper_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('BeeKeepers.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('BeeKeepers.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete

    public function statistics(){
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if($admin->type == 'employee'){
            $statistics = BeeKeeper::select('area_translations.name AS Area',
            'state_translations.name AS State',
                DB::raw("COUNT(bee_keepers.village_id) As village_count") ,

                DB::raw('SUM(bee_keepers.old_beehive_count) As new_beehive_count'),
                DB::raw('SUM(bee_keepers.new_beehive_count) As new_beehive_count'),
                DB::raw('COUNT(bee_keepers.id) As beehive_count'),
                DB::raw('COUNT(DISTINCT (bee_keepers.farmer_id)) As farmer_count'),
                DB::raw('SUM(bee_keepers.annual_new_product_beehive + bee_keepers.annual_old_product_beehive) As total_product'))

                ->join('area_translations', 'bee_keepers.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'bee_keepers.state_id', '=', 'state_translations.id')

                ->where('bee_keepers.admin_id',$admin->id)

                ->GroupBy('Area','State'
                )->get();
        }elseif ($admin->type == 'admin'){
            $statistics = BeeKeeper::select('area_translations.name AS Area',
                'state_translations.name AS State',
                DB::raw("COUNT(bee_keepers.village_id) As village_count") ,

                DB::raw('SUM(bee_keepers.old_beehive_count) As new_beehive_count'),
                DB::raw('SUM(bee_keepers.new_beehive_count) As new_beehive_count'),
                DB::raw('COUNT(bee_keepers.id) As beehive_count'),
                DB::raw('COUNT(DISTINCT (bee_keepers.farmer_id)) As farmer_count'),
                DB::raw('SUM(bee_keepers.annual_new_product_beehive + bee_keepers.annual_old_product_beehive) As total_product'))
                ->join('area_translations', 'bee_keepers.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'bee_keepers.state_id', '=', 'state_translations.id')

                ->GroupBy('Area','State'
                )->get();
        }

        return view('dashboard.admin.beekeepers.beekeepers_statistics',compact('statistics'));
    }

    public function beekeeper_details_statistics(){
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if($admin->type == 'employee') {
            $statistics = BeeKeeper::select('area_translations.name AS Area',
                'state_translations.name AS State', 'village_translations.name AS Village', 'farmers.firstname AS farmer',
                'bee_keepers.old_beehive_count as old_beehive_count', 'bee_keepers.new_beehive_count',
                'bee_keepers.annual_new_product_beehive as annual_new_product_beehive',
                'bee_keepers.annual_old_product_beehive as annual_old_product_beehive',
                'bee_keepers.supported_side as supported_side', 'bee_keepers.cost as cost')
                ->join('area_translations', 'bee_keepers.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'bee_keepers.state_id', '=', 'state_translations.id')
                ->join('village_translations', 'bee_keepers.village_id', '=', 'village_translations.id')
                ->join('farmers', 'bee_keepers.farmer_id', '=', 'farmers.id')
                ->where('bee_keepers.admin_id',$admin->id)

                ->get();
        }
        elseif ($admin->type == 'admin'){
            $statistics = BeeKeeper::select('area_translations.name AS Area',
                'state_translations.name AS State', 'village_translations.name AS Village', 'farmers.firstname AS farmer',
                'bee_keepers.old_beehive_count as old_beehive_count', 'bee_keepers.new_beehive_count',
                'bee_keepers.annual_new_product_beehive as annual_new_product_beehive',
                'bee_keepers.annual_old_product_beehive as annual_old_product_beehive',
                'bee_keepers.supported_side as supported_side', 'bee_keepers.cost as cost')
                ->join('area_translations', 'bee_keepers.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'bee_keepers.state_id', '=', 'state_translations.id')
                ->join('village_translations', 'bee_keepers.village_id', '=', 'village_translations.id')
                ->join('farmers', 'bee_keepers.farmer_id', '=', 'farmers.id')

                ->get();

        }
        return view('dashboard.admin.beekeepers.beekeepers_details_statistics',compact('statistics'));
    }
}