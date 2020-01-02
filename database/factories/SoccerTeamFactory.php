<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SoccerTeam;
use Faker\Generator as Faker;

$factory->define(SoccerTeam::class, function (Faker $faker) {
    return [
        'name' => $faker->streetName,
    ];
});
