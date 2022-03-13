<?php
namespace  App\Http\Repositories\Admin;
use App\Models\User;
use App\Http\Interfaces\Admin\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Traits\UploadT;

class UserRepository implements UserInterface{
    use UploadT;
    public function index() {
        return view('dashboard.admin.users.index');
    }
    public function data() {
        $users = User::select();

        return DataTables::of($users)
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->format('Y-m-d');
            })
            // ->addColumn('image', 'dashboard.admin.users.data_table.actions')
            ->addColumn('image', function (User $user) {
                return view('dashboard.admin.users.data_table.image', compact('user'));
            })
            ->addColumn('actions', 'dashboard.admin.users.data_table.actions')
            ->rawColumns([ 'actions'])
            ->toJson();
    }

    public function create() {
        return view('dashboard.admin.users.create');
    }
    public function store($request) {
        DB::beginTransaction();
        try{
            $requestData = $request->validated();
            $requestData['password'] = bcrypt($request->password);
            User::create($requestData);
            $user = User::latest()->first();
            $this->addImage($request, 'image' , 'users' , 'upload_image',$user->id, 'App\Models\User');
            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('users.index');
         } catch (\Exception $e) {
             DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }

    public function edit($user) {
        return view('dashboard.admin.users.edit', compact('user'));
    }

    public function update( $request,$user) {
        try{
            $user->update($request->validated());

            session()->flash('Edit', __('Admin/site.updated_successfully'));
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($user) {
        $user->delete();
        // session()->flash('Delete', __('Admin/site.deleted_successfully'));
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('users.index');
    }
}
