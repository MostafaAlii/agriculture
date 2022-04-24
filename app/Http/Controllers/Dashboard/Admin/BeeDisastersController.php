<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\BeeDisasterInterface;
use App\Http\Requests\Dashboard\DisasterBeeRequest;
use Illuminate\Http\Request;


class BeeDisastersController extends Controller
{
    protected $Data;
    public function __construct(BeeDisasterInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }


    public function data() {
        return $this->Data->data();
    }


    public function store(DisasterBeeRequest $request) {
        return $this->Data->store($request);
    }

    public function update(DisasterBeeRequest $request,$id) {
        return $this->Data->update($request,$id);
    }
    public function destroy($id) {
        return $this->Data->destroy($id);
    }
    public function bulkDelete( Request $request){
        return $this->Data->bulkDelete($request);
    }


}
