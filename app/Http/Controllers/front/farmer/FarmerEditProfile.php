<?php
namespace App\Http\Controllers\front\farmer;
use App\Traits\HasImage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth, DB};
use App\Http\Requests\Dashboard\FarmerProfileRequest;
use App\Models\{Area, Country, Farmer, Province, State};
class FarmerEditProfile extends Controller {
    use HasImage;
    public function editProfile() {
        return view('front.farmer.farmerProfileEdit');
    }
    public function update(FarmerProfileRequest $request)
    {
        try {
            // return 'hellooooo';
            DB::beginTransaction();
            $farmer = Farmer::findorfail(Auth::guard('web')->user()->id);
            $requestData = $request->validated();
            $farmer->update($requestData);
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'farmer-'.time().Str::slug($request->input('firstname') . '_' . $request->input('lastname'));
                $filename = $name .'.'.$image->getClientOriginalName();
                $farmer->updateImage($image->storeAs('farmers', $filename, 'public'));
            }
            DB::commit();
            session()->flash('Edit', __('Admin/site.updated_successfully'));
            return redirect()->route('farmer.ownprofile');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', __('Admin/site.sorry'));
            return redirect()->back();
            //    return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }
    }

    public function getProvince($country_id)
    {
        $country = Country::where('id', $country_id)->first();
        $provinces = $country->provinces->pluck('name', 'id');
        return $provinces;
    }
    public function getArea($province_id)
    {
        $province = Province::where('id', $province_id)->first();
        $areas = $province->areas->pluck('name', 'id');
        return $areas;
    }
    public function getState($area_id)
    {
        $area = Area::where('id', $area_id)->first();
        $states = $area->states->pluck('name', 'id');
        return $states;
    }
    public function getVillage($state_id)
    {
        $state = State::where('id', $state_id)->first();
        $villages = $state->villages->pluck('name', 'id');
        return $villages;
    }
}