<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShoppingBagMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $shoppingBag = collect();
        $shippingAmount = 1;
        
        if (auth()->check()) {

            $shoppingBag = Cart::where('user_id', auth()->user()->id)->with('product')->get();

        }

        $totalAmount = $shoppingBag->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        view()->share('shoppingBag', $shoppingBag);
        view()->share('totalAmount', $totalAmount);
        view()->share('shippingAmount', $shippingAmount);

        return $next($request);
    }
}
