<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enum\ContentMode;
use App\Models\SelectionPost;
use Faker\Generator as Faker;

$factory->define(SelectionPost::class, function (Faker $faker) {
    $contentMode = $faker->boolean(70) ? ContentMode::NORMAL : ContentMode::NO_CONTENT;
    $link = $contentMode === ContentMode::NO_CONTENT ? 'https://github.com' : null;

    return [
        'title'         => $faker->text(50),
        'description'   => $faker->text(50),
        'contents'      => $faker->randomHtml(),
        'content_mode'  => $contentMode,
        'link'          => $link,
        'image'         => $faker->imageUrl(),
        'release'       => $faker->boolean(70),
        'publish_from'  => $faker->boolean(70) ? $faker->dateTimeBetween('-1 years', '+1 years') : null,
        'publish_to'    => $faker->boolean(70) ? $faker->dateTimeBetween('-1 years', '+1 years') : null,
    ];
});
