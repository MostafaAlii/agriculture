<?php

namespace App\Http\Interfaces\Admin;

interface CountryInterface {
    public function index();
    public function data();
    public function create();
    public function store($request);
    public function edit($country);
    public function update($request,$country);
    public function destroy($country);
    public function bulkDelete($ids);



}
