<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\WholesaleInterface;
use App\Http\Requests\Dashboard\WholesaleRequest;
use App\Http\Requests\Dashboard\WholesaleUpdateRequest;

use Illuminate\Http\Request;
class WholesaleController extends Controller
{
    protected $Data;
    public function __construct(WholesaleInterface $Data) {
        $this->middleware('permission:whole-sale', ['only' => ['index']]);
        $this->middleware('permission:whole-sale-create', ['only' => ['store']]);
        $this->middleware('permission:whole-sale-edit', ['only' => ['update']]);
        $this->middleware('permission:whole-sale-delete', ['only' => ['destroy']]);
        $this->middleware('permission:whole-sale-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }// end of data



    public function store(WholesaleRequest $request) {
        return $this->Data->store($request);
    }



    public function update(WholesaleUpdateRequest $request,$id) {
        return $this->Data->update($request,$id);
    }// end of update


    public function destroy($id) {
        return $this->Data->destroy($id);
    }// end of destroy

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }// end of bulkDelete

}

