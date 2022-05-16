<?php
namespace App\Http\Controllers\Dashboard\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ReviewRequest;
use App\Http\Interfaces\Admin\ReviewInterface;

class ReviewController extends Controller {
    protected $Data;
    public function __construct(ReviewInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }

    public function store(ReviewRequest $request) {
       // dd('fff');
        return $this->Data->store($request);
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }// end of edit

    public function update(ReviewRequest $request,$id) {
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
