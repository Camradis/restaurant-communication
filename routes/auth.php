<?php

Auth::routes();
Route::get('/register/verify/{token}', 'Auth\LoginController@verify');