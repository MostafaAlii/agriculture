<?php
namespace App\Http\Interfaces\Admin;
interface CountryInterface {
    public function index();
    public function data();
    public function store($request);
    public function edit($country);
    public function update($request,$country);
    public function destroy($country);
}