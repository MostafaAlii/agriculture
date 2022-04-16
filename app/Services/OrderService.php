<?php
namespace App\Services;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductCoupon;
use App\Models\OrderProduct;
use App\Models\OrderTransaction;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
class OrderService {
    public function createOrder($request) {
        $order = Order::create([
            'referance_id' => 'ORD-' . Str::random(8),
            'user_id' => auth()->user(),
            'payment_method_id' => $request['payment_method_id'],
            'subtotal' => getCalcDiscountNumbers()->get('subtotal'),
            'discount_code' => session()->has('coupon') ? session()->get('coupon')['code'] : null,
            'discount' => getCalcDiscountNumbers()->get('discount'),
            'shipping' => getCalcDiscountNumbers()->get('shipping'),
            'tax' => getCalcDiscountNumbers()->get('productTaxesInCart'),
            'total' => getCalcDiscountNumbers()->get('total'),
            'currency' => 'USD',
            'order_status' => 0,
        ]);
        dd($order);
        foreach (Cart::content() as $item) {
            /*DB::table('order_product')->create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty
            ]);*/
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty
            ]);
            $product = Product::find($item->model->id);
            $product->update(['quantity' => $product->quantity - $item->qty]);
        }
        $order->transactions()->create([
            'transaction' => OrderTransaction::NEW_ORDER
        ]);
    }
}