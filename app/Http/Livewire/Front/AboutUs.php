<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class AboutUs extends Component
{
    public function render()
    {
        //read from about_us cache
        $data['about_us']=Cache::get('about_us');          
        $data['teams']=Cache::get('teams');
        
        return view('livewire.front.about-us',$data)->layout('front.layouts.master3');
    }
}
