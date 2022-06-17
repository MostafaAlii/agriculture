<?php
namespace  App\Http\Interfaces\Admin;
interface BeekeeperInterface {
    public function data();
    public function create();
    public function store($request);
    public function edit($id);
    public function index();
    public function update($request,$id);
    public function destroy($id);
    public function bulkDelete($request);

    public function index_statistics();

    public function statistics($request);

}