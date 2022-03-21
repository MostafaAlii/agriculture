<?php
namespace App\Http\Interfaces\Admin;
//use Illuminate\Http\Request;
interface BlogInterface {
    public function index();
    public function data();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function destroy($id);
    public function bulkDelete($request);
}
