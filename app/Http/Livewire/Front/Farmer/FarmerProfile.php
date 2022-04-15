<?php

namespace App\Http\Livewire\Front\Farmer;

use App\Models\Area;
use App\Models\Country;
use App\Models\Farmer;
use App\Models\Province;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FarmerProfile extends Component
{
    public function render()
    {
        $data['farmer'] = Farmer::find(Auth::guard('web')->user()->id);
        $farmerSum =  $data['farmer']->ratings->sum(function($item){ // $item isrelated to the guardTable (User or Other)
            return $item->pivot->rating;
        });
        if($data['farmer']->ratings->count()){
            $data['avg'] = 10*($farmerSum /  $data['farmer']->ratings->count());
        }else{ $data['avg']=0;}
        return view('livewire.front.farmer.farmer-profile',$data)->layout('front.layouts.master2');
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
