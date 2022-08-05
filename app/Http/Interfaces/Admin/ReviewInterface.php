<?php
namespace App\Http\Interfaces\Admin;
interface ReviewInterface {
    public function index();
    public function data();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function destroy($id);
    public function bulkDelete($request);
}