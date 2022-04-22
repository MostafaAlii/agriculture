<?php
namespace App\Http\Repositories\Admin;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Interfaces\Admin\OrderInterface;
use Carbon\Carbon;
class OrderRepository implements OrderInterface {
    public function index() {
        return view('dashboard.admin.orders.index');
    }

    public function data() {
        $orders = Order::query()->latest()->get();
        return DataTables::of($orders)
        ->editColumn('created_at', function (Order $order) {
            return $order->created_at->format('Y-m-d');
        })
        ->editColumn('status', function (Order $order) {
            return view('dashboard.admin.orders.data_table.status', compact('order'));
        })
        ->addColumn('name', function (Order $order) {
            return $order->firstname .' '. $order->lastname;
        })
        ->addColumn('actions', 'dashboard.admin.orders.data_table.actions')
        ->rawColumns(['actions'])
        ->toJson();
    }

    public function showOrder($id) {
        $orderID    =   Crypt::decrypt($id);
        $order     =   Order::findorfail($orderID);
        return view('dashboard.admin.orders.show', compact('order'));
        //return $orderID;
    }
}