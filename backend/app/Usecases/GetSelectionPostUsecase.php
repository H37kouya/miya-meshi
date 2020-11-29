<?php

namespace App\Usecases;

use App\Repositories\GetSelectionPostRepository;
use Illuminate\Support\Facades\Cache;

class GetSelectionPostUsecase extends BaseSelectionPostUsecase
{
    private GetSelectionPostRepository $_getSelectionPostRepository;

    public function __construct(GetSelectionPostRepository $getSelectionPostRepository)
    {
        $this->_getSelectionPostRepository = $getSelectionPostRepository;
    }

    /**
     * SelectionPostの取得
     *
     * @param integer $selectionPostId
     * @param boolean $onlyRelease 公開中のみを取得する
     * @return array
     */
    public function invoke(
        int $selectionPostId,
        bool $onlyRelease = true
    ): array {
        return Cache::remember(
            self::CACHE_GET.$selectionPostId,
            120,
            fn () => $this->_getSelectionPostRepository->invoke($selectionPostId, $onlyRelease)
        );
    }
}
