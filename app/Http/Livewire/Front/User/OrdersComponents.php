<?php
namespace App\Http\Livewire\Front\User;
use Carbon\Carbon;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Exports\Client\OrderExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelXlsx;

class OrdersComponents extends Component {
    //use WithPagination;
    public $paginate = 10;
    public $search = "";
    public $selectPage = false;
    public $selectedStatus = null;
    public $checked = [];
    public $showOrder = false;
    public $order;
    //////////////////////////////
    public function mount() {
        $this->user = auth()->user();
        $this->username = $this->user->firstname . '-' . $this->user->lastname;
    }
    public function render() {
        $orders = Order::where('user_id', $this->user->id);
        return view('livewire.front.user.orders-components', [
            'orders'    =>  $orders
            ->when($this->selectedStatus, function ($query){
                $query->where('status', $this->selectedStatus);
            })
            ->search(trim($this->search))
            ->paginate($this->paginate),
        ]);
    }

    public function exportSelected() {
        return Excel::download(new OrderExport($this->checked), $this->username . '_ORD-' . date('Y-m-d') . '.xlsx', ExcelXlsx::XLSX);
    }

    public function displayOrder($id) {
        $this->order = Order::with(['orderItems'])->find($id);
        $this->showOrder = true;
    }

    //-----------cancel selected orders--------------------
    public function cancelSelected() {
        $all=$this->checked;
        foreach ($all as $order_id) {
             $this->cancelOrder($order_id);
        }
    }

    public function cancelOrder($id) {
        $order = Order::find($id);
	    $order->status = Order::CANCELED;
	    $order->canceled_date = Carbon::now()->format('Y-m-d');
	    $order->save();
	    session()->flash('order_message','Order has been canceled!');
    }

    public function printOrder($id) {
        $order = Order::with(['orderItems'])->find($id);
        return view('livewire.front.user.orders.print_invoice',['order'=>$order]);
    }

    public function printSelectedOrder() {
        $all=$this->checked;
        foreach ($all as $order_id) {
            $this->printOrder($order_id);
        }
    }

}
