<?php

namespace App\Http\Livewire\Front\Farmer;

use App\Models\Farmer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FarmerProfile extends Component
{
    public function render()
    {
        $farmer = Farmer::find(Auth::guard('web')->user()->id);
        return view('livewire.front.farmer.farmer-profile',compact('farmer'))->layout('front.layouts.master2');
    }
}
