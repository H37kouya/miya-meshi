<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enum\PrefCode;
use App\Enum\PriceRange;
use App\Models\ShopInformation;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Faker\Generator as Faker;

$factory->define(ShopInformation::class, fn (Faker $faker, array $attribute) => [
    'shop_id'       => $attribute['id'],
    'name'          => $faker->name,
    'name_kana'     => $faker->kanaName,
    'prefix_name'   => $faker->boolean() ? '居酒屋' : null,
    'description'   => $faker->words(4, true),
    'intro'         => $faker->sentence(),
    'pref_code'     => PrefCode::TOCHIGI,
    'address'       => '栃木県宇都宮市旭1丁目1-5',
    'building_name' => $faker->boolean() ? '1号館' : null,
    'tel'           => '028-000-0000',
    'postal'        => '320-0818',
    'location_latitude'  => 36.55514162148,
    'location_longitude' => 139.88253160236,

    'facebook_link' => $faker->boolean(30) ? 'https://example.com' : null,
    'homepage_link' => $faker->boolean(30) ? 'https://example.com' : null,
    'insta_link'    => $faker->boolean(30) ? 'https://example.com' : null,
    'line_link'     => $faker->boolean(30) ? 'https://example.com' : null,
    'twitter_link'  => $faker->boolean(30) ? 'https://example.com' : null,
    'ubereats_link' => $faker->boolean(30) ? 'https://example.com' : null,
    'youtube_link'  => $faker->boolean(30) ? 'https://example.com' : null,
    'gotoeat_link'  => $faker->boolean(30) ? 'https://example.com' : null,

    'price_range'   => $faker->boolean() ? PriceRange::UNDER_500 : null,

    'business_start_hour1'      => '10:00',
    'business_end_hour1'        => '15:00',
    'business_lo_hour1'         => '14:00',
    'business_start_hour2'      => '18:00',
    'business_end_hour2'        => '25:00',
    'business_lo_hour2'         => '24:00',
    'business_start_hour3'      => null,
    'business_end_hour3'        => null,
    'business_lo_hour3'         => null,

    'parking_lot'               => null,
    'seat'                      => null,
    'access'                    => null,
    'regular_holiday'           => null,
    'reservervation_max_number' => 10,
    'credit_card'               => null,
    'electronic_money'          => null,
    'about_smoking'             => null,
    'total_number_of_seats'     => null,
    'private_room'              => null,
    'can_takeout'               => true,
    'can_gotoeat'               => false,
    'can_reservation'           => false,
    'period_of_time'            => null,

    'insta_number'              => $attribute['id'] % 5 !== 0 ? $attribute['id'] : null,
    'insta_shop_link'           => $attribute['id'] % 5 !== 0 ? 'https://example.com' : null,
    'insta_iframe'              => null,
]);
