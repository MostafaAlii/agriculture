<?php
namespace App\Http\Repositories\Front;
use App\Models\PaymentMethod;
use App\Services\PaytabsService;
use App\Services\OrderService;
use App\Http\Interfaces\Front\PaymentInterface;
class PaymentRepository implements PaymentInterface {
    public function checkout_now($request) {
        $order = (new OrderService)->createOrder($request->except(['_token', 'submit']));
        $payTabs = new PaytabsService('PayPal_Express');
        $response = $payTabs->purchase([
            'amount' => $order->total,
            'transactionId' => $order->referance_id,
            'currency' => $order->currency,
            'cancelUrl' => $payTabs->getCancelUrl($order->id),
            'returnUrl' => $payTabs->getReturnUrl($order->id),
        ]);
        if ($response->isRedirect()) {
            $response->redirect();
        }
        toast($response->getMessage(), 'error');
        return redirect()->route('shop');
    }
}