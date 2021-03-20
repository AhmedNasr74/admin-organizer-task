<?php

use App\Event;
use App\Organizer;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Event::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'status' => $faker->boolean,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'organizer_id' => Organizer::query()->inRandomOrder()->first()->id,
    ];
});
