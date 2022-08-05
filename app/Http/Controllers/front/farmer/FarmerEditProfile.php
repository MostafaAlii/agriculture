<?php

namespace App\Http\Controllers\front\farmer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FarmerProfileRequest;
use App\Models\Area;
use App\Models\Country;
use App\Models\Farmer;
use App\Models\Province;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadT;

class FarmerEditProfile extends Controller
{

    use UploadT;
    public function editProfile()
    {
        return view('front.farmer.farmerProfileEdit');
    }
    public function update(FarmerProfileRequest $request) {
        try{
            // return 'hellooooo';
            DB::beginTransaction();
            $farmer = Farmer::findorfail(Auth::guard('web')->user()->id);
            $requestData = $request->validated();
            $farmer->update($requestData);
            if($request->image){
                $this->deleteImage('upload_image','/farmers/' . Auth::guard('web')->user()->image,Auth::guard('web')->user()->id);
            }
            $this->addImage($request, 'image' , 'farmers' , 'upload_image',Auth::guard('web')->user()->id, 'App\Models\Farmer');
            DB::commit();
            session()->flash('Edit',__('Admin/site.updated_successfully'));
            return redirect()->route('farmer.ownprofile');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error',__('Admin/site.sorry'));
            return redirect()->back();
            //    return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
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
