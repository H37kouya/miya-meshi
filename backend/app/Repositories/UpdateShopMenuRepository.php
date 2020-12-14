<?php

namespace App\Repositories;

use App\Enum\Models\ImageModel;
use App\Enum\Models\ShopMenuModel;
use App\Models\ShopMenu;
use Illuminate\Support\Arr;

class UpdateShopMenuRepository
{
    /**
     * invoke
     *
     * @return void
     */
    public function invoke(int $shopMenuId, array $inputs)
    {
        $inputShopMenu = $this->get_shop_menu_by_inputs($inputs);
        $imageLink = Arr::get($inputs, ShopMenuModel::image_link);

        $shopMenu = ShopMenu::with([
                ShopMenuModel::withImage,
            ])->whereId($shopMenuId)->firstOrFail();
        $shopMenu->update($inputShopMenu);

        $shopMenu->image()->delete();
        if ($imageLink) {
            $shopMenu->image()->create([
                ImageModel::url            => $imageLink,
                ImageModel::imageable_name => ShopMenuModel::image_link,
            ]);
        }
    }

    /**
     * ShopMenuテーブルに保存する値を取得
     *
     * @param array $inputs
     * @return array
     */
    private function get_shop_menu_by_inputs(
        array $inputs
    ): array {
        return [
            ShopMenuModel::name            => Arr::get($inputs, ShopMenuModel::name, null),
            ShopMenuModel::release         => Arr::get($inputs, ShopMenuModel::release, true),
            ShopMenuModel::publish_from    => Arr::get($inputs, ShopMenuModel::publish_from, null),
            ShopMenuModel::publish_to      => Arr::get($inputs, ShopMenuModel::publish_to, null),
            ShopMenuModel::priority        => Arr::get($inputs, ShopMenuModel::priority, 1),
            ShopMenuModel::description     => Arr::get($inputs, ShopMenuModel::description, null),
            ShopMenuModel::intro           => Arr::get($inputs, ShopMenuModel::intro, null),
            ShopMenuModel::price           => Arr::get($inputs, ShopMenuModel::price, null),
            ShopMenuModel::period_of_time  => Arr::get($inputs, ShopMenuModel::period_of_time, null),
            ShopMenuModel::is_tax_included => Arr::get($inputs, ShopMenuModel::is_tax_included, true),
            ShopMenuModel::can_takeout     => Arr::get($inputs, ShopMenuModel::can_takeout, true),
        ];
    }
}
