<?php
namespace  App\Http\Repositories\Admin;
use App\Models\User;
use App\Http\Interfaces\Admin\UserInterface;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Traits\UploadT;
use Illuminate\Support\Facades\Storage;

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
            ->addColumn('image', function (User $user) {
                return view('dashboard.admin.users.data_table.image', compact('user'));
            })
            // ->addColumn('actions', function (User $user) {
            //     return view('dashboard.admin.users.data_table.actions', compact('user'));
            // })
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
            // if($request->image){
                // if($request->image != 'default.jpg'){
                    // Storage::disk('upload_image')->delete('/users/' . $user->image->filename);
                // }
                // $image=Image::where('imageable_id',$user->id)->first();
                // $image->save(public_path('upload_image' . $request->image ));
                // Image::make($request->image)->resize(300, null, function ($constraint) {
                //     $constraint->aspectRatio();
                // })->save(public_path('uploads/user-img/' . $request->image->hashName() ));
                // $input['image'] = $request->image->hashName();
            // }
            $user->update($request->validated());
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($user) {
        try{
            // Storage::disk('upload_image')->delete('/Dashboard/img' . $user->image->filename);
            // Image::where('imageable_id',$user->id)->delete();
            // if($user->image != 'avatar.jpg'){
                // Storage::disk('upload_image')->delete('/users/' . $user->image->filename);
        //    }
            $this->deleteImage('upload_image','/users/' . $user->image->filename,$user->id);
            $user->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('users.index');
        } catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
