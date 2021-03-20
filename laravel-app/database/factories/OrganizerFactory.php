<?php

use App\Organizer;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Organizer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '123456789',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
