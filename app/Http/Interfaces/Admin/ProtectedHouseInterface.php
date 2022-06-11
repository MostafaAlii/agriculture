<?php
namespace  App\Http\Interfaces\Admin;
interface ProtectedHouseInterface{
    public function index();
    public function data();
    public function create();
    public function store($request);
    public function edit($id) ;

    public function update($request,$id);
    public function destroy($id);
    public function bulkDelete($request);
    public function protected_house_index();
    public function protected_house_statistics($request);

    //    public function getFarmerInf($id);
}