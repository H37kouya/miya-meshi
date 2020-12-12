<?php

namespace App\Repositories;

use App\Enum\Models\ShopInformationModel;
use App\Enum\Models\ShopModel;
use App\Models\Shop;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class GetShopRepository
{
    /**
     * invoke
     *
     * @return array
     */
    public function invoke(
        int $shopId,
        bool $onlyRelease = true
    ): array {
        $foundShop = Shop::with(ShopModel::withShopInformation)
            ->when($onlyRelease, function($query) {
                $query->nowPublicPosts(Carbon::now());
            })->whereId($shopId)->firstOrFail([
                ShopModel::id,
                ShopModel::release,
                ShopModel::publish_from,
                ShopModel::publish_to,
                ShopModel::priority,
            ])->toArray();

        $shopInformation = Arr::get($foundShop, ShopModel::shop_information, []);
        $mappedShop = Arr::except($foundShop, ShopModel::shop_information);
        $mappedShop['shop_information_id'] = Arr::get($shopInformation, ShopInformationModel::id);
        $mappedShop = array_merge($mappedShop, Arr::except($shopInformation, [
            ShopInformationModel::id,
            ShopInformationModel::shop_id
        ]));

        return $mappedShop;
    }
}
