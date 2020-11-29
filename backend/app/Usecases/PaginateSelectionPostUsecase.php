<?php

namespace App\Usecases;

use App\Repositories\PaginateSelectionPostRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class PaginateSelectionPostUsecase extends BaseSelectionPostUsecase
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

        return Cache::remember(
            $this->get_cache_name($releases, $limit, $id, $createdAt, $updatedAt),
            120,
            fn () => $this->_paginateSelectionPostRepository->invoke(
                $releases,
                $limit,
                $id,
                $createdAt,
                $updatedAt
            )
        );
    }

    private function get_cache_name(
        array $releases = [true],
        int $limit,
        ?int $id = null,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ) {
        $cachename = self::CACHE_PAGINATION . 'limit=' . $limit;
        $strReleases = '';
        foreach ($releases as $release) {
            $strReleases .= strval($release);
        }

        $cachename .= 'releases='.$strReleases;
        if ($id) {
            $cachename .= 'id='.$id;
        }
        if ($createdAt) {
            $cachename .= 'createdAt='.$createdAt;
        }
        if ($updatedAt) {
            $cachename .= 'updatedAt='.$updatedAt;
        }

        return $cachename;
    }
}
