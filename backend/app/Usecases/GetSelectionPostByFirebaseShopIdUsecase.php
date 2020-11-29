<?php

namespace App\Usecases;

use App\Repositories\GetSelectionPostByFirebaseShopIdRepository;
use Illuminate\Support\Facades\Cache;

class GetSelectionPostByFirebaseShopIdUsecase extends BaseSelectionPostUsecase
{
    private GetSelectionPostByFirebaseShopIdRepository $_getSelectionPostByFirebaseShopIdRepository;

    /**
     * Create a new usecase instance.
     *
     * @return void
     */
    public function __construct(
        GetSelectionPostByFirebaseShopIdRepository $getSelectionPostByFirebaseShopIdRepository
    ) {
        $this->_getSelectionPostByFirebaseShopIdRepository = $getSelectionPostByFirebaseShopIdRepository;
    }

    /**
     * invoke
     *
     * @return void
     */
    public function invoke(string $firebaseShopId)
    {
        return Cache::remember(
            self::CACHE_GET_BY_FIREBASE_SHOP_ID.$firebaseShopId,
            120,
            fn () => $this->_getSelectionPostByFirebaseShopIdRepository->invoke($firebaseShopId)
        );
    }
}
