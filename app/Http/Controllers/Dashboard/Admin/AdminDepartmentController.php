<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\AdminDepartmentInterface;
use App\Http\Requests\Dashboard\AdminDepartmentRequest;

class AdminDepartmentController extends Controller
{
    protected $Data;
    public function __construct(AdminDepartmentInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function create() {
        return $this->Data->create();
    }


    public function store(AdminDepartmentRequest $request) {
        return $this->Data->store($request);
    }
    public function edit($id) {
        return $this->Data->edit($id);
    }



    public function update(AdminDepartmentRequest $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}
