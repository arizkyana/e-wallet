<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Wallet::class, function (Faker $faker) {
    return [
        'id_user' => 1,
        'balance' => 100000,
        'created_at' => now()
    ];
});
