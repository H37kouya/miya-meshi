<?php

namespace App\Usecases\Client;

use App\Enum\Models\ImageModel;
use App\Enum\Models\ShopModel;
use App\Models\Shop;
use App\Usecases\ArgObjects\SearchShopArgObjects;
use Illuminate\Support\Carbon;

class SearchShopsUsecase
{
    /**
     * invoke
     *
     * @param SearchShopArgObjects $search
     * @return array
     */
    public function invoke(SearchShopArgObjects $search): array
    {
        $cursor = [];

        $shops = Shop::with([
            'shopInformation',
            'firebaseDish',
            'firebaseKeyword',
            'images' => function ($query) {
                $query->where(ImageModel::imageable_name, ShopModel::image_link);
            },
        ])
            ->nowPublicPosts(Carbon::now())
            ->when($search->can_takeout !== null, function($query) use ($search) {
                $query->whereHas('shopInformation', function ($query) use ($search) {
                    $query->whereCanTakeout($search->can_takeout);
                });
            })
            ->when($search->can_gotoeat !== null, function($query) use ($search) {
                $query->whereHas('shopInformation', function ($query) use ($search) {
                    $query->whereCanGotoeat($search->can_gotoeat);
                });
            })
            ->when($search->period_of_time !== null, function($query) use ($search) {
                $query->whereHas('shopInformation', function ($query) use ($search) {
                    $query->whereAllPeriodOfTime($search->period_of_time);
                });
            })
            ->when($search->firebase_dish_ids !== null && count($search->firebase_dish_ids) > 0, function($query) use ($search) {
                $query->whereHas('firebaseDish', function ($query) use ($search) {
                    $query->whereIn('id', $search->firebase_dish_ids);
                });
            })
            ->when($search->firebase_keyword_ids !== null && count($search->firebase_keyword_ids) > 0, function($query) use ($search) {
                $query->whereHas('firebaseKeyword', function ($query) use ($search) {
                    $query->whereIn('id', $search->firebase_keyword_ids);
                });
            })
            ->lampager()
            ->forward()
            ->limit($search->limit)
            ->orderByDesc(ShopModel::priority)
            ->orderByDesc('updated_at') // ORDER BY `updated_at` DESC, `created_at` DESC, `id` DESC
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->seekable()
            ->paginate($cursor)
            ->toArray(JSON_PRETTY_PRINT);

        return $shops;
    }
}
