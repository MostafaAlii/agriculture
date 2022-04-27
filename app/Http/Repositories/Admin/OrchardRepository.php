<?php
namespace  App\Http\Repositories\Admin;
use App\Models\Orchard;
use App\Models\Farmer;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Village;
use App\Models\Unit;
use App\Models\SupportedSide;

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
        $farmers = Farmer::all();
        $admin_dpartments = AdminDepartment::all();
        $land_category = LandCategory::all();
        $units = Unit::all();

        $supported_sides = SupportedSide::all();
        return view('dashboard.admin.orchards.index',
            compact('farmers', 'admin_dpartments', 'land_category', 'units', 'supported_sides'));

    }

    public function data()
    {
        $orchards = Orchard::with('farmer', 'village', 'adminDepartment','supported_side','trees')
            ->selectRaw('distinct orchards.*')->get();

        return DataTables::of($orchards)
            ->addColumn('record_select', 'dashboard.admin.orchards.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Orchard $chard) {
                return $chard ->created_at->diffforhumans();
            })
            ->addColumn('farmer', function (Orchard $chard) {
                return $chard ->farmer->email;
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
            ->addColumn('adminDepartment', function (Orchard $chard) {
                return $chard->adminDepartment->dep_name_ar;
            })
        ->addColumn('supported_side', function (Orchard $chard) {
            return $chard->supported_side->Name;
        })

            ->addColumn('actions', 'dashboard.admin.orchards.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }

    public function create()
    {
        $areas = Area::all();
        $states = State::all();
        $villages = Village::all();
        $farmers = Farmer::all();
        $admin_dpartments = AdminDepartment::all();
        $land_categories = LandCategory::all();
        $trees = Tree::all();
        $units = Unit::all();
        $supported_sides = SupportedSide::all();

        return view('dashboard.admin.orchards.create',
            compact('farmers', 'admin_dpartments', 'supported_sides',
                'land_categories', 'areas', 'trees', 'states', 'units'));
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
            $requestData = $request->validated();
            $orchard = new OrChard();
            $orchard->admin_id = Auth::user()->id;
            $orchard->farmer_id =    $requestData['farmer_id'];
            $orchard->area_id = $requestData['area_id'];
            $orchard->state_id = $requestData['state_id'];
            $orchard->village_id = $requestData['village_id'];
            $orchard->admin_department_id = $requestData['admin_department_id'];
            $orchard->land_category_id = $requestData['land_category_id'];
            $orchard->admin_department_id = 1;
            $orchard->tree_count_per_orchard = $requestData['tree_count_per_orchard'];
            $orchard->orchard_area = $requestData['orchard_area'];
            $orchard->unit_id = $requestData['unit_id'];
            $orchard->supported_side_id = $requestData['supported_side_id'];
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
    {
//      $orchardID = Crypt::decrypt($id);
        $orchard = Orchard::findorfail($id);
        $areas = Area::all();
        $farmers = Farmer::all();
        $admin_dpartments = AdminDepartment::all();
        $land_categories = LandCategory::all();
        $trees = Tree::all();
        $orchard = OrChard::findorfail($id);
        $units = Unit::all();
        $supported_sides = SupportedSide::all();


        return view('dashboard.admin.orchards.edit',
            compact('farmers', 'admin_dpartments', 'land_categories', 'supported_sides','areas','trees', 'units','orchard'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
//            $orchardID = Crypt::decrypt($id);
            $requestData = $request->validated();
            $orchard = Orchard::findorfail($id);
            $orchard->admin_id = Auth::user()->id;
            $orchard->farmer_id =       $requestData['farmer_id'];
            $orchard->area_id = $requestData['area_id'];
            $orchard->state_id = $requestData['state_id'];
            $orchard->village_id = $requestData['village_id'];
            $orchard->admin_department_id = $requestData['admin_department_id'];
            $orchard->land_category_id = $requestData['land_category_id'];
            $orchard->admin_department_id = 1;
            $orchard->tree_count_per_orchard = $requestData['tree_count_per_orchard'];
            $orchard->orchard_area = $requestData['orchard_area'];
            $orchard->unit_id = $requestData['unit_id'];
            $orchard->supported_side_id = $requestData['supported_side_id'];
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


}