<?php

namespace App\Http\Livewire\Front\Worker;

use App\Models\Worker;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Workerprofile extends Component
{
    public function render()
    {
        $data['worker'] = Worker::find(Auth::guard('worker')->user()->id);
        return view('livewire.front.worker.workerprofile',$data)->layout('front.layouts.master2');
    }
}
