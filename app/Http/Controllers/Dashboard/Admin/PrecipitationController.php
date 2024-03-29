<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Models\Precipitation;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\PrecipitationInterface;
use App\Http\Requests\Dashboard\PrecipitationRequest;
use App\Http\Requests\Dashboard\PrecipitationUpdateRequest;

use Illuminate\Http\Request;


class PrecipitationController extends Controller
{
    protected $Data;
    public function __construct(PrecipitationInterface $Data) {
        $this->middleware('permission:precipitation', ['only' => ['index']]);
        $this->middleware('permission:precipitation-create', ['only' => ['create','store']]);
        $this->middleware('permission:precipitation-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:precipitation-delete', ['only' => ['destroy']]);
        $this->middleware('permission:precipitation-delete-all', ['only' => ['bulkDelete']]);
        $this->middleware('permission:precipitation-statistics', ['only' => ['index_statistic']]);
        $this->middleware('permission:precipitation-details-statistics', ['only' => ['get_details_statistics_index']]);
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
    public function store(PrecipitationRequest $request){
        return $this->Data->store($request);
    }
    public function edit($id) {
        return $this->Data->edit($id);
    }
    public function update(PrecipitationUpdateRequest $request,$id) {
        return $this->Data->update($request,$id);
    }
    public function destroy($id) {
        return $this->Data->destroy($id);
    }
    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }// end of destroy


    //index for report
    public function precipitation_index_statistic(){
        return $this->Data->precipitation_index_statistic();
    }


    //filter for report
    public function precipitation_statistics(Request $request){
        return $this->Data->precipitation_statistics($request);
    }



}
