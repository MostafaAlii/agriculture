<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\SubscribeInterface;
use App\Jobs\Sendmails;
use App\Jobs\Subscriptions\SendExpiredSubscriptionMailJob;
use App\Models\Admin;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Traits\UploadT;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
class SubscribeRepository implements SubscribeInterface{
    public function data($request) {
        if(request()->ajax()) {
            return datatables()->of(Subscription::select('*'))
            ->addColumn('record_select', 'dashboard.admin.Dates.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Subscription $data) {
                return $data->created_at->format('Y-m-d');
            })
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
            $data=Subscription::findorfail($dataID);
            $data->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('subscribe');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }
    // public function bulkDelete($request) {
    //     if ($request->delete_select_id) {
    //         $delete_select_id = explode(",", $request->delete_select_id);
    //         foreach ($delete_select_id as $datas_ids) {
    //             $data = Data::findorfail($datas_ids)->first();
    //             $data->delete();
    //         }
    //         toastr()->error(__('Admin/site.deleted_successfully'));
    //         return redirect()->route('subscribe');
    //     } else {
    //         toastr()->error(__('Admin/site.no_data_found'));
    //         return redirect()->route('subscribe');
    //     }
    // }// end of bulkDelete

        public function bulkDelete($request) {
        if($request->delete_select_id){
            $delete_select_id = explode(",",$request->delete_select_id);
            foreach($delete_select_id as $datas_ids){
               $admin = Subscription::findorfail($datas_ids);
            }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('subscribe');
        }
        Subscription::destroy( $delete_select_id );
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('subscribe');

    }// end of bulkDelete
    // public function sendMails()
    // {
    //     $emails = Subscription::chunk(50,function($data){
    //          dispatch(new Sendmails($data));
    //     });
    //     toastr()->success(__('Admin/site.emails_success'));
    //     return redirect()->route('subscribe');
    // }
    // public function sendMails()
    // {
    //     $emails = Subscription::chunk(50,function($ex_subscription,$expired_date){
    //          dispatch(new SendExpiredSubscriptionMailJob($ex_subscription,$expired_date))->delay(\Carbon\Carbon::now()->addSeconds(10));

    //     });
    //     // $job = (new SendExpiredSubscriptionMailJob)->delay(\Carbon\Carbon::now()->addSeconds(10));
    //     // dispatch($job);
    //     // dd($data);
    //     toastr()->success(__('Admin/site.subsms'));
    //     return redirect()->route('subscribe');
    // }
}
