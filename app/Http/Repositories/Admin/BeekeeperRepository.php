<?php
namespace  App\Http\Repositories\Admin;
use App\Models\BeeKeeper;
use App\Models\Farmer;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Village;
use App\Models\CourseBee;
use App\Models\BeeDisaster;
use App\Models\Unit;
use App\Models\SupportedSide;

use App\Models\AdminDepartment;
use App\Models\LandCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Auth;
use Yajra\DataTables\DataTables;
use App\Http\Interfaces\Admin\BeekeeperInterface;
class BeekeeperRepository implements BeekeeperInterface {
    public function index(){
        return view('dashboard.admin.beekeepers.index');

    }


    public function data()
    {
        $beekeeper = BeeKeeper::with('farmer', 'village', 'adminDepartment','coursebees','beedisasters')
            ->selectRaw('distinct bee_keepers.*')->get();;

        return DataTables::of($beekeeper)
            ->addColumn('record_select', 'dashboard.admin.beekeepers.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (BeeKeeper $beekeeper) {
                return $beekeeper ->created_at->diffforhumans();
            })
            ->addColumn('farmer', function (BeeKeeper $beekeeper) {
                return $beekeeper ->farmer->email;
            })
            ->addColumn('village', function (BeeKeeper $beekeeper) {
                return $beekeeper->village->name;
            })->addColumn('c_name', function ($beekeeper) {
                return implode(', ', $beekeeper->coursebees->pluck('name')->toArray());
            })
            ->rawColumns(['c_name'])
            ->addColumn('d_name', function ($beekeeper) {
                return implode(', ', $beekeeper->beedisasters->pluck('name')->toArray());
            })
            ->rawColumns(['d_name'])
            ->addColumn('actions', 'dashboard.admin.beekeepers.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }
    public function create()
    {
        $areas = Area::all();
        $states = State::all();
        $villages = Village::all();
        $farmers = Farmer::all();
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();
        $courses = CourseBee::all();
        $disasters = BeeDisaster::all();
        $units = Unit::all();
        $supported_sides = SupportedSide::all();

        return view('dashboard.admin.beekeepers.create',
            compact('farmers', 'admins', 'admin_dpartments', 'supported_sides',
                'disasters', 'areas', 'courses', 'states', 'units'));
    }



    public function store(  $request)

    {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $beekeeper = new BeeKeeper();
            $beekeeper->admin_id = Auth::user()->id;
            $beekeeper->farmer_id = $requestData['farmer_id'];
            $beekeeper->area_id = $requestData['area_id'];
            $beekeeper->state_id = $requestData['state_id'];
            $beekeeper->village_id = $requestData['village_id'];
            $beekeeper->died_beehive_count = $requestData['died_beehive_count'];

            $beekeeper->admin_department_id = $requestData['admin_department_id'];
            $beekeeper->annual_new_product_beehive = $requestData['annual_new_product_beehive'];
            $beekeeper->annual_old_product_beehive = $requestData['annual_old_product_beehive'];
            $beekeeper->new_beehive_count = $requestData['new_beehive_count'];
            $beekeeper->old_beehive_count = $requestData['old_beehive_count'];
            $beekeeper->unit_id = $requestData['unit_id'];
            $beekeeper->supported_side_id = $requestData['supported_side_id'];
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

        $areas = Area::all();
        $states = State::all();
        $villages = Village::all();
        $farmers = Farmer::all();
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();
        $courses = CourseBee::all();
        $disasters = BeeDisaster::all();
        $units = Unit::all();
        $supported_sides = SupportedSide::all();
        return view('dashboard.admin.beekeepers.edit',
            compact('farmers', 'admins', 'admin_dpartments', 'supported_sides',
                'disasters', 'areas', 'courses', 'states', 'units','beekeeper'));
    }

    public function update( $request, $id) {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $beekeeper =  BeeKeeper::findorfail($id);
            $beekeeper->admin_id = Auth::user()->id;
            $beekeeper->farmer_id = $requestData['farmer_id'];
            $beekeeper->area_id = $requestData['area_id'];
            $beekeeper->state_id = $requestData['state_id'];
            $beekeeper->village_id = $requestData['village_id'];
            $beekeeper->died_beehive_count = $requestData['died_beehive_count'];

            $beekeeper->admin_department_id = $requestData['admin_department_id'];
            $beekeeper->annual_new_product_beehive = $requestData['annual_new_product_beehive'];
            $beekeeper->annual_old_product_beehive = $requestData['annual_old_product_beehive'];
            $beekeeper->new_beehive_count = $requestData['new_beehive_count'];
            $beekeeper->old_beehive_count = $requestData['old_beehive_count'];
            $beekeeper->unit_id = $requestData['unit_id'];
            $beekeeper->supported_side_id = $requestData['supported_side_id'];
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
}