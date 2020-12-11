<?php

namespace App\Repositories;

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

        $fetchShops = Shop::with('shopInformation')
            ->when($onlyRelease, function($query) {
                $query->nowPublicPosts(Carbon::now());
            })->select([
                'id',
                'release',
                'publish_from',
                'publish_to',
                'priority'
            ])
            ->lampager()
            ->forward()
            ->limit($limit)
            ->orderByDesc('priority')
            ->orderByDesc('updated_at') // ORDER BY `updated_at` DESC, `created_at` DESC, `id` DESC
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->seekable()
            ->paginate($cursor)
            ->toArray(JSON_PRETTY_PRINT);

        $recordShops = (new Collection($fetchShops['records']))->map(fn(Shop $_shop) => $_shop->toArray());

        $mapped = [];
        foreach ($recordShops as $shop) {
            $shopInformation = Arr::get($shop, 'shop_information', []);
            $newShop = Arr::except($shop, 'shop_information');
            $newShop['shop_information_id'] = Arr::get($shopInformation, 'id');
            $newShop = array_merge($newShop, Arr::except($shopInformation, ['id', 'shop_id']));
            $mapped[] = $newShop;
        }

        return [
            'records'         => $mapped,
            'has_previous'    => $fetchShops['has_previous'],
            'previous_cursor' => $fetchShops['previous_cursor'],
            'has_next'        => $fetchShops['has_next'],
            'next_cursor'     => $fetchShops['next_cursor'],
        ];
    }
}
