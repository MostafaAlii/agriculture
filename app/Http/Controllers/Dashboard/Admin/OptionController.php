<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\Admin\OptionInterface;
use App\Http\Requests\Dashboard\OptionRequest;

class OptionController extends Controller
{
    protected $Data;
    public function __construct(OptionInterface $Data) {
        $this->middleware('permission:options', ['only' => ['index']]);
        $this->middleware('permission:option-create', ['only' => ['store']]);
        $this->middleware('permission:option-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:option-delete', ['only' => ['destroy']]);
        $this->middleware('permission:option-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }
  

    public function data() {
        return $this->Data->data();
    }// end of data

    public function store(OptionRequest $request) {
        return $this->Data->store($request);
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }// end of edit

    public function update(OptionRequest $request,$id) {
        return $this->Data->update($request,$id);
    }// end of update

    public function destroy($id) {
        return $this->Data->destroy($id);
    }// end of destroy

    public function bulkDelete(Request $request)
    {
        return $this->Data->bulkDelete($request);
    }
}
