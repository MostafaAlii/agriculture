<?php
namespace  App\Http\Interfaces\Admin;
interface SummerCropInterface {
    public function data();
    public function index();
    public function store($request);
    public function update($request,$id);
    public function destroy($id);
    public function bulkDelete($request);

}