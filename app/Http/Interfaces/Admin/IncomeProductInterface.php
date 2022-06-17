<?php
namespace  App\Http\Interfaces\Admin;
interface IncomeProductInterface {
    public function data();
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function destroy($id);
    public function bulkDelete($request) ;
    public function index_income_products();
    public function income_product_statistics($request);



    }