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

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'board_id' => function () {
            return factory('App\Models\Board')->create()->id;
        },
        'birthday' => $faker->date,
        'sex' => 'Male',
        'diabetes' => 'Type 1',
        'detection_date' => $faker->date,
    ];
});

$factory->define(App\Models\Record::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\Models\User')->create()->id;
        },
        'date' => $faker->date,
        'board_id' => function () {
            return factory('App\Models\Board')->create()->id;
        },
        'comment' => $faker->sentence,
        'condition' => $faker->numberBetween(1, 4),
        'status' => $faker->sentence,
        'measure' => $faker->numberBetween(10, 300),
    ];
});

$factory->define(App\Models\Weight::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\Models\User')->create()->id;
        },
        'date' => $faker->date,
        'weight' => $faker->numberBetween(70, 150),
    ];
});

$factory->define(App\Models\Board::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
    ];
});
