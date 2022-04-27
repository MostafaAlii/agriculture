<?php
namespace App\Http\Controllers\front\vendor;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VendorController extends Controller {
    public function index() {
        return view('front.client.dashboard');
    }

    public function orders() {
        return view('front.client.myOrders');
    }
}
