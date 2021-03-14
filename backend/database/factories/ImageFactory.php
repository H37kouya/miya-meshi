<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enum\Models\ImageModel;
use App\Enum\Models\ShopModel;
use App\Models\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        ImageModel::url => "https://example.com",
        ImageModel::imageable_name => $faker->boolean() ? ShopModel::menu_image_link : ShopModel::image_link,
    ];
});
