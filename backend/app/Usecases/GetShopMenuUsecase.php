<?php

namespace App\Usecases;

use App\Repositories\GetShopRepository;

class GetShopMenuUsecase
{
    private GetShopRepository $_getShopRepository;

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
    public function invoke(int $shopMenuId, bool $onlyRelease = true)
    {
        return $this->_getShopRepository->invoke($shopMenuId);
    }
}
