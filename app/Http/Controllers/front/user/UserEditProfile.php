<?php

namespace App\Http\Controllers\front\user;

use App\Models\Area;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Traits\UploadT;
use App\Models\Province;
use App\Traits\HasImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\userProfileRequest;

class UserEditProfile extends Controller
{
    use HasImage;
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
            /*if($request->image){
                $this->deleteImage('upload_image','/users/' . Auth::guard('vendor')->user()->image->filename,Auth::guard('vendor')->user()->id);
            }
            $this->addImage($request, 'image' , 'users' , 'upload_image',Auth::guard('vendor')->user()->id, 'App\Models\user');*/
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'user-'.time().Str::slug($request->input('firstname') . '_' . $request->input('lastname'));
                $filename = $name .'.'.$image->getClientOriginalName();
                $user->updateImage($image->storeAs('users', $filename, 'public'));
            }
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