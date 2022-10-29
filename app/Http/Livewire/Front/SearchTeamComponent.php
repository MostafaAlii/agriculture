<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class SearchTeamComponent extends Component
{
    public $search;
    public function mount(){
        $this->fill(request()->only('search'));
    }
    public function render()
    {
        return view('livewire.front.search-team-component');
    }
}