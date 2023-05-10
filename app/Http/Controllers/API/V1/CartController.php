<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\CartFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CartCollection;
use App\Http\Resources\V1\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $filter  = new CartFilter();
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return new CartCollection(Cart::paginate());
        } else {
            $carts = Cart::where($queryItems)->paginate();

            return new CartCollection($carts->appends($request->query()));
        }   
    }

    public function show(Cart $cart)
    {
        return new CartResource($cart);
    }
}
