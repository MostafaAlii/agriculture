<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\UserInterface;
use App\Http\Requests\Dashboard\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller {
    protected $Data;
    public function __construct(UserInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();

    }

    public function data()
    {
        return $this->Data->data();

    }// end of data

    public function create() {
        return $this->Data->create();
    }

    public function store(UserRequest $request)
    {
        return $this->Data->store($request);
    }// end of store

    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(UserRequest $request,$id) {
        return $this->Data->update($request,$id);
    }// end of update

    public function destroy($id) {
        return $this->Data->destroy($id);
    }// end of destroy

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }// end of destroy
}
