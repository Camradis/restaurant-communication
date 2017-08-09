<?php
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
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

        Route::get('/orders/completed', 'Order\CompletedOrderController@index' )
            ->name('orders.completed.index');
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

        Route::patch('/order/{order}/completed' , 'Order\CompletedOrderController@update')
            ->name('orders.completed.update');

    });

});

Route::get('/notification/readed', function () {
    Auth::user()->unreadNotifications->markAsRead();
});


Route::get('/some', function () {
    foreach (Auth::user()->unreadNotifications as $notification){
        if($notification->type == "App\\Notifications\\AddOrderToKitchen"){
            echo true;
        }else echo false;
    }
});
