<?php
namespace  App\Http\Repositories\Admin;
use App\Models\Area;
use App\Models\Admin;
use App\Models\Worker;
use App\Models\Currency;
use App\Traits\HasImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\NewWorker;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Notification;
use App\Http\Interfaces\Admin\WorkerInterface;

class WorkerRepository implements WorkerInterface{
    use HasImage;
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
        $currencies = Currency::all();
        return view('dashboard.admin.workers.create',compact('currencies'));
    }
    
    public function store($request) {
        DB::beginTransaction();
        try{
            $requestData = $request->validated();
            $requestData['password'] = bcrypt($request->password);
            Worker::create($requestData);
            $worker = Worker::latest()->first();
            if($request->hasFile('image')) {
                    $image = $request->file('image');
                    $name = 'worker-'.time().Str::slug($request->input('firstname') . '_' . $request->input('lastname'));
                    $filename = $name .'.'.$image->getClientOriginalName();
                    $worker->storeImage($image->storeAs('workers', $filename, 'public'));
            }
            //Notification::send($worker, new NewWorker($worker));
            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('workers.index');
         } catch (\Exception $e) {
            DB::rollBack();
           toastr()->error(__('Admin/site.sorry'));
           return redirect()->back();
            // return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
         }
    }

    public function edit($id) {
        $workerID = Crypt::decrypt($id);
        $currencies = Currency::all();
        $worker=Worker::findorfail($workerID);
        return view('dashboard.admin.workers.profile.profiledit', compact('worker','currencies'));
    }

    public function destroy($id) {
        try{
            $workerID = Crypt::decrypt($id);
            $worker=Worker::findorfail($workerID);
            $worker->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('workers.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.cant_delete'));
            return redirect()->back();
        }
    }
    
    public function bulkDelete($request) {
        try{
            if($request->delete_select_id){
                $delete_select_id = explode(",",$request->delete_select_id);
                foreach($delete_select_id as $workers_ids){
                    $worker = Worker::findorfail($workers_ids);
                    if($worker->image && $worker->image->filename != 'default_worker.jpg'){
                        $old_photo = $worker->image->filename;
                        $worker->deleteImage();
                    }
                }
            }else{
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('workers.index');
            }
            Worker::destroy( $delete_select_id );
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('workers.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.cant_delete_all'));
            return redirect()->back();
        }
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
            $workerpassword = $worker->password;
            $requestData = $request->validated();
            if($request->password){
                $requestData['password'] = bcrypt($request->password);
            }else{
                $requestData['password'] = $workerpassword ;
            }
            if($request->daily_price ){
                $requestData['hourly_price'] = null;
            }
            if($request->hourly_price ){
                $requestData['daily_price'] = null;
            }
            $worker->update($requestData);

            if($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'worker-'.time().Str::slug($request->input('firstname') . '_' . $request->input('lastname'));
                $filename = $name .'.'.$image->getClientOriginalName();
                $worker->updateImage($image->storeAs('workers', $filename, 'public'));
            }

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