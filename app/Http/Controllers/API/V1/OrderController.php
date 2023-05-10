<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\OrderFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrderCollection;
use App\Http\Resources\V1\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $filter  = new OrderFilter();
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return new OrderCollection(Order::paginate());
        } else {
            $orders = Order::where($queryItems)->paginate();

            return new OrderCollection($orders->appends($request->query()));
        }   
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }
}
