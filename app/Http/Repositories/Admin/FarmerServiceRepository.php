<?php

namespace App\Http\Repositories\Admin;

use App\Models\FarmerService;
use App\Http\Interfaces\Admin\FarmerServiceInterface;
use App\Models\Area;
use App\Models\State;
use App\Models\AreaTranslation;
use App\Models\StateTranslation;
use App\Models\Village;

use App\Models\VillageTranslation;
use App\Models\Farmer;
use App\Models\Admin;
use App\Models\AgriService;
use App\Models\AgriTService;
use App\Models\WaterService;
use App\Models\AdminDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Auth;
use Yajra\DataTables\DataTables;

class FarmerServiceRepository implements FarmerServiceInterface
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
            return view('dashboard.admin.farmer_services.index',
                compact('admin', 'areaID', 'area_name', 'stateID', 'state_name'));
        }


    }

    public function data()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == 'employee') {
            $farmers_s = FarmerService::with('farmer', 'village', 'admin',
                'agri_services', 'agrit_services', 'water_services')
                ->where('admin_id', $admin->id)
                ->selectRaw('distinct farmer_services.*')->get();
        } else {
            $farmers_s = FarmerService::with('farmer', 'village', 'admin',
                'agri_services', 'agrit_services', 'water_services')
                ->selectRaw('distinct farmer_services.*')->get();
        }
        return DataTables::of($farmers_s)
            ->addColumn('record_select', 'dashboard.admin.farmer_services.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (FarmerService $farmer_service) {
                return $farmer_service->created_at->diffforhumans();
            })
            ->addColumn('farmer', function (FarmerService $farmer_service) {
                return $farmer_service->farmer->firstname;
            })
            ->addColumn('admin', function (FarmerService $farmer_service) {
                return $farmer_service->admin->firstname;
            })
            ->addColumn('village', function (FarmerService $farmer_service) {
                return $farmer_service->village->name;
            })
            ->addColumn('name_a', function ($farmers_s) {
                return implode(', ', $farmers_s->agri_services->pluck('name')->toArray());
            })
            ->rawColumns(['name_a'])
            ->addColumn('name_t', function ($farmers_s) {
                return implode(', ', $farmers_s->agrit_services->pluck('name')->toArray());
            })
            ->rawColumns(['name_t'])
            ->addColumn('name_w', function ($farmers_s) {
                return implode(', ', $farmers_s->water_services->pluck('name')->toArray());
            })
            ->rawColumns(['name_w'])
            ->addColumn('actions', 'dashboard.admin.farmer_services.data_table.actions')
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
        $villages = Village::where('state_id', $stateID)->get();
        $agri_services = AgriService::all();
        $agri_t_services = AgriTService::all();
        $water_services = WaterService::all();
        $areas = Area::all();
        $states = State::all();

        return view('dashboard.admin.farmer_services.create',
            compact('states', 'stateID', 'state_name', 'adminId', 'area_name', 'areaID', 'villages', 'agri_services', 'agri_t_services', 'areas', 'water_services'));
    }

    public function store($request)

    {
        DB::beginTransaction();
        try {

            $requestData = $request->validated();
            $farmerService = new FarmerService();

            $farmerService->farmer_id = $requestData['farmer_id'];
            $farmerService->admin_id = $requestData['admin_id'];
            $farmerService->area_id = $requestData['area_id'];
            $farmerService->state_id = $requestData['state_id'];
            $farmerService->village_id = $requestData['village_id'];

            $farmerService->agri_services_count = count(array_unique(array($request->agri_services)));
            $farmerService->agri_t_services_count = count(array_unique(array($request->agri_t_services)));

            $farmerService->water_services_count = count(array_unique(array($request->water_services)));

            $farmerService->save($requestData);
            $farmerService->agri_services()->attach($request->agri_services);
            $farmerService->agrit_services()->attach($request->agri_t_services);
            $farmerService->water_services()->attach($request->water_services);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('FarmerServices.index');


        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.add_wrong'));

            return redirect()->back();
        }

    }

    public function edit($id)
    {
        $farmer_serviceID = Crypt::decrypt($id);
        $farmer_service = FarmerService::findorfail($farmer_serviceID);
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        $villages = Village::where('state_id', $stateID)->get();
        $agri_services = AgriService::all();
        $agri_t_services = AgriTService::all();
        $water_services = WaterService::all();
        $areas = Area::all();
        $states = State::all();

        return view('dashboard.admin.farmer_services.edit',
            compact('areaID', 'area_name', 'farmer_service', 'state_name', 'stateID', 'states', 'villages', 'adminId',
                'agri_services', 'agri_t_services', 'areas', 'water_services'));
    }

    public function update($request, $id)

    {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $farmer_serviceID = Crypt::decrypt($id);
            $farmerService = FarmerService::findorfail($farmer_serviceID);

            $farmerService->farmer_id = $requestData['farmer_id'];
            $farmerService->admin_id = $requestData['admin_id'];
            $farmerService->area_id = $requestData['area_id'];
            $farmerService->state_id = $requestData['state_id'];
            $farmerService->village_id = $requestData['village_id'];

            $farmerService->agri_services_count = count(array_unique(array($request->agri_services)));
            $farmerService->agri_t_services_count = count(array_unique(array($request->agri_t_services)));

            $farmerService->water_services_count = count(array_unique(array($request->water_services)));

            $farmerService->update($requestData);
            $farmerService->agri_services()->sync($request->agri_services);
            $farmerService->agrit_services()->sync($request->agri_t_services);
            $farmerService->water_services()->sync($request->water_services);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('FarmerServices.index');


        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.edit_wrong'));

            return redirect()->back();
        }

    }

    public function destroy($id)
    {
        try {
            $farmer_serviceID = Crypt::decrypt($id);
            $farmer_service = FarmerService::findorfail($farmer_serviceID);

            $farmer_service->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('FarmerServices.index');

        } catch (\Exception $e) {
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
                foreach ($delete_select_id as $farmer_services_ids) {

                    $farmer_service = FarmerService::findorfail($farmer_services_ids);

                    FarmerService::destroy($farmer_services_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('FarmerServices.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('FarmerServices.index');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();
        }
    }

    // end of bulkDelete

    public function farmer_services_index_statistics()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $state_id = $admin->state->id;
        return view('dashboard.admin.farmer_services.statistics', compact('admin','state_id'));
    }

    public function farmer_services_statistics($request)
    {
        $validated = $request->validate([
            'area_id' => 'sometimes|nullable|exists:areas,id',
            'state_id' => 'sometimes|nullable|exists:states,id',
            'village_id' => 'sometimes|nullable|exists:villages,id',

        ], [

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

        if ($admin->type == 'employee') {
            if ($request->village_id != null) {

                $area_id = $admin->area_id;
                $state_id = $admin->state_id;
                $statistics = FarmerService::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw("SUM(farmer_services.agri_services_count) As agri_services_count"),
                    DB::raw("SUM(farmer_services.agri_t_services_count) As agri_t_services_count"),
                    DB::raw("SUM(farmer_services.water_services_count) As water_services_count"))
                    ->join('area_translations', 'farmer_services.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_services.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_services.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'farmer_services.farmer_id', '=', 'farmers.id')
                    ->where('farmer_services.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer'
                    )->get();
                return view('dashboard.admin.farmer_services.statistics', compact('state_id','admin', 'statistics'));

            }
            if ($request->village_id == null) {

                $area_id = $admin->area_id;
                $state_id = $admin->state_id;
                $statistics = FarmerService::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw("SUM(farmer_services.agri_services_count) As agri_services_count"),
                    DB::raw("SUM(farmer_services.agri_t_services_count) As agri_t_services_count"),
                    DB::raw("SUM(farmer_services.water_services_count) As water_services_count"))
                    ->join('area_translations', 'farmer_services.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_services.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_services.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'farmer_services.farmer_id', '=', 'farmers.id')
                    ->where('farmer_services.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->GroupBy('Area', 'State', 'Village', 'farmer'
                    )->get();
                return view('dashboard.admin.farmer_services.statistics', compact('state_id','admin', 'statistics'));

            }
        }
        elseif ($admin->type == 'admin') {
            if ($request->area_id != null && $request->state_id != null && $request->village_id != null) {
                $statistics = FarmerService::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw("SUM(farmer_services.agri_services_count) As agri_services_count"),
                    DB::raw("SUM(farmer_services.agri_t_services_count) As agri_t_services_count"),
                    DB::raw("SUM(farmer_services.water_services_count) As water_services_count"))
                    ->join('area_translations', 'farmer_services.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_services.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_services.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'farmer_services.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer'
                    )->get();
                return view('dashboard.admin.farmer_services.statistics', compact('admin', 'statistics'));

            } elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null) {
                $statistics = FarmerService::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw("SUM(farmer_services.agri_services_count) As agri_services_count"),
                    DB::raw("SUM(farmer_services.agri_t_services_count) As agri_t_services_count"),
                    DB::raw("SUM(farmer_services.water_services_count) As water_services_count"))
                    ->join('area_translations', 'farmer_services.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_services.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_services.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'farmer_services.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer'
                    )->get();
                return view('dashboard.admin.farmer_services.statistics', compact('admin', 'statistics'));

            } elseif ($request->area_id == null && $request->state_id == null && $request->village_id == null) {
                $statistics = FarmerService::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw("SUM(farmer_services.agri_services_count) As agri_services_count"),
                    DB::raw("SUM(farmer_services.agri_t_services_count) As agri_t_services_count"),
                    DB::raw("SUM(farmer_services.water_services_count) As water_services_count"))
                    ->join('area_translations', 'farmer_services.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_services.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_services.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'farmer_services.farmer_id', '=', 'farmers.id')
                    ->GroupBy('Area', 'State', 'Village', 'farmer'
                    )->get();
                return view('dashboard.admin.farmer_services.statistics', compact('admin', 'statistics'));

            } elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null) {
                $statistics = FarmerService::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw("SUM(farmer_services.agri_services_count) As agri_services_count"),
                    DB::raw("SUM(farmer_services.agri_t_services_count) As agri_t_services_count"),
                    DB::raw("SUM(farmer_services.water_services_count) As water_services_count"))
                    ->join('area_translations', 'farmer_services.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_services.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_services.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'farmer_services.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer'
                    )->get();
                return view('dashboard.admin.farmer_services.statistics', compact('admin', 'statistics'));

            }

        }
    }


}