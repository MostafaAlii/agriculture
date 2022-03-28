<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\ProductInterface;
use App\Http\Requests\Dashboard\ProductRequest;
use Illuminate\Http\Request;
class ProductController extends Controller {
    protected $Data;
    public function __construct(ProductInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }

    public function create(ProductRequest $request) {
        return $this->Data->generalInformation($request);
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(ProductRequest $request) {
        return $this->Data->update($request);
    }
    
    public function destroy($id){
        return $this->Data->destroy($id);
    }
    public function bulkDelete(Request $request){
        return $this->Data->bulkDelete($request);
    }
}
