<?php

namespace App\Repositories;

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
            [ 'shop_id' => $shopId ],
            [ 'shop_id' => $shopId, 'firebase_shop_id' => $firebaseShopId ]
        )->toArray();
    }
}
