<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\TagInterface;
use App\Http\Requests\Dashboard\TagRequest;
use Illuminate\Http\Request;
class TagController extends Controller
{
    protected $Data;
    public function __construct(TagInterface $Data) {
        $this->middleware('permission:tags', ['only' => ['index']]);
        $this->middleware('permission:tag-create', ['only' => ['store']]);
        $this->middleware('permission:tag-edit', ['only' => ['update']]);
        $this->middleware('permission:tag-delete', ['only' => ['destroy']]);
        $this->middleware('permission:tag-delete-all', ['only' => ['bulkDelete']]);
        $this->Data = $Data;
    }

    public function data(Request $request) {
        return $this->Data->data($request);
    }

    public function store(TagRequest $request) {
        return $this->Data->store($request);
    }


    public function update(TagRequest $request ,$id) {
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
