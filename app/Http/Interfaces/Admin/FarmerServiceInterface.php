<?php
namespace  App\Http\Interfaces\Admin;
interface FarmerServiceInterface {
    public function data();
    public function index();
    public function edit($id);
    public function create();
    public function store($request);
    public function update($request,$id);
    public function destroy($id);
    public function bulkDelete($request);
    public function statistics();


    }