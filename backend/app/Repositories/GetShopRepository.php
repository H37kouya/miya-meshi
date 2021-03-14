<?php

namespace App\Repositories;

use App\Enum\Models\ImageModel;
use App\Enum\Models\ShopInformationModel;
use App\Enum\Models\ShopModel;
use App\Models\Shop;
use App\Support\Arr;
use Illuminate\Support\Carbon;

class GetShopRepository
{
    /**
     * invoke
     *
     * @return array
     */
    public function invoke(
        int $shopId,
        bool $onlyRelease = true
    ): array {
        $foundShop = Shop::with([
            ShopModel::withShopInformation,
            ShopModel::withImages,
        ])
            ->when($onlyRelease, function($query) {
                $query->nowPublicPosts(Carbon::now());
            })->whereId($shopId)->firstOrFail([
                ShopModel::id,
                ShopModel::release,
                ShopModel::publish_from,
                ShopModel::publish_to,
                ShopModel::priority,
            ])->toArray();

        $shopInformation = Arr::get($foundShop, ShopModel::shop_information, []);
        $images = Arr::get($foundShop, ShopModel::images);

        $mappedShop = Arr::except($foundShop, [
            ShopModel::shop_information,
            ShopModel::images,
        ]);
        $mappedShop['shop_information_id'] = Arr::get($shopInformation, ShopInformationModel::id);
        $imageLink = Arr::get(
            Arr::first($images, fn ($image) => $image[ImageModel::imageable_name] === ShopModel::image_link, []),
            ImageModel::url
        );
        $subImageLink = Arr::pluck(
            Arr::where(
                $images,
                fn ($image) => $image[ImageModel::imageable_name] === ShopModel::sub_image_link
            ),
            ImageModel::url
        );
        $appearanceImageLink = Arr::pluck(
            Arr::where(
                $images,
                fn ($image) => $image[ImageModel::imageable_name] === ShopModel::appearance_image_link
            ),
            ImageModel::url
        );
        $menuImageLink = Arr::pluck(
            Arr::where(
                $images,
                fn ($image) => $image[ImageModel::imageable_name] === ShopModel::menu_image_link
            ),
            ImageModel::url
        );

        $mappedShop = array_merge(
            $mappedShop,
            Arr::except($shopInformation, [
                ShopInformationModel::id,
                ShopInformationModel::shop_id
            ]),
            [
                ShopModel::image_link            => $imageLink,
                ShopModel::sub_image_link        => $subImageLink,
                ShopModel::appearance_image_link => $appearanceImageLink,
                ShopModel::menu_image_link       => $menuImageLink,
            ]
        );

        return $mappedShop;
    }
}
