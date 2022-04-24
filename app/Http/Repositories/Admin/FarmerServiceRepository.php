<?php
namespace  App\Http\Repositories\Admin;
use App\Models\FarmerService;
use App\Http\Interfaces\Admin\FarmerServiceInterface;
use App\Models\Area;
use App\Models\State;
use App\Models\Village;
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
class FarmerServiceRepository implements FarmerServiceInterface {
    public function index()
    {

        return view('dashboard.admin.farmer_services.index');

    }

    public function data()
    {
        $farmers_s = FarmerService::with('farmer', 'village', 'area','state','adminDepartment','agri_services','agrit_services','water_services')

            ->selectRaw('distinct farmer_services.*')->get();

        return DataTables::of($farmers_s)
            ->addColumn('record_select', 'dashboard.admin.farmer_services.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (FarmerService $farmer_service) {
                return $farmer_service ->created_at->diffforhumans();
            })
            ->addColumn('farmer', function (FarmerService $farmer_service) {
                return $farmer_service ->farmer->email;
            })
            ->addColumn('area', function (FarmerService $farmer_service) {
                return $farmer_service->area->name;
            })
            ->addColumn('state', function (FarmerService $farmer_service) {
                return $farmer_service->state->name;
            })

            ->addColumn('village', function (FarmerService $farmer_service) {
                return $farmer_service->village->name;
            })



            ->addColumn('name', function ($farmers_s) {
                return implode(', ', $farmers_s->agri_services->pluck('name')->toArray());
            })
            ->rawColumns(['name'])
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

    public function create(){

        $areas = Area::all();
        $farmers = Farmer::all();
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();
        $agri_services = AgriService::all();
        $agri_t_services = AgriTService::all();
        $water_services = WaterService::all();
        $state = State::all();

        return view('dashboard.admin.farmer_services.create',
            compact('farmers', 'admin_dpartments', 'agri_services', 'agri_t_services','areas','water_services'));
    }

    public function store($request)

    {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $farmerService = new FarmerService();
            $farmerService->admin_id = Auth::user()->id;
            $farmerService->farmer_id = $requestData['farmer_id'];
            $farmerService->area_id = $requestData['area_id'];
            $farmerService->state_id = $requestData['state_id'];
            $farmerService->village_id = $requestData['village_id'];
            $farmerService->admin_department_id = $requestData['admin_department_id'];
            $farmerService->phone = $requestData['phone'];
            $farmerService->email = $requestData['email'];


            $farmerService->save($requestData);
            $farmerService->agri_services()->attach($request->agri_services);
            $farmerService->agrit_services()->attach($request->agrit_services);
            $farmerService->water_services()->attach($request->water_services);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('FarmerServices.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }

    }

    public function edit($id){
        $farmer_service = FarmerService::findorfail($id);
        $areas = Area::all();
        $farmers = Farmer::all();
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();
        $agri_services = AgriService::all();
        $agri_t_services = AgriTService::all();
        $water_services = WaterService::all();
        $state = State::all();

        return view('dashboard.admin.farmer_services.edit',
            compact('farmers','farmer_service', 'admin_dpartments',
                'agri_services', 'agri_t_services','areas','water_services'));
    }

    public function update($request,$id)

    {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $farmerService =  FarmerService::findorfail($id);
            $farmerService->admin_id = Auth::user()->id;
            $farmerService->farmer_id = $requestData['farmer_id'];
            $farmerService->area_id = $requestData['area_id'];
            $farmerService->state_id = $requestData['state_id'];
            $farmerService->village_id = $requestData['village_id'];
            $farmerService->admin_department_id = $requestData['admin_department_id'];
            $farmerService->phone = $requestData['phone'];
            $farmerService->email = $requestData['email'];


            $farmerService->update($requestData);
            $farmerService->agri_services()->sync($request->agri_services);
            $farmerService->agrit_services()->sync($request->agrit_services);
            $farmerService->water_services()->sync($request->water_services);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('FarmerServices.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }

    }

    public function destroy($id)
    {
        $farmer_serviceID = Crypt::decrypt($id);
        $farmer_service = FarmerService::findorfail($farmer_serviceID);
        $agri_services = $farmer_service->agri_services->count();
        $water_services = $farmer_service->water_services->count();

        $agri_services = $farmer_service->agri_services->count();

        if($agri_services> 0 and $agri_services>0 and $water_services>0){
            toastr()->error(__('Admin/services.cant_delete'));
            return redirect()->route('FarmerServices.index');
        }else{
            $farmer_service->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('FarmerServices.index');
        }


    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $farmer_services_ids) {

                    $farmer_service = FarmerService::findorfail($farmer_services_ids);
                    $agri_services = $farmer_service->agri_services->count();
                    $water_services = $farmer_service->water_services->count();

                    $agri_services = $farmer_service->agri_services->count();

                    if($agri_services> 0 and $agri_services>0 and $water_services>0){
                        toastr()->error(__('Admin/services.cant_delete'));
                        return redirect()->route('FarmerServices.index');
                    }

                    Orchard::destroy($farmer_services_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('FarmerServices.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('FarmerServices.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete




}