<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->firstName . " " . $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'activated' => true
    ];
});

$factory->state(App\Models\User::class, 'admin', function () {
    return [
        'role_id' => App\Models\Role::findOrFail(1)->id
    ];
});

$factory->state(App\Models\User::class, 'kitchen', function () {
    return [
        'role_id' => App\Models\Role::findOrFail(2)->id
    ];
});

$factory->state(App\Models\User::class, 'server', function (Faker\Generator $faker) {
    return [
        'role_id' => App\Models\Role::findOrFail(3)->id,
        'name' => 'Server ' . $faker->firstName . " " . $faker->lastName
    ];
});