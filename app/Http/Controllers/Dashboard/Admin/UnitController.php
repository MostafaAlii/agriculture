<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\UnitInterface;
use App\Http\Requests\Dashboard\UnitRequest;
use Illuminate\Http\Request;
class UnitController extends Controller
{
    protected $Data;
    public function __construct(UnitInterface $Data) {
        $this->middleware('permission:units', ['only' => ['index']]);
        $this->middleware('permission:unit-create', ['only' => ['store']]);
        $this->middleware('permission:unit-edit', ['only' => ['update']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }// end of data

    public function store(UnitRequest $request) {
        return $this->Data->store($request);
    }

    public function update(UnitRequest $request,$id) {
        return $this->Data->update($request,$id);
    }// end of update
}

