<?php

use App\Models\Order;
use App\Events\CreateOrderEvent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/test','test');

Route::get('/', function () {
    $order=Order::first();
    if(is_object($order))
    event(new CreateOrderEvent($order,$order->items));
    return view('welcome');
});
