<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\LandAreaInterface;
use Illuminate\Http\Request;

use App\Http\Requests\Dashboard\LandAreaRequest;
use App\Http\Requests\Dashboard\LandAreaUpdateRequest;


class LandAreaController extends Controller
{
    protected $Data;
    public function __construct(LandAreaInterface $Data) {
        $this->middleware('permission:land-area', ['only' => ['index']]);
        $this->middleware('permission:land-area-create', ['only' => ['create','store']]);
        $this->middleware('permission:land-area-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:land-area-delete', ['only' => ['destroy']]);
        $this->middleware('permission:land-area-delete-all', ['only' => ['bulkDelete']]);
        $this->middleware('permission:land-area-report', ['only' => ['getStatisticaldata']]);
        $this->middleware('permission:land-area-details-report', ['only' => ['statistic_land_area_detail']]);
        $this->middleware('permission:land-area-state-report', ['only' => ['statistic_land_area_state']]);
        return $this->Data = $Data;
    }

     public function data(){
         return $this->Data->data();
     }

    public function index(){
        return $this->Data->index();
    }

    public function store(LandAreaRequest $request){
        return $this->Data->store($request);
    }
    public function create(){
        return $this->Data->create();
    }
    public function edit($id){
        return $this->Data->edit($id);
    }

    public function update(LandAreaUpdateRequest $request,$id){
        return  $this->Data->update( $request,$id);
    }

    public function destroy($id){
        return  $this->Data->destroy( $id);
    }

    public function bulkDelete(Request $request) {
        return  $this->Data->bulkDelete( $request);
    }
//index for report
    public function index_land_area_statistics(){
        return  $this->Data->index_land_area_statistics();

    }
//filter for report
    public function statistic_land_area_detail(Request $request) {
        return  $this->Data->statistic_land_area_detail($request);
    }



}
