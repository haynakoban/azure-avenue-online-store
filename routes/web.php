<?php

use App\Http\Controllers\API\V1\CartController;
use App\Http\Controllers\API\V1\PaymentController;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\SocialAuthController;
use App\Http\Controllers\API\V1\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(ProductController::class)->group(function () { 
    Route::get('/', 'index'); // show some of the products
    Route::get('/products/{product}', 'show'); // show single product
});

Route::controller(CartController::class)->group(function () { 
    Route::post('/bags', 'store')->name('bags.store'); // add to bag|cart
    Route::delete('/bags/{cart}', 'destroy')->name('bags.destroy'); // remove from bag|cart
});

Route::controller(UserController::class)->group(function () {
    Route::get('/register', 'create')->middleware('guest'); // show register form ( page )
    Route::post('/register', 'store'); // create new user
    Route::get('/login', 'login')->name('login')->middleware('guest'); // show login form ( page )
    Route::post('/login', 'authenticate'); // login the user 
    Route::post('/logout', 'logout')->middleware('auth'); // logout the user
});

Route::controller(SocialAuthController::class)->group(function () {
    Route::get('/auth/{provider}/redirect', 'redirect')->middleware('guest'); // retrieve data from the specified provider (github and google)
    Route::get('/auth/{provider}/callback', 'callback')->middleware('guest'); // create and login the user
});

Route::controller(PaymentController::class)->group(function () {
    Route::get('/checkout', 'checkout')->name('checkout'); // show checkout bags
    Route::post('/checkout-pay', 'pay')->name('payment');
    Route::get('/checkout-success', 'success');
    Route::get('/checkout-cancel', 'cancel');
});