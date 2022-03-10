<?php
namespace  App\Http\Interfaces;
interface AdminInterface {
    public function index();
    public function store($request);
    public function update($request);
    public function destroy($request);
}