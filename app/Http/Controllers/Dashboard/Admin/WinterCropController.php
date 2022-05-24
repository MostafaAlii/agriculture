<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\WinterCropInterface;
use Illuminate\Http\Request;

use App\Http\Requests\Dashboard\WinterCropRequest;

class WinterCropController extends Controller
{
    protected $Data;
    public function __construct(WinterCropInterface $Data) {
        $this->middleware('permission:winter-crops', ['only' => ['index']]);
        $this->middleware('permission:winter-crop-create', ['only' => ['store']]);
        $this->middleware('permission:winter-crop-edit', ['only' => ['update']]);
        $this->middleware('permission:winter-crop-delete', ['only' => ['destroy']]);
        $this->middleware('permission:winter-crop-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }
    public function data() {
        return $this->Data->data();
    }

    public function store(WinterCropRequest $request) {
        return $this->Data->store($request);
    }



    public function update(WinterCropRequest $request,$id ) {
        return $this->Data->update($request,$id);
    }

    public function destroy($id) {
        return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request){
        return $this->Data->destroy($request);


    }

}
