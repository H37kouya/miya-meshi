<?php

namespace App\Repositories;

use App\Enum\Models\ImageModel;
use App\Enum\Models\ShopMenuModel;
use App\Models\ShopMenu;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class GetShopMenusAllRepository
{
    /**
     * invoke
     *
     * @return void
     */
    public function invoke(int $shopId, bool $onlyRelease = true)
    {
        $shopMenus = ShopMenu::with([
                ShopMenuModel::withImage
            ])->when($onlyRelease, function($query) {
                $query->nowPublicPosts(Carbon::now());
            })->whereShopId($shopId)->get()->toArray();

        $mappedShopMenus = [];
        foreach ($shopMenus as $shopMenu) {
            $mappedShopMenus[] = array_merge(
                Arr::except($shopMenu, ShopMenuModel::image),
                [
                    ShopMenuModel::image_link =>
                    Arr::get(
                        Arr::get($shopMenu, ShopMenuModel::image),
                        ImageModel::url
                    )
                ]
            );
        }

        return $mappedShopMenus;
    }
}
