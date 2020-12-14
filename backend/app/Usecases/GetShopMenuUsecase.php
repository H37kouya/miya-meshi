<?php

namespace App\Usecases;

use App\Repositories\GetShopMenuRepository;

class GetShopMenuUsecase
{
    private GetShopMenuRepository $_getShopMenuRepository;

    /**
     * Create a new usecase instance.
     *
     * @return void
     */
    public function __construct(GetShopMenuRepository $getShopMenuRepository)
    {
        $this->_getShopMenuRepository = $getShopMenuRepository;
    }

    /**
     * invoke
     *
     * @return void
     */
    public function invoke(int $shopMenuId, bool $onlyRelease = true)
    {
        return $this->_getShopMenuRepository->invoke($shopMenuId, $onlyRelease);
    }
}
