<?php
namespace App\Http\Controllers\Dashboard\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\AttributeInterface;
use App\Http\Requests\Dashboard\AttributeRequest;
class AttributeController extends Controller {
    protected $Data;
    public function __construct(AttributeInterface $Data) {
        $this->middleware('permission:attributes', ['only' => ['index']]);
        $this->middleware('permission:attribute-create', ['only' => ['store']]);
        $this->middleware('permission:attribute-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:attribute-delete', ['only' => ['destroy']]);
        $this->middleware('permission:attribute-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }

    public function store(AttributeRequest $request) {
        return $this->Data->store($request);
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }// end of edit

    public function update(AttributeRequest $request,$id) {
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
