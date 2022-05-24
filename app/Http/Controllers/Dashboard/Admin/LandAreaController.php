<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\LandAreaInterface;
use Illuminate\Http\Request;

use App\Http\Requests\Dashboard\LandAreaRequest;


class LandAreaController extends Controller
{
    protected $Data;
    public function __construct(LandAreaInterface $Data) {
        $this->middleware('permission:land-area', ['only' => ['index']]);
        $this->middleware('permission:land-area-create', ['only' => ['create','store']]);
        $this->middleware('permission:land-area-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:land-area-delete', ['only' => ['destroy']]);
        $this->middleware('permission:land-area-delete-all', ['only' => ['bulkDelete']]);
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
    public function update(LandAreaRequest $request,$id){
        return  $this->Data->update( $request,$id);
    }
    public function destroy($id){
        return  $this->Data->destroy( $id);
    }
    public function bulkDelete(Request $request) {
        return  $this->Data->bulkDelete( $request);
    }
    public function getStatisticaldata(){
        return  $this->Data->getStatisticaldata();
    }
    public function statistic_land_area_detail() {
        return  $this->Data->statistic_land_area_detail();
    }
    public function statistic_land_area_state() {
        return  $this->Data->statistic_land_area_state();
    }


}
