<?php

namespace App\Usecases;

use App\Repositories\GetShopRepository;

class GetShopUsecase
{
    private $_getShopRepository;

    /**
     * Create a new usecase instance.
     *
     * @return void
     */
    public function __construct(GetShopRepository $getShopRepository)
    {
        $this->_getShopRepository = $getShopRepository;
    }

    /**
     * invoke
     *
     * @return void
     */
    public function invoke(
        int $shopId,
        bool $onlyRelase = true
    ) {
        return $this->_getShopRepository->invoke($shopId, $onlyRelase);
    }
}
