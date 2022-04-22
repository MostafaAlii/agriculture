<?php
namespace App\Http\Livewire\Front\User;
use Livewire\Component;
class OrdersComponents extends Component {
    public function render() {
        return view('livewire.front.user.orders-components', ['orders' => auth()->user()->orders]);
    }
}
