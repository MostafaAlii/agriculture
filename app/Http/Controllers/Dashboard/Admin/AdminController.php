<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\AdminInterface;
use App\Http\Requests\Dashboard\AdminRequest;
use Illuminate\Http\Request;
class AdminController extends Controller {

    protected $Data;
    public function __construct(AdminInterface $Data) {
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

    public function store(AdminRequest $request) {
        return $this->Data->store($request);
    }// end of store

    public function edit($id) {
        // dd($id);
        return $this->Data->edit($id);
    }// end of edit

    public function update(AdminRequest $request,$id) {
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


    public function updateAccount(AdminRequest $request,$id) {
        return $this->Data->updateAccount($request,$id);
    }// end of update
    public function updateInformation(AdminRequest $request,$id) {
        return $this->Data->updateInformation($request,$id);
    }// end of update
}
