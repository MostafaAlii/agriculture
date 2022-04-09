<?php
namespace App\Http\Repositories\Admin;
use App\Models\Farmer;
use App\Models\ProductCoupon;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Interfaces\Admin\ProductCouponInterface;
class ProductCouponRepository implements ProductCouponInterface {
    public function index() {
        $data = [];
        $data['users'] = Farmer::select('id', 'firstname', 'lastname')->OrderByDesc('id')->get();
        $data['coupons'] = ProductCoupon::get();
        return view('dashboard.admin.coupons.index', $data);
    }

    public function data() {
        $coupons = ProductCoupon::couponsWithUser();
        return DataTables::of($coupons)
            ->addColumn('username', function (ProductCoupon $coupon) {
                return $coupon->user->firstname .' '. $coupon->user->lastname;
            })
            ->addColumn('record_select', 'dashboard.admin.coupons.data_table.record_select')
            ->editColumn('description', function (ProductCoupon $coupon) {
                return $coupon->limit();
            })
            ->editColumn('status', function (ProductCoupon $coupon) {
                return $coupon->getStatus();
            })
            ->editColumn('value', function (ProductCoupon $coupon) {
                return $coupon->value . ' ' . $coupon->valueTypeSwitch();
            })
            ->editColumn('used_times', function (ProductCoupon $coupon) {
                return $coupon->useTimeCustomized();
            })
            ->editColumn('start_date', function (ProductCoupon $coupon) {
                return $coupon->startEndDateCustomized();
            })
            ->editColumn('created_at', function (ProductCoupon $coupon) {
                return $coupon->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.coupons.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store($request) {
        try{
            ProductCoupon::create($request->validated());
            toastr()->success(__('Admin/coupons.coupon_add_coupon_successfully'));
            return redirect()->route('ProductCoupons.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/coupons.operation_coupon_error_msg'));
            return redirect()->back();
        }
    }

    public function edit($id) {
        $real_id= Crypt::decrypt($id);
        $data = [];
        $data['coupon']        =       ProductCoupon::findOrfail($real_id);
        $data['users']        =       Farmer::select('id', 'firstname', 'lastname')->get();
        return view('dashboard.admin.coupons.edit', $data);
    }

    public function update($request, $id) {
        try{
            $couponID = Crypt::decrypt($id);
            $coupon=ProductCoupon::findorfail($couponID);
            $requestData = $request->except(['_token','_method']);
            $coupon->update($requestData);
            toastr()->success(__('Admin/coupons.update_coupon_successfully'));
            return redirect()->route('ProductCoupons.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/coupons.operation_coupon_error_msg'));
            return redirect()->back();
        }
    }

    public function destroy($id) {
        try{
            $couponID = Crypt::decrypt($id);
            $coupon=ProductCoupon::findorfail($couponID);
            $coupon->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('ProductCoupons.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }

    public function bulkDelete($request){
        try{
            if($request->delete_select_id){
                $all_ids = explode(',',$request->delete_select_id);
                ProductCoupon::whereIn('id',$all_ids)->delete(); //soft_delete
                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('ProductCoupons.index');
            }else{
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('ProductCoupons.index');
            }
        }catch (\Exception $e) {
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->route('ProductCoupons.index');
        }
    }
}