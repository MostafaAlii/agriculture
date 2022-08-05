<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\TreeInterface;
use App\Http\Requests\Dashboard\TreeRequest;
use App\Http\Requests\Dashboard\TreeUpdateRequest;


use Illuminate\Http\Request;
class TreeController extends Controller
{
    protected $Data;
    public function __construct(TreeInterface $Data) {
        $this->middleware('permission:tree', ['only' => ['index']]);
        $this->middleware('permission:tree-create', ['only' => ['store']]);
        $this->middleware('permission:tree-edit', ['only' => ['update']]);
        $this->middleware('permission:tree-delete', ['only' => ['destroy']]);
        $this->middleware('permission:tree-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }// end of data

    public function store(TreeRequest $request) {
        return $this->Data->store($request);
    }

    public function update(TreeUpdateRequest $request,$id) {

        return $this->Data->update($request,$id);
    }// end of update

    public function destroy($id) {
        return $this->Data->destroy($id);
    }// end of destroy

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }// end of destroy
}

