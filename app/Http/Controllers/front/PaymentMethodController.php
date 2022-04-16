<?php
namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Front\PaymentInterface;
use Illuminate\Http\Request;
class PaymentMethodController extends Controller {
    protected $Data;
    public function __construct(PaymentInterface $Data) {
        $this->Data = $Data;
    }

    public function checkout_now(Request $request) {
        return $this->Data->checkout_now($request);
    }

    public function cancelled($order_id) {

    }

    public function completed($order_id) {
        
    }

    public function webhook($order, $env) {
        //
    }
}
