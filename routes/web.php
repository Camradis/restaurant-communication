<?php

require_once 'auth.php';
require_once 'admin.php';
require_once 'orders.php';
require_once 'users.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');