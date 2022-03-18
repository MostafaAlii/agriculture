<?php
namespace  App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\ProfileInterface;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Traits\UploadT;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
class ProfileRepository implements ProfileInterface{
    use UploadT;
    public function index() {
        return view('dashboard.admin.profile.profileview');
    }

    public function edit($id) {
        $adminID = Crypt::decrypt($id);
        // dd($adminID);
        $admin=Admin::findorfail($adminID);
     return view('dashboard.admin.profile.profiledit',compact('admin'));
    }

    public function updateAccount($request,$id) {
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
    public function updateInformation($request,$id) {
        try{
            $adminID = Crypt::decrypt($id);
            $admin=Admin::findorfail($adminID);
            $requestData = $request->validated();
            $admin->update($requestData);
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('profile.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }// end of update

    public function getProvince($country_id)
    {
        $country = Country::where('id', $country_id)->first();
        $provinces = $country->provinces->pluck('name','id');
        return $provinces;
    }
    public function getArea($province_id)
    {
        $province = Province::where('id', $province_id)->first();
        $areas = $province->areas->pluck('name','id');
        return $areas;
    }

}
