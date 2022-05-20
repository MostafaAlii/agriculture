<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\WorkerInterface;
use App\Http\Requests\Dashboard\WorkerProfileAccountRequest;
use App\Http\Requests\Dashboard\WorkerProfileInformationRequest;
use App\Http\Requests\Dashboard\WorkerRequest;
use Illuminate\Http\Request;
class WorkerController extends Controller {
    protected $Data;
    public function __construct(WorkerInterface $Data) {
        $this->middleware('permission:worker-list', ['only' => ['index']]);
        $this->middleware('permission:worker-create', ['only' => ['create','store']]);
        $this->middleware('permission:worker-show', ['only' => ['show']]);
        $this->middleware('permission:worker-show|worker-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:worker-delete', ['only' => ['destroy']]);
        $this->middleware('permission:worker-delete-all', ['only' => ['bulkDelete']]);
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

    public function store(WorkerRequest $request) {
        return $this->Data->store($request);
    }// end of store


    public function edit($id) {
        return $this->Data->edit($id);
    }// end of edit

    public function destroy($id) {
        return $this->Data->destroy($id);
    }// end of destroy

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }// end of destroy
    public function showProfile($id) {
        return $this->Data->showProfile($id);
    }// end of showprofile

    public function updateAccount(WorkerProfileAccountRequest $request,$id) {
        return $this->Data->updateAccount($request,$id);
    }// end of update
    public function updateInformation(WorkerProfileInformationRequest $request,$id) {
        return $this->Data->updateInformation($request,$id);
    }// end of update
}
