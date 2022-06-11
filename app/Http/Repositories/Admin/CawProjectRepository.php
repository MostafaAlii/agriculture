<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\CawProjectInterface;
use App\Models\CawProject;
use App\Models\Farmer;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Village;
use App\Models\AdminDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Illuminate\Http\Request;
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
                ->where('admin_id',$admin->id );

          }
          else {
              $cawProjects = CawProject::with('farmer', 'village', 'admin','area','state');
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
        $villages = Village::where('state_id',$stateID)->get();
        return view('dashboard.admin.caw_projects.create',
            compact('adminId', 'admin', 'areaID', 'area_name', 'villages','areas','states','state_name','stateID'));
    }


    public function store($request)    {

        try {

            $requestData = $request->validated();

            $beekeeper = BeeKeeper::create([
                'admin_id' => $requestData['admin_id'],
                'farmer_id' => $requestData['farmer_id'],
                'state_id' => $requestData['state_id'],
                'area_id' => $requestData['area_id'],
                'village_id' => $requestData['village_id'],
                'unit_id' => $requestData['unit_id'],
                'project_name' => $requestData['project_name'],
                'hall_num' => $requestData['hall_num'],
                'animal_count' => $requestData['animal_count'],
                'food_source' => $requestData['food_source'],
                'marketing_side' => $requestData['marketing_side'],
                'cost' => $requestData['cost'],
                'type' => $requestData['type'],
                'phone' => $requestData['phone'],
                'email' => $requestData['email'],
            ]);


            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Animals.index');


        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));

            return redirect()->back();
        }

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

        return view('dashboard.admin.caw_projects.edit',
            compact('area_name','state_name','admin','villages',
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


            $animal->project_name = $requestData['project_name'];
            $animal->hall_num = $requestData['hall_num'];
            $animal->animal_count = $requestData['animal_count'];
            $animal->food_source = $requestData['food_source'];
            $animal->marketing_side = $requestData['marketing_side'];
            $animal->cost = $requestData['cost'];
            $animal->type = $requestData['type'];
            $animal->phone = $requestData['phone'];
            $animal->email = $requestData['email'];


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

    public function statistics(){
//            $statistics = CawProject::select( 'area_translations.name AS Area','state_translations.name AS State',
//                'farmers.firstname AS farmer_name','farmers.phone AS phone','village_translations.name AS village_name'
//
//             , DB::raw('SUM(caw_projects.animal_count) As animal_count')
//                ,   'caw_projects.type AS type'
//            )
//
//                ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
//                ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
//                ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
//                ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
//                ->where('caw_projects.marketing_side','like','%private%')
//                ->whereIn('caw_projects.type',['Caw','Ship','تربية الأغنام','تربية الأبقار'])
//                ->GroupBy('Area','State','village_name','farmer_name','phone','type'
//                )
//                ->get();
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if($admin->type =='employee'){
            $statistics = CawProject::select( 'area_translations.name AS Area',
                'state_translations.name AS State',
                'farmers.firstname AS farmer_name','farmers.phone AS farmer_phone',
                'village_translations.name AS village_name'


                , DB::raw('SUM(CASE WHEN caw_projects.type = "ship" THEN caw_projects.animal_count ELSE 0 END )AS ship_count')
                , DB::raw('SUM(CASE WHEN caw_projects.type = "caw" THEN caw_projects.animal_count ELSE 0 END ) As caw_count' ))


                ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                ->where('caw_projects.admin_id',$admin->id)
                ->where('caw_projects.marketing_side','like','%private%')
                ->GroupBy('Area','State','village_name','farmer_name','farmer_phone','type'
                )
                ->get();
        }elseif($admin->type =='admin'){
            $statistics = CawProject::select( 'area_translations.name AS Area',
                'state_translations.name AS State',
                'farmers.firstname AS farmer_name','farmers.phone AS farmer_phone',
                'village_translations.name AS village_name'


                , DB::raw('SUM(CASE WHEN caw_projects.type = "ship" THEN caw_projects.animal_count ELSE 0 END )AS ship_count')
                , DB::raw('SUM(CASE WHEN caw_projects.type = "caw" THEN caw_projects.animal_count ELSE 0 END ) As caw_count' ))


                ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                ->where('caw_projects.marketing_side','like','%private%')
                ->GroupBy('Area','State','village_name','farmer_name','farmer_phone','type'
                )
                ->get();
        }

                 return view('dashboard.admin.caw_projects.statistics',compact('statistics'));
    }
    public function ship_statistics(){
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if($admin->type =='employee'){
        $ship_statistics = CawProject::select( 'area_translations.name AS Area','state_translations.name AS State',
            'farmers.firstname AS farmer_name','farmers.phone AS phone','village_translations.name AS village_name'
//            , DB::raw('SUM(caw_projects.animal_count) As animal_count')
            ,   'caw_projects.project_name as project_name', 'caw_projects.hall_num as hall_num',
            'caw_projects.animal_count as animal_count',
//            'caw_projects.type as type' ,
            'caw_projects.marketing_side as marketing_side','caw_projects.food_source as food_source'
            )
            ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
            ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
            ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
            ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
            ->where('caw_projects.admin_id',$admin->id)

            ->where('caw_projects.marketing_side','like','%govermental%')
            ->whereIn('caw_projects.type',['Ship','تربية الأغنام'])
//            ->GroupBy('Area','State','village_name','farmer_name'  )
           ->get();
        }elseif ($admin->type =='admin'){
            $ship_statistics = CawProject::select( 'area_translations.name AS Area','state_translations.name AS State',
                'farmers.firstname AS farmer_name','farmers.phone AS phone','village_translations.name AS village_name'
//            , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                ,   'caw_projects.project_name as project_name', 'caw_projects.hall_num as hall_num',
                'caw_projects.animal_count as animal_count',
//            'caw_projects.type as type' ,
                'caw_projects.marketing_side as marketing_side','caw_projects.food_source as food_source'
            )
                ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')

                ->where('caw_projects.marketing_side','like','%govermental%')
                ->whereIn('caw_projects.type',['Ship','تربية الأغنام'])
//            ->GroupBy('Area','State','village_name','farmer_name'  )
                ->get();
        }

        return view('dashboard.admin.caw_projects.ship_statistics',compact('ship_statistics'));
    }


    public function caw_statistics(){
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if($admin->type =='employee'){
        $caw_statistics = CawProject::select( 'area_translations.name AS Area','state_translations.name AS State',
            'farmers.firstname AS farmer_name','farmers.phone AS phone','village_translations.name AS village_name'
//            , DB::raw('SUM(caw_projects.animal_count) As animal_count')
            ,'caw_projects.project_name as project_name', 'caw_projects.hall_num as hall_num',
            'caw_projects.animal_count as animal_count',
//            'caw_projects.type as type' ,
            'caw_projects.marketing_side as marketing_side', 'caw_projects.food_source as food_source')

            ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
            ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
            ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
            ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
            ->whereIn('caw_projects.type',['Caw','تربية الأبقار'])
            ->where('caw_projects.admin_id',$admin->id)

            ->where('caw_projects.marketing_side','like','%govermental%')
//            ->GroupBy('Area','State','village_name','farmer_name' )
            ->get();}
            elseif ($admin->type =='admin'){
                $caw_statistics = CawProject::select( 'area_translations.name AS Area','state_translations.name AS State',
                    'farmers.firstname AS farmer_name','farmers.phone AS phone','village_translations.name AS village_name'
//            , DB::raw('SUM(caw_projects.animal_count) As animal_count')
                    ,'caw_projects.project_name as project_name', 'caw_projects.hall_num as hall_num',
                    'caw_projects.animal_count as animal_count',
//            'caw_projects.type as type' ,
                    'caw_projects.marketing_side as marketing_side', 'caw_projects.food_source as food_source')

                    ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                    ->whereIn('caw_projects.type',['Caw','تربية الأبقار'])

                    ->where('caw_projects.marketing_side','like','%govermental%')
//            ->GroupBy('Area','State','village_name','farmer_name' )
                    ->get();
            }
        return view('dashboard.admin.caw_projects.caw_statistics',compact('caw_statistics'));
    }

    public function fish_statistics(){
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if($admin->type =='employee') {
            $fish_statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                , 'caw_projects.project_name as project_name', 'caw_projects.hall_num as hall_num',
                'caw_projects.animal_count as animal_count',
//            'caw_projects.type as type' ,
                'caw_projects.marketing_side as marketing_side', 'caw_projects.food_source as food_source')
                ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                ->where('caw_projects.marketing_side', 'like', '%govermental%')
                ->where('caw_projects.admin_id', $admin->id)
                ->whereIn('caw_projects.type', ['Fish', 'زراعة السمك'])
//            ->GroupBy('Area','State','village_name','farmer_name','phone' ,'type' )
                ->get();
        }elseif ($admin->type =='admin'){
            $fish_statistics = CawProject::select('area_translations.name AS Area', 'state_translations.name AS State',
                'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name'
                , 'caw_projects.project_name as project_name', 'caw_projects.hall_num as hall_num',
                'caw_projects.animal_count as animal_count',
//            'caw_projects.type as type' ,
                'caw_projects.marketing_side as marketing_side', 'caw_projects.food_source as food_source')
                ->join('area_translations', 'caw_projects.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'caw_projects.state_id', '=', 'state_translations.id')
                ->join('village_translations', 'caw_projects.village_id', '=', 'village_translations.id')
                ->join('farmers', 'caw_projects.farmer_id', '=', 'farmers.id')
                ->where('caw_projects.marketing_side', 'like', '%govermental%')
                ->whereIn('caw_projects.type', ['Fish', 'زراعة السمك'])
//            ->GroupBy('Area','State','village_name','farmer_name','phone' ,'type' )
                ->get();
        }
        return view('dashboard.admin.caw_projects.fish_statistics',compact('fish_statistics'));
    }

}