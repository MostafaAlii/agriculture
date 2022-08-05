<?php

namespace App\Http\Interfaces\Admin;
interface VillageInterface {
    public function index();
    public function data();
    public function store($request);
    public function edit($id);
    public function update($request,$village);
    public function destroy($village);
    public function bulkDelete($ids);

}