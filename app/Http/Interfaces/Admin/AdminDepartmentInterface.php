<?php
namespace  App\Http\Interfaces\Admin;
interface AdminDepartmentInterface {
   public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function destroy($request);
}