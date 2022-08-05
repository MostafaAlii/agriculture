<?php
namespace App\Http\Livewire\Front\User;
use Livewire\Component;
class ThankYouComponent extends Component {
    public function render() {
        return view('livewire.front.user.thank-you-component')->layout('front.layouts.master2');;
    }
}
