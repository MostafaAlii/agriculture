<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\TreeTypeInterface;
use App\Http\Requests\Dashboard\TreeTypeUpdateRequest;
use App\Http\Requests\Dashboard\TreeTypeRequest;

use Illuminate\Http\Request;
class TreeTypeController extends Controller
{
    protected $Data;
    public function __construct(TreeTypeInterface $Data) {
        $this->middleware('permission:tree-type', ['only' => ['index']]);
        $this->middleware('permission:tree-type-create', ['only' => ['store']]);
        $this->middleware('permission:tree-type-edit', ['only' => ['update']]);
        $this->middleware('permission:tree-type-delete', ['only' => ['destroy']]);
        $this->middleware('permission:tree-type-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }// end of data

//    public function create() {
//        return $this->Data->create();
//    }

    public function store(TreeTypeRequest $request) {
        return $this->Data->store($request);
    }

//    public function edit($id) {
//        return $this->Data->edit($id);
//    }// end of edit

    public function update(TreeTypeUpdateRequest $request,$id) {
        return $this->Data->update($request,$id);
    }// end of update

    public function destroy($id) {
        return $this->Data->destroy($id);
    }// end of destroy

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }// end of destroy
}

