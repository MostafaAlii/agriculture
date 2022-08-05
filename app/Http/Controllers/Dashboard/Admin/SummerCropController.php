<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\SummerCropInterface;
use Illuminate\Http\Request;

use App\Http\Requests\Dashboard\SummerCropRequest;
use App\Http\Requests\Dashboard\SummerCropUpdateRequest;


class SummerCropController extends Controller
{
    protected $Data;
    public function __construct(SummerCropInterface $Data) {
        $this->middleware('permission:summer-crops', ['only' => ['index']]);
        $this->middleware('permission:summer-crop-create', ['only' => ['store']]);
        $this->middleware('permission:summer-crop-edit', ['only' => ['update']]);
        $this->middleware('permission:summer-crop-delete', ['only' => ['destroy']]);
        $this->middleware('permission:summer-crop-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }
    public function data() {
        return $this->Data->data();
    }

    public function store(SummerCropRequest $request) {
        return $this->Data->store($request);
    }



    public function update(SummerCropUpdateRequest $request,$id ) {
        return $this->Data->update($request,$id);
    }

    public function destroy($id) {
        return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request){
        return $this->Data->destroy($request);


    }

}
