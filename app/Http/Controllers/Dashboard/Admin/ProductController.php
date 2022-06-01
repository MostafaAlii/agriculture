<?php
namespace App\Http\Controllers\Dashboard\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\ProductInterface;
use App\Http\Requests\Dashboard\Product\GeneralRequest;
use App\Http\Requests\Dashboard\Product\ProductPriceRequest;
use App\Http\Requests\Dashboard\Product\ProductStockRequest;
class ProductController extends Controller {
    protected $Data;
    public function __construct(ProductInterface $Data) {
        $this->middleware('permission:products', ['only' => ['index']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'generalInformationStore']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-special-price', ['only' => ['additionalPrice', 'additionalPriceStore']]);
        $this->middleware('permission:product-stock', ['only' => ['additionalStock', 'additionalStockStore']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
        $this->middleware('permission:product-delete-all', ['only' => ['bulkDelete']]);
        $this->middleware('permission:product-trushed-delete', ['only' => ['forceDestroy']]);
        $this->middleware('permission:product-trushed', ['only' => ['restore']]);
        $this->middleware('permission:product-restore', ['only' => ['updateRestore']]);
        $this->middleware('permission:product-trushed-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }

    public function trashed_data() {
        return $this->Data->trashed_data();
    }

    public function create() {
        return $this->Data->generalInformation();
    }

    public function generalInformationStore(GeneralRequest $request) {
        return $this->Data->generalInformationStore($request);
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(GeneralRequest $request) {
        return $this->Data->update($request);
    }

    public function additionalPrice($id) {
        return $this->Data->additionalPrice($id);
    }

    public function additionalPriceStore(ProductPriceRequest $request) {
        return $this->Data->additionalPriceStore($request);
    }

    public function additionalStock($id) {
        return $this->Data->additionalStock($id);
    }

    public function additionalStockStore(ProductStockRequest $request) {
        return $this->Data->additionalStockStore($request);
    }

    public function restore() {
        return $this->Data->restore();
    }

    public function updateRestore(Request $request, $id) {
        return $this->Data->updateRestore($request, $id);
    }

    public function destroy( $id){
        return $this->Data->destroy($id);
    }
    public function forceDestroy( $id){
        return $this->Data->forceDestroy($id);
    }
    public function bulkDelete(Request $request){
        return $this->Data->bulkDelete($request);
    }
}
