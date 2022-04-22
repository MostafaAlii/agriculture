<?php
namespace App\Http\Controllers\front\vendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class VendorController extends Controller {
    public function index() {
        return view('front.client.dashboard');
    }

    public function orders() {
        return view('front.client.myOrders');
    }
}
