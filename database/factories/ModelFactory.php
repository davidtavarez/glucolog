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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'is_admin' => 0,
        'is_user' => 1
    ];
});

$factory->define(App\Record::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'fecha' => $faker->date,
        'ayuno' => $faker->boolean(0),
        'comentario' => $faker->sentence,
        'comida' => $faker->sentence,
        'medida' => $faker->numberBetween(10,1000)
    ];
});

$factory->define(App\Peso::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'fecha' => $faker->date,
        'peso' => $faker->numberBetween(70,150)
    ];
});