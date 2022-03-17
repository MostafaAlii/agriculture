<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AdminRequest;
use App\Http\Requests\Dashboard\ProfileAccountRequest;
use App\Models\Admin;
use App\Models\Province;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadT;
class ProfileController extends Controller {
    use UploadT;
    // protected $Data;
    // public function __construct(AdminInterface $Data) {
    //     $this->Data = $Data;
    // }

    public function index() {
        return view('dashboard.admin.profile.profileview');
    }

    public function edit($id) {
        $adminID = Crypt::decrypt($id);
        // dd($adminID);
        $admin=Admin::findorfail($adminID);
     return view('dashboard.admin.profile.profiledit',compact('admin'));
    }// end of edit

    public function updateAccount(ProfileAccountRequest $request,$id) {
        // return $this->Data->update($request,$id);
        try{
            DB::beginTransaction();
            $adminID = Crypt::decrypt($id);
            $admin=Admin::findorfail($adminID);
            $requestData = $request->validated();
            // $requestData['type'] = $request->type;
            $admin->update($requestData);

            if($request->image){
                $this->deleteImage('upload_image','/admins/' . $admin->image->filename,$admin->id);
            }
            $this->addImage($request, 'image' , 'admins' , 'upload_image',$admin->id, 'App\Models\Admin');

            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('profile.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }// end of update
    public function updateInformation(Request $request,$id) {
        // return $this->Data->update($request,$id);
    }// end of update
    public function getProvince($country_id)
    {
        $provinces = Province::where('country_id', $country_id)->pluck('name','id');
        return $provinces;
    }
    // public function destroy($id) {
    //     return $this->Data->destroy($id);
    // }// end of destroy

    // public function bulkDelete(Request $request) {
    //     return $this->Data->bulkDelete($request);
    // }// end of destroy
}
