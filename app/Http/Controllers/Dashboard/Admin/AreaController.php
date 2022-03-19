<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\AreaInterface;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    protected $Data;
    public function __construct(AreaInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function store(Request $request) {
        return $this->Data->store($request);
    }

    public function update(Request $request,$id) {
        return $this->Data->update($request,$id);
    }// end of update

    public function destroy($id) {
        return $this->Data->destroy($id);
    }// end of destroy
}
