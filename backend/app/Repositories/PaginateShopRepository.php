<?php

namespace App\Repositories;

use App\Enum\Models\ShopInformationModel;
use App\Enum\Models\ShopModel;
use App\Enum\Vendor\LamporPagination;
use App\Models\Shop;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class PaginateShopRepository
{
    /**
     * invoke
     *
     * @return array
     */
    public function invoke(
        bool $onlyRelease = true,
        int $limit = 10
    ): array {
        $cursor = [];

        $fetchShops = Shop::with(ShopModel::withShopInformation)
            ->when($onlyRelease, function($query) {
                $query->nowPublicPosts(Carbon::now());
            })->select([
                ShopModel::id,
                ShopModel::release,
                ShopModel::publish_from,
                ShopModel::publish_to,
                ShopModel::priority,
            ])
            ->lampager()
            ->forward()
            ->limit($limit)
            ->orderByDesc(ShopModel::priority)
            ->orderByDesc(ShopModel::updated_at) // ORDER BY `updated_at` DESC, `created_at` DESC, `id` DESC
            ->orderByDesc(ShopModel::created_at)
            ->orderByDesc(ShopModel::id)
            ->seekable()
            ->paginate($cursor)
            ->toArray(JSON_PRETTY_PRINT);

        $recordShops = (new Collection($fetchShops[LamporPagination::records]))->map(fn(Shop $_shop) => $_shop->toArray());

        $mapped = [];
        foreach ($recordShops as $shop) {
            $shopInformation = Arr::get($shop, ShopModel::shop_information, []);
            $newShop = Arr::except($shop, ShopModel::shop_information);
            $newShop['shop_information_id'] = Arr::get($shopInformation, ShopInformationModel::id);
            $newShop = array_merge($newShop, Arr::except($shopInformation, [
                ShopInformationModel::id,
                ShopInformationModel::shop_id,
            ]));
            $mapped[] = $newShop;
        }

        return [
            LamporPagination::records         => $mapped,
            LamporPagination::has_previous    => $fetchShops[LamporPagination::has_previous],
            LamporPagination::previous_cursor => $fetchShops[LamporPagination::previous_cursor],
            LamporPagination::has_next        => $fetchShops[LamporPagination::has_next],
            LamporPagination::next_cursor     => $fetchShops[LamporPagination::next_cursor],
        ];
    }
}
