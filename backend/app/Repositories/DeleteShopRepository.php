<?php

namespace App\Repositories;

use App\Models\Shop;
use App\Models\ShopInformation;

class DeleteShopRepository
{
    /**
     * invoke
     *
     * @return void
     */
    public function invoke(
        int $shopId
    ): bool {
        ShopInformation::whereShopId($shopId)->delete();
        Shop::whereId($shopId)->firstOrFail([
            'id'
        ])->forceDelete();

        return true;
    }
}
