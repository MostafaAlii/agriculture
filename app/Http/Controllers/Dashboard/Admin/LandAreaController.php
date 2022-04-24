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


}
