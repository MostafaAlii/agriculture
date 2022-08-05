<?php
namespace App\Http\Interfaces\Admin;
interface OrderInterface {
    public function index();
    public function data();
    public function update($request,$id);
    public function showOrder($id);
    public function printOrder($id);
}