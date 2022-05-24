<?php
namespace  App\Http\Interfaces\Admin;
interface AgriServiceInterface {
    public function index();
    public function data();
    public function create();
    public function store($request);
    public function update($request,$id);
    public function destroy($id);
    public function bulkDelete( $request) ;

    }