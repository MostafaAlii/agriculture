<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\ProductCouponInterface;
use App\Http\Requests\Dashboard\ProductCouponRequest;
use Illuminate\Http\Request;
class ProductCouponController extends Controller {
    protected $Data;
    public function __construct(ProductCouponInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }

    public function store(ProductCouponRequest $request) {
        return $this->Data->store($request);
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(ProductCouponRequest $request, $id) {
        return $this->Data->update($request, $id);
    }

    public function destroy( $id){
        return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request){
        return $this->Data->bulkDelete($request);
    }
}
