<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\ChickenProjectInterface;
use App\Models\ChickenProject;
use App\Models\Farmer;
use App\Models\Admin;
use App\Models\Area;
use App\Models\AreaTranslation;

use App\Models\State;
use App\Models\StateTranslation;

use App\Models\Village;
use App\Models\VillageTranslation;

use App\Models\AdminDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Auth;
use Yajra\DataTables\DataTables;
class ChickenProjectRepository implements ChickenProjectInterface{

    public function index()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->area == Null && $admin->state == null) {
            toastr()->error(__('Admin/animals.index-wrong'));

            return redirect()->back();
        } else {
            $areaID = $admin->area->id;
            $area_name = $admin->area->name;
            $stateID = $admin->state->id;
            $state_name = $admin->state->name;
            return view('dashboard.admin.chicken_projects.index',
                compact('admin','areaID','area_name','stateID','state_name'));
        }

    }
    public function data()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == 'employee') {
            $chickenProjects = ChickenProject::with('farmer', 'village', 'admin')
                ->where('admin_id', $admin->id);
        }else{
            $chickenProjects = ChickenProject::with('farmer', 'village', 'admin');
        }

        return DataTables::of($chickenProjects)
            ->addColumn('record_select', 'dashboard.admin.chicken_projects.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (ChickenProject $chickenProject ) {
                return $chickenProject ->created_at->diffforhumans();
            })
            ->editColumn('marketing_side', function (ChickenProject $chickenProject) {
                return view('dashboard.admin.chicken_projects.data_table.marketing_side', compact('chickenProject'));
            })
            ->editColumn('food_source', function (ChickenProject $chickenProject) {
                return view('dashboard.admin.chicken_projects.data_table.food_source', compact('chickenProject'));
            })
            ->editColumn('suse_source', function (ChickenProject $chickenProject) {
                return view('dashboard.admin.chicken_projects.data_table.suse_source', compact('chickenProject'));
            })
            ->addColumn('farmer', function (ChickenProject $chickenProject) {
                return $chickenProject ->farmer->email;
            })
            ->addColumn('admin', function (ChickenProject $chickenProject) {
                return $chickenProject ->admin->firstname;
            })
            ->addColumn('village', function (ChickenProject $chickenProject) {
                return $chickenProject->village->name;
            })

            ->addColumn('actions', 'dashboard.admin.chicken_projects.data_table.actions')
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
        return view('dashboard.admin.chicken_projects.create',
            compact('admin', 'area_name','areaID', 'villages','state_name','stateID','adminId'));
    }
    public function store($request)

    {
        try {
            $requestData = $request->validated();
            $chicken = ChickenProject::create([
           'farmer_id' => $requestData['farmer_id'],
           'village_id' => $requestData['village_id'],
            'admin_id' => $requestData['admin_id'],
           'area_id'=>  $requestData['area_id'],
           'state_id'=>  $requestData['state_id'],
           'project_name' => $requestData['project_name'],
           'hall_num' => $requestData['hall_num'],
           'power' => $requestData['power'],
           'food_source' => $requestData['food_source'],
            'suse_source'=> $requestData['suse_source'],
            'marketing_side' => $requestData['marketing_side'],
            'cost'=> $requestData['cost']
            ]);


            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Chickens.index');


        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));

            return redirect()->back();
        }

    }
    public function edit($id)
    {

        $animalID = Crypt::decrypt($id);
        $chicken = ChickenProject::findorfail($animalID);
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        $areas = Area::all();
        $states = State::all();
        $villages = Village::where('state_id',$stateID)->get();

        return view('dashboard.admin.chicken_projects.edit',
            compact('admin', 'adminId','area_name', 'areas','areaID', 'villages','states','state_name','stateID','chicken'));
    }

    public function update($request,$id)

    {
        try {
            $animalID = Crypt::decrypt($id);
            $requestData = $request->validated();
            $chicken = ChickenProject::findorfail($animalID);

            $chicken->admin_id =  $requestData['admin_id'];
            $chicken->farmer_id = $requestData['farmer_id'];
            $chicken->village_id = $requestData['village_id'];
            $chicken->area_id =  $requestData['area_id'];
            $chicken->state_id =  $requestData['state_id'];
            $chicken->project_name = $requestData['project_name'];
            $chicken->hall_num = $requestData['hall_num'];
            $chicken->power = $requestData['power'];
            $chicken->food_source = $requestData['food_source'];
            $chicken->suse_source = $requestData['suse_source'];

            $chicken->marketing_side = $requestData['marketing_side'];
            $chicken->cost = $requestData['cost'];


            $chicken->update($requestData);

            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('Chickens.index');


        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));

            return redirect()->back();
        }

    }

    public function destroy($id)
    {
        try{
            $animalID = Crypt::decrypt($id);

            $chicken = ChickenProject::findorfail($animalID);

            $chicken->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('Chickens.index');
        }catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();
        }




    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $animal_id) {

                    $animal = ChickenProject::findorfail($animal_id);

                    $animal->delete();
//                    ChickenProject::destroy($animal_id);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('Chickens.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('Chickens.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();
//            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete

    public  function chicken_statistic_index(){
        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);
        return view('dashboard.admin.chicken_projects.chicken_statistics',compact('admin'));

    }

    public function chicken_project_statistics($request)
    {
        $validated = $request->validate([

                'area_id' => 'sometimes|nullable|exists:areas,id',
                'state_id' => 'sometimes|nullable|exists:states,id',
                'village_id'=>'sometimes|nullable|exists:villages,id',
                'marketing_side'=>'sometimes|nullable|in:private,govermental',
                'food_source'=>'sometimes|nullable|in:local,imorted',
                'suse_source'=>'sometimes|nullable|in:local,imorted',

            ]
            , [
            'area_id.exists' => trans('Admin/validation.exists'),
            'state_id.exists' => trans('Admin/validation.exists'),
            'village_id.exists' => trans('Admin/validation.exists'),
        ]
        );
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);

        if (!empty($request->area_id)) {
            $area_name = AreaTranslation::where('area_id', '=', $request->area_id)->pluck('name');

        }
        if (!empty($request->state_id)) {
            $state_name = StateTranslation::where('state_id', '=', $request->state_id)->pluck('name');
        }
        if (!empty($request->village_id)) {
            $village_name = VillageTranslation::where('village_id', '=', $request->village_id)->pluck('name');
        }
        $food_source = $request->food_source;
        $suse_source = $request->suse_source;
        $marketing_side = $request->marketing_side;





        if ($admin->type = 'admin') {

            if ($request->area_id != null && $request->state_id != null &&
                $request->village_id != null && $request->food_source != null &&
                $request->suse_source != null && $request->marketing_side != null) {
                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('chicken_projects.marketing_side', $marketing_side)
                    ->where('chicken_projects.food_source', $food_source)
                    ->where('chicken_projects.suse_source', $suse_source)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));

            }


            elseif ($request->area_id != null && $request->state_id == null &&
                $request->village_id == null && $request->food_source == null &&
                $request->suse_source == null && $request->marketing_side == null)
            {
                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));

            }


            elseif ($request->area_id != null && $request->state_id != null && $request->village_id
                != null && $request->food_source == null && $request->suse_source == null
                && $request->marketing_side == null) {
                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)

                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));

            }

            elseif ($request->area_id != null && $request->state_id != null &&
                $request->village_id != null && $request->food_source != null &&
                $request->suse_source != null && $request->marketing_side == null) {
                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('chicken_projects.food_source', $food_source)
                    ->where('chicken_projects.suse_source', $suse_source)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));

            }


            elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null
                && $request->food_source == null && $request->suse_source != null &&
                $request->marketing_side != null) {
                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('chicken_projects.marketing_side', $marketing_side)
                    ->where('chicken_projects.suse_source', $suse_source)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));

            }


            elseif ($request->area_id != null && $request->state_id != null &&
                $request->village_id == null && $request->food_source != null &&
                $request->suse_source == null && $request->marketing_side != null) {
                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('chicken_projects.marketing_side', $marketing_side)
                    ->where('chicken_projects.food_source', $food_source)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));

            }


            elseif ($request->area_id != null && $request->state_id != null &&
                $request->village_id == null && $request->food_source != null
                && $request->suse_source != null && $request->marketing_side == null) {
                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('chicken_projects.food_source', $food_source)
                    ->where('chicken_projects.suse_source', $suse_source)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));

            }


            elseif ($request->area_id != null && $request->state_id == null &&
                $request->village_id == null && $request->food_source != null &&
                $request->suse_source != null && $request->marketing_side != null) {
                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('chicken_projects.marketing_side', $marketing_side)
                    ->where('chicken_projects.food_source', $food_source)
                    ->where('chicken_projects.suse_source', $suse_source)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));

            }


            elseif ($request->area_id != null && $request->state_id == null &&
                $request->village_id == null && $request->food_source != null &&
                $request->suse_source == null && $request->marketing_side != null) {
                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('chicken_projects.marketing_side', $marketing_side)
                    ->where('chicken_projects.food_source', $food_source)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));

            }
            elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null
                && $request->food_source != null && $request->suse_source != null
                && $request->marketing_side == null) {
                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('chicken_projects.food_source', $food_source)
                    ->where('chicken_projects.suse_source', $suse_source)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));

            }
            elseif ($request->area_id != null && $request->state_id == null &&
                $request->village_id == null && $request->food_source == null
                && $request->suse_source == null && $request->marketing_side != null) {
                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('chicken_projects.marketing_side', $marketing_side)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));

            }
            elseif ($request->area_id == null && $request->state_id == null &&
                $request->village_id == null && $request->food_source == null
                && $request->suse_source == null && $request->marketing_side == null) {
                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));

            }
            elseif ($request->area_id != null && $request->state_id != null &&
                $request->village_id != null && $request->food_source != null &&
                $request->suse_source == null && $request->marketing_side == null) {
                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('chicken_projects.food_source', $food_source)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));

            }


        }
        elseif ($admin->type = 'employee') {

            $area_id = $admin->area_id;
            $state_id = $admin->state_id;

            if ($request->village_id != null && $request->food_source != null &&
                $request->suse_source != null && $request->marketing_side != null) {


                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('chicken_projects.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('chicken_projects.marketing_side', $marketing_side)
                    ->where('chicken_projects.food_source', $food_source)
                    ->where('chicken_projects.suse_source', $suse_source)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));
            }

            elseif ($request->village_id != null && $request->food_source == null &&
                $request->suse_source != null && $request->marketing_side == null) {


                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('chicken_projects.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('chicken_projects.suse_source', $suse_source)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));
            }

            elseif ($request->village_id != null && $request->food_source == null &&
                $request->suse_source == null && $request->marketing_side == null) {


                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('chicken_projects.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)

                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));
            }

            elseif ($request->village_id != null && $request->food_source != null &&
                $request->suse_source != null && $request->marketing_side == null) {

                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('chicken_projects.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('chicken_projects.food_source', $food_source)
                    ->where('chicken_projects.suse_source', $suse_source)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));
            }

            elseif ($request->village_id != null && $request->food_source != null &&
                $request->suse_source == null && $request->marketing_side == null) {

                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('chicken_projects.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('chicken_projects.food_source', $food_source)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));
            }

            elseif ($request->village_id != null && $request->food_source == null &&
                $request->suse_source == null && $request->marketing_side == null) {

                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('chicken_projects.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));
            }
            elseif ($request->village_id == null && $request->food_source == null &&
                $request->suse_source == null && $request->marketing_side == null) {

                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('chicken_projects.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));
            }


            elseif ($request->village_id != null && $request->food_source != null
                && $request->suse_source == null && $request->marketing_side != null) {

                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('chicken_projects.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('chicken_projects.marketing_side', $marketing_side)
                    ->where('chicken_projects.food_source', $food_source)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));
            }

            elseif ($request->village_id != null && $request->food_source == null &&
                $request->suse_source != null && $request->marketing_side != null) {

                $chicken_statistics = ChickenProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                    , 'chicken_projects.project_name as project_name', 'chicken_projects.hall_num as hall_num',
                    'chicken_projects.power as power',
                    'chicken_projects.suse_source as suse_source',
                    'chicken_projects.marketing_side as marketing_side', 'chicken_projects.food_source as food_source')
                    ->join('area_translations', 'chicken_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'chicken_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'chicken_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'chicken_projects.farmer_id', '=', 'farmers.id')
                    ->where('chicken_projects.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('chicken_projects.marketing_side', $marketing_side)
                    ->where('chicken_projects.suse_source', $suse_source)
                    ->get();
                return view('dashboard.admin.chicken_projects.chicken_statistics', compact('admin', 'chicken_statistics'));
            }

        }

    }

}