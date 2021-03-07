<?php

namespace App\Repositories;

use App\Models\Shop;

class DeleteImageOfShopRepository
{
    /**
     * invoke
     *
     * @return void
     */
    public function invoke(Shop $shop)
    {
        $shop->images()->delete();
    }
}
