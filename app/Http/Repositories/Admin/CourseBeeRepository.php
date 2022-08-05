<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\CourseBeeInterface;
use App\Models\CourseBee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Auth;
use Yajra\DataTables\DataTables;

class CourseBeeRepository implements CourseBeeInterface
{

    public function index()
    {
        return view('dashboard.admin.course_bees.index');
    }

    public function data()
    {

        $courseBees = CourseBee::query()->get();
        return DataTables::of($courseBees)
            ->addColumn('record_select', 'dashboard.admin.course_bees.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (CourseBee $courseBee) {
                return $courseBee->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.course_bees.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();
    }

    public function store($request)
    {
        try {
            $validated = $request->validated();

            CourseBee::create([
                'name' => $validated['name'],
                'desc' => $validated['desc']
            ]);


            toastr()->success(__('Admin/country.added_successfully'));
            return redirect()->route('CourseBees.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));

            return redirect()->back();
        }


    }


    public function edit(CourseBeeRequest $request)
    {
        //
    }

    public function update($request, $id)
    {

        try {
            $validated = $request->validated();

            $courseBeeID = Crypt::decrypt($id);
            $coursBee = CourseBee::findorfail($courseBeeID)->first();

            $coursBee->name = $validated['name'];
            $coursBee->desc = $validated['desc'];
            $coursBee->update();

            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('CourseBees.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));

            return redirect()->back();

        }


    }

    public function destroy($id)
    {
        try {
            $courseBeeID = Crypt::decrypt($id);
            $courseBee = CourseBee::findorfail($courseBeeID);

            $courseBee->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('CourseBees.index');
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
                foreach ($delete_select_id as $course_bee_ids) {
                    $course_bee = CourseBee::findorfail($course_bee_ids);

                    $course_bee->delete();
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('CourseBees.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('CourseBees.index');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }// end of bulkDelete

}