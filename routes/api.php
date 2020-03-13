<?php

use App\Services\OrderService;
use App\Currency;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('/calculate_paid_in_usd/', function() {
    // calculate total amount of usd needed to pay for feign currency
    $currency = Currency::findOrFail(request()->currency_id);


    $aa = (new OrderService())->setCurrency($currency)->prepareOrder(request()->amount);
    return $aa;
});
