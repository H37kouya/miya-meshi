<?php

namespace App\Repositories;

use App\Enum\Models\ImageModel;
use App\Models\Shop;
use Illuminate\Support\Arr;

class CreateImagesOfShop
{
    public const imageable_name = ImageModel::imageable_name;
    public const url = ImageModel::url;

    /**
     * invoke
     *
     * @param Shop $shop
     * @param array $insertUrls
     * @return void
     *
     * $insertUrls = [
     *   [ 'imageable_name => '', 'url' => '' ],
     *   [ 'imageable_name => '', 'url' => '' ],
     * ]
     */
    public function invoke(Shop $shop, array $insertUrls)
    {
        $updatedAt = $shop->updated_at;

        $shouldInsertData = [];
        foreach ($insertUrls as $insertUrl) {
            $shouldInsertData[] = [
                ImageModel::imageable_id   => $shop->id,
                ImageModel::imageable_type => $shop->getMorphClass(),
                ImageModel::url            => Arr::get($insertUrl, self::url),
                ImageModel::imageable_name => Arr::get($insertUrl, self::imageable_name),
                ImageModel::created_at     => $updatedAt,
                ImageModel::updated_at     => $updatedAt
            ];
        }

        $shop->images()->insert($shouldInsertData);
    }
}
