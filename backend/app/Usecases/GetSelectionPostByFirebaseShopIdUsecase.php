<?php

namespace App\Usecases;

use App\Repositories\GetSelectionPostByFirebaseShopIdRepository;

class GetSelectionPostByFirebaseShopIdUsecase
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
        return $this->_getSelectionPostByFirebaseShopIdRepository
            ->invoke($firebaseShopId);
    }
}
