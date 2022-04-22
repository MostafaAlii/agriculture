<?php

namespace App\Http\Controllers\front\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\userProfileRequest;
use App\Models\Area;
use App\Models\Country;
use App\Models\Province;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\UploadT;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserEditProfile extends Controller
{
    use UploadT;
    public function editProfile()
    {
        return view('front.user.userProfileEdit');
    }

    public function update(userProfileRequest $request) {
        try{
            // return 'hellooooo';
            DB::beginTransaction();
            $user = User::findorfail(Auth::guard('vendor')->user()->id);
            $requestData = $request->validated();
            $user->update($requestData);
            if($request->image){
                $this->deleteImage('upload_image','/users/' . Auth::guard('vendor')->user()->image->filename,Auth::guard('vendor')->user()->id);
            }
            $this->addImage($request, 'image' , 'users' , 'upload_image',Auth::guard('vendor')->user()->id, 'App\Models\user');
            DB::commit();
            session()->flash('Edit',__('Admin/site.updated_successfully'));
            return redirect()->route('user.ownprofile');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error',__('Admin/site.sorry'));
            return redirect()->back();
        }
    }

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
