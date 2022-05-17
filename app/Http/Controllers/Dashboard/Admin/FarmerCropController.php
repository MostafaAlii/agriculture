<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\FarmerCropInterface;
use Illuminate\Http\Request;

use App\Http\Requests\Dashboard\FarmerCropRequest;

class FarmerCropController extends Controller
{
    protected $Data;
    public function __construct(FarmerCropInterface $Data) {
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
    public function update(FarmerCropRequest $request,$id){
        return $this->Data->update($request,$id);
    }
    public function destroy($id) {
        return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }
 public function statistics() {
    return $this->Data->statistics();
}
}
