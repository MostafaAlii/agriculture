<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\BlogInterface;
use App\Http\Requests\Dashboard\BlogRequest;
use App\Http\Requests\Dashboard\DepartmentRequest;
use Illuminate\Http\Request;
class BlogController extends Controller
{
    protected $Data;
    public function __construct(BlogInterface $Data) {
        $this->middleware('permission:blogs', ['only' => ['index']]);
        $this->middleware('permission:blog-create', ['only' => ['create','store']]);
        $this->middleware('permission:blog-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:blog-delete', ['only' => ['destroy']]);
        $this->middleware('permission:blog-delete-all', ['only' => ['bulkDelete']]);
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

    public function store(BlogRequest $request) {
        return $this->Data->store($request);
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(BlogRequest $request , $id) {
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
