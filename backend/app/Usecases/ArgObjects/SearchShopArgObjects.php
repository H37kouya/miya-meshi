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
        $newSearchShopArgObjects->firebase_keyword_ids = is_string(Arr::get($inputs, 'firebase_keyword_ids'))
            ? explode(',', Arr::get($inputs, 'firebase_keyword_ids'))
            : null;
        $newSearchShopArgObjects->firebase_dish_ids = is_string(Arr::get($inputs, 'firebase_dish_ids'))
            ? explode(',', Arr::get($inputs, 'firebase_dish_ids'))
            : null;
        $newSearchShopArgObjects->can_takeout = Arr::get($inputs, 'can_takeout');
        $newSearchShopArgObjects->can_gotoeat = Arr::get($inputs, 'can_gotoeat');
        $newSearchShopArgObjects->period_of_time = is_string(Arr::get($inputs, 'period_of_time'))
            ? explode(',', Arr::get($inputs, 'period_of_time'))
            : null;
        return $newSearchShopArgObjects;
    }
}
