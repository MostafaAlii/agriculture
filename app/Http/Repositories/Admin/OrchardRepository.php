<?php
namespace  App\Http\Repositories\Admin;
use App\Models\OrChard;
use App\Models\Farmer;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Village;
use App\Models\Tree;
use App\Models\AdminDepartment;
use App\Models\LandCategory;

use App\Http\Interfaces\Admin\OrchardInterface;
use Illuminate\Http\Request;
class OrchardRepository implements OrchardInterface{
    public function index() {
        $farmers = Farmer::all();
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();
        $land_category = LandCategory::all();
        return view('dashboard.admin.orchards.index',
            compact('farmers','admins','admin_dpartments','land_category'));

    }
    public function data() {
        $orchards = OrChard::with('farmer','admin','adminDepartment','landCategory','treeTypes');

        return DataTables::of($orchards)
            ->addColumn('record_select', 'dashboard.admin.orchards.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (OrChard $orChard) {
                return $orChard->created_at->format('Y-m-d');
            })

            ->addColumn('farmer', function (OrChard $chard) {
                return $chard->farmer->name;
            })
            ->addColumn('admin', function (OrChard $chard) {
                return $chard->admin->name;
            })
            ->addColumn('landCategory', function (OrChard $chard) {
                return $chard->landCategory->category_name;
            })
            ->addColumn('actions', 'dashboard.admin.orchards.data_table.actions')

            ->rawColumns([ 'record_select','actions'])
            ->toJson();

    }
    public function create(){
        $areas = Area::all();
        $states = State::all();
        $villages = Village::all();
        $farmers = Farmer::all();
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();
        $land_categorys = LandCategory::all();
        $trees = Tree::all();
        return view('dashboard.admin.orchards.create',
            compact('farmers','admins','admin_dpartments','land_categorys','areas','trees','states'));
    }

    public function getFarmer($village_id)
    {
        $village = Village::where('id', $village_id)->first();
        $farmers = $village->farmers->pluck('name','id');
        return $farmers;
    }


    public function getFarmerInf($farmer_id){

        $data = Farmer::where('id', $farmer_id)->first();
        return response()->json($data);
    }


    public function store($request) {

    }

    public function update($request) {

    }

    public function destroy($request) {

    }
}