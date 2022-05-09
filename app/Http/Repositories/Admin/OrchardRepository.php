<?php
namespace  App\Http\Repositories\Admin;
use App\Models\Orchard;
use App\Models\Farmer;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Village;
use App\Models\Unit;

use App\Models\Tree;
use App\Models\AdminDepartment;
use App\Models\LandCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use App\Http\Interfaces\Admin\OrchardInterface;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\DataTables;


class OrchardRepository implements OrchardInterface
{
    use UploadT;

    public function index()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        return view('dashboard.admin.orchards.index',
            compact('admin','areaID','area_name','stateID','state_name'));

    }

    public function data()
    {
        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);
        if($admin->type =='employee') {
            $orchards = Orchard::with('admin', 'farmer', 'village', 'trees', 'landCategory', 'area', 'state')
                ->where('admin_id', '==', $admin->id)
                ->selectRaw('distinct orchards.*')->get();
        }else {
            $orchards = Orchard::with('admin', 'farmer', 'village', 'trees', 'landCategory', 'area', 'state')
                ->selectRaw('distinct orchards.*')->get();
        }
            return DataTables::of($orchards)
                ->addColumn('record_select', 'dashboard.admin.orchards.data_table.record_select')
                ->addIndexColumn()
                ->editColumn('created_at', function (Orchard $chard) {
                    return $chard ->created_at->diffforhumans();
                })
                ->editColumn('supported_side', function (Orchard $chard) {
                    return view('dashboard.admin.orchards.data_table.supported_side', compact('chard'));
                })
                ->addColumn('farmer', function (Orchard $chard) {
                    return $chard ->farmer->email;
                })
                ->addColumn('admin', function (Orchard $chard) {
                    return $chard ->admin->email;
                })
                ->addColumn('area', function (Orchard $chard) {
                    return $chard->area->name;
                })
                ->addColumn('state', function (Orchard $chard) {
                    return $chard->state->name;
                })
                ->addColumn('village', function (Orchard $chard) {
                    return $chard->village->name;
                })
                ->addColumn('landCategory', function (Orchard $chard) {
                    return $chard->landCategory->category_name;
                })
                ->addColumn('name', function ($orchards) {
                    return implode(', ', $orchards->trees->pluck('name')->toArray());
                })



                ->addColumn('actions', 'dashboard.admin.orchards.data_table.actions')
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
        $land_categories = LandCategory::all();
        $trees = Tree::all();
        $units = Unit::all();

        return view('dashboard.admin.orchards.create',
            compact('admin','area_name','areaID','stateID',
                'land_categories', 'state_name', 'trees', 'villages', 'units'));
    }


    public function getFarmer($village_id)
    {
        $farmers = Farmer::where('id',$village_id)->pluck('firstname','id');

        return $farmers;
    }


    public function getFarmerInf($farmer_id)
    {

        $data = Farmer::where('id', $farmer_id)->first();
        return response()->json($data);
    }


    public function store($request)
    {

        DB::beginTransaction();
        try {
            $adminId = Auth::user()->id;
            $admin = Admin::findorfail($adminId);
            $areaID = $admin->area->id;
            $stateID = $admin->state->id;
            $requestData = $request->validated();
            $orchard = new OrChard();
            $orchard->admin_id = $admin->id;
            $orchard->farmer_id =    $requestData['farmer_id'];
            $orchard->area_id = $areaID;
            $orchard->state_id = $stateID;
            $orchard->village_id = $requestData['village_id'];

            $orchard->land_category_id = $requestData['land_category_id'];
            $orchard->tree_count_per_orchard = $requestData['tree_count_per_orchard'];
            $orchard->orchard_area = $requestData['orchard_area'];
            $orchard->unit_id = $requestData['unit_id'];
            $orchard->supported_side = $requestData['supported_side'];
            $orchard->phone =  $requestData['phone'];
            $orchard->email =  $requestData['email'];


            $orchard->save($requestData);
            $orchard->trees()->attach($request->trees);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('orchards.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }

    }

    public function edit($id)
    {   $orchard = Orchard::findorfail($id);
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        $villages = Village::where('state_id',$stateID)->get();
        $land_categories = LandCategory::all();
        $trees = Tree::all();
        $units = Unit::all();





        return view('dashboard.admin.orchards.edit',
            compact('state_name', 'villages', 'land_categories','stateID','areaID','area_name','trees', 'units','orchard'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
//            $orchardID = Crypt::decrypt($id);
            $requestData = $request->validated();
            $orchard = Orchard::findorfail($id);
            $adminId = Auth::user()->id;
            $admin = Admin::findorfail($adminId);
            $areaID = $admin->area->id;
            $stateID = $admin->state->id;
            $orchard->admin_id =$admin->id;
            $orchard->farmer_id =       $requestData['farmer_id'];
            $orchard->area_id = $areaID;
            $orchard->state_id = $stateID;
            $orchard->village_id = $requestData['village_id'];
            $orchard->land_category_id = $requestData['land_category_id'];
            $orchard->tree_count_per_orchard = $requestData['tree_count_per_orchard'];
            $orchard->orchard_area = $requestData['orchard_area'];
            $orchard->unit_id = $requestData['unit_id'];
            $orchard->supported_side = $requestData['supported_side'];
            $orchard->phone =     $requestData['phone'];
            $orchard->email =   $requestData['email'];


            $orchard->update($requestData);
            $orchard->trees()->sync($request->trees);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('orchards.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }

    }

    public function destroy($id)
    {
        $orchardID = Crypt::decrypt($id);
        $orchard = Orchard::findorfail($orchardID);
        $trees = $orchard->trees->count();
        if($trees> 0){
            toastr()->error(__('Admin/orchards.cant_delete'));
            return redirect()->route('orchards.index');
        }else{
            $orchard->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('orchards.index');
        }


    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $orchard_ids) {

                    $orchard = Orchard::findorfail($orchard_ids);
                    $trees = $orchard->trees->count();

                    if ($trees > 0) {
                        toastr()->error(__('Admin/orchards.cant_delete'));
                        return redirect()->route('orchards.index');
                    }

                    Orchard::destroy($orchard_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('orchards.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('orchards.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete


    public function statistics(){
        $statistics = Orchard::select( 'area_translations.name AS Area','state_translations.name AS State',
            'farmers.firstname AS farmer_name','village_translations.name AS village_name' ,

            DB::raw('SUM(orchards.orchard_area) As orchard_area'),
            DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard'),
            'tree_translations.name AS name',
            'orchards.supported_side AS supported_side',
            'land_category_translations.category_name AS category_name')
            ->join('orchard_trees', 'orchards.id', '=', 'orchard_trees.orchard_id')
            ->join('tree_translations', 'tree_translations.id', '=', 'orchard_trees.tree_id')
//
            ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
            ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
            ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
            ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
            ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
            ->where('land_category_translations.category_name','like','%سيحي%')
            ->orWhere('land_category_translations.category_name','like','%ديمي%')
            ->orWhere('land_category_translations.category_name','like','%قمريات%')
            ->GroupBy('Area','State','village_name','farmer_name','supported_side','category_name','name')->get();

        return view('dashboard.admin.orchards.statistics',compact('statistics'));}


}