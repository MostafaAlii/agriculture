<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\SliderInterface;
use App\Http\Requests\Dashboard\SliderRequest;
use Illuminate\Http\Request;
class SliderController extends Controller
{
    protected $Data;
    public function __construct(SliderInterface $Data) {
        $this->middleware('permission:slider-managment', ['only' => ['index']]);
        $this->middleware('permission:photo-slider-create', ['only' => ['create','store']]);
        $this->middleware('permission:photo-slider-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:photo-slider-delete', ['only' => ['destroy']]);
        $this->middleware('permission:photo-slider-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }
    public function index() {
        return $this->Data->index();
    }
    public function data()
    {
        return $this->Data->data();

    }
    public function create() {
        return $this->Data->create();
    }

    public function store(SliderRequest $request) {
        return $this->Data->store($request);
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(SliderRequest $request , $id) {
        return $this->Data->update($request,$id);
    }

    public function destroy($id) {
         return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request)
    {
        return $this->Data->bulkDelete($request);
    }

}
