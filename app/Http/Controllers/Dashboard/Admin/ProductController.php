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

    public function create(ProductRequest $request) {
        return $this->Data->generalInformation($request);
    }
}
