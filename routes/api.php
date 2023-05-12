<?php

use App\Http\Controllers\API\V1\CartController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\OrderController;
use App\Http\Controllers\API\V1\PaymentController;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\API\V1'], function () {
    Route::apiResource('carts', CartController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('payments', PaymentController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('users', UserController::class);

    Route::post('carts/bulk', [CartController::class, 'bulkStore']);
    Route::post('categories/bulk', [CategoryController::class, 'bulkStore']);
    Route::post('orders/bulk', [OrderController::class, 'bulkStore']);
    Route::post('payments/bulk', [PaymentController::class, 'bulkStore']);
    Route::post('products/bulk', [ProductController::class, 'bulkStore']);
    Route::post('users/bulk', [UserController::class, 'bulkStore']);
});