<?php

namespace App\Http\Livewire\Front;

use App\Models\Team;
use App\Models\About;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;
class AboutUs extends Component
{
    use WithPagination;
    public $sorting;
    public $allteams;
    public $teamid;
    public function mount(){
        $this->sorting = "default";
        $this->allteams = Team::all();
        // $this->teamid = '';
    }
    public function render()
    {
        $data['about_us']=Cache::get('about_us')??About::first();
        $data['teams']=Team::whereId($this->sorting)
                            ->orderby('id','desc')->paginate(6);
        return view('livewire.front.about-us',$data)->layout('front.layouts.master3');
    }
}
