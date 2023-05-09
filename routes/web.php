<?php

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

Route::get('/', function () {
    return view('shop.products.index');
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