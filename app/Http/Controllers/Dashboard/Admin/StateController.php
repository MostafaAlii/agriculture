<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\StateInterface;
use App\Http\Requests\Dashboard\StateRequest;
use App\Http\Requests\Dashboard\StateUpdateRequest;

use Illuminate\Http\Request;
class StateController extends Controller
{
    protected $Data;
    public function __construct(StateInterface $Data) {
        $this->middleware('permission:state-managment', ['only' => ['index']]);
        $this->middleware('permission:state-create', ['only' => ['store']]);
        $this->middleware('permission:state-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:state-delete', ['only' => ['destroy']]);
        $this->middleware('permission:state-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }


    public function data() {
        return $this->Data->data();
    }

    public function store(StateRequest $request) {
        return $this->Data->store($request);
    }


    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(StateUpdateRequest $request,$id) {
        return $this->Data->update($request,$id);
    }// end of update

    public function destroy($id) {
        return $this->Data->destroy($id);
    }// end of destroy

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }// end of destroy
}
