<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\BrandInterface;
use App\Http\Requests\Dashboard\BrandRequest;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $Data;
    public function __construct(BrandInterface $Data) {
        $this->middleware('permission:brands-managment', ['only' => ['index']]);
        $this->middleware('permission:brands-create', ['only' => ['create','store']]);
        $this->middleware('permission:brands-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:brands-delete', ['only' => ['destroy']]);
        $this->middleware('permission:brands-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }
    public function index() {
        return $this->Data->index();
    }
    public function data()
    {
        return $this->Data->data();

    }
    public function create() {
        return $this->Data->create();
    }

    public function store(BrandRequest $request) {
        return $this->Data->store($request);
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(BrandRequest $request , $id) {
        return $this->Data->update($request,$id);
    }

    public function destroy($id) {
         return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request)
    {
        return $this->Data->bulkDelete($request);
    }
}
