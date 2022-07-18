<?php

namespace App\Http\Controllers\front\worker;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\WorkerProfileRequest;
use App\Models\Area;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Province;
use App\Models\State;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadT;

class WorkerEditProfile extends Controller
{
    use UploadT;
    public function editProfile()
    {
        $currencies = Currency::all();
        return view('front.worker.workerProfileEdit', compact('currencies'));
    }
    public function update(WorkerProfileRequest $request) {
        // dd($request);
        // return 'hellooooo';
        try{
            DB::beginTransaction();
            $worker = Worker::findorfail(Auth::guard('worker')->user()->id);
            $requestData = $request->validated();
            // dd($worker);
            if($request->daily_price ){
                $requestData['hourly_price'] = null;
            }
            if($request->hourly_price ){
                $requestData['daily_price'] = null;
            }
            $worker->update($requestData);
            if($request->image){
                $this->deleteImage('upload_image','/workers/' . Auth::guard('worker')->user()->image,Auth::guard('worker')->user()->id);
            }
            $this->addImage($request, 'image' , 'workers' , 'upload_image',$worker->id, 'App\Models\worker');
            DB::commit();
            session()->flash('Edit',__('Admin/site.updated_successfully'));
            return redirect()->route('worker.ownprofile');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error',__('Admin/site.sorry'));
            return redirect()->back();
            // return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
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
