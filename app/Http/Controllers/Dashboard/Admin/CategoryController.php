<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\CategoryInterface;
use App\Http\Requests\Dashboard\CategoryRequest;
use Illuminate\Http\Request;
class CategoryController extends Controller
{
    protected $Data;
    public function __construct(CategoryInterface $Data) {
        $this->middleware('permission:category-managment', ['only' => ['index']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
        $this->middleware('permission:category-delete-all', ['only' => ['bulkDelete']]);
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

    public function store(CategoryRequest $request) {
      // dd('ff');
        return $this->Data->store($request);
        //return $request;
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(CategoryRequest $request) {
        return $this->Data->update($request);
    }

    public function destroy($id) {
         return $this->Data->destroy($id);
    }

    public function bulkDelete(Request $request)
    {
        return $this->Data->bulkDelete($request);
    }
}
