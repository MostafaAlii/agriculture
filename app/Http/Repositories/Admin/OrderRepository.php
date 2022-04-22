<?php
namespace App\Http\Repositories\Admin;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Interfaces\Admin\OrderInterface;
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
        $orders     =   Order::select('status')->get();
        return view('dashboard.admin.orders.show', compact('order', 'orders'));
    }

    public function printOrder($id) {
        $orderID    =   Crypt::decrypt($id);
        $order     =   Order::findorfail($orderID);
        return view('dashboard.admin.orders.ext.print', compact('order'));
    }

    public function update($request, $id) {
        try{
            $orderID    =   Crypt::decrypt($id);
            $order     =   Order::findorfail($orderID);
            $order->status = $request->status;
        if($request->status == Order::DELIVERED) {
            $order->delivered_date = DB::raw('CURRENT_DATE');
        }
        elseif($request->status == Order::CANCELED) {
            $order->canceled_date = DB::raw('CURRENT_DATE');
        }
        $order->save();
        toastr()->success(__('Admin/site.added_successfully'));
        return redirect()->route('Orders.index');
        } catch(\Exception $ex) {
            toastr()->error(__('Admin/attributes.add_wrong'));
            return redirect()->back();
        }  
    }
}