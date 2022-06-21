<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\Admin\AgriServiceInterface;
use App\Http\Requests\Dashboard\AgriServiceRequest;
use App\Http\Requests\Dashboard\AgriServiceUpdateRequest;

class AgriServiceController extends Controller
{
    protected $Data;
    public function __construct(AgriServiceInterface $Data) {
        $this->middleware('permission:agriculture-service', ['only' => ['index']]);
        $this->middleware('permission:agriculture-service-create', ['only' => ['store']]);
        $this->middleware('permission:agriculture-service-edit', ['only' => ['update']]);
        $this->middleware('permission:agriculture-service-delete', ['only' => ['destroy']]);
        $this->middleware('permission:agriculture-service-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }
    public function data() {
        return $this->Data->data();
    }

    public function store(AgriServiceRequest $request) {
        return $this->Data->store($request);
    }

    public function update(AgriServiceUpdateRequest $request,$id) {
        return $this->Data->update($request,$id);
    }
    public function destroy($id) {
        return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }


}
