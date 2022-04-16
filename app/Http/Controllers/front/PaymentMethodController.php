<?php
namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
//use App\Http\Interfaces\Front\PaymentMethodInterface;
use Illuminate\Http\Request;
class PaymentMethodController extends Controller {
    protected $Data;
    /*public function __construct(PaymentMethodInterface $Data) {
        $this->Data = $Data;
    }*/
    public function checkout() {
        dd('Success');
    }
}
