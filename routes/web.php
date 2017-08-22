<?php
use Illuminate\Support\Facades\Redis;
use App\Events\TestEvent;

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

    Route::get('/notification/readed', function () {
        Auth::user()->unreadNotifications->markAsRead();
    });

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

    Route::group(['middleware' => 'role:admin,kitchen'], function() {

        Route::get('/admin/users' , 'Admin\UserController@index')
            ->name('admin.index');

        Route::post('/admin/users' , 'Admin\UserController@store')
            ->name('admin.search');

    });
});



Route::get('/test', function () {

    event(
        new TestEvent()
    );

//    return view('test');
});


