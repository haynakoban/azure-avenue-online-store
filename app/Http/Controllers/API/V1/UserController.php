<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BulkStoreUserRequest;
use App\Http\Requests\V1\StoreUserRequest;
use App\Http\Requests\V1\UpdateUserRequest;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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

    public function store(StoreUserRequest $request)
    {
        return new UserResource(User::create($request->all()));
    }

    public function bulkStore(BulkStoreUserRequest $request)
    {
        $bulk = collect($request->all())->map(function($arr, $key) {
            return Arr::except($arr, ['roleType']);
        });

        $now = Carbon::now();
        $bulk = $bulk->map(function ($record) use ($now) {
            $record['created_at'] = $now;
            $record['updated_at'] = $now;
            return $record;
        });

        User::insert($bulk->toArray());
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
    }
}
