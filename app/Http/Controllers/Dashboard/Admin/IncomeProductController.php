<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Models\IncomeProduct;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\IncomeProductInterface;
use App\Http\Requests\Dashboard\IncomeProductRequest;
use Illuminate\Http\Request;


class IncomeProductController extends Controller
{
    protected $Data;
    public function __construct(IncomeProductInterface $Data) {
        $this->middleware('permission:income-products', ['only' => ['index']]);
        $this->middleware('permission:income-products-create', ['only' => ['create','store']]);
        $this->middleware('permission:income-products-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:income-products-delete', ['only' => ['destroy']]);
        $this->middleware('permission:income-products-delete-all', ['only' => ['bulkDelete']]);
        $this->middleware('permission:income-product-statistics', ['only' => ['income_product_statistics']]);
        $this->middleware('permission:index-income-product-statistics', ['only' => ['index_income_products']]);
        $this->middleware('permission:income-local-product-statistics', ['only' => ['index_income_local_products']]);
        $this->middleware('permission:income-imported-product-statistics', ['only' => ['index_income_imported_products']]);
        $this->middleware('permission:income-iraq-product-statistics', ['only' => ['index_income_iraq_products']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }


    public function data() {
        return $this->Data->data();
    }
    public function create() {
        return $this->Data->create();
    }
    public function store(IncomeProductRequest $request){
        return $this->Data->store($request);
    }
    public function edit($id) {
        return $this->Data->edit($id);
    }
    public function update(IncomeProductRequest $request,$id) {
        return $this->Data->update($request,$id);
    }
    public function destroy($id) {
        return $this->Data->destroy($id);
    }
    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }// end of destroy


    //index for report
    public function index_income_products(){
        return $this->Data->index_income_products();
    }

    //filter for report
    public function income_product_statistics(Request $request){
        return $this->Data->income_product_statistics($request);
    }



}
