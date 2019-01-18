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

$factory->define(App\Domain\User::class, function (Faker $faker) {
    $members_ids = \DB::table('members')->select('id')->get();
    $member_id = $faker->unique()->randomElement($members_ids)->id;


    return [
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->name,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'disabled' => false,
        'member_id' => $member_id
    ];
});
