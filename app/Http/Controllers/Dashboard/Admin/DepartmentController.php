<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\DepartmentInterface;
use App\Http\Requests\Dashboard\DepartmentRequest;
use Illuminate\Http\Request;
class DepartmentController extends Controller
{
    protected $Data;
    public function __construct(DepartmentInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }
    public function data()
    {
        return $this->Data->data();

    }
    public function create() {
        return $this->Data->create();
    }

    public function store(DepartmentRequest $request) {
      // dd('ff');
        return $this->Data->store($request);
        //return $request;
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(DepartmentRequest $request) {
        return $this->Data->update($request);
    }

    public function destroy($id) {
         return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request)
    {
        return $this->Data->bulkDelete($request);
    }
}
