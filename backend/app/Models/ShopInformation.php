<?php

namespace App\Models;

use App\Enum\Models\ShopInformationModel;
use App\Enum\PeriodOfTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

/**
 * App\Models\ShopInformation
 *
 * @property int $id
 * @property int $shop_id
 * @property string $name 店舗名
 * @property string|null $name_kana 店舗名かな
 * @property string|null $prefix_name 店舗肩書き
 * @property string|null $description 一言紹介
 * @property string|null $intro 長文紹介
 * @property int|null $pref_code 都道府県コード
 * @property string|null $address 住所
 * @property string|null $building_name 建物名
 * @property string|null $tel 電話番号
 * @property string|null $postal 郵便番号
 * @property float|null $location_latitude 位置情報
 * @property float|null $location_longitude 位置情報
 * @property string|null $facebook_link Facebook URL
 * @property string|null $homepage_link Homepage URL
 * @property string|null $insta_link Instagram URL
 * @property string|null $line_link Line URL
 * @property string|null $twitter_link Twitter URL
 * @property string|null $ubereats_link Ubereats URL
 * @property string|null $youtube_link Youtube URL
 * @property string|null $gotoeat_link Go To Eat URL
 * @property string|null $price_range 価格帯
 * @property string|null $business_start_hour1 営業開始時間1
 * @property string|null $business_end_hour1 営業終了時間1
 * @property string|null $business_lo_hour1 ラストオーダー1
 * @property string|null $business_start_hour2 営業開始時間2
 * @property string|null $business_end_hour2 営業終了時間2
 * @property string|null $business_lo_hour2 ラストオーダー2
 * @property string|null $business_start_hour3 営業開始時間3
 * @property string|null $business_end_hour3 営業終了時間3
 * @property string|null $business_lo_hour3 ラストオーダー3
 * @property string|null $parking_lot 駐車場
 * @property string|null $seat 座席
 * @property string|null $access 交通アクセス
 * @property string|null $regular_holiday 定休日
 * @property int|null $reservervation_max_number 予約最大人数
 * @property string|null $credit_card クレジットカード
 * @property string|null $electronic_money 電子マネー
 * @property string|null $about_smoking 禁煙・喫煙
 * @property string|null $total_number_of_seats 総席数
 * @property string|null $private_room 個室
 * @property bool $can_takeout テイクアウト可能
 * @property bool $can_gotoeat Go To Eat実施店舗かどうか
 * @property bool $can_reservation 予約可能かどうか
 * @property string|null $period_of_time 時間帯
 * @property int|null $insta_number インスタ番号
 * @property string|null $insta_shop_link インスタリンク
 * @property string|null $insta_iframe インスタ Iframe
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereAboutSmoking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereBuildingName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereBusinessEndHour1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereBusinessEndHour2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereBusinessEndHour3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereBusinessLoHour1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereBusinessLoHour2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereBusinessLoHour3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereBusinessStartHour1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereBusinessStartHour2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereBusinessStartHour3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereCanGotoeat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereCanReservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereCanTakeout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereCreditCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereElectronicMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereFacebookLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereGotoeatLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereHomepageLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereInstaIframe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereInstaLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereInstaNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereInstaShopLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereLineLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereLocationLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereLocationLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereNameKana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereParkingLot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation wherePeriodOfTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation wherePostal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation wherePrefCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation wherePrefixName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation wherePriceRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation wherePrivateRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereRegularHoliday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereReservervationMaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereSeat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereTotalNumberOfSeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereTwitterLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereUbereatsLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShopInformation whereYoutubeLink($value)
 * @mixin \Eloquent
 */
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

    public function firebaseKeywords(): MorphMany
    {
        return $this->morphMany(FirebaseKeywords::class, 'keywordable');
    }

    public function firebaseDishes(): MorphMany
    {
        return $this->morphMany(firebaseDishes::class, 'dishable');
    }

    public function scopeWhereAllPeriodOfTime($query, array $period_of_time)
    {
        $searchPeriodOfTimes = [];

        if (in_array(PeriodOfTime::ALL_TIME, $period_of_time, true)) {
            $searchPeriodOfTimes[] = PeriodOfTime::ALL_TIME;
        }

        if (in_array(
            [PeriodOfTime::MORNING, PeriodOfTime::MORNING_AND_LUNCH, PeriodOfTime::MORNING_AND_LUNCH_AND_NIGHT],
            $period_of_time,
            true)
        ) {
            $searchPeriodOfTimes[] =  PeriodOfTime::MORNING;
            $searchPeriodOfTimes[] =  PeriodOfTime::MORNING_AND_LUNCH;
            $searchPeriodOfTimes[] =  PeriodOfTime::MORNING_AND_LUNCH_AND_NIGHT;
        }

        if (in_array(
            [PeriodOfTime::LUNCH, PeriodOfTime::MORNING_AND_LUNCH, PeriodOfTime::LUNCH_AND_NIGHT,  PeriodOfTime::MORNING_AND_LUNCH_AND_NIGHT],
            $period_of_time,
            true)
        ) {
            $searchPeriodOfTimes[] =  PeriodOfTime::LUNCH;
            $searchPeriodOfTimes[] =  PeriodOfTime::MORNING_AND_LUNCH;
            $searchPeriodOfTimes[] =  PeriodOfTime::LUNCH_AND_NIGHT;
            $searchPeriodOfTimes[] =  PeriodOfTime::MORNING_AND_LUNCH_AND_NIGHT;
        }

        if (in_array(
            [PeriodOfTime::NIGHT, PeriodOfTime::LUNCH_AND_NIGHT, PeriodOfTime::MORNING_AND_LUNCH_AND_NIGHT],
            $period_of_time,
            true)
        ) {
            $searchPeriodOfTimes[] =  PeriodOfTime::NIGHT;
            $searchPeriodOfTimes[] =  PeriodOfTime::LUNCH_AND_NIGHT;
            $searchPeriodOfTimes[] =  PeriodOfTime::MORNING_AND_LUNCH_AND_NIGHT;
        }

        $newSearchPeriodOfTimes = (new Collection($searchPeriodOfTimes))->unique()->values()->toArray();
        $query->when(count($newSearchPeriodOfTimes) > 0, function ($query) use ($newSearchPeriodOfTimes) {{
            $query->whereIn('period_of_time', $newSearchPeriodOfTimes);
        }});
    }
}
