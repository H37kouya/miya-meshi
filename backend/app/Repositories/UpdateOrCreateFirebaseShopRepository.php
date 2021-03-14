<?php

namespace App\Repositories;

use App\Enum\Models\FirebaseShopModel;
use App\Models\FirebaseShop;

class UpdateOrCreateFirebaseShopRepository
{
    /**
     * invoke
     *
     * @return void
     */
    public function invoke(
        int $shopId,
        string $firebaseShopId
    ) {
        return FirebaseShop::updateOrCreate(
            [ FirebaseShopModel::shop_id => $shopId ],
            [
                FirebaseShopModel::shop_id => $shopId,
                FirebaseShopModel::firebase_shop_id => $firebaseShopId,
            ]
        )->toArray();
    }
}
