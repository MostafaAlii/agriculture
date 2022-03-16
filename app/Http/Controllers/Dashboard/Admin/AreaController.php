<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\AreaInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\AreaRequest;

class AreaController extends Controller
{
    protected $Data;
    public function __construct(AreaInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }
    public function data()
    {
        return $this->Data->data();

    }// end of data


    public function create() {
        return $this->Data->create();
    }

    public function store(AreaRequest $request) {
        return $this->Data->store($request);
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        return $this->Data->edit($id);

    }

    public function update(AreaRequest $request,$id)
    {
        return $this->Data->update($request,$id);
    }// end of update

    public function destroy($id)
    {
        return $this->Data->destroy($id);

    }// end of destroy
}
