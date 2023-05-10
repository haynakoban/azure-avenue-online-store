<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        if (auth()->user()) {

            Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);

            return redirect()->back();

        } else {

            return redirect('/login');

        }
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->back();
    }
}
