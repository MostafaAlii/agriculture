<?php
namespace  App\Http\Repositories\Admin;
use App\Models\User;
use App\Models\Image;
use App\Traits\HasImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\NewUser;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
// use Notification;
use Illuminate\Support\Facades\Storage;
use App\Http\Interfaces\Admin\UserInterface;
use Illuminate\Support\Facades\Notification;

class UserRepository implements UserInterface{
    use HasImage;
    public function index() {
        return view('dashboard.admin.users.index');
    }

    public function data() {
        $users = User::select();
        return DataTables::of($users)
            ->addColumn('record_select', 'dashboard.admin.users.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->format('Y-m-d');
            })
            ->addColumn('image', function (User $user) {
                return view('dashboard.admin.users.data_table.image', compact('user'));
            })
            ->addColumn('country', function (User $user) {
                return $user->country->name != null ? $user->country->name:null;
            })
            ->addColumn('ordercount', function (User $user) {
                return view('dashboard.admin.users.data_table.related', compact('user'));
            })
            ->addColumn('actions', 'dashboard.admin.users.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
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
            $user=User::create($requestData);
            if($request->hasFile('image')) {
                    $image = $request->file('image');
                    $name = 'user-'.time().Str::slug($request->input('firstname') . '_' . $request->input('lastname'));
                    $filename = $name .'.'.$image->getClientOriginalName();
                    $user->storeImage($image->storeAs('users', $filename, 'public'));
            }
            //Notification::send($user, new NewUser($user));
            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('users.index');
         } catch (\Exception $e) {
             DB::rollBack();
             toastr()->error(__('Admin/site.sorry'));
             return redirect()->back();
         }
    }

    public function edit($id) {
        $userID = Crypt::decrypt($id);
        $user=User::findorfail($userID);
        return view('dashboard.admin.users.profile.profiledit', compact('user'));
    }

    public function update($request,$id) {
        try{
            DB::beginTransaction();
            $userID = Crypt::decrypt($id);
            $user=User::findorfail($userID);
            $requestData = $request->validated();
            $user->update($requestData);
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'user-'.time().Str::slug($request->input('firstname') . '_' . $request->input('lastname'));
                $filename = $name .'.'.$image->getClientOriginalName();
                $user->updateImage($image->storeAs('users', $filename, 'public'));
            }
            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }

    public function destroy($id) {
        try{
            $userID = Crypt::decrypt($id);
            $user=User::findorfail($userID);
            $user->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.cant_delete'));
            return redirect()->back();
        }
    }


    public function bulkDelete($request)
    {
        try{
            if($request->delete_select_id){
                    $delete_select_id = explode(",",$request->delete_select_id);
                    foreach($delete_select_id as $users_ids){
                        $user = User::findorfail($users_ids);
                        if($user->image && $user->image->filename != 'default_vendor.jpg'){
                            $old_photo = $user->image->filename;
                            $user->deleteImage();
                        }
                    }
            }else{
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('users.index');
            }
            User::destroy( $delete_select_id );
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.cant_delete_all'));
            return redirect()->back();
        }
    }// end of bulkDelete

    public function showProfile($id){
        $userID = Crypt::decrypt($id);
        // dd( $userID);
        $user=User::findorfail($userID);
        return view('dashboard.admin.users.profile.profileview', compact('user'));
    }


    public function updateAccount($request,$id) {
        try{
            DB::beginTransaction();
            $userID = Crypt::decrypt($id);
            $user=User::findorfail($userID);
            $userpassword =  $user->password;
            $requestData = $request->validated();
            if($request->password){
                $requestData['password'] = bcrypt($request->password);
            }else{
                $requestData['password'] = $userpassword ;
            }
            $user->update($requestData);
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'user-'.time().Str::slug($request->input('firstname') . '_' . $request->input('lastname'));
                $filename = $name .'.'.$image->getClientOriginalName();
                $user->updateImage($image->storeAs('users', $filename, 'public'));
            }
            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }// end of update
    
    public function updateInformation($request,$id) {
        try{
            $userID = Crypt::decrypt($id);
            $user=User::findorfail($userID);
            $requestData = $request->validated();
            $user->update($requestData);
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }

    }// end of update
}