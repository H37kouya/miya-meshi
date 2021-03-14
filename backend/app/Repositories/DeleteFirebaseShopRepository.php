<?php

namespace App\Repositories;

use App\Models\FirebaseShop;

class DeleteFirebaseShopRepository
{
    /**
     * invoke
     *
     * @return void
     */
    public function invoke(
        int $shopId
    ) {
        FirebaseShop::whereShopId($shopId)->delete();

        return true;
    }
}
