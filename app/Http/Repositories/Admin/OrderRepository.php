<?php
namespace App\Http\Repositories\Admin;
use App\Models\Order;
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
            if($request->status == Order::DELIVERED) { // تم الشحن
                $order->suggestion_delivered_date = Carbon::now()->addDays(5);
                $order->delivered_date = NULL;
                $order->under_proces_date = NULL;
                $order->reject_date = NULL;
                $order->push_from_stock_date = NULL;
                $order->canceled_date = NULL;
            }
            elseif($request->status == Order::UNDER_PROCESS) { // جارى تجهيز الطلب
                $order->under_proces_date = Carbon::now();
            }
            elseif($request->status == Order::FINISHED) { // جارى تجهيز الطلب
                $order->delivered_date = Carbon::now();
            }
            elseif($request->status == Order::REJECTED) { // رفض الطلب
                $order->reject_date = Carbon::now();
                $order->reason  =   $request->reason;
            }
            elseif($request->status == Order::PUSH_FROM_STOCK) { // الخروج من المخزن
                $order->push_from_stock_date = Carbon::now();

            }
            elseif($request->status == Order::CANCELED) { // تم الالغاء
                $order->canceled_date = Carbon::now();
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
