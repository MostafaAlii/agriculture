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
        $this->Data = $Data;
    }

    public function data(Request $request) {
        return $this->Data->data($request);
    }
    // public function data()
    // {
    //     return $this->Data->data();

    // }
    // public function create() {
    //     return $this->Data->create();
    // }

    public function store(TagRequest $request) {
        return $this->Data->store($request);
    }

    // public function edit($id) {
    //     return $this->Data->edit($id);
    // }

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
