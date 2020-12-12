<?php

namespace App\Models;

use App\Enum\Models\ShopInformationModel;
use Illuminate\Database\Eloquent\Model;

class ShopInformation extends Model
{
    protected $fillable = [
        ShopInformationModel::shop_id,
        ShopInformationModel::name,
        ShopInformationModel::name_kana,
        ShopInformationModel::prefix_name,
        ShopInformationModel::description,
        ShopInformationModel::intro,
        ShopInformationModel::pref_code,
        ShopInformationModel::address,
        ShopInformationModel::building_name,
        ShopInformationModel::tel,
        ShopInformationModel::postal,
        ShopInformationModel::location_latitude,
        ShopInformationModel::location_longitude,
        ShopInformationModel::facebook_link,
        ShopInformationModel::homepage_link,
        ShopInformationModel::insta_link,
        ShopInformationModel::line_link,
        ShopInformationModel::twitter_link,
        ShopInformationModel::ubereats_link,
        ShopInformationModel::youtube_link,
        ShopInformationModel::gotoeat_link,
        ShopInformationModel::price_range,
        ShopInformationModel::business_start_hour1,
        ShopInformationModel::business_end_hour1,
        ShopInformationModel::business_lo_hour1,
        ShopInformationModel::business_start_hour2,
        ShopInformationModel::business_end_hour2,
        ShopInformationModel::business_lo_hour2,
        ShopInformationModel::business_start_hour3,
        ShopInformationModel::business_end_hour3,
        ShopInformationModel::business_lo_hour3,
        ShopInformationModel::parking_lot,
        ShopInformationModel::seat,
        ShopInformationModel::access,
        ShopInformationModel::regular_holiday,
        ShopInformationModel::reservervation_max_number,
        ShopInformationModel::credit_card,
        ShopInformationModel::electronic_money,
        ShopInformationModel::about_smoking,
        ShopInformationModel::total_number_of_seats,
        ShopInformationModel::private_room,
        ShopInformationModel::can_takeout,
        ShopInformationModel::can_gotoeat,
        ShopInformationModel::can_reservation,
        ShopInformationModel::period_of_time,
        ShopInformationModel::insta_number,
        ShopInformationModel::insta_shop_link,
        ShopInformationModel::insta_iframe,
    ];

    protected $casts = [
        ShopInformationModel::can_takeout     => 'boolean',
        ShopInformationModel::can_gotoeat     => 'boolean',
        ShopInformationModel::can_reservation => 'boolean',
    ];
}
