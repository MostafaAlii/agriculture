<?php

namespace App\Http\Repositories\Admin;

use App\Models\ProtectedHouse;
use App\Models\Admin;
use App\Models\Village;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\DataTables;
use App\Http\Interfaces\Admin\ProtectedHouseInterface;

class ProtectedHouseRepository implements ProtectedHouseInterface
{
    public function index()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        return view('dashboard.admin.protected_houses.index',
            compact('admin', 'areaID', 'area_name', 'stateID', 'state_name'));


    }

    public function data()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == 'employee') {
            $protectedHouse = ProtectedHouse::with('farmer', 'village', 'area', 'state', 'admin')
                ->where('admin_id', '==', $admin->id);
        } else {
            $protectedHouse = ProtectedHouse::with('farmer', 'village', 'area', 'state', 'admin');

        }

        return DataTables::of($protectedHouse)
            ->addColumn('record_select', 'dashboard.admin.protected_houses.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (ProtectedHouse $protected) {
                return $protected->created_at->diffforhumans();
            })
            ->editColumn('supported_side', function (ProtectedHouse $protected) {
                return view('dashboard.admin.protected_houses.data_table.supported_side', compact('protected'));
            })
            ->editColumn('status', function (ProtectedHouse $protected) {
                return view('dashboard.admin.protected_houses.data_table.status', compact('protected'));
            })
            ->addColumn('farmer', function (ProtectedHouse $protected) {
                return $protected->farmer->email;
            })
            ->addColumn('admin', function (ProtectedHouse $protected) {
                return $protected->admin->firstname;
            })
            ->addColumn('village', function (ProtectedHouse $protected) {
                return $protected->village->name;
            })
            ->addColumn('area', function (ProtectedHouse $protected) {
                return $protected->area->name;
            })
            ->addColumn('state', function (ProtectedHouse $protected) {
                return $protected->state->name;
            })
            ->addColumn('actions', 'dashboard.admin.protected_houses.data_table.actions')
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
        $villages = Village::where('state_id', $stateID)->get();
        $state_name = $admin->state->name;
        $units = Unit::all();
        $adminID = $admin->id;
        $admin = Admin::findorfail($adminID);


        return view('dashboard.admin.protected_houses.create',
            compact('admin', 'stateID', 'areaID', 'villages', 'area_name', 'state_name', 'units'));
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
            $protected_house = new ProtectedHouse();
            $protected_house->admin_id = $admin->id;
            $protected_house->farmer_id = $requestData['farmer_id'];
            $protected_house->area_id = $areaID;
            $protected_house->state_id = $stateID;
            $protected_house->village_id = $requestData['village_id'];
            $protected_house->status = $requestData['status'];
            $protected_house->average_product_annual = $requestData['average_product_annual'];
            $protected_house->unit_id = $requestData['unit_id'];
            $protected_house->count_protected_house = $requestData['count_protected_house'];

            $protected_house->supported_side = $requestData['supported_side'];
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
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $area_name = $admin->area->name;
        $state_name = $admin->state->name;
        $stateID = $admin->state->id;
        $units = Unit::all();
        $villages = Village::where('state_id', $stateID)->get();


        return view('dashboard.admin.protected_houses.edit',
            compact('admin', 'area_name', 'state_name', 'villages', 'units', 'protected_house'));
    }

    public function update($request, $id)
    {

        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $protectedID = Crypt::decrypt($id);
            $adminId = Auth::user()->id;
            $admin = Admin::findorfail($adminId);
            $areaID = $admin->area->id;
            $stateID = $admin->state->id;
            $protected_house = ProtectedHouse::findorfail($protectedID);
            $protected_house->admin_id = $admin->id;
            $protected_house->farmer_id = $requestData['farmer_id'];
            $protected_house->area_id = $areaID;
            $protected_house->state_id = $stateID;
            $protected_house->village_id = $requestData['village_id'];
            $protected_house->average_product_annual = $requestData['average_product_annual'];

            $protected_house->count_protected_house = $requestData['count_protected_house'];

            $protected_house->status = $requestData['status'];
            $protected_house->unit_id = $requestData['unit_id'];
            $protected_house->supported_side = $requestData['supported_side'];
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

    public function bulkDelete($request)
    {
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
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete


    public function protected_house_statistics()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $first_name = $admin->firstname;;
        if ($admin->type == 'employee') {
            $statistics = ProtectedHouse::select('area_translations.name AS Area', 'state_translations.name AS State',
                'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name',
                'protected_houses.supported_side AS supported_side',
                'protected_houses.status AS status',
                'protected_houses.count_protected_house AS count_protected_house',
                'protected_houses.average_product_annual AS average_product_annual',
                'unit_translations.Name AS unit_name')
                ->join('area_translations', 'protected_houses.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'protected_houses.state_id', '=', 'state_translations.id')
                ->join('village_translations', 'protected_houses.village_id', '=', 'village_translations.id')
                ->join('farmers', 'protected_houses.farmer_id', '=', 'farmers.id')
                ->join('unit_translations', 'protected_houses.unit_id', '=', 'unit_translations.id')
                ->where('protected_houses.admin_id', $admin->id)
                ->get();
        } elseif ($admin->type == 'admin') {
            $statistics = ProtectedHouse::select('area_translations.name AS Area', 'state_translations.name AS State',
                'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name',
                'protected_houses.supported_side AS supported_side',
                'protected_houses.status AS status',
                'protected_houses.count_protected_house AS count_protected_house',
                'protected_houses.average_product_annual AS average_product_annual',
                'unit_translations.Name AS unit_name')
                ->join('area_translations', 'protected_houses.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'protected_houses.state_id', '=', 'state_translations.id')
                ->join('village_translations', 'protected_houses.village_id', '=', 'village_translations.id')
                ->join('farmers', 'protected_houses.farmer_id', '=', 'farmers.id')
                ->join('unit_translations', 'protected_houses.unit_id', '=', 'unit_translations.id')
                ->get();
        }

        return view('dashboard.admin.protected_houses.protected_house_statistics', compact('statistics'));
    }

    public function protected_house_gov_statistics()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == "employee") {
            $statistics = ProtectedHouse::select('area_translations.name AS Area', 'state_translations.name AS State',
                'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name',
                'protected_houses.supported_side AS supported_side',
                'protected_houses.status AS status'
                , DB::raw('SUM(protected_houses.count_protected_house) As count_protected_house')
                , DB::raw('SUM(protected_houses.average_product_annual) As average_product_annual'),

                'unit_translations.Name AS unit_name')
                ->join('area_translations', 'protected_houses.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'protected_houses.state_id', '=', 'state_translations.id')
                ->join('village_translations', 'protected_houses.village_id', '=', 'village_translations.id')
                ->join('farmers', 'protected_houses.farmer_id', '=', 'farmers.id')
                ->join('unit_translations', 'protected_houses.unit_id', '=', 'unit_translations.id')
                ->where('protected_houses.admin_id', $admin->id)
                ->where('protected_houses.supported_side', 'like', 'govermental')
                ->GROUPBY('Area', 'State', 'village_name', 'status', 'farmer_name', 'phone', 'supported_side',
                    'status', 'count_protected_house', 'average_product_annual', 'unit_name')->get();
        } elseif ($admin->type == "admin") {
            $statistics = ProtectedHouse::select('area_translations.name AS Area', 'state_translations.name AS State',
                'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name',
                'protected_houses.supported_side AS supported_side',
                'protected_houses.status AS status'
                , DB::raw('SUM(protected_houses.count_protected_house) As count_protected_house')
                , DB::raw('SUM(protected_houses.average_product_annual) As average_product_annual'),

                'unit_translations.Name AS unit_name')
                ->join('area_translations', 'protected_houses.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'protected_houses.state_id', '=', 'state_translations.id')
                ->join('village_translations', 'protected_houses.village_id', '=', 'village_translations.id')
                ->join('farmers', 'protected_houses.farmer_id', '=', 'farmers.id')
                ->join('unit_translations', 'protected_houses.unit_id', '=', 'unit_translations.id')
                ->where('protected_houses.supported_side', 'like', 'govermental')
                ->GROUPBY('Area', 'State', 'village_name', 'status', 'farmer_name', 'phone', 'supported_side',
                    'status', 'count_protected_house', 'average_product_annual', 'unit_name')->get();
        }


        return view('dashboard.admin.protected_houses.protected_house_g_statistics', compact('statistics'));
    }

    public function protected_house_private_statistics()
    { $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == "employee") {
            $statistics = ProtectedHouse::select('area_translations.name AS Area', 'state_translations.name AS State',
                'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name',
                'protected_houses.supported_side AS supported_side',
                'protected_houses.status AS status',
                'protected_houses.count_protected_house AS count_protected_house',
                'protected_houses.average_product_annual AS average_product_annual'
                , DB::raw('SUM(protected_houses.count_protected_house) As count_protected_house')
                , DB::raw('SUM(protected_houses.average_product_annual) As average_product_annual'),
                'unit_translations.Name AS unit_name')
                ->join('area_translations', 'protected_houses.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'protected_houses.state_id', '=', 'state_translations.id')
                ->join('village_translations', 'protected_houses.village_id', '=', 'village_translations.id')
                ->join('farmers', 'protected_houses.farmer_id', '=', 'farmers.id')
                ->join('unit_translations', 'protected_houses.unit_id', '=', 'unit_translations.id')
                ->where('protected_houses.admin_id', $admin->id)
                ->whereIn('protected_houses.supported_side', ['private', 'International Organization'])
                ->GROUPBY('Area', 'State', 'village_name', 'status', 'farmer_name', 'phone', 'supported_side',
                    'status', 'count_protected_house', 'average_product_annual', 'unit_name')->get();
        }elseif ($admin->type == "admin"){
            $statistics = ProtectedHouse::select('area_translations.name AS Area', 'state_translations.name AS State',
                'farmers.firstname AS farmer_name', 'farmers.phone AS phone', 'village_translations.name AS village_name',
                'protected_houses.supported_side AS supported_side',
                'protected_houses.status AS status',
                'protected_houses.count_protected_house AS count_protected_house',
                'protected_houses.average_product_annual AS average_product_annual'
                , DB::raw('SUM(protected_houses.count_protected_house) As count_protected_house')
                , DB::raw('SUM(protected_houses.average_product_annual) As average_product_annual'),
                'unit_translations.Name AS unit_name')
                ->join('area_translations', 'protected_houses.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'protected_houses.state_id', '=', 'state_translations.id')
                ->join('village_translations', 'protected_houses.village_id', '=', 'village_translations.id')
                ->join('farmers', 'protected_houses.farmer_id', '=', 'farmers.id')
                ->join('unit_translations', 'protected_houses.unit_id', '=', 'unit_translations.id')
                ->whereIn('protected_houses.supported_side', ['private', 'International Organization'])
                ->GROUPBY('Area', 'State', 'village_name', 'status', 'farmer_name', 'phone', 'supported_side',
                    'status', 'count_protected_house', 'average_product_annual', 'unit_name')->get();
        }
        return view('dashboard.admin.protected_houses.protected_house_P_statistics', compact('statistics'));
    }
}