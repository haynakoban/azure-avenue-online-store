<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $filter  = new UserFilter();
        $filterItems = $filter->transform($request);

        $users = User::where($filterItems);

        $includeCarts = $request->query('includeCarts');
        $includeOrders = $request->query('includeOrders');
        $includePayments = $request->query('includePayments');
        $includeProducts = $request->query('includeProducts');

        if ($includeCarts) {
            $users = $users->with('carts');
        }
        if ($includeOrders) {
            $users = $users->with('orders');
        }
        if ($includePayments) {
            $users = $users->with('payments');
        }
        if ($includeProducts) {
            $users = $users->with('products');
        }

        return new UserCollection($users->paginate()->appends($request->query()));  
    }

    public function show(User $user)
    {
        $includeCarts = request()->query('includeCarts');
        $includeOrders = request()->query('includeOrders');
        $includePayments = request()->query('includePayments');
        $includeProducts = request()->query('includeProducts');

        if ($includeCarts) {
            $user = $user->loadMissing('carts');
        }
        if ($includeOrders) {
            $user = $user->loadMissing('orders');
        }
        if ($includePayments) {
            $user = $user->loadMissing('payments');
        }
        if ($includeProducts) {
            $user = $user->loadMissing('products');
        }
        
        return new UserResource($user);
    }
}
