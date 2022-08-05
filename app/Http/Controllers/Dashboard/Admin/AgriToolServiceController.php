<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgriTService;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Dashboard\AgriTServiceRequest;
use App\Http\Requests\Dashboard\AgriTServiceUpdateRequest;

use App\Http\Interfaces\Admin\AgriToolServiceInterface;


class AgriToolServiceController extends Controller
{
    protected $Data;
    public function __construct(AgriToolServiceInterface $Data) {
        $this->middleware('permission:agriculture-tools-service', ['only' => ['index']]);
        $this->middleware('permission:agriculture-tools-service-create', ['only' => ['store']]);
        $this->middleware('permission:agriculture-tools-service-edit', ['only' => ['update']]);
        $this->middleware('permission:agriculture-tools-service-delete', ['only' => ['destroy']]);
        $this->middleware('permission:agriculture-tools-service-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }


    public function data() {
        return $this->Data->data();
    }

    public function store(AgriTServiceRequest $request) {
        return $this->Data->store($request);
    }
    public function update(AgriTServiceUpdateRequest $request,$id) {
        return $this->Data->update($request,$id);
    }
    public function destroy($id) {
        return $this->Data->destroy($id);
    }
    public function bulkDelete(Request $request) {
        return $this->Data->destroy($request);
    }


//    public function index() {
//        return view('dashboard.admin.agriculture_tool_services.index');
//    }
//    public function data() {
//
//        $agriculture_tool_service = AgriTService::query();
//        return DataTables::of($agriculture_tool_service)
//            ->addColumn('record_select', 'dashboard.admin.agriculture_tool_services.data_table.record_select')
//            ->addIndexColumn()
//            ->editColumn('created_at', function (AgriTService $agri_tool_service) {
//                return $agri_tool_service->created_at->diffforhumans();
//            })
//
//            ->addColumn('actions', 'dashboard.admin.agriculture_tool_services.data_table.actions')
//
//            ->rawColumns([ 'record_select','actions'])
//            ->toJson();
//    }
//
//    public function store( AgriTServiceRequest $request) {
//        DB::beginTransaction();
//        try{
//            $validated = $request->validated();
//
//            AgriTService::create([
//                'name'=>$validated['name']
//            ]);
//
//            DB::commit();
//
//            toastr()->success(__('Admin/country.added_successfully'));
//            return redirect()->route('AgricultureToolServices.index');
//        } catch (\Exception $e) {
//            DB::rollBack();
//            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
//        }
//
//
//    }
//
//    public function update( AgriTServiceRequest $request,$id) {
//
//        try{
//            DB::beginTransaction();
//
//            $agriTSID = Crypt::decrypt($id);
//            $agri_t_service=AgriTService::findorfail($agriTSID);
//            $agri_t_service->name = $request->name;
//
//            $agri_t_service->update();
//
//            DB::commit();
//            toastr()->success( __('Admin/site.updated_successfully'));
//            return redirect()->route('AgricultureToolServices.index');
//        } catch (\Exception $e) {
//            DB::rollBack();
//            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
//
//        }
//
//
//    }
//
//    public function destroy($id) {
//
//        $data = [];
//        $agriTSID = Crypt::decrypt($id);
//
//        $agri_t_service=AgriTService::findorfail($agriTSID);
//
//        $agri_t_service->delete();
//        toastr()->success(__('Admin/site.deleted_successfully'));
//        return redirect()->route('AgricultureToolServices.index');
//    }
//
//    public function bulkDelete( Request $request) {
//        try {
//            DB::beginTransaction();
//            if ($request->delete_select_id) {
//                $delete_select_id = explode(",", $request->delete_select_id);
//                foreach ($delete_select_id as $agri_t_service_ids) {
//                    $agri_t_service = AgriTService::findorfail($agri_t_service_ids);
//
//
//                    AgriTService::destroy($agri_t_service_ids);
//                }
//                DB::commit();
//
//                toastr()->error(__('Admin/site.deleted_successfully'));
//                return redirect()->route('AgricultureToolServices.index');
//            } else {
//                toastr()->error(__('Admin/site.no_data_found'));
//                return redirect()->route('AgricultureToolServices.index');
//            }
//        }catch (\Exception $e) {
//            DB::rollBack();
//            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
//
//        }
//
//
//    }// end of bulkDelete
}
