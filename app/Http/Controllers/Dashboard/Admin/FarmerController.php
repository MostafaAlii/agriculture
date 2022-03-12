<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\farmerInterface;
use App\Http\Requests\Dashboard\FarmerRequest;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FarmerController extends Controller {
    protected $Data;
    public function __construct(farmerInterface $Data) {
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

    public function store(FarmerRequest $request)
    {
        return $this->Data->store($request);
    }// end of store

    public function edit(Farmer $farmer)
    {
        return $this->Data->edit($farmer);

    }// end of edit

    public function update(FarmerRequest $request, Farmer $farmer)
    {
        return $this->Data->update($request,$farmer);
    }// end of update

    public function destroy(Farmer $farmer)
    {

        return $this->Data->destroy($farmer);
    }// end of destroy
}
