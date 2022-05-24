<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\AgriServiceInterface;
use App\Models\AgriService;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
class AgriServiceRepository implements AgriServiceInterface {
    public function index() {
        return view('dashboard.admin.agriculture_services.index');
    }
    public function data() {

        $agriculture_service = AgriService::query();
        return DataTables::of($agriculture_service)

            ->addColumn('record_select', 'dashboard.admin.agriculture_services.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (AgriService $agri_service) {
                return $agri_service->created_at->diffforhumans();
            })

            ->addColumn('actions', 'dashboard.admin.agriculture_services.data_table.actions')

            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store($request) {
        DB::beginTransaction();
        try{
            $validated = $request->validated();

            AgriService::create([
                'name'=>$validated['name']
            ]);

            DB::commit();

            toastr()->success(__('Admin/country.added_successfully'));
            return redirect()->route('AgricultureServices.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function update( $request,$id) {

        try{
            DB::beginTransaction();

            $agriSID = Crypt::decrypt($id);
            $agri_service=AgriService::findorfail($agriSID);
            $agri_service->name = $request->name;

            $agri_service->update();

            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('AgricultureServices.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }

    public function destroy($id) {

        $agriSID = Crypt::decrypt($id);

        $agri_service=AgriService::findorfail($agriSID);

        $agri_service->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('AgricultureServices.index');
        }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $agri_service_ids) {
                    $agri_service = AgriService::findorfail($agri_service_ids);


                    AgriService::destroy($agri_service_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('AgricultureServices.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('AgricultureServices.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete


}