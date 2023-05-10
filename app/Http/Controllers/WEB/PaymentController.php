<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Omnipay\Omnipay;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct() {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request)
    {
        
        if ($request->payment === 'cod') {

            $uuid = Str::uuid();
            $uuid = 'CODID-' . strtoupper(str_replace('-', '', $uuid));

            $payment = new Payment();
            $payment->payment_id = $uuid;
            $payment->payer_id = auth()->user()->id;
            $payment->payer_email = auth()->user()->email;
            $payment->amount = $request->amount;
            $payment->currency = env('PAYPAL_CURRENCY');
            $payment->payment_method = 'Cash on delivery';
            $payment->payment_status = 'approved';
            $payment->save();

            // remove items in cart
            foreach ($request->bag as $bag) {
                $cart = json_decode($bag);
                Cart::find($cart->id)->delete();
                
                foreach ($request->product as $p) {
                    $product = json_decode($p);

                    if ($cart->product_id == $product->id) {
                        $updateProduct = Product::where('id', $product->id)->first();
                        $updateProduct->quantity -= $cart->quantity;
                        $updateProduct->save();
                    }
                }
            }

            return redirect()->route('checkout');

        } else {

            try {
                
                $response = $this->gateway->purchase(array(
                    'amount' => $request->amount,
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('checkout-success'),
                    'cancelUrl' => url('checkout-cancel')
                ))->send();

                if ($response->isRedirect()) {

                    // Store the bag and product data in session variables
                    session()->put('bag', $request->bag);
                    session()->put('product', $request->product);

                    $response->redirect();

                } else {

                    return $response->getMessage();

                }

            } catch (\Throwable $th) {
                
                return $th->getMessage();

            }

        }
    }

    public function success(Request $request)
    {
        
        if ($request->input('paymentId') && $request->input('PayerID')) {
            
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $response = $transaction->send();

            if ($response->isSuccessful()) {

                $arr = $response->getData();

                $payment = new Payment();
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_method = 'PayPal';
                $payment->payment_status = $arr['state'];
                $payment->save();

                // Retrieve the bag and product data from session variables
                $bags = session()->get('bag');
                $products = session()->get('product');

                // remove items in cart
                foreach ($bags as $bag) {
                    $cart = json_decode($bag);
                    Cart::find($cart->id)->delete();
                    
                    foreach ($products as $p) {
                        $product = json_decode($p);

                        if ($cart->product_id == $product->id) {
                            $updateProduct = Product::where('id', $product->id)->first();
                            $updateProduct->quantity -= $cart->quantity;
                            $updateProduct->save();
                        }
                    }
                }

                session()->forget('bag');
                session()->forget('product');

                return redirect()->route('checkout');

            } else {

                return $response->getMessage();

            }
        } else {

            return 'Payment declined!';

        }
    }

    public function cancel() 
    {
        return redirect()->route('checkout');
    }

    public function checkout()
    {
        return view('shop.checkout.index');
    }
}
