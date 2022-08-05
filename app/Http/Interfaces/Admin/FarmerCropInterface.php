<?php
namespace  App\Http\Interfaces\Admin;
interface FarmerCropInterface
{
    public function data();

    public function index();

    public function create();

    public function edit($id);


    public function store($request);

    public function update($request, $id);

    public function destroy($id);

    public function bulkDelete($request);
    public function statistics_index();
    public function statistics($request) ;
}