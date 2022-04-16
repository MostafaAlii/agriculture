<?php
namespace App\Services;
use Paytabscom\Laravel_paytabs\Facades\paypage;
class PaytabsService {
    protected $gateway = '';
    public function __construct($payment_method = 'PayPal_Express') {
        if(is_null($payment_method) || $payment_method == 'PayPal_Express'){
            $this->gateway = paypage::create('PayPal_Express');
            $this->gateway->setUsername(env('PAYPAL_USERNAME'));
            $this->gateway->setPassword(env('PAYPAL_PASSWORD'));
            $this->gateway->setSignature(env('PAYPAL_SIGNATURE'));
            $this->gateway->setTestMode(env('PAYPAL_SANDBOX'));
        }
        return $this->gateway;
    }

    public function purchase(array $parameter) {
        $response = $this->gateway->purchase($parameter)->send();
        return $response;
    }

    public function refund(array $parameter) {
        $response = $this->gateway->refund($parameter)->send();
        return $response;
    }

    public function complete(array $parameter) {
        $response = $this->gateway->completePurchase($parameter)->send();
        return $response;
    }

    public function getCancelUrl($order_id) {
        return route('checkout.paypal.cancel', $order_id);
    }

    public function getReturnUrl($order_id) {
        return route('checkout.paypal.complete', $order_id);
    }

    public function getNotifyUrl($order_id) {
        $env = env('PAYPAL_SANDBOX') ? 'sandbox' : 'live';
        return route('checkout.paypal.webhook.ipn', [$order_id, $env]);
    }
}