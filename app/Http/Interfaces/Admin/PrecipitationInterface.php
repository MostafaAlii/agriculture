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
    public function precipitation_index_statistic();

    public function precipitation_statistics($request);


}
