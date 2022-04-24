<?php
namespace  App\Http\Repositories\Admin;
use Illuminate\Http\Request;
use App\Models\BeeDisaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Auth;
use Yajra\DataTables\DataTables;
use App\Http\Interfaces\Admin\BeeDisasterInterface;

class BeeDisasterRepository implements BeeDisasterInterface{
    public function index()
    {
        return view('dashboard.admin.bee_disasters.index');
    }

    public function data() {

        $bDisaster = BeeDisaster::query();
        return DataTables::of($bDisaster)

            ->addColumn('record_select', 'dashboard.admin.bee_disasters.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (BeeDisaster $bDisaster) {
                return $bDisaster->created_at->diffforhumans();
            })

            ->addColumn('actions', 'dashboard.admin.bee_disasters.data_table.actions')

            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }
    public function store( $request) {
        DB::beginTransaction();
        try{
            $validated = $request->validated();
            $bDisaster = new BeeDisaster();
            $bDisaster->name = $validated['name'];
            $bDisaster->desc = $validated['desc'];
            $bDisaster->save();

            DB::commit();

            toastr()->success(__('Admin/country.added_successfully'));
            return redirect()->route('BeeDisasters.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function update( $request,$id)
    {
        DB::beginTransaction();

        try{
            $validated = $request->validated();

            $bDisasterID = Crypt::decrypt($id);
            $bDisaster=BeeDisaster::findorfail($bDisasterID);

            $bDisaster->name =$validated['name'];
            $bDisaster->desc =$validated['desc'];
            $bDisaster->update();

            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('BeeDisasters.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }
    public function destroy($id) {

        $bDisasterID = Crypt::decrypt($id);
        $bDisaster=BeeDisaster::findorfail($bDisasterID)->first();

        $bDisaster->delete();
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('BeeDisasters.index');

    }
    public function bulkDelete( $request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $bee_disaster_ids) {
                    $bDisaster = BeeDisaster::findorfail($bee_disaster_ids)->first();

                    $bDisaster->delete();
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('BeeDisasters.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('BeeDisasters.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete
}