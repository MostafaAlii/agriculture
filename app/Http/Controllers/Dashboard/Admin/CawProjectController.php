<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Requests\Dashboard\AnimalRequest;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\CawProjectInterface;
use Illuminate\Http\Request;


class CawProjectController extends Controller
{

    protected $Data;
    public function __construct(CawProjectInterface $Data) {
        $this->middleware('permission:caws-project', ['only' => ['index']]);
        $this->middleware('permission:caws-project-create', ['only' => ['create','store']]);
        $this->middleware('permission:caws-project-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:caws-project-delete', ['only' => ['destroy']]);
        $this->middleware('permission:caws-project-delete-all', ['only' => ['bulkDelete']]);
        $this->middleware('permission:statistics-report', ['only' => ['statistics']]);
        $this->middleware('permission:ship-report-statistics', ['only' => ['ship_statistics']]);
        $this->middleware('permission:caw-report-statistics', ['only' => ['caw_statistics']]);
        $this->middleware('permission:fish-report-statistics', ['only' => ['fish_statistics']]);
        $this->Data = $Data;
    }

    public function data() {
        return $this->Data->data();
    }
    public function index() {
        return $this->Data->index();
    }

    public function create() {
        return $this->Data->create();
    }

    public function store(AnimalRequest $request) {
        return $this->Data->store($request);
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(AnimalRequest $request, $id) {
        return $this->Data->update($request,$id);
    }

    public function destroy($id) {
        return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request){
        return $this->Data->bulkDelete($request);
    }
    public function statistics(){
        return $this->Data->statistics();
    }
    public function caw_statistics(){
        return $this->Data->caw_statistics();
    }
    public function fish_statistics(){
        return $this->Data->fish_statistics();
    }
    public function ship_statistics(){
        return $this->Data->ship_statistics();
    }
}
