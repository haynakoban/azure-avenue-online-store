<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\OrderFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreOrderRequest;
use App\Http\Requests\V1\UpdateOrderRequest;
use App\Http\Resources\V1\OrderCollection;
use App\Http\Resources\V1\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $filter  = new OrderFilter();
        $filterItems = $filter->transform($request);

        $orders = Order::where($filterItems);

        $includeUser = $request->query('includeUser');

        if ($includeUser) {
            $orders = $orders->with('user');
        }

        return new OrderCollection($orders->paginate()->appends($request->query()));   
    }

    public function show(Order $order)
    {
        $includeUser = request()->query('includeUser');

        if ($includeUser) {
            $order = $order->loadMissing('user');
        }

        return new OrderResource($order);
    }

    public function store(StoreOrderRequest $request)
    {
        return new OrderResource(Order::create($request->all()));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());
    }
}
