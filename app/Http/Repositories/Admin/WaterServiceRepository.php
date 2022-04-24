<?php
namespace  App\Http\Repositories\Admin;
use App\Models\WaterService;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\Admin\WaterServiceInterface;
class WaterServiceRepository implements WaterServiceInterface{

    public function index() {
        return view('dashboard.admin.water_services.index');
    }
    public function data() {

        $waterServices = WaterService::query();
        return DataTables::of($waterServices)
            ->addColumn('record_select', 'dashboard.admin.water_services.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (WaterService $waterService) {
                return $waterService->created_at->diffforhumans();
            })

            ->addColumn('actions', 'dashboard.admin.water_services.data_table.actions')

            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store($request) {
        DB::beginTransaction();
        try{
            $validated = $request->validated();

            WaterService::create([
                'name'=>$validated['name']
            ]);

            DB::commit();

            toastr()->success(__('Admin/country.added_successfully'));
            return redirect()->route('WaterServices.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function update($request,$id) {

        try{
            DB::beginTransaction();

            $waterSID = Crypt::decrypt($id);
            $water_service=WaterService::findorfail($waterSID);
            $water_service->name = $request->name;

            $water_service->update();

            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('WaterServices.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }

    public function destroy($id) {

        $data = [];
        $waterSID = Crypt::decrypt($id);

        $water_service=WaterService::findorfail($waterSID);

        $water_service->delete();
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('WaterServices.index');
    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $water_service_ids) {
                    $water_service = WaterService::findorfail($water_service_ids);


                    WaterService::destroy($water_service_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('WaterServices.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('WaterServices.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete
}