<?php

namespace App\Repositories;

use App\Models\Shop;

class UpdateImageOfShopRepository
{
    private CreateImagesOfShopRepository $_createImagesOfShopRepository;
    private DeleteImageOfShopRepository $_deleteImageOfShopRepository;

    public const imageable_name = CreateImagesOfShopRepository::imageable_name;
    public const url = CreateImagesOfShopRepository::url;

    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct(
        CreateImagesOfShopRepository $createImagesOfShopRepository,
        DeleteImageOfShopRepository $deleteImageOfShopRepository
    ) {
        $this->_createImagesOfShopRepository = $createImagesOfShopRepository;
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
            $this->_createImagesOfShopRepository->invoke($shop, $insertUrls);
        }
    }
}
