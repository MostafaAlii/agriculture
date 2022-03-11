<?php
namespace  App\Http\Interfaces\Admin;
interface farmerInterface {
    public function index();
    public function data();
    public function create();
    public function store($request);
    public function edit($farmer);
    public function update($request,$farmer);
    public function destroy($farmer);
}
