<?php
namespace App\Http\Interfaces\Admin;
interface ProductInterface {
    public function index();
    public function generalInformation($request);
}