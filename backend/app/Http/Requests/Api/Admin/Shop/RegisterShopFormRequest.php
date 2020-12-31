<?php

namespace App\Http\Requests\Api\Admin\Shop;

use App\Enum\DisplayMode;
use App\Enum\Models\FirebaseShopModel;
use App\Enum\Models\ShopInformationModel;
use App\Enum\Models\ShopModel;
use App\Enum\PriceRange;
use App\Http\Requests\Traits\JsonRequest;
use App\Support\Arr;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterShopFormRequest extends FormRequest
{
    use JsonRequest;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Arr::camel_keys([
            ShopModel::release      => 'required|boolean',
            ShopModel::publish_from => 'string|nullable|max:255',
            ShopModel::publish_to   => 'string|nullable|max:255',
            ShopModel::priority     => 'required|min:0|integer',
            ShopModel::display_mode => [
                'required',
                Rule::in(DisplayMode::NORMAL)
            ],
            ShopModel::image_link                      => 'string|url|nullable',
            ShopModel::sub_image_link                  => 'array|nullable',
            ShopModel::sub_image_link.'.*'             => 'string|url|max:255',
            ShopModel::menu_image_link                 => 'array|nullable',
            ShopModel::menu_image_link.'.*'            => 'string|url|max:255',
            ShopModel::appearance_image_link           => 'array|nullable',
            ShopModel::appearance_image_link.'.*'      => 'string|url|max:255',
            ShopInformationModel::name                 => 'required|string',
            ShopInformationModel::name_kana            => 'string|nullable|max:100',
            ShopInformationModel::prefix_name          => 'string|nullable|max:100',
            ShopInformationModel::description          => 'string|nullable|max:255',
            ShopInformationModel::intro                => 'string|nullable|max:255',
            ShopInformationModel::tel                  => 'string|nullable|max:50',
            ShopInformationModel::postal               => 'string|nullable|max:50',
            ShopInformationModel::address              => 'string|nullable|max:255',
            ShopInformationModel::building_name        => 'string|nullable|max:255',
            ShopInformationModel::location_latitude    => 'numeric|nullable',
            ShopInformationModel::location_longitude   => 'numeric|nullable',
            ShopInformationModel::facebook_link        => 'string|url|nullable|max:255',
            ShopInformationModel::insta_link           => 'string|url|nullable|max:255',
            ShopInformationModel::homepage_link        => 'string|url|nullable|max:255',
            ShopInformationModel::twitter_link         => 'string|url|nullable|max:255',
            ShopInformationModel::line_link            => 'string|url|nullable|max:255',
            ShopInformationModel::youtube_link         => 'string|url|nullable|max:255',
            ShopInformationModel::ubereats_link        => 'string|url|nullable|max:255',
            ShopInformationModel::gotoeat_link         => 'string|url|nullable|max:255',
            ShopInformationModel::price_range          => [
                'string', 'nullable', Rule::in(PriceRange::getAll())
            ],
            ShopInformationModel::business_start_hour1 => 'string|nullable|max:255',
            ShopInformationModel::business_end_hour1   => 'string|nullable|max:255',
            ShopInformationModel::business_lo_hour1    => 'string|nullable|max:255',
            ShopInformationModel::business_start_hour2 => 'string|nullable|max:255',
            ShopInformationModel::business_end_hour2   => 'string|nullable|max:255',
            ShopInformationModel::business_lo_hour2    => 'string|nullable|max:255',
            ShopInformationModel::business_start_hour3 => 'string|nullable|max:255',
            ShopInformationModel::business_end_hour3   => 'string|nullable|max:255',
            ShopInformationModel::business_lo_hour3    => 'string|nullable|max:255',
            ShopInformationModel::parking_lot          => 'string|nullable|max:255',
            ShopInformationModel::seat                 => 'string|nullable|max:255',
            ShopInformationModel::access               => 'string|nullable|max:255',
            ShopInformationModel::regular_holiday      => 'string|nullable|max:255',
            ShopInformationModel::reservervation_max_number => 'integer|nullable',
            ShopInformationModel::credit_card           => 'string|nullable|max:255',
            ShopInformationModel::electronic_money      => 'string|nullable|max:255',
            ShopInformationModel::about_smoking         => 'string|nullable|max:255',
            ShopInformationModel::total_number_of_seats => 'string|nullable|max:255',
            ShopInformationModel::private_room          => 'string|nullable|max:255',
            ShopInformationModel::can_takeout           => 'required|boolean',
            ShopInformationModel::can_gotoeat           => 'required|boolean',
            ShopInformationModel::can_reservation       => 'required|boolean',
            ShopInformationModel::period_of_time        => 'array|nullable',
            ShopInformationModel::insta_number          => 'integer|nullable|min:0',
            ShopInformationModel::insta_shop_link       => 'url|nullable',
            ShopInformationModel::insta_iframe          => 'nullable|max:100000',
            FirebaseShopModel::firebase_shop_id         => 'string|nullable|max:255',
        ]);
    }
}
