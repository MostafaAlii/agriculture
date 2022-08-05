<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\FarmerCropInterface;
use Illuminate\Http\Request;

use App\Http\Requests\Dashboard\FarmerCropRequest;
use App\Http\Requests\Dashboard\FarmerCropUpdateRequest;


class FarmerCropController extends Controller
{
    protected $Data;
    public function __construct(FarmerCropInterface $Data) {
        $this->middleware('permission:farmer-crop', ['only' => ['index']]);
        $this->middleware('permission:farmer-crop-create', ['only' => ['create','store']]);
        $this->middleware('permission:farmer-crop-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:farmer-crop-delete', ['only' => ['destroy']]);
        $this->middleware('permission:farmer-crop-delete-all', ['only' => ['bulkDelete']]);
        $this->middleware('permission:farmer-crop-statistics', ['only' => ['statistics']]);
        $this->Data = $Data;
    }


   public function index(){
        return $this->Data->index();
   }

    public function data(){
        return $this->Data->data();
    }

    public function create(){
        return $this->Data->create();
    }
    public function edit($id){
        return $this->Data->edit($id);
    }
    public function store(FarmerCropRequest $request){
        return $this->Data->store($request);
    }
    public function update(FarmerCropUpdateRequest $request,$id){
        return $this->Data->update($request,$id);
    }
    public function destroy($id) {
        return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }
    public function statistics_index(){
        return $this->Data->statistics_index();
    }
 public function statistics(Request $request) {
    return $this->Data->statistics($request);
}
}
