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
}