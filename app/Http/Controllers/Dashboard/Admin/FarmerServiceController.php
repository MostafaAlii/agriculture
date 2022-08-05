<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\FarmerServiceInterface;
use Illuminate\Http\Request;
use App\Models\FarmerService;


use App\Http\Requests\Dashboard\FarmerServiceRequest;
use App\Http\Requests\Dashboard\FarmerServiceUpdateRequest;


class FarmerServiceController extends Controller
{
    protected $Data;
    public function __construct(FarmerServiceInterface $Data) {
        $this->middleware('permission:farmer-service', ['only' => ['index']]);
        $this->middleware('permission:farmer-service-create', ['only' => ['create','store']]);
        $this->middleware('permission:farmer-service-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:farmer-service-delete', ['only' => ['destroy']]);
        $this->middleware('permission:farmer-service-delete-all', ['only' => ['bulkDelete']]);
        $this->middleware('permission:farmer-service-statistics', ['only' => ['statistics']]);
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

    public function update(FarmerServiceUpdateRequest $request,$id) {
        return $this->Data->update($request,$id);
    }
    public function destroy($id) {
        return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }
    // index for report
    public function farmer_services_index_statistics(){
        return $this->Data->farmer_services_index_statistics();
    }

    // filter for report
    public function farmer_services_statistics(Request $request)
    {
        return $this->Data->farmer_services_statistics($request);
    }



}
