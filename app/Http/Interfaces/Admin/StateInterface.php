<?php
namespace App\Http\Interfaces\Admin;
interface StateInterface {
    public function index();
    public function data();
    public function store($request);
    public function edit($id);
    public function update($request,$state);
    public function destroy($area);
}