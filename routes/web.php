<?php

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

Route::get('/server', function () {
    return 'Server Area';
})->middleware('role:server');

Route::get('/admin', function () {
    return view('layouts.main');
})->middleware('role:admin');

Route::get('/adminserverkitchen', function () {
    return 'Admin Server Kitchen Area';
})->middleware('role:admin,server,kitchen' );

Route::get('/kitchen', function () {
    return 'Kitchen Area';
})->middleware('role:kitchen');