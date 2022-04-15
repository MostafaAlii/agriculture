<?php
namespace App\Http\Interfaces\Admin;
interface PaymentMethodInterface {
    public function index();
    public function data();
    public function store($request);
}