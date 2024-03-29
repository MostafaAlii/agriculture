<?php
namespace  App\Http\Repositories\Admin;

use App\Models\Area;
use App\Models\Admin;
use App\Models\State;
use App\Models\Country;
use App\Traits\UploadT;
use App\Models\Province;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Interfaces\Admin\ProfileInterface;

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
            $adminpassword = Auth::guard('admin')->user()->password;
            $requestData = $request->validated();
            if($request->password){
                $requestData['password'] = bcrypt($request->password);
            }else{
                $requestData['password'] = $adminpassword ;
            }
            $admin->update($requestData);
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'admin-'.time().Str::slug($request->input('firstname') . '_' . $request->input('lastname'));
                $filename = $name .'.'.$image->getClientOriginalName();
                $admin->updateImage($image->storeAs('admins', $filename, 'public'));
           }
            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('profile.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
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
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
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
    public function getState($area_id)
    {
        $area = Area::where('id', $area_id)->first();
        $states = $area->states->pluck('name','id');
        return $states;
    }
    public function getVillage($state_id)
    {
        $state = State::where('id', $state_id)->first();
        $villages = $state->villages->pluck('name','id');
        return $villages;
    }

}