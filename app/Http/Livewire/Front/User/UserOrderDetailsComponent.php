<?php
namespace App\Http\Livewire\Front\User;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class UserOrderDetailsComponent extends Component
{
    public $order_id;
    public function mount($order_id) {
        $this->order_id = Crypt::decrypt($order_id);
        $this->user = auth()->user();
    }
    public function render() {
        $order = Order::where('user_id', $this->user->id)->whereId($this->order_id)->first();
        return view('livewire.front.user.user-order-details-component',['order'=>$order])->layout('front.layouts.master5');
    }
    public function cancelOrder($id) {
        $order = Order::find($id);
	    $order->status = Order::CANCELED;
	    $order->canceled_date = DB::raw('CURRENT_DATE');
	    $order->save();
	    session()->flash('order_message','Order has been canceled!');
    }

    public function printOrder($id) {
        //$orderID    =   Crypt::decrypt($id);
        //$order     =   Order::findorfail($orderID);
        $order = Order::where('user_id', $this->user->id)->whereId($this->order_id)->first();
        //return view('dashboard.admin.orders.print_invoice',['order'=>$order]);
        //return view('dashboard.admin.orders.ext.print', compact('order'));
        return view('livewire.front.user.orders.print_invoice',['order'=>$order]);
    }
}
