<?php

namespace App\Repositories;

use App\Enum\DisplayMode;
use App\Enum\Models\ShopInformationModel;
use App\Enum\Models\ShopModel;
use App\Enum\PrefCode;
use App\Models\Shop;
use Illuminate\Support\Arr;

class UpdateShopRepository
{
    private GetShopRepository $_getShopRepository;

    public function __construct(GetShopRepository $getShopRepository)
    {
        $this->_getShopRepository = $getShopRepository;
    }

    /**
     * invoke
     *
     * @return array
     */
    public function invoke(
        int $id,
        array $inputs
    ) {
        $inputShop = $this->get_shop_by_inputs($inputs);
        $inputShopInformation = $this->get_shop_information_by_inputs($inputs);

        // Shop
        /** @var Shop */
        $shop = Shop::with(ShopModel::withShopInformation)->findOrFail($id);
        $shop->update($inputShop);

        // ShopInformation
        Arr::set($inputShopInformation, 'shop_id', $shop->id);
        $shop->shopInformation->update($inputShopInformation);

        return;
    }

    /**
     * Shopテーブルに保存する値を取得
     *
     * @param array $inputs
     * @return array
     */
    private function get_shop_by_inputs(
        array $inputs
    ): array {
        return [
            ShopModel::release      => Arr::get($inputs, ShopModel::release, true),
            ShopModel::publish_from => Arr::get($inputs, ShopModel::publish_from, null),
            ShopModel::publish_to   => Arr::get($inputs, ShopModel::publish_to, null),
            ShopModel::priority     => Arr::get($inputs, ShopModel::priority, 1),
            ShopModel::display_mode => Arr::get($inputs, ShopModel::display_mode, DisplayMode::NORMAL),
        ];
    }

    /**
     * ShopInformationテーブルに保存する値を取得
     *
     * @param array $inputs
     * @return array
     */
    private function get_shop_information_by_inputs(
        array $inputs
    ): array {
        return [
            ShopInformationModel::name                      => Arr::get($inputs, ShopInformationModel::name, null),
            ShopInformationModel::name_kana                 => Arr::get($inputs, ShopInformationModel::name_kana, null),
            ShopInformationModel::prefix_name               => Arr::get($inputs, ShopInformationModel::prefix_name, null),
            ShopInformationModel::description               => Arr::get($inputs, ShopInformationModel::description, null),
            ShopInformationModel::intro                     => Arr::get($inputs, ShopInformationModel::intro, null),
            ShopInformationModel::pref_code                 => Arr::get($inputs, ShopInformationModel::pref_code, PrefCode::TOCHIGI),
            ShopInformationModel::address                   => Arr::get($inputs, ShopInformationModel::address, null),
            ShopInformationModel::building_name             => Arr::get($inputs, ShopInformationModel::building_name, null),
            ShopInformationModel::tel                       => Arr::get($inputs, ShopInformationModel::tel, null),
            ShopInformationModel::postal                    => Arr::get($inputs, ShopInformationModel::postal, null),
            ShopInformationModel::location_latitude         => Arr::get($inputs, ShopInformationModel::location_latitude, null),
            ShopInformationModel::location_longitude        => Arr::get($inputs, ShopInformationModel::location_longitude, null),
            ShopInformationModel::facebook_link             => Arr::get($inputs, ShopInformationModel::facebook_link, null),
            ShopInformationModel::homepage_link             => Arr::get($inputs, ShopInformationModel::homepage_link, null),
            ShopInformationModel::insta_link                => Arr::get($inputs, ShopInformationModel::insta_link, null),
            ShopInformationModel::line_link                 => Arr::get($inputs, ShopInformationModel::line_link, null),
            ShopInformationModel::twitter_link              => Arr::get($inputs, ShopInformationModel::twitter_link, null),
            ShopInformationModel::ubereats_link             => Arr::get($inputs, ShopInformationModel::ubereats_link, null),
            ShopInformationModel::youtube_link              => Arr::get($inputs, ShopInformationModel::youtube_link, null),
            ShopInformationModel::gotoeat_link              => Arr::get($inputs, ShopInformationModel::gotoeat_link, null),
            ShopInformationModel::price_range               => Arr::get($inputs, ShopInformationModel::price_range, null),
            ShopInformationModel::business_start_hour1      => Arr::get($inputs, ShopInformationModel::business_start_hour1, null),
            ShopInformationModel::business_end_hour1        => Arr::get($inputs, ShopInformationModel::business_end_hour1, null),
            ShopInformationModel::business_lo_hour1         => Arr::get($inputs, ShopInformationModel::business_lo_hour1, null),
            ShopInformationModel::business_start_hour2      => Arr::get($inputs, ShopInformationModel::business_start_hour2, null),
            ShopInformationModel::business_end_hour2        => Arr::get($inputs, ShopInformationModel::business_end_hour2, null),
            ShopInformationModel::business_lo_hour2         => Arr::get($inputs, ShopInformationModel::business_lo_hour2, null),
            ShopInformationModel::business_start_hour3      => Arr::get($inputs, ShopInformationModel::business_start_hour3, null),
            ShopInformationModel::business_end_hour3        => Arr::get($inputs, ShopInformationModel::business_end_hour3, null),
            ShopInformationModel::business_lo_hour3         => Arr::get($inputs, ShopInformationModel::business_lo_hour3, null),
            ShopInformationModel::parking_lot               => Arr::get($inputs, ShopInformationModel::parking_lot, null),
            ShopInformationModel::seat                      => Arr::get($inputs, ShopInformationModel::seat, null),
            ShopInformationModel::access                    => Arr::get($inputs, ShopInformationModel::access, null),
            ShopInformationModel::regular_holiday           => Arr::get($inputs, ShopInformationModel::regular_holiday, null),
            ShopInformationModel::reservervation_max_number => Arr::get($inputs, ShopInformationModel::reservervation_max_number, null),
            ShopInformationModel::credit_card               => Arr::get($inputs, ShopInformationModel::credit_card, null),
            ShopInformationModel::electronic_money          => Arr::get($inputs, ShopInformationModel::electronic_money, null),
            ShopInformationModel::about_smoking             => Arr::get($inputs, ShopInformationModel::about_smoking, null),
            ShopInformationModel::total_number_of_seats     => Arr::get($inputs, ShopInformationModel::total_number_of_seats, null),
            ShopInformationModel::private_room              => Arr::get($inputs, ShopInformationModel::private_room, null),
            ShopInformationModel::can_takeout               => Arr::get($inputs, ShopInformationModel::can_takeout, true),
            ShopInformationModel::can_gotoeat               => Arr::get($inputs, ShopInformationModel::can_gotoeat, false),
            ShopInformationModel::can_reservation           => Arr::get($inputs, ShopInformationModel::can_reservation, true),
            ShopInformationModel::period_of_time            => Arr::get($inputs, ShopInformationModel::period_of_time, null),
            ShopInformationModel::insta_number              => Arr::get($inputs, ShopInformationModel::insta_number, null),
            ShopInformationModel::insta_shop_link           => Arr::get($inputs, ShopInformationModel::insta_shop_link, null),
            ShopInformationModel::insta_iframe              => Arr::get($inputs, ShopInformationModel::insta_iframe, null),
        ];
    }
}
