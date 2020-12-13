<?php

namespace App\Repositories;

use App\Models\Shop;

class UpdateImageOfShopRepository
{
    private CreateImagesOfShop $_createImagesOfShop;
    private DeleteImageOfShopRepository $_deleteImageOfShopRepository;

    public const imageable_name = CreateImagesOfShop::imageable_name;
    public const url = CreateImagesOfShop::url;

    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct(
        CreateImagesOfShop $createImagesOfShop,
        DeleteImageOfShopRepository $deleteImageOfShopRepository
    ) {
        $this->_createImagesOfShop = $createImagesOfShop;
        $this->_deleteImageOfShopRepository = $deleteImageOfShopRepository;
    }

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
    public function invoke(
        int $shopId,
        array $insertUrls
    ) {
        $shop = Shop::find($shopId);
        $this->_deleteImageOfShopRepository->invoke($shop);

        if (count($insertUrls) > 0) {
            $this->_createImagesOfShop->invoke($shop, $insertUrls);
        }
    }
}
