<?php

namespace App\Usecases;

use App\Repositories\UpdateOrCreateFirebaseShopRepository;

class ConnectShopAndFirebaseShopUsecase
{
    private UpdateOrCreateFirebaseShopRepository $_updateOrCreateFirebaseShopRepository;

    /**
     * Create a new usecase instance.
     *
     * @return void
     */
    public function __construct(UpdateOrCreateFirebaseShopRepository $updateOrCreateFirebaseShopRepository)
    {
        $this->_updateOrCreateFirebaseShopRepository = $updateOrCreateFirebaseShopRepository;
    }

    /**
     * FirebaseShopとShopを結びつける
     *
     * @return void
     */
    public function invoke(
        int $shopId,
        string $firebaseShopId
    ) {
        return $this->_updateOrCreateFirebaseShopRepository->invoke(
            $shopId,
            $firebaseShopId
        );
    }
}
