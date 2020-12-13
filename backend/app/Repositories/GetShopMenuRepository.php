<?php

namespace App\Repositories;

use App\Enum\Models\ImageModel;
use App\Enum\Models\ShopMenuModel;
use App\Models\ShopMenu;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class GetShopMenuRepository
{
    /**
     * invoke
     *
     * @return void
     */
    public function invoke(
        int $shopMenuId,
        bool $onlyRelease = true
    ): array {
        $foundShopMenu = ShopMenu::with([
                ShopMenuModel::withImage,
            ])->when($onlyRelease, function($query) {
                $query->nowPublicPosts(Carbon::now());
            })->whereShopId($shopMenuId)->first()->toArray();

        $imageLink = Arr::get(
                $foundShopMenu,
                ShopMenuModel::image
            );

        $mappedShopMenu = array_merge(
            Arr::except($foundShopMenu, ShopMenuModel::image),
            [ ShopMenuModel::imageLink => $imageLink ]
        );

        return $mappedShopMenu;
    }
}
