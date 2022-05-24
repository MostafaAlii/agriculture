<?php
namespace  App\Http\Interfaces\Admin;
interface AdminInterface {
    public function index();
    public function data();
    public function create();
    public function store($request);
    public function edit($admin);
    public function update($request,$admin);
    public function destroy($admin);
    public function bulkDelete($ids);
    public function showProfile($id);
    public function updateAccount($request,$admin);
    public function updateInformation($request,$admin);
    public function change_status($id);

}
