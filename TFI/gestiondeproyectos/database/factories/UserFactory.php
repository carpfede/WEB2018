<?php

use Faker\Generator as Faker;

$factory->define(App\Domain\User::class, function (Faker $faker) {
    $members_ids = App\Domain\Member::where('id','!=',1)->get(['id']);
    $member_id = $faker->unique()->randomElement($members_ids)->id;

    return [
        'username' => $faker->name,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'disabled' => false,
        'member_id' => $member_id
    ];
});
