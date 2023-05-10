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
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return new UserCollection(User::paginate());
        } else {
            return new UserCollection(User::where($queryItems)->paginate());
        }   
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }
}
