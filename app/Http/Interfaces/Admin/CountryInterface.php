<?php
namespace App\Http\Interfaces\Admin;
interface CountryInterface {
    public function index();
    public function data();
    public function store($request);
}