<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class SearchFarmerComponent extends Component
{
    public $search;
    public function mount(){
        $this->fill(request()->only('search'));
    }
    public function render()
    {
        return view('livewire.front.search-farmer-component');
    }
}
