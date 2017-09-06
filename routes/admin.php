<?php

Route::group(['middleware' => 'role:admin'], function() {

    Route::get('/admin/users' , 'Admin\UserController@index')
        ->name('admin.index');

    Route::post('/admin/users' , 'Admin\UserController@search')
        ->name('admin.search');

});