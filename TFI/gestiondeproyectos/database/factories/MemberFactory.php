<?php

use Faker\Generator as Faker;

$factory->define(App\Domain\Member::class, function (Faker $faker) {
    $role_ids = App\Domain\Role::where('id','!=',1)->get(['id']);
    $role_id = $faker->randomElement($role_ids);
    $types = [20,27];

    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'address' => $faker->streetAddress,
        'birthday' => $faker->date(),
        'CUIT' => $faker->randomElement($types).'-'.$faker->unique()->numberBetween(1,99999999).'-'.$faker->numberBetween(1,9),
        'email' => $faker->unique()->companyEmail,
        'role_id' => $role_id->id
    ];
});
