<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\WholeSaleProductInterface;
use Illuminate\Http\Request;

use App\Http\Requests\Dashboard\WholeSaleProductRequest;

class WholeSaleProductController extends Controller
{
    protected $Data;
    public function __construct(WholeSaleProductInterface $Data) {
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



    public function update(WholeSaleProductRequest $request,$id ) {
        return $this->Data->update($request,$id);
    }

    public function destroy($id) {
        return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request){
        return $this->Data->destroy($request);


    }

}
