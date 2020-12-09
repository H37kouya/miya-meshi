<?php

namespace App\Usecases;

use App\Repositories\PaginateShopRepository;

class PaginateShopUsecase
{
    private PaginateShopRepository $_paginateShopRepository;

    /**
     * Create a new usecase instance.
     *
     * @return void
     */
    public function __construct(PaginateShopRepository $paginateShopRepository)
    {
        $this->_paginateShopRepository = $paginateShopRepository;
    }

    /**
     * invoke
     *
     * @return void
     */
    public function invoke(): array
    {
        return $this->_paginateShopRepository->invoke();
    }
}
