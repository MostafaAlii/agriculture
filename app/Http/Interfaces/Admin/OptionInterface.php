<?php
namespace App\Http\Interfaces\Admin;
interface OptionInterface {
    public function index();
    public function data();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function destroy($id);
    public function bulkDelete($request);
}