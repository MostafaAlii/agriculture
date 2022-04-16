<?php
namespace App\Http\Interfaces\Front;
interface PaymentInterface {
    public function checkout_now($request);
}