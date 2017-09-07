<?php

$factory->define(App\Models\Role::class, function () {

    return [
        'name'          => 'Default Name',
        'description'   => "Default description"
    ];
});

$factory->state(App\Models\Role::class, 'admin', function () {
    return [
        'name'          => 'Administrator',
        'description'   => "Administrative Role"
    ];
});

$factory->state(App\Models\Role::class, 'kitchen', function () {
    return [
        'name'          => 'Kitchen Manager',
        'description'   => "Kitchen Manager Role"
    ];
});

$factory->state(App\Models\Role::class, 'server', function () {
    return [
        'name'          => 'Server',
        'description'   => "Server Role"
    ];
});

$factory->state(App\Models\Role::class, 'user', function () {
    return [
        'name'          => 'User',
        'description'   => "User Role"
    ];
});