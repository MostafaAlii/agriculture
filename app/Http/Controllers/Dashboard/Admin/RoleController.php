<?php
namespace App\Http\Controllers\Dashboard\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RolesRequest;
use App\Http\Requests\Dashboard\RoleUpdateRequest;
use App\Http\Interfaces\Admin\RoleRepositoryInterface;

class RoleController extends Controller {
    protected $Data;
    public function __construct(RoleRepositoryInterface $Data) {
        /*$this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);*/
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

    public function store(RolesRequest $request) {
        return $this->Data->store($request);
    }

    public function show($id) {
        return $this->Data->show($id);
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(RoleUpdateRequest $request, $id) {
        return $this->Data->update($request, $id);
    }

    public function destroy($id) {
        return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }
}
