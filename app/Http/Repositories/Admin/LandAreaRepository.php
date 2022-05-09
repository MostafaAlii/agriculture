<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\LandAreaInterface;
use App\Models\LandArea;
use App\Models\Admin;
use App\Models\Area;
use App\Models\Village;
use App\Models\LandCategory;
use App\Models\State;
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
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        $land_areas = LandArea::all();
        return view('dashboard.admin.land_areas.index',
            compact('admin','area_name','state_name'));

    }
//
//$users = User::select([
//'users.id',
//'users.name',
//'users.email',
//\DB::raw('count(posts.user_id) as count'),
//'users.created_at',
//'users.updated_at'
//])->join('posts','posts.user_id','=','users.id')
//->groupBy('posts.user_id');

    public function data()
    {
        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);
        if($admin->type =='employee') {
            $land_areas = LandArea::with('area', 'state', 'village', 'landCategory','admin')
                ->where('admin_id', '==', $admin->id);
        }else{
            $land_areas = LandArea::with('area', 'state', 'village', 'landCategory','admin');
        }
        return DataTables::of($land_areas)
            ->addColumn('record_select', 'dashboard.admin.land_areas.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (LandArea $land_area) {
                return $land_area ->created_at->diffforhumans();
            })
            ->addColumn('admin', function (LandArea $land_area) {
                return $land_area->admin->firstname;
            })
            ->addColumn('area', function (LandArea $land_area) {
                return $land_area->area->name;
            })
            ->addColumn('state', function (LandArea $land_area) {
                return $land_area->state->name;
            })
            ->addColumn('village', function (LandArea $land_area) {
                return $land_area->village->name;
            })
            ->addColumn('landCategory', function (LandArea $land_area) {
                return $land_area->landCategory->category_name;
            })
            ->addColumn('count', function (LandArea $land_area) {
                return $land_area->where('land_category_id', 'like', '1')->sum('L_area');
            })


            ->addColumn('actions', 'dashboard.admin.land_areas.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }



    public function create() {
        $areas = Area::all();
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        $land_categories= LandCategory::all();
        $units = Unit::all();


        return view('dashboard.admin.land_areas.create',
            compact( 'area_name', 'areas', 'state_name', 'units','land_categories','admin'));
    }

    public function store($request) {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $landArea = new LandArea();
            $landArea->admin_id = Auth::user()->id;
            $landArea->area_id = $requestData['area_id'];
            $landArea->state_id = $requestData['state_id'];
            $landArea->village_id = $requestData['village_id'];
            $landArea->L_area = $requestData['L_area'];
            $landArea->land_category_id = $requestData['land_category_id'];
            $landArea->unit_id = $requestData['unit_id'];



            $landArea->save($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('LandAreas.index');


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
        $LandID = Crypt::decrypt($id);
        $land_area = LandArea::findorfail($LandID);
        $areas = Area::all();
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        $land_categories= LandCategory::all();
        $units = Unit::all();


        return view('dashboard.admin.land_areas.edit',
            compact('area_name', 'areas', 'state_name', 'units','land_area','land_categories','admin'));
    }

    public function update($request, $id) {
        DB::beginTransaction();
        try {
            $LandID = Crypt::decrypt($id);

            $requestData = $request->validated();
            $landArea = LandArea::findorfail($LandID);
            $landArea->admin_id = Auth::user()->id;
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
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }
    }

    public function destroy($id) {
        $landAreaID = Crypt::decrypt($id);
        $land_area = LandArea::findorfail($landAreaID);


        $land_area->delete();
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('LandAreas.index');

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
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete


    public function statistic_land_area_detail(){
        $statistics = LandArea::select( DB::raw('SUM(land_areas.L_area) As L_area'),'area_translations.name AS Area',
            'state_translations.name AS State',
           'village_translations.name AS Village',

            'land_category_translations.category_name AS Category_name',
            'land_category_translations.category_type AS Category_type')

            ->join('land_category_translations', 'land_areas.land_category_id', '=', 'land_category_translations.id')
            ->join('area_translations', 'land_areas.area_id', '=', 'area_translations.id')
            ->join('state_translations', 'land_areas.state_id', '=', 'state_translations.id')
            ->join('village_translations', 'land_areas.village_id', '=', 'village_translations.id')
            ->GroupBy('Area','State','Village','Category_type','Category_name')->get();

           return view('dashboard.admin.land_areas.statistic_land_area_details',compact('statistics'));
    }
    public function statistic_land_area_state(){
        $statistics = LandArea::select( DB::raw('SUM(land_areas.L_area) As L_area'),
            'state_translations.name AS State',
            'land_category_translations.category_name AS Category_name',
            'land_category_translations.category_type AS Category_type')
            ->join('state_translations', 'land_areas.state_id', '=', 'state_translations.id')
            ->join('land_category_translations', 'land_areas.land_category_id', '=', 'land_category_translations.id')
            ->GroupBy('State','Category_type','Category_name')->get();

        return view('dashboard.admin.land_areas.statistic_land_area_state',compact('statistics'));
    }
        public function getStatisticaldata(){
            $statistics = LandArea::select( DB::raw('SUM(land_areas.L_area) As L_area'),
//                'land_category_translations.category_name AS Category_name',
                'land_category_translations.category_type AS Category_type'
                ,'state_translations.name As state_name'
            )

                ->join('land_category_translations', 'land_areas.land_category_id', '=', 'land_category_translations.id')
                ->join('state_translations', 'land_areas.state_id', '=', 'state_translations.id')
                ->whereIn('land_category_translations.category_type',array('زراعي','غير زراعي'))
                ->GroupBy('Category_type'       ,'state_name'      )->get();

            return view('dashboard.admin.land_areas.get_land_area_statistic',compact('statistics'));

    }
}