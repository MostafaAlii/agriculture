<?php
namespace  App\Http\Interfaces\Admin;
interface farmerInterface {
    public function index();
    public function data();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request,$farmer);
    public function destroy($farmer);
    public function bulkDelete($ids);
}
