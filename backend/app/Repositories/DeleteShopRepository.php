<?php

namespace App\Repositories;

use App\Enum\Models\ShopModel;
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
        $shop = Shop::with([
                ShopModel::withImages,
                ShopModel::withShopInformation
            ])->whereId($shopId)->firstOrFail([
                'id'
            ]);
        $shop->images()->delete();
        $shop->shopInformation()->delete();
        $shop->forceDelete();

        return true;
    }
}
