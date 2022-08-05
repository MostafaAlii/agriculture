<?php

namespace App\Http\Repositories\Admin;

use App\Models\Wholesale;

use App\Http\Interfaces\Admin\WholesaleInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class WholesaleRepository implements WholesaleInterface
{

    public function index()
    {

        return view('dashboard.admin.wholesales.index');
    }

    public function data()
    {

        $wholesales = Wholesale::query()->get();
        return DataTables::of($wholesales)
            ->addIndexColumn()
            ->addColumn('record_select', 'dashboard.admin.wholesales.data_table.record_select')

            ->editColumn('created_at', function (Wholesale $wholesale) {
                return $wholesale->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.wholesales.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store($request)
    {
        try {
            $validated = $request->validated();

            Wholesale::create([
                'Name' => $validated['Name']
            ]);


            toastr()->success(__('Admin/wholesale.added_successfully'));
            return redirect()->route('Wholesales.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));

            return redirect()->back();

        }


    }

    public function update($request, $id)
    {

        try {

            $wholesaleId = Crypt::decrypt($id);
            $wholesale = Wholesale::findorfail($wholesaleId);
            $wholesale->Name = $request->Name;

            $wholesale->update();

            DB::commit();
            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('Wholesales.index');
        }
        catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));
            return redirect()->back();

        }


    }
//
    public function destroy($id) {

        $wholesaleID = Crypt::decrypt($id);

        $wholesale=Wholesale::findorfail($wholesaleID);

        $wholesale->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('Wholesales.index');

    }


    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $wholesale_id) {
                    $wholesale = Wholesale::findorfail($wholesale_id);
                    $wholesale->delete();

                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('Wholesales.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('Wholesales.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete

}