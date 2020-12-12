<?php

namespace App\Repositories;

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
        $foundShop = Shop::with('shopInformation')
            ->when($onlyRelease, function($query) {
                $query->nowPublicPosts(Carbon::now());
            })->whereId($shopId)->firstOrFail([
                'id',
                'release',
                'publish_from',
                'publish_to',
                'priority'
            ])->toArray();

        $shopInformation = Arr::get($foundShop, 'shop_information', []);
        $mappedShop = Arr::except($foundShop, 'shop_information');
        $mappedShop['shop_information_id'] = Arr::get($shopInformation, 'id');
        $mappedShop = array_merge($mappedShop, Arr::except($shopInformation, ['id', 'shop_id']));

        return $mappedShop;
    }
}
