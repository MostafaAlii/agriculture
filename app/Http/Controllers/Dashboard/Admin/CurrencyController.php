<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\CurrencyInterface;
use App\Http\Requests\Dashboard\CurrencyRequest;
use App\Http\Requests\Dashboard\CurrencyUpdateRequest;

use Illuminate\Http\Request;
class CurrencyController extends Controller
{
    protected $Data;
    public function __construct(CurrencyInterface $Data) {
        $this->middleware('permission:currencies', ['only' => ['index']]);
        $this->middleware('permission:currency-create', ['only' => ['store']]);
        $this->middleware('permission:currency-edit', ['only' => ['update']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }// end of data



    public function store(CurrencyRequest $request) {
        return $this->Data->store($request);
    }



    public function update(CurrencyUpdateRequest $request,$id) {
        return $this->Data->update($request,$id);
    }// end of update
}

