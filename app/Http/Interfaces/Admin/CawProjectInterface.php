<?php
namespace  App\Http\Interfaces\Admin;
interface CawProjectInterface {
    public function index();
    public function data();
    public function store($request);
    public function update($request,$id);
    public function destroy($request);
    public function bulkDelete($request);
}