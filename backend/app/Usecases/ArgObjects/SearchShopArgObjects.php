<?php


namespace App\Usecases\ArgObjects;


use App\Support\Arr;

class SearchShopArgObjects
{
    public int $limit;
    public ?array $firebase_keyword_ids;
    public ?array $firebase_dish_ids;
    public ?bool $can_takeout;
    public ?bool $can_gotoeat;
    public ?array $period_of_time;

    public static function of(array $inputs): SearchShopArgObjects
    {
        $newSearchShopArgObjects = new SearchShopArgObjects();
        $newSearchShopArgObjects->limit = Arr::get($inputs, 'limit');
        $newSearchShopArgObjects->firebase_keyword_ids = Arr::get($inputs, 'firebase_keyword_ids');
        $newSearchShopArgObjects->firebase_dish_ids = Arr::get($inputs, 'firebase_dish_ids');
        $newSearchShopArgObjects->can_takeout = Arr::get($inputs, 'can_takeout');
        $newSearchShopArgObjects->can_gotoeat = Arr::get($inputs, 'can_gotoeat');
        $period_of_time = Arr::get($inputs, '$period_of_time');
        $newSearchShopArgObjects->period_of_time = is_array($period_of_time) || is_null($period_of_time) ? $period_of_time : [$period_of_time];
        return $newSearchShopArgObjects;
    }
}
