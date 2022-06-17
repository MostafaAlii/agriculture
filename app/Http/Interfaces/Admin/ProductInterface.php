<?php
namespace App\Http\Interfaces\Admin;
interface ProductInterface {
    public function index();
    public function data();
    public function generalInformation();
    public function generalInformationStore($request);
    public function additionalPrice($id);
    public function additionalPriceStore($request);
    public function additionalStockStore($request);
    public function edit($id);
    public function update($request);
}
