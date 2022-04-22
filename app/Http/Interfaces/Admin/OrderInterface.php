<?php
namespace App\Http\Interfaces\Admin;

use App\Models\Order;
interface OrderInterface {
    public function index();
    public function data();
    public function showOrder($id);
}