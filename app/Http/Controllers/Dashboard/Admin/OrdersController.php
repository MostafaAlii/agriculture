<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\OrderInterface;
use Illuminate\Http\Request;

class OrdersController extends Controller {
    protected $Data;
    public function __construct(OrderInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }

    public function showOrder($id) {
        return $this->Data->showOrder($id);
    }

    public function printOrder($id) {
        return $this->Data->printOrder($id);
    }

    public function update(Request $request, $id) {
        //
    }
}
