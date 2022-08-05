<?php
namespace  App\Http\Interfaces\Admin;
interface WorkerInterface {
    public function index();
    public function data();
    public function create();
    public function store($request);
    public function edit($worker);
    // public function update($request,$admin);
    public function destroy($worker);
    public function bulkDelete($ids);
    public function showProfile($id);
    public function updateAccount($request,$worker);
    public function updateInformation($request,$admin);
}
