<?php
namespace  App\Http\Interfaces\Admin;
interface OrchardInterface {
    public function index();
    public function data();
    public function create();
    public function store($request);
    public function update($request);
    public function destroy($request);
}