<?php
namespace  App\Http\Interfaces\Admin;
interface PrecipitationInterface
{
    public function data();

    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request, $id);

    public function destroy($id);

    public function bulkDelete($request);

//    public function statistics();
    public function index_statistic();

    public function get_custom_statistics();

    public function get_details_statistics_index();

    public function get_details_statistics();

}
