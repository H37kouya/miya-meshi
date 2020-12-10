<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class ShopInformation extends Model
{
    //use SpatialTrait;

    protected $fillable = [
        'shop_id',
        'name',
        'name_kana',
        'prefix_name',
        'description',
        'intro',
        'pref_code',
        'address',
        'building_name',
        'tel',
        'postal',
        // 'location',
        'facebook_link',
        'homepage_link',
        'insta_link',
        'line_link',
        'twitter_link',
        'ubereats_link',
        'youtube_link',
        'gotoeat_link',
        'price_range',
        'business_start_hour1',
        'business_end_hour1',
        'business_lo_hour1',
        'business_start_hour2',
        'business_end_hour2',
        'business_lo_hour2',
        'business_start_hour3',
        'business_end_hour3',
        'business_lo_hour3',
        'parking_lot',
        'seat',
        'access',
        'regular_holiday',
        'reservervation_max_number',
        'credit_card',
        'electronic_money',
        'about_smoking',
        'total_number_of_seats',
        'private_room',
        'can_takeout',
        'can_gotoeat',
        'can_reservation',
        'period_of_time',
        'insta_number',
        'insta_shop_link',
        'insta_iframe',
    ];

    // protected $spatialFields = ['location'];
}
