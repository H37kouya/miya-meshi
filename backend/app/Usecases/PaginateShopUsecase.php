<?php

namespace App\Usecases;

use App\Repositories\PaginateShopRepository;
use Illuminate\Support\Arr;

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
    public function invoke(array $search): array
    {
        $limit = Arr::get($search, PaginateShopRepository::limit, 10);
        $onlyRelease = Arr::get($search, PaginateShopRepository::only_release, true);

        return $this->_paginateShopRepository->invoke(
            $onlyRelease,
            $limit
        );
    }
}
