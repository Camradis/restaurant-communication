<?php

Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => 'role:admin,server,kitchen'], function() {

        Route::get('/orders', 'OrderController@index' )
            ->name('orders.index');

        Route::get('/orders/completed', 'Order\CompletedOrderController@index' )
            ->name('orders.completed.index');
    });

    Route::group(['middleware' => 'role:admin,server'], function() {

        Route::resource('orders', 'OrderController', ['only' => [
            'create', 'store', 'show'
        ]]);

    });

    Route::group(['middleware' => 'role:admin,kitchen'], function() {

        Route::resource('orders', 'OrderController', ['only' => [
            'edit', 'update'
        ]]);

        Route::patch('/order/{order}/completed' , 'Order\CompletedOrderController@update')
            ->name('orders.completed.update');

    });

});
