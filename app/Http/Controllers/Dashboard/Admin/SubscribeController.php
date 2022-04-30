<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class SubscribeController extends Controller
{
    // public function index()
    // {
    //    return 'hello';

    // }
    public function data(Request $request) {
        if(request()->ajax()) {
            return datatables()->of(Data::select('*'))
            ->addColumn('record_select', 'dashboard.admin.Dates.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Data $data) {
                return $data->created_at->format('Y-m-d');
            })

            // ->addColumn('actions', function (Data $data) {
            //     return view('dashboard.admin.Datas.data_table.actions', compact('Data'));
            // })
            ->addColumn('actions', 'dashboard.admin.Dates.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
        }
        return view('dashboard.admin.Dates.index');
    }
    public function destroy($id) {
        try{
            $dataID = Crypt::decrypt($id);
            //  dd($adminID);
            $data=Data::findorfail($dataID);
            $data->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('subscribe');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }
    // public function bulkDelete($request) {
    //     if($request->delete_select_id){
    //         $delete_select_id = explode(",",$request->delete_select_id);
    //         foreach($delete_select_id as $datas_ids){
    //            $admin = Data::findorfail($datas_ids);
    //         }
    //     }else{
    //         toastr()->error(__('Admin/site.no_data_found'));
    //         return redirect()->route('subscribe');
    //     }
    //     Data::destroy( $delete_select_id );
    //     toastr()->error(__('Admin/site.deleted_successfully'));
    //     return redirect()->route('subscribe');

    // }// end of bulkDelete

    public function bulkDelete( Request $request) {
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $datas_ids) {
                    $data = Data::findorfail($datas_ids)->first();
                    $data->delete();
                }
                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('subscribe');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('subscribe');
            }
    }// end of bulkDelete
}
