<?php
namespace  App\Http\Interfaces\Admin;
interface OutcomeProductInterface {
    public function data();
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function destroy($id);
    public function bulkDelete($request) ;
    public function outcome_product_statistics();
    public function index_outcome_products();
    public function get_weekly_monthly_anual_outcome_product_statistics();
}