<?php

namespace App\Usecases;

use App\Repositories\PaginateSelectionPostRepository;
use Illuminate\Support\Arr;

class PaginateSelectionPostUsecase
{
    private PaginateSelectionPostRepository $_paginateSelectionPostRepository;

    public function __construct(PaginateSelectionPostRepository $paginateSelectionPostRepository)
    {
        $this->_paginateSelectionPostRepository = $paginateSelectionPostRepository;
    }

    /**
     * SelectionPostのPagination
     *
     * @param array $search
     * @return array
     */
    public function invoke(array $search): array
    {
        $releases = Arr::get($search, 'releases', [true]);
        $limit = Arr::get($search, 'limit', 10);
        $id = Arr::get($search, 'id', null);
        $createdAt = Arr::get($search, 'created_at', null);
        $updatedAt = Arr::get($search, 'updated_at', null);

        return $this->_paginateSelectionPostRepository->invoke(
            $releases,
            $limit,
            $id,
            $createdAt,
            $updatedAt
        );
    }
}
