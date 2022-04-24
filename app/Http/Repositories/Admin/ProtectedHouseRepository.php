<?php
namespace  App\Http\Repositories\Admin;
use App\Models\ProtectedHouse;
use App\Models\Farmer;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Village;
use App\Models\Unit;
use App\Models\SupportedSide;

use App\Models\AdminDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\DataTables;
use App\Http\Interfaces\Admin\ProtectedHouseInterface;

class ProtectedHouseRepository implements ProtectedHouseInterface{
    public function index() {
        $farmers = Farmer::all();
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();
        $units = Unit::all();
        $supported_sides = SupportedSide::all();
        return view('dashboard.admin.protected_houses.index',
            compact( 'admin_dpartments', 'units', 'supported_sides','farmers','admins'));


    }

    public function data()
    {
        $protectedHouse = ProtectedHouse::with('farmer', 'village', 'adminDepartment');

        return DataTables::of($protectedHouse)
            ->addColumn('record_select', 'dashboard.admin.protected_houses.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (ProtectedHouse $protected) {
                return $protected ->created_at->diffforhumans();
            })
            ->addColumn('farmer', function (ProtectedHouse $protected) {
                return $protected ->farmer->firstname;
            })
            ->addColumn('village', function (ProtectedHouse $protected) {
                return $protected->village->name;
            })


            ->addColumn('actions', 'dashboard.admin.protected_houses.data_table.actions')
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
        $units = Unit::all();
        $supported_sides = SupportedSide::all();

        return view('dashboard.admin.protected_houses.create',
            compact('farmers', 'admins', 'admin_dpartments', 'supported_sides',
             'areas',  'states', 'units'));
    }

    public function store($request)

    {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $protected_house = new ProtectedHouse();
            $protected_house->admin_id = Auth::user()->id;
            $protected_house->farmer_id = $requestData['farmer_id'];
            $protected_house->area_id = $requestData['area_id'];
            $protected_house->state_id = $requestData['state_id'];
            $protected_house->village_id = $requestData['village_id'];
            $protected_house->admin_department_id = $requestData['admin_department_id'];
            $protected_house->average_product_annual = $requestData['average_product_annual'];
            $protected_house->status = $requestData['status'];
            $protected_house->unit_id = $requestData['unit_id'];
            $protected_house->supported_side_id = $requestData['supported_side_id'];
            $protected_house->phone = $requestData['phone'];
            $protected_house->email = $requestData['email'];


            $protected_house->save($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('ProtectedHouse.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }

    }

    public function edit($id)
    {
        $protectedID = Crypt::decrypt($id);
        $protected_house = ProtectedHouse::findorfail($protectedID);
        $areas = Area::all();
        $farmers = Farmer::all();
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();
        $units = Unit::all();
        $supported_sides = SupportedSide::all();


        return view('dashboard.admin.protected_houses.edit',
            compact('farmers', 'admin_dpartments', 'supported_sides','areas', 'units','protected_house'));
    }

    public function update($request,$id) {

        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $protectedID = Crypt::decrypt($id);

            $protected_house =  ProtectedHouse::findorfail($protectedID);
            $protected_house->admin_id = Auth::user()->id;
            $protected_house->farmer_id = $requestData['farmer_id'];
            $protected_house->area_id = $requestData['area_id'];
            $protected_house->state_id = $requestData['state_id'];
            $protected_house->village_id = $requestData['village_id'];
            $protected_house->admin_department_id = $requestData['admin_department_id'];
            $protected_house->average_product_annual = $requestData['average_product_annual'];
            $protected_house->status = $requestData['status'];
            $protected_house->unit_id = $requestData['unit_id'];
            $protected_house->supported_side_id = $requestData['supported_side_id'];
            $protected_house->phone = $requestData['phone'];
            $protected_house->email = $requestData['email'];


            $protected_house->update($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('ProtectedHouse.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }


    }

    public function destroy($id)
    {
        $protectedID = Crypt::decrypt($id);
        $protected_house = ProtectedHouse::findorfail($protectedID);

        $protected_house->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('ProtectedHouse.index');



    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $protected_ids) {

                    $protected_house = ProtectedHouse::findorfail($protected_ids);


                    ProtectedHouse::destroy($protected_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('ProtectedHouse.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('ProtectedHouse.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete

}