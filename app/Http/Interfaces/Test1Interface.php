<?php
namespace  App\Http\Interfaces;
interface Test1Interface {
    public function index();
    public function store($request);
    public function update($request);
    public function destroy($request);
}