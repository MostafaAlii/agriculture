<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\farmerInterface;
use App\Http\Requests\Dashboard\FarmerProfileAccountRequest;
use App\Http\Requests\Dashboard\FarmerProfileInformationRequest;
use App\Http\Requests\Dashboard\FarmerRequest;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FarmerController extends Controller {
    protected $Data;
    public function __construct(farmerInterface $Data) {
        $this->middleware('permission:farmer-list', ['only' => ['index']]);
        $this->middleware('permission:farmer-create', ['only' => ['create','store']]);
        $this->middleware('permission:farmer-show', ['only' => ['show']]);
        $this->middleware('permission:farmer-show|farmer-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:farmer-delete', ['only' => ['destroy']]);
        $this->middleware('permission:farmer-delete-all', ['only' => ['bulkDelete']]);
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

    public function store(FarmerRequest $request) {
        return $this->Data->store($request);
    }// end of store

    public function edit($id) {
        return $this->Data->edit($id);
    }// end of edit

    public function update(FarmerRequest $request,$id) {
        return $this->Data->update($request,$id);
    }// end of update

    public function destroy($id) {
        return $this->Data->destroy($id);
    }// end of destroy

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }// end of destroy
    public function showProfile($id) {
        // dd($id);
        return $this->Data->showProfile($id);
    }// end of showprofile

    public function updateAccount(FarmerProfileAccountRequest $request,$id) {
        return $this->Data->updateAccount($request,$id);
    }// end of update
    public function updateInformation(FarmerProfileInformationRequest  $request,$id) {
        return $this->Data->updateInformation($request,$id);
    }// end of update

    public function getProduct($id){
        return $this->Data->getProduct($id);
    }// end of getProduct
    public function getProductDetails($id){
        return $this->Data->getProductDetails($id);
    }// end of getProduct
}
