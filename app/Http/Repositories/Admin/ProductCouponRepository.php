<?php
namespace App\Http\Repositories\Admin;
use App\Models\ProductCoupon;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Interfaces\Admin\ProductCouponInterface;
class ProductCouponRepository implements ProductCouponInterface {
    public function index() {
        $data = [];
        return $data['coupons'] = ProductCoupon::couponsWithUser();
        return view('dashboard.admin.coupons.index', $data);
    }

    public function data() {
        return $coupons = ProductCoupon::select();
        return DataTables::of($coupons)
            ->addColumn('record_select', 'dashboard.admin.coupons.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (ProductCoupon $coupon) {
                return $coupon->created_at->diffforhumans();
            })
            ->addColumn('actions',function (ProductCoupon $coupon) {
                return view('dashboard.admin.coupons.data_table.actions', compact('coupon'));
            })
            ->rawColumns(['record_select','actions'])
            ->toJson();
    }
}