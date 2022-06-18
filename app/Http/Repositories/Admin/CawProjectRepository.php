<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\CawProjectInterface;
use App\Models\CawProject;
use App\Models\Currency;
use App\Models\Farmer;
use App\Models\Admin;
use App\Models\Area;
use App\Models\AreaTranslation;
use App\Models\State;
use App\Models\StateTranslation;

use App\Models\Village;
use App\Models\VillageTranslation;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

use Auth;
use Yajra\DataTables\DataTables;

class CawProjectRepository implements CawProjectInterface{

    public function index()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);

        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        return view('dashboard.admin.caw_projects.index',
            compact('admin','areaID','area_name','stateID','state_name'));
    }


    public function data()    {

        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == 'employee') {
            $cawProjects = CawProject::with('farmer', 'village','admin','area','state')
                ->where('admin_id',$admin->id )->get();

          }
          else {
              $cawProjects = CawProject::with('farmer', 'village', 'admin','area','state')->get();
          }
            return DataTables::of($cawProjects)
                ->addColumn('record_select', 'dashboard.admin.caw_projects.data_table.record_select')
                ->addIndexColumn()
                ->editColumn('created_at', function (CawProject $cawProject) {
                    return $cawProject->created_at->diffforhumans();
                })

                 ->editColumn('type', function (CawProject $cawProject) {
                     return view('dashboard.admin.caw_projects.data_table.type', compact('cawProject'));
                })
                ->editColumn('marketing_side', function (CawProject $cawProject) {
                    return view('dashboard.admin.caw_projects.data_table.marketing_side', compact('cawProject'));
                })
                ->editColumn('food_source', function (CawProject $cawProject) {
                    return view('dashboard.admin.caw_projects.data_table.food_source', compact('cawProject'));
                })

                ->addColumn('farmer', function (CawProject $cawProject) {
                    return $cawProject->farmer->email;
                })
                ->addColumn('admin', function (CawProject $cawProject) {
                    return $cawProject->admin->firstname;
                })
                ->addColumn('area', function (CawProject $cawProject) {
                    return $cawProject->area->name;
                })
                ->addColumn('state', function (CawProject $cawProject) {
                    return $cawProject->state->name;
                })
                ->addColumn('village', function (CawProject $cawProject) {
                    return $cawProject->village->name;
                })
                ->addColumn('actions', 'dashboard.admin.caw_projects.data_table.actions')
                ->rawColumns(['record_select', 'actions'])
                ->toJson();

    }


    public function create()    {

        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        $areas = Area::all();
        $states = State::all();
        $currencies = Currency::all();
        $villages = Village::where('state_id',$stateID)->get();
        return view('dashboard.admin.caw_projects.create',
            compact('adminId', 'admin', 'areaID', 'area_name', 'currencies','villages','areas','states','state_name','stateID'));
    }


    public function store($request)    {

        try {

            $requestData = $request->validated();

            $cawproject = CawProject::create([
                'admin_id' => $requestData['admin_id'],
                'farmer_id' => $requestData['farmer_id'],
                'state_id' => $requestData['state_id'],
                'area_id' => $requestData['area_id'],
                'village_id' => $requestData['village_id'],
                'currency_id' => $requestData['currency_id'],
                'project_name' => $requestData['project_name'],
                'hall_num' => $requestData['hall_num'],
                'animal_count' => $requestData['animal_count'],
                'food_source' => $requestData['food_source'],
                'marketing_side' => $requestData['marketing_side'],
                'cost' => $requestData['cost'],
                'type' => $requestData['type'],

            ]);


            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Animals.index');


        } catch (\Exception $e) {
//            toastr()->error(__('Admin/attributes.add_wrong'));

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);        }

    }
    public function edit($id)
    {
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        $villages = Village::where('state_id',$stateID)->get();
        $animalID = Crypt::decrypt($id);
        $animal = CawProject::findorfail($animalID);
        $currencies = Currency::all();

        return view('dashboard.admin.caw_projects.edit',
            compact('area_name','state_name','admin','villages','currencies',
                'animal','adminId','stateID','areaID'));
    }

    public function update($request,$id)

    {
        try {
            $requestData = $request->validated();
            $animalID = Crypt::decrypt($id);
            $animal = CawProject::findorfail($animalID);
            $animal->area_id = $requestData['area_id'];
            $animal->admin_id = $requestData['admin_id'];
            $animal->state_id = $requestData['state_id'];


            $animal->farmer_id = $requestData['farmer_id'];
            $animal->village_id = $requestData['village_id'];
            $animal->currency_id = $requestData['currency_id'];

            $animal->project_name = $requestData['project_name'];
            $animal->hall_num = $requestData['hall_num'];
            $animal->animal_count = $requestData['animal_count'];
            $animal->food_source = $requestData['food_source'];
            $animal->marketing_side = $requestData['marketing_side'];
            $animal->cost = $requestData['cost'];
            $animal->type = $requestData['type'];



            $animal->update($requestData);

            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Animals.index');


        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));

            return redirect()->back();
        }

    }

    public function destroy($id)
    {
        try{
            $animalID = Crypt::decrypt($id);
            $animal = CawProject::findorfail($animalID);

            $animal->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('Animals.index');
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
                foreach ($delete_select_id as $animal_ids) {

                    $animal = CawProject::findorfail($animal_ids);


                    CawProject::destroy($animal_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('Animals.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('Animals.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }// end of bulkDelete


    public  function index_statistics(){
        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);
        return view('dashboard.admin.caw_projects.statistics',compact('admin'));
    }


    public function statistics($request)
    {
        $validated = $request->validate([

                'area_id' => 'sometimes|nullable|exists:areas,id',
                'state_id' => 'sometimes|nullable|exists:states,id',
                'village_id'=>'sometimes|nullable|exists:villages,id',
                'marketing_side'=>'sometimes|nullable|in:private,govermental',
                'type'=>'sometimes|nullable|in:caw,ship,fish',
            ]
//            , [
//            'start_date.date' => trans('Admin/validation.date'),
//            'end_date.date' => trans('Admin/validation.date'),
//            'end_date.after_or_equal' => trans('Admin/validation.after_or_equal'),
//        ]
        );
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $type = $request->type;
        $marketing_side = $request->marketing_side;
        if (!empty($request->area_id)) {
            $area_name = AreaTranslation::where('area_id', '=', $request->area_id)->pluck('name');

        }
        if (!empty($request->state_id)) {
            $state_name = StateTranslation::where('state_id', '=', $request->state_id)->pluck('name');
        }
        if (!empty($request->village_id)) {
            $village_name = VillageTranslation::where('village_id', '=', $request->village_id)->pluck('name');
        }
//        $statistics = CawProject::select( 'area_translations.name AS Area',
//            'state_translations.name AS State',
//            'farmers.firstname AS farmer_name','farmers.phone AS phone',
//            'village_translations.name AS village_name'
//
//
//            , DB::raw('SUM(CASE WHEN caw_projects.type = "ship" THEN caw_projects.animal_count ELSE 0 END )AS ship_count')
//            , DB::raw('SUM(CASE WHEN caw_projects.type = "caw" THEN caw_projects.animal_count ELSE 0 END ) As caw_count' ))
//
//
//            ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
//            ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
//            ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
//            ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
//            ->where('caw_projects.admin_id',$admin->id)
//            ->where('caw_projects.marketing_side','like','%private%')
//            ->GroupBy('Area','State','village_name','farmer_name','phone','type'
//            )
//            ->get();

//
        if ($admin->type == 'employee') {
            if ($request->village_id != null && $request->type != null && $request->marketing_side != null) {

                $area_id = $admin->area_id;
                $state_id = $admin->state_id;
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('orchards.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('caw_projects.marketing_side', $marketing_side)
                    ->where('caw_projects.type', $type)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type', 'marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));


            } elseif ($request->village_id != null && $request->type != null && $request->marketing_side == null) {

                $area_id = $admin->area_id;
                $state_id = $admin->state_id;
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('orchards.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('caw_projects.type', $type)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type', 'marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));


            }
            elseif ($request->village_id != null && $request->type == null && $request->marketing_side != null) {

                $area_id = $admin->area_id;
                $state_id = $admin->state_id;
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('orchards.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('caw_projects.marketing_side', $marketing_side)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type', 'marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));


            }
            elseif ($request->village_id != null && $request->type == null && $request->marketing_side == null) {

                $area_id = $admin->area_id;
                $state_id = $admin->state_id;
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type', 'marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));


            }
        }
        elseif ($admin->type == 'admin') {
            if ($request->area_id != null && $request->state_id != null && $request->village_id != null && $request->type != null && $request->marketing_side != null)
            {
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('caw_projects.marketing_side', $marketing_side)
                    ->where('caw_projects.type', $type)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type','marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));

            }
            elseif ($request->area_id != null && $request->state_id != null && $request->village_id != null && $request->type != null && $request->marketing_side == null) {
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('caw_projects.type', $type)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type','marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));

            }
            elseif ($request->area_id == null && $request->state_id == null && $request->village_id == null && $request->type == null && $request->marketing_side == null) {
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')

                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type','marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));

            }

            elseif ($request->area_id != null && $request->state_id != null && $request->village_id != null && $request->type == null && $request->marketing_side != null) {
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('caw_projects.marketing_side', $marketing_side)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type','marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));

            }
            elseif ($request->area_id != null && $request->state_id != null && $request->village_id != null && $request->type == null && $request->marketing_side == null) {
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)

                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type','marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));

            }

            elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null && $request->type != null && $request->marketing_side != null) {
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('caw_projects.marketing_side', $marketing_side)
                    ->where('caw_projects.type', $type)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type','marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));

            }
            elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null && $request->type == null && $request->marketing_side != null) {
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('caw_projects.marketing_side', $marketing_side)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type','marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));

            }
            elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null && $request->type != null && $request->marketing_side == null) {
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('caw_projects.type', $type)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type','marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));

            }
            elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null && $request->type == null && $request->marketing_side == null) {
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type','marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));

            }
            elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null && $request->type == null && $request->marketing_side == null) {
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                     ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type','marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));

            }

            elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null && $request->type != null && $request->marketing_side == null) {
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('caw_projects.type', $type)

                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type','marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));

            }

            elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null && $request->type == null && $request->marketing_side != null) {
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('caw_projects.marleting_side', $marketing_side)

                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type','marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));

            }

            elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null && $request->type != null && $request->marketing_side != null) {
                $statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name', 'farmers.phone AS phone'
                    , 'caw_projects.type AS type', 'caw_projects.marketing_side as marketing_side'
                    , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                )
                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('caw_projects.marleting_side', $marketing_side)
                    ->where('caw_projects.type', $type)


                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'phone', 'type','marketing_side'
                    )
                    ->get();
                return view('dashboard.admin.caw_projects.statistics', compact('admin', 'statistics'));

            }


            }



    }


}