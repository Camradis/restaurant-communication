<?php

Route::group(['middleware' => ['auth']], function () {

    Route::get('/notification/readed', function () {
        auth()->user()->unreadNotifications->markAsRead();
    });

});