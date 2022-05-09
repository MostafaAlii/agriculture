<?php
namespace  App\Http\Interfaces\Admin;
interface LandAreaInterface {
    public function data();
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function destroy($id);
    public function bulkDelete($request) ;
    public function getStatisticaldata();
    public function statistic_land_area_detail();
    public function statistic_land_area_state() ;
}