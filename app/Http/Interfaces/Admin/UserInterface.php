<?php
namespace  App\Http\Interfaces\Admin;
interface UserInterface {
    public function index();
    public function data();
    public function create();
    public function store($request);
    public function edit($user);
    public function update($request,$user);
    public function destroy($user);
    public function bulkDelete($ids);
    public function showProfile($id);
    public function updateAccount($request,$admin);
    public function updateInformation($request,$admin);
}
