<?php
use App\Models\User;
use App\Models\Order;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/orders', 'OrderController@index' )
        ->name('orders.index')
        ->middleware('role:admin,server,kitchen');

    Route::get('/orders/create', 'OrderController@create' )
        ->name('orders.create')
        ->middleware('role:admin,server');

    Route::post('/orders', 'OrderController@store' )
        ->name('orders.store')
        ->middleware('role:admin,server');

    Route::get('/orders/{order}', 'OrderController@show' )
        ->name('orders.show')
        ->middleware('role:admin,server');

});

Route::get('/some', function () {

    $order = new Order;
    $order->dish_name = "Vodka";
    $order->save();

    $order = new Order;
    $order->dish_name = "Beer";
    $order->save();

});