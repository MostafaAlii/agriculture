<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\CourseBeeInterface;
use App\Models\CourseBee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Auth;
use Yajra\DataTables\DataTables;
class CourseBeeRepository implements CourseBeeInterface{

    public function index()
    {
        return view('dashboard.admin.course_bees.index');
    }

    public function data() {

        $courseBees = CourseBee::query();
        return DataTables::of($courseBees)

            ->addColumn('record_select', 'dashboard.admin.course_bees.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (CourseBee $courseBee) {
                return $courseBee->created_at->diffforhumans();
            })

            ->addColumn('actions', 'dashboard.admin.course_bees.data_table.actions')

            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store( $request) {
        DB::beginTransaction();
        try{
            $validated = $request->validated();

            CourseBee::create([
                'name'=>$validated['name'],
                'desc'=>$validated['desc']
            ]);

            DB::commit();

            toastr()->success(__('Admin/country.added_successfully'));
            return redirect()->route('CourseBees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function show(CourseBeeRequest $request)
    {
        //
    }


    public function edit(CourseBeeRequest $request)
    {
        //
    }

    public function update($request,$id)
    {
        DB::beginTransaction();

        try{
            $validated = $request->validated();

            $courseBeeID = Crypt::decrypt($id);
            $coursBee=CourseBee::findorfail($courseBeeID)->first();

            $coursBee->name =$validated['name'];
            $coursBee->desc =$validated['desc'];
            $coursBee->update();

            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('CourseBees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }

    public function destroy($id) {

        $courseBeeID = Crypt::decrypt($id);
        $courseBee=CourseBee::findorfail($courseBeeID)->first();

        $courseBee->delete();
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('CourseBees.index');

    }
    public function bulkDelete( $request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $course_bee_ids) {
                    $course_bee = CourseBee::findorfail($course_bee_ids)->first();

                    $course_bee->delete();
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('CourseBees.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('CourseBees.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete

}