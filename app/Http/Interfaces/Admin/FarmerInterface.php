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
    public function showProfile($id);
    public function updateAccount($request,$admin);
    public function updateInformation($request,$admin);
}
