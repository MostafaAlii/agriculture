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
    public function income_product_statistics();
    public function index_income_products();
    public function get_weekly_monthly_anual_income_product_statistics();

    public function index_income_local_products();

    public function get_weekly_monthly_anual_income_local_product_statistics();

    public function index_income_iraq_products();

    public function get_weekly_monthly_anual_income_iraq_product_statistics();

    public function index_income_imported_products();

    public function get_weekly_monthly_anual_income_imported_product_statistics();


    }