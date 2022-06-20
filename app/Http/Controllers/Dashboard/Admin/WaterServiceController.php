<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\WaterServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\WaterServiceRequest;
use App\Http\Requests\Dashboard\WaterServiceUpdateRequest;



class WaterServiceController extends Controller
{
    protected $Data;
    public function __construct(WaterServiceInterface $Data) {
        $this->middleware('permission:water-service', ['only' => ['index']]);
        $this->middleware('permission:water-service-create', ['only' => ['store']]);
        $this->middleware('permission:water-service-edit', ['only' => ['update']]);
        $this->middleware('permission:water-service-delete', ['only' => ['destroy']]);
        $this->middleware('permission:water-service-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }
    public function data() {
        return $this->Data->data();
    }


    public function store(WaterServiceRequest $request) {
        return $this->Data->store($request);
    }

    public function update(WaterServiceUpdateRequest $request,$id) {
        return $this->Data->update($request,$id);
    }
    public function destroy($id) {
        return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }



}
