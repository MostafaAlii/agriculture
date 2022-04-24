<?php
namespace  App\Http\Interfaces\Admin;
interface BeeDisasterInterface {
    public function index();
    public function data();



    public function store($request);
    public function update($request,$id);
    public function destroy($id);
    public function bulkDelete($request);

}