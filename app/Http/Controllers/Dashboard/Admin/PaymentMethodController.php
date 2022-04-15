<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\PaymentMethodInterface;
use App\Http\Requests\Dashboard\PaymentMethodRequest;
use Illuminate\Http\Request;
class PaymentMethodController extends Controller
{
    protected $Data;
    public function __construct(PaymentMethodInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }

    public function store(PaymentMethodRequest $request) {
        return $this->Data->store($request);
    }

    public function create() {
        //
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}
