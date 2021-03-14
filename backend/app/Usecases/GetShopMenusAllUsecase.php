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
     * 店舗メニュー一覧を取得
     *
     * @return array
     */
    public function invoke(int $shopId, bool $onlyRelease = true): array
    {
        return $this->_getShopMenusAllRepository->invoke($shopId, $onlyRelease);
    }
}
