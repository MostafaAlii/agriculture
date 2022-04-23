<?php
namespace App\Http\Livewire\Front\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\Client\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelXlsx;
class OrdersComponents extends Component {
    //use WithPagination;
    public $paginate = 10;
    public $search = "";
    public $selectPage = false;
    public $selectedStatus = null;
    public $checked = [];
    public function mount() {
        $this->user = auth()->user();
        $this->username = $this->user->firstname . '-' . $this->user->lastname;
    }
    public function render() {
        return view('livewire.front.user.orders-components', [
            'orders'    =>  $this->user->orders()
            ->with(['orderItems' => function ($query) {
                $query->select('id','order_id','quantity');
            }])
            ->with(['orderItems.product' => function ($query) {
                $query->select('id')->with('translations');
            }])
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
}
