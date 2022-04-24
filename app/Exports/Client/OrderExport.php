<?php
namespace App\Exports\Client;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
class OrderExport implements FromQuery, WithMapping, WithHeadings {
    use Exportable;
    protected $orders;
    public function __construct($orders) {
        $this->orders =  $orders;
    }
    public function query()
    {
        $clientOrder = Order::query()->whereKey($this->orders);
        return $clientOrder;
    }

    public function map($clientOrder): array {
        return [
            $clientOrder->referance_id,
            $clientOrder->subtotal,
            $clientOrder->total,
            $clientOrder->discount,
            $clientOrder->getStatusForExport(),
            $clientOrder->created_at->toDateString(),
        ];
    }

    public function headings(): array {
        return [
            __('Admin/orders.order_referance'),
            __('Admin/orders.order_subTotal'),
            __('Admin/orders.order_total'),
            __('Admin/orders.order_discount'),
            __('Admin/orders.order_status'),
            __('Admin/orders.order_date')
        ];
    }
}
