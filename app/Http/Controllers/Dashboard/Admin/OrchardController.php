<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\OrchardInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\OrchardRequest;

class OrchardController extends Controller
{
    protected $Data;
    public function __construct(OrchardInterface $Data) {
        $this->middleware('permission:orchard', ['only' => ['index']]);
        $this->middleware('permission:orchard-create', ['only' => ['create','store']]);
        $this->middleware('permission:orchard-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:orchard-delete', ['only' => ['destroy']]);
        $this->middleware('permission:orchard-delete-all', ['only' => ['bulkDelete']]);
        $this->middleware('permission:orchard-report-statistics', ['only' => ['statistics']]);
        $this->Data = $Data;
    }


    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }// end of data

    public function create() {
        return $this->Data->create();
    }
    public function getFarmer($id){
        return $this->Data->getFarmer($id);
    }
    public function getFarmerInf($id){
        return $this->Data->getFarmerInf($id);
    }
    public function store(OrchardRequest $request) {
        return $this->Data->store($request);
    }
    public function edit($id) {
        return $this->Data->edit($id);
    }
    public function update(OrchardRequest $request, $id) {
        return $this->Data->update($request, $id);
    }
    public function destroy($id) {
        return $this->Data->destroy($id);    }
    public function bulkDelete(Request $request){
        return $this->Data->bulkDelete($request);
    }
    public function statistics(){
        return $this->Data->statistics();
    }
}
