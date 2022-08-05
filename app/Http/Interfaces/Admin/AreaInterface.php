<?php
namespace App\Http\Interfaces\Admin;
interface AreaInterface {
    public function index();
    public function data();
    public function store($request);
    public function edit($id);
    public function update($request,$area);
    public function destroy($area);
    public function bulkDelete($ids);

}