<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\ProductInterface;
use App\Http\Requests\Dashboard\Product\GeneralRequest;
use Illuminate\Http\Request;
class ProductController extends Controller {
    protected $Data;
    public function __construct(ProductInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    /*public function data() {
        return $this->Data->data();
    }*/

    public function create() {
        return $this->Data->generalInformation();
    }

    public function generalInformationStore(GeneralRequest $request) {
        return $this->Data->generalInformationStore($request);
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(GeneralRequest $request) {
        return $this->Data->update($request);
    }
    
    public function destroy($id){
        return $this->Data->destroy($id);
    }
    public function bulkDelete(Request $request){
        return $this->Data->bulkDelete($request);
    }
}
