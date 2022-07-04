<?php

namespace App\Http\Repositories\Admin;

use App\Models\ProtectedHouse;
use App\Models\Admin;
use App\Models\Village;
use App\Models\VillageTranslation;
use App\Models\Area;
use App\Models\AreaTranslation;
use App\Models\State;
use App\Models\StateTranslation;

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
        if ($admin->area == Null && $admin->state == null) {
            toastr()->error(__('Admin/services.index-wrong'));

            return redirect()->back();
        } else {
            $areaID = $admin->area->id;
            $area_name = $admin->area->name;
            $stateID = $admin->state->id;
            $state_name = $admin->state->name;
            return view('dashboard.admin.protected_houses.index',
                compact('admin', 'areaID', 'area_name', 'stateID', 'state_name'));
        }



    }

    public function data()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == 'employee') {
            $protectedHouse = ProtectedHouse::with('farmer', 'village', 'area', 'state', 'admin')
                ->where('admin_id',  $admin->id)->get();
        } else {
            $protectedHouse = ProtectedHouse::with('farmer', 'village', 'area', 'state', 'admin')->get();

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
                return $protected->farmer->firstname;
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
            compact('admin', 'stateID', 'areaID','adminId', 'villages', 'area_name', 'state_name', 'units'));
    }

    public function store($request)

    {
        try {

            $requestData = $request->validated();
            $protected_house = ProtectedHouse::create([
               'farmer_id' => $requestData['farmer_id'],

            'area_id' => $requestData['area_id'],
           'state_id' => $requestData['state_id'],
            'admin_id' => $requestData['admin_id'],

           'village_id' => $requestData['village_id'],
            'status' => $requestData['status'],
            'average_product_annual' => $requestData['average_product_annual'],
            'unit_id' => $requestData['unit_id'],
            'count_protected_house' => $requestData['count_protected_house'],

           'supported_side' => $requestData['supported_side']

            ]);

            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('ProtectedHouse.index');


        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));
            return redirect()->back();
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
        $areaID = $admin->area->id;
        $units = Unit::all();
        $villages = Village::where('state_id', $stateID)->get();


        return view('dashboard.admin.protected_houses.edit',
            compact('admin', 'area_name', 'state_name', 'stateID','adminId'
                ,'areaID','villages', 'units', 'protected_house'));
    }

    public function update($request, $id)
    {
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

            $protected_house->update($requestData);

            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('ProtectedHouse.index');


        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));
            return redirect()->back();
        }


    }

    public function destroy($id)
    { try{
        $protectedID = Crypt::decrypt($id);
        $protected_house = ProtectedHouse::findorfail($protectedID);

        $protected_house->delete();
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('ProtectedHouse.index');
    }
    catch (\Exception $e) {
        toastr()->error(__('Admin/attributes.delete_wrong'));
        return redirect()->back();
    }



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
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }// end of bulkDelete


    public function protected_house_index(){
        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);
        return view('dashboard.admin.protected_houses.protected_house_statistics',compact('admin'));

    }


    public function protected_house_statistics($request)
    {
        $validated = $request->validate([

                'area_id' => 'sometimes|nullable|exists:areas,id',
                'state_id' => 'sometimes|nullable|exists:states,id',
                'village_id'=>'sometimes|nullable|exists:villages,id',
                'supported_side'=>'sometimes|nullable|in:private,govermental,international organizations',
                'status'=>'sometimes|nullable|in:active,inactive',
            ]
            , [
            'area_id.exists' => trans('Admin/validation.exists'),
            'village_id.exists' => trans('Admin/validation.exists'),
            'state_id.exists' => trans('Admin/validation.exists'),

        ]
        );
        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);
        $supported_side = $request->supported_side;
        $status = $request->status;
        if(!empty($request->area_id)){
            $area_name = AreaTranslation::where('area_id','=',$request->area_id)->pluck('name');

        }
        if(!empty($request->state_id)){
            $state_name = StateTranslation::where('state_id','=',$request->state_id)->pluck('name');
        }
        if(!empty($request->village_id)){
            $village_name = VillageTranslation::where('village_id','=',$request->village_id)->pluck('name');
        }

        if ($admin->type == 'employee') {
            if  ($request->village_id !=null  && $request->status !=null && $request->supported_side != null)
            {

                $area_id = $admin->area_id;
                $state_id = $admin->state_id;
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
                ->where('area_translations.area_id', $area_id)
                ->where('state_translations.state_id', $state_id)
                ->where('village_translations.name', $village_name)
                ->where('protected_houses.status', $status)
                ->where('protected_houses.supported_side', $supported_side)
                ->get();
                return view('dashboard.admin.protected_houses.protected_house_statistics',compact('admin','statistics'));

            }
            elseif
            ( $request->village_id !=null  && $request->status !=null && $request->supported_side == null)
            {
                $area_id = $admin->area_id;
                $state_id = $admin->state_id;
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
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('protected_houses.supported_side', $supported_side)
                    ->get();
                return view('dashboard.admin.orchards.statistics',compact('admin','statistics'));

            }
            elseif
            ( $request->village_id !=null  && $request->status ==null && $request->supported_side == null)
            {
                $area_id = $admin->area_id;
                $state_id = $admin->state_id;
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
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->get();
                return view('dashboard.admin.orchards.statistics',compact('admin','statistics'));

            }
            elseif
            ( $request->village_id ==null  && $request->status ==null && $request->supported_side == null)
            {
                $area_id = $admin->area_id;
                $state_id = $admin->state_id;
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
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->get();
                return view('dashboard.admin.orchards.statistics',compact('admin','statistics'));

            }
            elseif
            ( $request->village_id !=null  && $request->status ==null && $request->supported_side != null)
            {
                $area_id = $admin->area_id;
                $state_id = $admin->state_id;
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
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('protected_houses.status', $status)
                    ->get();
                return view('dashboard.admin.orchards.statistics',compact('admin','statistics'));

            }
        } elseif ($admin->type == 'admin') {

            if ($request->area_id != null && $request->state_id != null && $request->village_id != null
                && $request->status != null && $request->supported_side != null) {

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
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('protected_houses.supported_side', $supported_side)
                    ->where('protected_houses.status', $status)
                    ->get();
                return view('dashboard.admin.protected_houses.protected_house_statistics', compact('admin','statistics'));

            }
            elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null
                && $request->status != null && $request->supported_side != null) {

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
                    ->where('area_translations.name', $area_name)
                    ->where('protected_houses.supported_side', $supported_side)
                    ->where('protected_houses.status', $status)
                    ->get();
                return view('dashboard.admin.protected_houses.protected_house_statistics', compact('admin','statistics'));

            }
           elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null
                && $request->status == null && $request->supported_side != null) {

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
                    ->where('area_translations.name', $area_name)
                    ->where('protected_houses.supported_side', $supported_side)
                    ->get();
                return view('dashboard.admin.protected_houses.protected_house_statistics', compact('admin','statistics'));

            }
            elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null
                && $request->status != null && $request->supported_side == null) {

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
                    ->where('area_translations.name', $area_name)
                    ->where('protected_houses.status', $status)
                    ->get();
                return view('dashboard.admin.protected_houses.protected_house_statistics', compact('admin','statistics'));

            }
            elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null
                && $request->status == null && $request->supported_side == null) {

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
                    ->where('area_translations.name', $area_name)
                    ->get();
                return view('dashboard.admin.protected_houses.protected_house_statistics', compact('admin','statistics'));

            }
            elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null
                && $request->status == null && $request->supported_side == null) {

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
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->get();
                return view('dashboard.admin.protected_houses.protected_house_statistics', compact('admin','statistics'));

            }
            elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null
                && $request->status != null && $request->supported_side == null) {

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
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('protected_houses.status', $status)
                    ->get();
                return view('dashboard.admin.protected_houses.protected_house_statistics', compact('admin','statistics'));

            }

            elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null
                && $request->status == null && $request->supported_side != null) {

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
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('protected_houses.supported_side', $supported_side)
                    ->get();
                return view('dashboard.admin.protected_houses.protected_house_statistics', compact('admin','statistics'));

            }
            elseif ($request->area_id == null && $request->state_id == null && $request->village_id == null
                && $request->status == null && $request->supported_side == null) {

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
                return view('dashboard.admin.protected_houses.protected_house_statistics', compact('admin','statistics'));

            }
            elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null
                && $request->status != null && $request->supported_side != null) {

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
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('protected_houses.supported_side', $supported_side)
                    ->where('protected_houses.status', $status)
                    ->get();
                return view('dashboard.admin.protected_houses.protected_house_statistics', compact('admin','statistics'));

            }
            elseif ($request->area_id != null && $request->state_id != null && $request->village_id != null
                && $request->status == null && $request->supported_side == null) {

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
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->get();
                return view('dashboard.admin.protected_houses.protected_house_statistics', compact('admin','statistics'));

            }
            elseif ($request->area_id != null && $request->state_id != null && $request->village_id != null
                && $request->status != null && $request->supported_side == null) {

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
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('protected_houses.status', $status)

                    ->get();
                return view('dashboard.admin.protected_houses.protected_house_statistics', compact('admin','statistics'));

            }
            elseif ($request->area_id != null && $request->state_id != null && $request->village_id != null
                && $request->status == null && $request->supported_side != null) {

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
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('protected_houses.supported_side', $supported_side)

                    ->get();
                return view('dashboard.admin.protected_houses.protected_house_statistics', compact('admin','statistics'));

            }
        }

    }


}