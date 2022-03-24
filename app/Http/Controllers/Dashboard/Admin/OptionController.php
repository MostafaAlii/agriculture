<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Http\Interfaces\Admin\OptionInterface;
use App\Http\Requests\Dashboard\OptionRequest;

class OptionController extends Controller
{
    protected $Data;
    public function __construct(OptionInterface $Data) {
        $this->Data = $Data;
    }

    public function index($attr_id) {
        return $this->Data->index($attr_id);
    }
    

    public function show($attr_id) {
        return $this->Data->show($attr_id);
    }

    public function data($attr_id) {
        return $this->Data->data($attr_id);
    }// end of data

    public function store(OptionRequest $request) {
        return $this->Data->store($request);
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }// end of edit

    public function update(OptionRequest $request,$id) {
        return $this->Data->update($request,$id);
    }// end of update

    public function destroy($id) {
        return $this->Data->destroy($id);
    }// end of destroy

   
}
