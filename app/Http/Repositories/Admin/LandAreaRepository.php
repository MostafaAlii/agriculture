<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\LandAreaInterface;
use App\Models\LandArea;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\StateTranslation;
use App\Models\LandCategoryTranslation;

use App\Models\AreaTranslation;
use App\Models\Village;
use App\Models\VillageTranslation;
use App\Models\LandCategory;
use App\Models\Unit;
use App\Models\AdminDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Auth;
use Yajra\DataTables\DataTables;
class LandAreaRepository implements LandAreaInterface{

    public function index() {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->area == Null && $admin->state == null) {
            toastr()->error(__('Admin/services.index-wrong'));

            return redirect()->back();
        } else {
            $area_name = $admin->area->name;
            $state_name = $admin->state->name;
            return view('dashboard.admin.land_areas.index',
                compact('admin','area_name','state_name'));
        }


    }


    public function data()
    {
        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);
        if($admin->type =='employee') {
            $land_areas = LandArea::with('area', 'state', 'village', 'landCategory','admin','unit')
                ->where('admin_id',  $admin->id)->get();
        }else{
            $land_areas = LandArea::with('area', 'state', 'village', 'landCategory','admin','unit')->get();
        }
        return DataTables::of($land_areas)
            ->addColumn('record_select', 'dashboard.admin.land_areas.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (LandArea $land_area) {
                return $land_area ->created_at->diffforhumans();
            })
//            ->addColumn('admin', function (LandArea $land_area) {
//                return $land_area->admin->firstname;
//            })
            ->addColumn('area', function (LandArea $land_area) {
                return $land_area->area->name;
            })
            ->addColumn('state', function (LandArea $land_area) {
                return $land_area->state->name;
            })
            ->addColumn('unit', function (LandArea $land_area) {
                return $land_area->unit->Name;
            })
            ->addColumn('village', function (LandArea $land_area) {
                return $land_area->village->name;
            })
            ->addColumn('landCategory', function (LandArea $land_area) {
                return $land_area->landCategory->category_name;
            })



            ->addColumn('actions', 'dashboard.admin.land_areas.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }



    public function create() {
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $stateID = $admin->state->id;
        $villages = Village::where('state_id', $stateID)->get();
        $area_name = $admin->area->name;
        $state_name = $admin->state->name;
        $land_categories= LandCategory::all();
        $units = Unit::all();


        return view('dashboard.admin.land_areas.create',
            compact( 'area_name', 'areaID', 'state_name','stateID','villages', 'units','land_categories','admin','adminId'));
    }

    public function store($request) {
        try {
            $requestData = $request->validated();
            $landArea = LandArea::create([
             'area_id'=>   $requestData['area_id'],
                'admin_id'=>$requestData['admin_id'],
               'state_id' => $requestData['state_id'],
                'village_id'=> $requestData['village_id'],
                'L_area'=> $requestData['L_area'],
                'land_category_id'=> $requestData['land_category_id'] ,
                'unit_id'=>  $requestData['unit_id']

            ]);


            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('LandAreas.index');


        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));
            return redirect()->back();
        }
    }

    public function show($id) {
        //
    }

    public function edit($id)
    {
        $LandID = Crypt::decrypt($id);
        $land_area = LandArea::findorfail($LandID);
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $stateID = $admin->state->id;

        $state_name = $admin->state->name;
        $area_name = $admin->area->name;
        $villages = Village::where('state_id', $stateID)->get();

        $land_categories= LandCategory::all();
        $units = Unit::all();


        return view('dashboard.admin.land_areas.edit',
            compact('area_name', 'areaID', 'adminId','state_name','stateID','villages', 'units','land_area','land_categories','admin'));
    }

    public function update($request, $id) {
        try {
            $LandID = Crypt::decrypt($id);
            $requestData = $request->validated();
            $landArea = LandArea::findorfail($LandID);
            $landArea->admin_id = $requestData['admin_id'];
            $landArea->area_id = $requestData['area_id'];
            $landArea->state_id = $requestData['state_id'];
            $landArea->village_id = $requestData['village_id'];
            $landArea->L_area = $requestData['L_area'];
            $landArea->land_category_id = $requestData['land_category_id'];
            $landArea->unit_id = $requestData['unit_id'];
            $landArea->update($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('LandAreas.index');


        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));
            return redirect()->back();
        }
    }

    public function destroy($id) {
        try{
            $landAreaID = Crypt::decrypt($id);
            $land_area = LandArea::findorfail($landAreaID);


            $land_area->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('LandAreas.index');
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
                foreach ($delete_select_id as $landArea_ids) {

                    $land_area = LandArea::findorfail($landArea_ids);


                    LandArea::destroy($landArea_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('LandAreas.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('LandAreas.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }// end of bulkDelete

    public function index_land_area_statistics(){
        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);
        $state_id = $admin->state->id;
        return view('dashboard.admin.land_areas.statistic_land_area_details',compact('admin','state_id'));

    }

    public function statistic_land_area_detail($request)
    {
        $validated = $request->validate([
            'area_id' => 'sometimes|nullable|exists:areas,id',
            'state_id' => 'sometimes|nullable|exists:states,id',
            'village_id' => 'sometimes|nullable|exists:villages,id',
            'land_category_id'=>'sometimes|nullable|exists:land_categories,id',

        ],[

        ]);


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
        if ($request->land_category_id != null) {
            $land_category_name = LandCategoryTranslation::where('land_category_id', '=', $request->land_category_id)->pluck('category_name');
        }


        if ($admin->type == 'employee') {
            $area_id = $admin->area_id;
            $state_id = $admin->state_id;

            if ($request->village_id != null && $request->land_category_id != null && $area_id!= null && $state_id != null) {

                $statistics = LandArea::select(
                    'area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village',
                    'land_category_translations.category_name as category_name',
                    'land_category_translations.category_type as category_type',

                    DB::raw('SUM(land_areas.L_area )AS Land_Area'))
                    ->join('area_translations', 'land_areas.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'land_areas.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'land_areas.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'land_areas.land_category_id', '=', 'land_category_translations.id')
                    ->where('land_areas.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy(
                        'Area', 'State',
                        'Village', 'category_name', 'category_type')->get();
                return view('dashboard.admin.land_areas.statistic_land_area_details', compact('state_id','admin', 'statistics'));
            }
            elseif ($request->village_id != null && $request->land_category_id == null && $area_id!= null && $state_id != null) {

                $statistics = LandArea::select(
                    'area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village',
                    'land_category_translations.category_name as category_name',
                    'land_category_translations.category_type as category_type',

                    DB::raw('SUM(land_areas.L_area )AS Land_Area'))
                    ->join('area_translations', 'land_areas.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'land_areas.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'land_areas.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'land_areas.land_category_id', '=', 'land_category_translations.id')
                    ->where('land_areas.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->GroupBy(
                        'Area', 'State',
                        'Village', 'category_name', 'category_type')->get();
                return view('dashboard.admin.land_areas.statistic_land_area_details', compact('state_id','admin', 'statistics'));
            }
            elseif ($request->village_id == null && $request->land_category_id == null && $area_id!= null && $state_id != null) {

                $statistics = LandArea::select(
                    'area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village',
                    'land_category_translations.category_name as category_name',
                    'land_category_translations.category_type as category_type',

                    DB::raw('SUM(land_areas.L_area )AS Land_Area'))
                    ->join('area_translations', 'land_areas.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'land_areas.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'land_areas.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'land_areas.land_category_id', '=', 'land_category_translations.id')
                    ->where('land_areas.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->GroupBy(
                        'Area', 'State',
                        'Village', 'category_name', 'category_type')->get();
                return view('dashboard.admin.land_areas.statistic_land_area_details', compact('state_id','admin', 'statistics'));
            }
            elseif ($request->village_id == null && $request->land_category_id != null && $area_id!= null && $state_id != null) {

                $statistics = LandArea::select(
                    'area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village',
                    'land_category_translations.category_name as category_name',
                    'land_category_translations.category_type as category_type',

                    DB::raw('SUM(land_areas.L_area )AS Land_Area'))
                    ->join('area_translations', 'land_areas.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'land_areas.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'land_areas.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'land_areas.land_category_id', '=', 'land_category_translations.id')
                    ->where('land_areas.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('land_category_translations.category_name', $land_category_name)

                    ->GroupBy(
                        'Area', 'State',
                        'Village', 'category_name', 'category_type')->get();
                return view('dashboard.admin.land_areas.statistic_land_area_details', compact('state_id','admin', 'statistics'));
            }

        }
        elseif ($admin->type == 'admin') {
            if ($request->area_id != null && $request->state_id != null && $request->village_id != null && $request->land_category_id != null) {

                $statistics = LandArea::select(
                    'area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village',
                    'land_category_translations.category_name as category_name',
                    'land_category_translations.category_type as category_type',

                    DB::raw('SUM(land_areas.L_area )AS Land_Area'))
                    ->join('area_translations', 'land_areas.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'land_areas.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'land_areas.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'land_areas.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy('Area', 'State', 'Village', 'category_name', 'category_type')->get();
                return view('dashboard.admin.land_areas.statistic_land_area_details', compact('admin', 'statistics'));

            }
            elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null && $request->land_category_id == null) {

                $statistics = LandArea::select(
                    'area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village',
                    'land_category_translations.category_name as category_name',
                    'land_category_translations.category_type as category_type',

                    DB::raw('SUM(land_areas.L_area )AS Land_Area'))
                    ->join('area_translations', 'land_areas.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'land_areas.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'land_areas.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'land_areas.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->GroupBy('Area', 'State', 'Village', 'category_name', 'category_type')->get();
                return view('dashboard.admin.land_areas.statistic_land_area_details', compact('admin', 'statistics'));

            }

            elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null && $request->land_category_id != null) {

                $statistics = LandArea::select(
                    'area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village',
                    'land_category_translations.category_name as category_name',
                    'land_category_translations.category_type as category_type',

                    DB::raw('SUM(land_areas.L_area )AS Land_Area'))
                    ->join('area_translations', 'land_areas.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'land_areas.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'land_areas.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'land_areas.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy('Area', 'State', 'Village', 'category_name', 'category_type')->get();
                return view('dashboard.admin.land_areas.statistic_land_area_details', compact('admin', 'statistics'));

            }
            elseif ($request->area_id == null && $request->state_id == null && $request->village_id == null && $request->land_category_id == null) {

                $statistics = LandArea::select(
                    'area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village',
                    'land_category_translations.category_name as category_name',
                    'land_category_translations.category_type as category_type',

                    DB::raw('SUM(land_areas.L_area )AS Land_Area'))
                    ->join('area_translations', 'land_areas.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'land_areas.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'land_areas.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'land_areas.land_category_id', '=', 'land_category_translations.id')

                    ->GroupBy('Area', 'State', 'Village', 'category_name', 'category_type')->get();
                return view('dashboard.admin.land_areas.statistic_land_area_details', compact('admin', 'statistics'));

            }
            elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null && $request->land_category_id != null) {

                $statistics = LandArea::select(
                    'area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village',
                    'land_category_translations.category_name as category_name',
                    'land_category_translations.category_type as category_type',

                    DB::raw('SUM(land_areas.L_area )AS Land_Area'))
                    ->join('area_translations', 'land_areas.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'land_areas.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'land_areas.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'land_areas.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('village_translations.name', $village_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy('Area', 'State', 'Village', 'category_name', 'category_type')->get();
                return view('dashboard.admin.land_areas.statistic_land_area_details', compact('admin', 'statistics'));

            }

        }
    }

}