<?php


namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\CountryInterface;
use App\Http\Requests\Dashboard\CountryRequest;
use Illuminate\Http\Request;
class CountryController extends Controller
{
    protected $Data;
    public function __construct(CountryInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function data() {
        return $this->Data->data();
    }// end of data

    public function store(CountryRequest $request) {
        return $this->Data->store($request);
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }// end of edit

    public function update(CountryRequest $request,$id) {
        return $this->Data->update($request,$id);
    }// end of update

    public function destroy($id) {
        return $this->Data->destroy($id);
    }// end of destroy
}
