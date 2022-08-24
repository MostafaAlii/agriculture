<?php

namespace App\Http\Livewire\Front;

use App\Models\About;
use App\Models\Team;
use App\Models\TeamTranslation;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cache;
class SearchTeamPageComponent extends Component
{
    use WithPagination;
    public $search;
    public function mount(){
        $this->fill(request()->only('search'));
    }
    public function render()
    {
        $about_us  = About::get();
        $teams = Team::whereHas('translations', function ($query) {
                $query->where('position','like','%'.$this->search.'%');
            })->orderby('id','desc')
              ->paginate(6);
        return view('livewire.front.search-team-page-component',compact('about_us','teams'))
        ->layout('front.layouts.master3');
    }
}
