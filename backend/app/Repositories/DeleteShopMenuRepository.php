<?php

namespace App\Repositories;

use App\Models\ShopMenu;

class DeleteShopMenuRepository
{
    /**
     * invoke
     *
     * @return void
     */
    public function invoke(int $shopMenuId)
    {
        $shopMenu = ShopMenu::whereId($shopMenuId)->firstOrFail(['id']);
        $shopMenu->image()->delete();
        $shopMenu->delete();

        return true;
    }
}
