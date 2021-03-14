<?php

namespace App\Usecases;

use App\Repositories\DeleteFirebaseShopRepository;
use App\Repositories\DeleteShopRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class DeleteShopUsecase
{
    private DeleteShopRepository $_deleteShopRepository;
    private DeleteFirebaseShopRepository $_deleteFirebaseShopRepository;

    /**
     * Create a new usecase instance.
     *
     * @return void
     */
    public function __construct(
        DeleteShopRepository $deleteShopRepository,
        DeleteFirebaseShopRepository $deleteFirebaseShopRepository
    ) {
        $this->_deleteShopRepository = $deleteShopRepository;
        $this->_deleteFirebaseShopRepository = $deleteFirebaseShopRepository;
    }

    /**
     * invoke
     *
     * @return void
     */
    public function invoke(int $shopId)
    {
        DB::beginTransaction();

        try {
            $this->_deleteFirebaseShopRepository->invoke($shopId);
            $this->_deleteShopRepository->invoke($shopId);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
