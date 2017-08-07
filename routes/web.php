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

    Route::group(['middleware' => 'role:admin,server,kitchen'], function() {

        Route::get('/orders/create', 'OrderController@create' )
            ->name('orders.create');

        Route::get('/orders', 'OrderController@index' )
            ->name('orders.index');

    });

    Route::group(['middleware' => 'role:admin,server'], function() {

        Route::post('/orders', 'OrderController@store' )
            ->name('orders.store');

        Route::get('/orders/{order}', 'OrderController@show' )
            ->name('orders.show');

    });

    Route::group(['middleware' => 'role:admin,kitchen'], function() {

        Route::get('/orders/{order}/edit' , 'OrderController@edit')
            ->name('orders.edit');

        Route::patch('/order/{order}' , 'OrderController@update')
            ->name('orders.update');

    });

});

Route::get('/some', function () {

    $order = new Order;
    $order->dish_name = "Vodka";
    $order->save();

    $order = new Order;
    $order->dish_name = "Beer";
    $order->save();

});