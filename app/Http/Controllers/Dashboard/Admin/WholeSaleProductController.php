<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\WholeSaleProductInterface;
use Illuminate\Http\Request;

use App\Http\Requests\Dashboard\WholeSaleProductRequest;
use App\Http\Requests\Dashboard\WholeSaleProductUpdateRequest;


class WholeSaleProductController extends Controller
{
    protected $Data;
    public function __construct(WholeSaleProductInterface $Data) {
        $this->middleware('permission:whole-sale-products', ['only' => ['index']]);
        $this->middleware('permission:whole-sale-products-create', ['only' => ['store']]);
        $this->middleware('permission:whole-sale-products-edit', ['only' => ['update']]);
        $this->middleware('permission:whole-sale-products-delete', ['only' => ['destroy']]);
        $this->middleware('permission:whole-sale-products-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }
    public function data() {
        return $this->Data->data();
    }

    public function store(WholeSaleProductRequest $request) {
        return $this->Data->store($request);
    }



    public function update(WholeSaleProductUpdateRequest $request,$id ) {
        return $this->Data->update($request,$id);
    }

    public function destroy($id) {
        return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request){
        return $this->Data->bulkDelete($request);


    }

}
