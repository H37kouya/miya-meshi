<?php

namespace App\Usecases;

use App\Repositories\GetShopMenusAllRepository;

class GetShopMenusAllUsecase
{
    private GetShopMenusAllRepository $_getShopMenusAllRepository;

    /**
     * Create a new usecase instance.
     *
     * @return void
     */
    public function __construct(GetShopMenusAllRepository $getShopMenusAllRepository)
    {
        $this->_getShopMenusAllRepository = $getShopMenusAllRepository;
    }

    /**
     * invoke
     *
     * @return void
     */
    public function invoke(int $shopId, bool $onlyRelease = true)
    {
        return $this->_getShopMenusAllRepository->invoke($shopId, $onlyRelease);
    }
}
