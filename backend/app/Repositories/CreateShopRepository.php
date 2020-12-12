<?php

namespace App\Repositories;

use App\Enum\DisplayMode;
use App\Enum\PrefCode;
use App\Models\Shop;
use App\Models\ShopInformation;
use Illuminate\Support\Arr;

class CreateShopRepository
{
    private GetShopRepository $_getShopRepository;

    public function __construct(GetShopRepository $getShopRepository)
    {
        $this->_getShopRepository = $getShopRepository;
    }

    /**
     * invoke
     *
     * @return void
     */
    public function invoke(
        array $inputs
    ) {
        $inputShop = $this->get_shop_by_inputs($inputs);
        $inputShopInformation = $this->get_shop_information_by_inputs($inputs);

        // Shop
        /** @var Shop */
        $shop = Shop::create($inputShop);

        // ShopInformation
        Arr::set($inputShopInformation, 'shop_id', $shop->id);
        ShopInformation::create($inputShopInformation);

        return $this->_getShopRepository->invoke($shop->id, false);
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
            'release'      => Arr::get($inputs, 'release', true),
            'publish_from' => Arr::get($inputs, 'publish_from', null),
            'publish_to'   => Arr::get($inputs, 'publish_to', null),
            'priority'     => Arr::get($inputs, 'priority', 1),
            'display_mode' => Arr::get($inputs, 'display_mode', DisplayMode::NORMAL),
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
            'name'                      => Arr::get($inputs, 'name', null),
            'name_kana'                 => Arr::get($inputs, 'name_kana', null),
            'prefix_name'               => Arr::get($inputs, 'prefix_name', null),
            'description'               => Arr::get($inputs, 'description', null),
            'intro'                     => Arr::get($inputs, 'intro', null),
            'pref_code'                 => Arr::get($inputs, 'pref_code', PrefCode::TOCHIGI),
            'address'                   => Arr::get($inputs, 'address', null),
            'building_name'             => Arr::get($inputs, 'building_name', null),
            'tel'                       => Arr::get($inputs, 'tel', null),
            'postal'                    => Arr::get($inputs, 'postal', null),
            'location_latitude'         => Arr::get($inputs, 'location_latitude', null),
            'location_longitude'        => Arr::get($inputs, 'location_longitude', null),
            'facebook_link'             => Arr::get($inputs, 'facebook_link', null),
            'homepage_link'             => Arr::get($inputs, 'homepage_link', null),
            'insta_link'                => Arr::get($inputs, 'insta_link', null),
            'line_link'                 => Arr::get($inputs, 'line_link', null),
            'twitter_link'              => Arr::get($inputs, 'twitter_link', null),
            'ubereats_link'             => Arr::get($inputs, 'ubereats_link', null),
            'youtube_link'              => Arr::get($inputs, 'youtube_link', null),
            'gotoeat_link'              => Arr::get($inputs, 'gotoeat_link', null),
            'price_range'               => Arr::get($inputs, 'price_range', null),
            'business_start_hour1'      => Arr::get($inputs, 'business_start_hour1', null),
            'business_end_hour1'        => Arr::get($inputs, 'business_end_hour1', null),
            'business_lo_hour1'         => Arr::get($inputs, 'business_lo_hour1', null),
            'business_start_hour2'      => Arr::get($inputs, 'business_start_hour2', null),
            'business_end_hour2'        => Arr::get($inputs, 'business_end_hour2', null),
            'business_lo_hour2'         => Arr::get($inputs, 'business_lo_hour2', null),
            'business_start_hour3'      => Arr::get($inputs, 'business_start_hour3', null),
            'business_end_hour3'        => Arr::get($inputs, 'business_end_hour3', null),
            'business_lo_hour3'         => Arr::get($inputs, 'business_lo_hour3', null),
            'parking_lot'               => Arr::get($inputs, 'parking_lot', null),
            'seat'                      => Arr::get($inputs, 'seat', null),
            'access'                    => Arr::get($inputs, 'access', null),
            'regular_holiday'           => Arr::get($inputs, 'regular_holiday', null),
            'reservervation_max_number' => Arr::get($inputs, 'reservervation_max_number', null),
            'credit_card'               => Arr::get($inputs, 'credit_card', null),
            'electronic_money'          => Arr::get($inputs, 'electronic_money', null),
            'about_smoking'             => Arr::get($inputs, 'about_smoking', null),
            'total_number_of_seats'     => Arr::get($inputs, 'total_number_of_seats', null),
            'private_room'              => Arr::get($inputs, 'private_room', null),
            'can_takeout'               => Arr::get($inputs, 'can_takeout', true),
            'can_gotoeat'               => Arr::get($inputs, 'can_gotoeat', false),
            'can_reservation'           => Arr::get($inputs, 'can_reservation', true),
            'period_of_time'            => Arr::get($inputs, 'period_of_time', null),
            'insta_number'              => Arr::get($inputs, 'insta_number', null),
            'insta_shop_link'           => Arr::get($inputs, 'insta_shop_link', null),
            'insta_iframe'              => Arr::get($inputs, 'insta_iframe', null),
        ];
    }
}
