<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\WorkerInterface;
use App\Models\Admin;
use App\Models\Area;
use App\Models\Worker;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Traits\UploadT;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
class WorkerRepository implements WorkerInterface{
    use UploadT;
    public function index() {
        return view('dashboard.admin.workers.index');
    }
    public function data() {
        $workers = Worker::select();

        return DataTables::of($workers)
            ->addColumn('record_select', 'dashboard.admin.workers.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Worker $worker) {
                return $worker->created_at->format('Y-m-d');
            })
            ->addColumn('status', function (Worker $worker) {
                return view('dashboard.admin.workers.data_table.status', compact('worker'));
            })
            ->addColumn('salary', function (Worker $worker) {
                return view('dashboard.admin.workers.data_table.salary', compact('worker'));
            })
            ->addColumn('work', function (Worker $worker) {
                return view('dashboard.admin.workers.data_table.work', compact('worker'));
            })
            ->addColumn('image', function (Worker $worker) {
                return view('dashboard.admin.workers.data_table.image', compact('worker'));
            })
            ->addColumn('dhprice', function (Worker $worker) {
                return view('dashboard.admin.workers.data_table.dayandhourprice', compact('worker'));
            })
             ->addColumn('country', function (Worker $worker) {
                return $worker->country->name??null;
                })
            ->addColumn('actions', 'dashboard.admin.workers.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function create() {
        // $areas = Area::all();
        return view('dashboard.admin.workers.create');
    }
    public function store($request) {
        DB::beginTransaction();
        try{
            $requestData = $request->validated();
            $requestData['password'] = bcrypt($request->password);
            Worker::create($requestData);
            $worker = Worker::latest()->first();
            $this->addImage($request, 'image' , 'workers' , 'upload_image',$worker->id, 'App\Models\Worker');
            Notification::send($worker, new \App\Notifications\NewWorker($worker));
            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('workers.index');
         } catch (\Exception $e) {
            DB::rollBack();
           toastr()->error(__('Admin/site.sorry'));
            // return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
           return redirect()->back();
         }
    }

    public function edit($id) {
        $workerID = Crypt::decrypt($id);
        $worker=Worker::findorfail($workerID);
        return view('dashboard.admin.workers.profile.profiledit', compact('worker'));
    }

    // public function update( $request,$id) {
    //     try{
    //         DB::beginTransaction();
    //         $workerID = Crypt::decrypt($id);
    //         $worker=Admin::findorfail($workerID);
    //         $requestData = $request->validated();
    //         $requestData['type'] = $request->type;
    //         $worker->update($requestData);

    //         if($request->image){
    //             $this->deleteImage('upload_image','/admins/' . $worker->image->filename,$worker->id);
    //         }
    //         $this->addImage($request, 'image' , 'admins' , 'upload_image',$worker->id, 'App\Models\Admin');

    //         DB::commit();
    //         toastr()->success( __('Admin/site.updated_successfully'));
    //         return redirect()->route('Admins.index');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         toastr()->error(__('Admin/site.sorry'));
    //         return redirect()->back();
    //     }
    // }

    public function destroy($id) {
        try{
            $workerID = Crypt::decrypt($id);
            //  dd($workerID);
            $worker=Worker::findorfail($workerID);
            if($worker->image){
                $this->deleteImage('upload_image','/workers/' . $worker->image->filename,$worker->id);
            }
            $worker->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('workers.index');
        } catch (\Exception $e) {
            // toastr()->error(__('Admin/site.sorry'));
            toastr()->error(__('Admin/site.cant_delete'));
            return redirect()->back();
        }
    }
    public function bulkDelete($request) {
        if($request->delete_select_id){
            $delete_select_id = explode(",",$request->delete_select_id);
            foreach($delete_select_id as $workers_ids){
               $worker = Worker::findorfail($workers_ids);
               if($worker->image){
                $this->deleteImage('upload_image','/workers/' . $worker->image->filename,$worker->id);
               }
            }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('workers.index');
        }
        Worker::destroy( $delete_select_id );
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('workers.index');

    }// end of bulkDelete

    public function showProfile($id){
        $workerID = Crypt::decrypt($id);
        $worker=Worker::findorfail($workerID);
        return view('dashboard.admin.workers.profile.profileview', compact('worker'));
    }

    public function updateAccount($request,$id) {
        try{
            DB::beginTransaction();
            $workerID = Crypt::decrypt($id);
            $worker=Worker::findorfail($workerID);
            $requestData = $request->validated();
            // $requestData['status'] = $request->status;
            if($request->daily_price ){
                $requestData['hourly_price'] = null;
            }
            if($request->hourly_price ){
                $requestData['daily_price'] = null;
            }
            $worker->update($requestData);

            if($request->image){
                $this->deleteImage('upload_image','/workers/' . $worker->image->filename,$worker->id);
            }
            $this->addImage($request, 'image' , 'workers' , 'upload_image',$worker->id, 'App\Models\Worker');

            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('workers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
            //    return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }
    }// end of update

    public function updateInformation($request,$id) {
        try{
            $workerID = Crypt::decrypt($id);
            $worker=Worker::findorfail($workerID);
            $requestData = $request->validated();
            $worker->update($requestData);
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('workers.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }

    }// end of update
}
