<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\ProtectedHouseInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\ProtectedHouseRequest;
use App\Http\Requests\Dashboard\ProtectedHouseUpdateRequest;


class ProtectedHouseController extends Controller
{
    protected $Data;
    public function __construct(ProtectedHouseInterface $Data) {
        $this->middleware('permission:protect-house', ['only' => ['index']]);
        $this->middleware('permission:protect-house-create', ['only' => ['create','store']]);
        $this->middleware('permission:protect-house-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:protect-house-delete', ['only' => ['destroy']]);
        $this->middleware('permission:protect-house-delete-all', ['only' => ['bulkDelete']]);
        $this->middleware('permission:protected-house-statistics', ['only' => ['protected_house_statistics']]);
        $this->middleware('permission:protected-house-government-statistics', ['only' => ['protected_house_gov_statistics']]);
        $this->middleware('permission:protected-house-private-statistics', ['only' => ['protected_house_private_statistics']]);
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

    public function store(ProtectedHouseRequest $request) {
        return $this->Data->store($request);
    }


    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(ProtectedHouseUpdateRequest $request, $id) {
        return $this->Data->update($request, $id);
    }

    public function destroy($id) {
        return $this->Data->destroy($id);    }

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }// end of destroy

    // index report for protected house
    public function protected_house_index(){
        return $this->Data->protected_house_index();
    }


    // filter report for protected house
    public function protected_house_statistics(Request $request){
        return $this->Data->protected_house_statistics($request);
    }

}
