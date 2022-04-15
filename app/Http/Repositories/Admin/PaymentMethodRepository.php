<?php
namespace App\Http\Repositories\Admin;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Interfaces\Admin\PaymentMethodInterface;
class PaymentMethodRepository implements PaymentMethodInterface {
    public function index() {
        return view('dashboard.admin.payments.index');
    }

    public function data() {
        $payments = PaymentMethod::query()->get();
        return DataTables::of($payments)
        ->addColumn('record_select',function (PaymentMethod $payments) {
            return view('dashboard.admin.payments.data_table.record_select', compact('payments'));
        })
        ->editColumn('status', function (PaymentMethod $payment) {
            return view('dashboard.admin.payments.data_table.status', compact('payment'));
        })
        ->editColumn('sandbox', function (PaymentMethod $payment) {
            return view('dashboard.admin.payments.data_table.sandbox', compact('payment'));
        })
        ->editColumn('created_at', function (PaymentMethod $payment) {
            return $payment->created_at->diffforhumans();
        })
        ->addColumn('actions', 'dashboard.admin.payments.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store($request) {
        PaymentMethod::create($request->validated());
        toastr()->success(__('Admin/site.added_successfully'));
        return redirect()->route('Payments.index');
    }
}