<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enum\Models\ShopMenuModel;
use App\Models\ShopMenu;
use Faker\Generator as Faker;

$factory->define(ShopMenu::class, function (Faker $faker, array $attribute) {
    return [
        ShopMenuModel::shop_id         => $attribute['shop_id'],
        ShopMenuModel::release         => $faker->boolean(70),
        ShopMenuModel::publish_from    => null,
        ShopMenuModel::publish_to      => null,
        ShopMenuModel::priority        => 1,
        ShopMenuModel::name            => 'テストメニュー',
        ShopMenuModel::description     => 'テストメニュー。とても美味しかったです。春におすすめ。',
        ShopMenuModel::intro           => 'テストメニュー。とても美味しかったです。春におすすめ。',
        ShopMenuModel::price           => 1000,
        ShopMenuModel::period_of_time  => 'aaa',
        ShopMenuModel::is_tax_included => $faker->boolean(),
        ShopMenuModel::can_takeout     => $faker->boolean(),
    ];
});
