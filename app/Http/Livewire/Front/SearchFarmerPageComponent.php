<?php

namespace App\Http\Livewire\Front;

use App\Models\Farmer;
use Livewire\Component;
use Livewire\WithPagination;
class SearchFarmerPageComponent extends Component
{
    use WithPagination;
    public $search;
    public function mount(){
        $this->fill(request()->only('search'));
    }
    public function render()
    {
        $farmers = Farmer::
        where('firstname','like','%'.$this->search.'%')
        ->orWhere('lastname','like','%'.$this->search.'%')
        ->orWhere('email','like','%'.$this->search.'%')
        ->orWhere('phone','like','%'.$this->search.'%')
        ->orderby('id','desc')
        ->paginate(6);
        return view('livewire.front.search-farmer-page-component',compact('farmers'))
        ->layout('front.layouts.master8');
    }
}
