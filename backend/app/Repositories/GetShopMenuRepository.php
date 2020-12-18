<?php

namespace App\Repositories;

use App\Enum\Models\ImageModel;
use App\Enum\Models\ShopMenuModel;
use App\Models\ShopMenu;
use App\Support\Arr;
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
            })->whereId($shopMenuId)->first()->toArray();

        $imageLink = Arr::get(
            Arr::get(
                $foundShopMenu,
                ShopMenuModel::image
            ),
            ImageModel::url
        );

        $mappedShopMenu = array_merge(
            Arr::except($foundShopMenu, ShopMenuModel::image),
            [ ShopMenuModel::image_link => $imageLink ]
        );

        return $mappedShopMenu;
    }
}
