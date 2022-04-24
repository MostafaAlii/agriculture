<?php
namespace  App\Http\Repositories\Admin;
use App\Models\AgriTService;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\Admin\AgriToolServiceInterface;

class AgriToolServiceRepository implements AgriToolServiceInterface{


    public function index() {
        return view('dashboard.admin.agriculture_tool_services.index');
    }
    public function data() {

        $agriculture_tool_service = AgriTService::query();
        return DataTables::of($agriculture_tool_service)
            ->addColumn('record_select', 'dashboard.admin.agriculture_tool_services.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (AgriTService $agri_tool_service) {
                return $agri_tool_service->created_at->diffforhumans();
            })

            ->addColumn('actions', 'dashboard.admin.agriculture_tool_services.data_table.actions')

            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store( $request) {
        DB::beginTransaction();
        try{
            $validated = $request->validated();

            AgriTService::create([
                'name'=>$validated['name']
            ]);

            DB::commit();

            toastr()->success(__('Admin/country.added_successfully'));
            return redirect()->route('AgricultureToolServices.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function update(  $request,$id) {

        try{
            DB::beginTransaction();

            $agriTSID = Crypt::decrypt($id);
            $agri_t_service=AgriTService::findorfail($agriTSID);
            $agri_t_service->name = $request->name;

            $agri_t_service->update();

            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('AgricultureToolServices.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }

    public function destroy($id) {

        $data = [];
        $agriTSID = Crypt::decrypt($id);

        $agri_t_service=AgriTService::findorfail($agriTSID);

        $agri_t_service->delete();
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('AgricultureToolServices.index');
    }

    public function bulkDelete( $request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $agri_t_service_ids) {
                    $agri_t_service = AgriTService::findorfail($agri_t_service_ids);


                    AgriTService::destroy($agri_t_service_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('AgricultureToolServices.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('AgricultureToolServices.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete
}