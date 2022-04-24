<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\CourseBeeInterface;

use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\CourseBeeRequest;

class CourseBeeController extends Controller
{

    protected $Data;
    public function __construct(CourseBeeInterface $Data) {
        $this->Data = $Data;
    }

    public function data() {
        return $this->Data->data();
    }
    public function index() {
        return $this->Data->index();
    }
    public function store(CourseBeeRequest $request) {
        return $this->Data->store($request);
    }
    public function update(CourseBeeRequest $request,$id) {
        return $this->Data->update($request,$id);
    }
    public function destroy($id) {
        return $this->Data->destroy($id);
    }
    public function bulkDelete(Request $request){
        return $this->Data->bulkDelete($request);
    }

}
