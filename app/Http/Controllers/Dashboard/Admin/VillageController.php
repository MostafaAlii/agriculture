<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\VillageInterface;
use App\Http\Requests\Dashboard\VillageRequest;
use Illuminate\Http\Request;
class VillageController extends Controller
{
    protected $Data;
    public function __construct(VillageInterface $Data) {
        $this->middleware('permission:village-managment', ['only' => ['index']]);
        $this->middleware('permission:village-create', ['only' => ['store']]);
        $this->middleware('permission:village-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:village-delete', ['only' => ['destroy']]);
        $this->middleware('permission:village-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }

    public function store(VillageRequest $request) {
        return $this->Data->store($request);
    }


    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(VillageRequest $request, $id) {
        return $this->Data->update($request,$id);
    }

    public function destroy($id) {
        return $this->Data->destroy($id);
    }

    public function bulkDelete(VillageRequest $request) {
        return $this->Data->bulkDelete($request);
    }// end of destroy
}
