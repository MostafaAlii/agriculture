<?php
namespace App\Http\Interfaces\Admin;
interface ProductInterface {
    public function index();
    public function data();
    public function generalInformation();
    public function generalInformationStore($request);
    public function additionalPriceStore($request);
    public function additionalStockStore($request);
    public function changeStatus($request);
    public function edit($id);
    public function update($request);
    public function trashed_data();
    public function restore();
    public function updateRestore($request, $id);
    public function destroy($id);
    public function forceDestroy($id);
    public function bulkDelete($request);
}
