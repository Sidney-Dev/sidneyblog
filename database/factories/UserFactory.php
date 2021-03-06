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
        'is_active' => $faker->numberBetween(0,1),
        'role_id' => $faker->numberBetween(1,3),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3,5),
        'description' => $faker->paragraphs(rand(2,3), true),
        'category_id' => $faker->numberBetween(1,2),
        'user_id' => $faker->numberBetween(1,10),
        'slug'=> $faker->slug()
    ];
});

$factory->define(App\Role::class, function (Faker $faker) {
    return [
        'name' => 'administrator',
    ];
});

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => 'Lifestyle',
    ];
});

