<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\ProductInterface;
use App\Http\Requests\Dashboard\Product\GeneralRequest;
use App\Http\Requests\Dashboard\Product\ProductPriceRequest;
use App\Http\Requests\Dashboard\Product\ProductStockRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}
