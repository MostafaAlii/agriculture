<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Models\OutcomeProduct;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\OutcomeProductInterface;
use App\Http\Requests\Dashboard\OutcomeProductRequest;
use Illuminate\Http\Request;


class OutcomeProductController extends Controller
{
    protected $Data;
    public function __construct(OutcomeProductInterface $Data) {
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
    public function store(OutcomeProductRequest $request){
        return $this->Data->store($request);
    }
    public function edit($id) {
        return $this->Data->edit($id);
    }
    public function update(OutcomeProductRequest $request,$id) {
        return $this->Data->update($request,$id);
    }
    public function destroy($id) {
        return $this->Data->destroy($id);
    }
    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }// end of destroy

    public function outcome_product_statistics(){

    return $this->Data->outcome_product_statistics();
      }
}
