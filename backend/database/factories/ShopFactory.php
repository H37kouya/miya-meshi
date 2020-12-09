<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enum\DisplayMode;
use App\Models\Shop;
use Faker\Generator as Faker;

$factory->define(Shop::class, fn (Faker $faker) => [
    'release'      => $faker->boolean(70),
    'priority'     => $faker->boolean() ? 5 : ($faker->boolean() ? 3 : 1),
    'publish_from' => $faker->boolean(70) ? $faker->dateTimeBetween('-1 years', '+1 years') : null,
    'publish_to'   => $faker->boolean(70) ? $faker->dateTimeBetween('-1 years', '+1 years') : null,
    'display_mode' => DisplayMode::NORMAL
]);
