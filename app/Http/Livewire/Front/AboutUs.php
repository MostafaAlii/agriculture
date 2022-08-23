<?php

namespace App\Http\Livewire\Front;

use App\Models\Team;
use App\Models\About;
use App\Models\TeamTranslation;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;
use Illuminate\Support\Str;
class AboutUs extends Component
{
    use WithPagination;
    // public $allteams;
    // public $teamid='cc';
    public function mount(){
        // $this->allteams = TeamTranslation::groupBy('position')->get();
        // $this->allteams = TeamTranslation::select('position')->distinct()->get()->toArray();
        // $this->teamid = $teamid;
        // dd($this->allteams);
        // $this->teamid = Str::slug($this->teamid, '-');

    }
    public function render()
    {
        // $teamid    = Str::slug($this->teamid, '-');
        // $teamid    = $this->teamid;
        $about_us  = Cache::get('about_us')??About::first();
        // $pos       = TeamTranslation::select('position')->distinct()->get();
        // if($teamid == 'cc'){
        //     $teams = Team::whereHas('translations', function ($query) use ($pos) {
        //     $query->whereIn('position', $pos);
        //     })->whereHas('translations', function ($q) use ($teamid) {
        //         $q->where(Str::slug('position', '-'), $teamid);
        //     })->paginate(6);
        // }else{
        //     $teams = Team::orderby('id','desc')->paginate(10);
        // }
        $teams = Team::orderby('id','desc')->paginate(6);

        // if($this->teamid !=''){
        //     $data['teams']=TeamTranslation::whereIn(Str::slug('position','-'),$this->allteams)->paginate(6);
        //     Team::where('position',$this->teamid)
        //     ->orderby('id','desc')->paginate(6);
        //   }else{
        //     $data['teams']=Team::orderby('id','desc')->paginate(10);
        //   }
        // $data['teams']=Team::where('id',$this->teamid)
        //                     ->orderby('id','desc')->paginate(6);
        return view('livewire.front.about-us',compact('about_us','teams'))->layout('front.layouts.master3');
    }
}
