<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\FarmerServiceInterface;
use Illuminate\Http\Request;
use App\Models\FarmerService;


use App\Http\Requests\Dashboard\FarmerServiceRequest;


class FarmerServiceController extends Controller
{
    protected $Data;
    public function __construct(FarmerServiceInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }
    public function data() {
        return $this->Data->data();
    }

    public function create() {
        return $this->Data->create();
    }
    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function store(FarmerServiceRequest $request) {
        return $this->Data->store($request);
    }

    public function update(FarmerServiceRequest $request,$id) {
        return $this->Data->store($request,$id);
    }
    public function destroy($id) {
        return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }


}
