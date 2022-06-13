<?php
namespace App\Http\Interfaces\Admin;
interface ProductInterface {
    public function index();
    public function create();
    public function edit($id);
}
