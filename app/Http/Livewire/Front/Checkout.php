<?php
namespace App\Http\Livewire\Front;
use App\Models\Order;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Paytabscom\Laravel_paytabs\Facades\paypage as paypage;
use Illuminate\Support\Facades\Notification;
class Checkout extends Component {
    public $cart_subtotal, $cart_tax, $cart_total, $cart_discount;
    public $user_id, $user_address1, $user_address2, $user_email, $user_firstname,$user_lastname, $user_mobile;
    public $user_country, $user_proviency, $user_area, $user_state, $user_village;
    public $ship_to_different;
    public $shipping_address1, $shipping_address2, $shipping_email, $shipping_firstname,$shipping_lastname, $shipping_mobile;
    public $shipping_country, $shipping_proviency, $shipping_area, $shipping_state, $shipping_village;
    public $paymentmode, $thankyou;
    public $card_no, $exp_month, $exp_year, $cvc;
    public function mount(){
        $this->user_address1 = auth()->user()->address1;
        $this->user_email = auth()->user()->email;
        $this->user_id = Auth::guard('vendor')->user()->id;
        $this->user_mobile = auth()->user()->phone;
        $this->user_firstname = auth()->user()->firstname;
        $this->user_lastname = auth()->user()->lastname;
        $this->user_country = auth()->user()->country->name;
        $this->user_proviency = auth()->user()->province->name;
        $this->user_area = auth()->user()->area->name;
        $this->user_state = auth()->user()->state->name;
        $this->user_village = auth()->user()->village->name;
        $this->total = session()->get('checkout')['total'];
    }

    public function updated($fields) {
        $this->validateOnly($fields,[
            'user_firstname'                     =>           'required',
            'user_lastname'                      =>           'required',
            'user_email'                         =>           'required|email',
            'user_mobile'                        =>           'required|numeric|required|numeric|min:10',
            'user_country'                       =>           'required',
            'user_proviency'                     =>           'required',
            'user_area'                          =>           'required',
            'user_state'                         =>           'required',
            'user_village'                       =>           'required',
            'user_address1'                      =>           'required',
            'paymentmode'                        =>           'required',
        ]);
        if($this->ship_to_different) {
            $this->validateOnly($fields,[
                'shipping_firstname'             =>           'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'shipping_lastname'              =>           'required|string|regex:/^[A-Za-z-أ-ي]+$/u',
                'shipping_email'                 =>           'required|email',
                'shipping_mobile'                =>           'required|numeric|min:10',
                'shipping_country'               =>           'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'shipping_proviency'             =>           'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'shipping_area'                  =>           'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'shipping_state'                 =>           'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'shipping_village'               =>           'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'shipping_address1'              =>           'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'shipping_address2'              =>           'sometimes|nullable|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            ]);
        }
        if($this->paymentmode == Transaction::CARD) {
            $this->validateOnly($fields,[
                'card_no'                       =>                      'required|numeric',
                'exp_month'                     =>                      'numeric|between:1,12',
                'exp_year'                      =>                      'numeric',
                'cvc'                           =>                      'required|numeric',
            ]);
        }
    }

    public function placeOrder() {
        $this->validate([
            'user_firstname'                    =>                     'required',
            'user_lastname'                     =>                     'required',
            'user_email'                        =>                     'required|email',
            'user_mobile'                       =>                     'required|numeric|required|numeric|min:10',
            'user_country'                      =>                     'required',
            'user_proviency'                    =>                     'required',
            'user_area'                         =>                     'required',
            'user_state'                        =>                     'required',
            'user_village'                      =>                     'required',
            'user_address1'                     =>                     'required',
            'paymentmode'                       =>                     'required',
        ]);
        if($this->paymentmode == Transaction::CARD) {
            $this->validate([
                'card_no'                       =>                      'required|numeric',
                'exp_month'                     =>                      'numeric|between:1,12',
                'exp_year'                      =>                      'numeric',
                'cvc'                           =>                      'required|numeric',
            ]);
        }
        $order =  new Order();
        $order->referance_id = 'ORD-' . Str::random(8);
        $order->user_id = Auth::guard('vendor')->user()->id;
        $order->subtotal = session()->get('checkout')['subtotal'];
        $order->discount = session()->get('checkout')['discount'];
        $order->tax = session()->get('checkout')['tax'];
        $order->total = session()->get('checkout')['total'];
        $order->firstname = Auth::guard('vendor')->user()->firstname;
        $order->lastname = Auth::guard('vendor')->user()->lastname;
        $order->email = Auth::guard('vendor')->user()->email;
        $order->mobile = Auth::guard('vendor')->user()->phone;
        $order->address1 = Auth::guard('vendor')->user()->address1;
        $order->country = Auth::guard('vendor')->user()->country->name;
        $order->province = Auth::guard('vendor')->user()->province->name;
        $order->area = Auth::guard('vendor')->user()->area->name;
        $order->state = Auth::guard('vendor')->user()->state->name;
        $order->village = Auth::guard('vendor')->user()->village->name;
        $order->currency = Order::CURRENCY;
        $order->status = Order::ORDERED;
        $order->is_shipping_different = $this->ship_to_different ? 1:0;
        $order->save();
        foreach(Cart::instance('cart')->content() as $item) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->price = $item->price;
                $orderItem->quantity = $item->qty;
                $orderItem->save();
        }
        if($this->ship_to_different) {
            $this->validate([
                'shipping_firstname'             =>           'required|string|regex:/^[A-Za-z-أ-ي]+$/u',
                'shipping_lastname'              =>           'required|string|regex:/^[A-Za-z-أ-ي]+$/u',
                'shipping_email'                 =>           'required|email',
                'shipping_mobile'                =>           'required|numeric|min:10',
                'shipping_country'               =>           'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'shipping_proviency'             =>           'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'shipping_area'                  =>           'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'shipping_state'                 =>           'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'shipping_village'               =>           'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'shipping_address1'              =>           'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'shipping_address2'              =>           'sometimes|nullable|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            ]);
            $shipping = new Shipping();
            $shipping->order_id = $order->id;
            $shipping->firstname = $this->shipping_firstname;
            $shipping->lastname = $this->shipping_lastname;
            $shipping->email = $this->shipping_email;
            $shipping->mobile = $this->shipping_mobile;
            $shipping->address1 = $this->shipping_address1;
            $shipping->address2 = $this->shipping_address2;
            $shipping->country = $this->shipping_country;
            $shipping->province = $this->shipping_proviency;
            $shipping->area = $this->shipping_area;
            $shipping->state = $this->shipping_state;
            $shipping->village = $this->shipping_village;
            $shipping->save();
        }
        Notification::send(Auth::guard('vendor')->user(), new \App\Notifications\NewOrder(Auth::guard('vendor')->user()));


        if($this->paymentmode == Transaction::COD) {
            $this->makeTransaction($order->id, Transaction::PENDING);
            $this->resetCard();
        }
        elseif($this->paymentmode == Transaction::CARD) {
            try {
                $paytabs= paypage::sendPaymentCode('all')
                ->sendTransaction('Auth')
                ->sendCart($this->card_no,$this->cvc,'CARD Description')
                ->sendCustomerDetails(
                    $this->user_firstname . ' _ ' . $this->user_lastname,
                    $this->user_email,
                    $this->user_mobile,
                    $this->user_address1,
                    $this->user_proviency . ' _ ' .$this->user_area,
                    $this->user_state. ' _ ' .$this->user_village,
                    $this->user_country,
                    null,
                    null)
                ->sendShippingDetails(
                    $this->user_firstname . ' ' . $this->user_lastname,
                    $this->user_email,
                    $this->user_mobile,
                    $this->user_address1. ' ' .$this->user_address2,
                    $this->user_proviency . ' _ ' .$this->user_area,
                    $this->user_state. ' _ ' .$this->user_village,
                    $this->user_country,
                    null, // for ZipCode
                    null, // for IP
                );
                //if($paytabs == 'succeeded') {
                    $this->makeTransaction($order->id,'approved');
                    $this->resetCard();
                /*} else {
                    session()->flash('paytabs_error','Error in Transaction!');
                    $this->thankyou = 0;
                }*/
                //dd ($paytabs);
            } catch(\Exception $ex){
                session()->flash('paytabs_error',$ex->getMessage());
                $this->thankyou = 0;
            }
        }
    }
    public function makeTransaction($order_id, $status) {
        $transaction = new Transaction();
        $transaction->user_id = Auth::guard('vendor')->user()->id;
        $transaction->order_id = $order_id;
        $transaction->mode = $this->paymentmode;
        $transaction->status = $status;
        $transaction->save();
    }
    public function resetCard() {
        $this->thankyou = Transaction::THANK_YOU;
        Cart::instance('cart')->destroy();
        session()->forget('checkout');
        return redirect()->route('thankyou');
    }
    public function verifyForCheckout() {
        if(!Auth::check()) {
            return redirect()->route('user.login');
        } elseif ($this->thankyou) {
            return redirect()->route('thankyou');
        } elseif (!session()->get('checkout')) {
            return redirect()->route('shop');
        }
    }
    public function render() {
        //$this->verifyForCheckout();
        return view('livewire.front.checkout')->layout('front.layouts.master2');
    }
}
