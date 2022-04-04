<?php


namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\LandCategoryInterface;
use App\Http\Requests\Dashboard\LandCategoryRequest;
use Illuminate\Http\Request;

class LandCategoryController extends Controller
{
    protected $Data;
    public function __construct(LandCategoryInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }// end of data



    public function store(LandCategoryRequest $request) {
        return $this->Data->store($request);
    }



    public function update(LandCategoryRequest $request,$id) {
        return $this->Data->update($request,$id);
    }// end of update

    public function destroy($id) {
        return $this->Data->destroy($id);
    }// end of destroy

    public function bulkDelete(Request $request) {
        return $this->Data->bulkDelete($request);
    }// end of destroy
}

