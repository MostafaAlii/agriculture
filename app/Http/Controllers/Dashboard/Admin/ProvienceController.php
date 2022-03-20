<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\ProvienceInterface;
use App\Http\Requests\Dashboard\ProvienceRequest;
use Illuminate\Http\Request;
class ProvienceController extends Controller
{
    protected $Data;
    public function __construct(ProvienceInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }// end of data

    public function store(ProvienceRequest $request) {
        return $this->Data->store($request);
    }
    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(ProvienceRequest $request, $id) {
        return $this->Data->update($request,$id);
    }// end of update

    public function destroy($id) {
        return $this->Data->destroy($id);
    }// end of destroy


    public function bulkDelete(ProvienceRequest $request) {
        return $this->Data->bulkDelete($request);
    }// end of destroy
}
