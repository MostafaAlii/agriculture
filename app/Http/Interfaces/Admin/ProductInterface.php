<?php
namespace App\Http\Interfaces\Admin;
interface ProductInterface {
    public function index();
    public function generalInformation();
    public function generalInformationStore($request);
    //public function data();
    public function edit($id);
    public function update($request);
    public function destroy($id);
    public function bulkDelete($request);
}