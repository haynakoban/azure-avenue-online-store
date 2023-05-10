<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\CartFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCartRequest;
use App\Http\Requests\V1\UpdateCartRequest;
use App\Http\Resources\V1\CartCollection;
use App\Http\Resources\V1\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $filter  = new CartFilter();
        $filterItems = $filter->transform($request);

        $carts = Cart::where($filterItems);

        $includeUser = $request->query('includeUser');
        $includeProduct = $request->query('includeProduct');

        if ($includeUser) {
            $carts = $carts->with('user');
        }
        if ($includeProduct) {
            $carts = $carts->with('product');
        }

        return new CartCollection($carts->paginate()->appends($request->query())); 
    }

    public function show(Cart $cart)
    {
        $includeUser = request()->query('includeUser');
        $includeProduct = request()->query('includeProduct');

        if ($includeUser) {
            $cart = $cart->loadMissing('user');
        }
        if ($includeProduct) {
            $cart = $cart->loadMissing('product');
        }

        return new CartResource($cart);
    }

    public function store(StoreCartRequest $request)
    {
        return new CartResource(Cart::create($request->all()));
    }

    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $cart->update($request->all());
    }
}
