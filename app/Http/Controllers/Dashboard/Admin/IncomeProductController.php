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
    public function income_product_statistics(){
    return $this->Data->income_product_statistics();
    }
    public function index_income_products(){
        return $this->Data->index_income_products();
    }
    public function get_weekly_monthly_anual_income_product_statistics(){
        return $this->Data->get_weekly_monthly_anual_income_product_statistics();
    }

}
