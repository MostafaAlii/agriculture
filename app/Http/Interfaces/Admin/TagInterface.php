<?php
namespace App\Http\Interfaces\Admin;
//use Illuminate\Http\Request;
interface TagInterface {
    public function data($request);
    public function store($request);
    public function update($request,$id);
    public function destroy($id);
    public function bulkDelete($request);
}
