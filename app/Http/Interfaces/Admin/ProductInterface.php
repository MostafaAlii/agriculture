<?php
namespace App\Http\Interfaces\Admin;
interface ProductInterface {
    public function index();
    public function generalInformation();
    public function generalInformationStore($request);
    public function data();
    public function edit($id);
    public function additionalPrice($id);
    public function additionalPriceStore($request);
    public function additionalStock($id);
    public function additionalStockStore($request);
    public function update($request);
    public function destroy($id);
    public function bulkDelete($request);
}
