<?php

namespace App\Usecases;

use App\Repositories\CreateShopMenuRepository;
use App\Repositories\GetShopMenuRepository;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CreateShopMenuUsecase
{
    private CreateShopMenuRepository $_createShopMenuRepository;
    private GetShopMenuRepository $_getShopMenuRepository;

    /**
     * Create a new usecase instance.
     *
     * @return void
     */
    public function __construct(
        CreateShopMenuRepository $createShopMenuRepository,
        GetShopMenuRepository $getShopMenuRepository
    ) {
        $this->_createShopMenuRepository = $createShopMenuRepository;
        $this->_getShopMenuRepository = $getShopMenuRepository;
    }

    /**
     * invoke
     *
     * @return void
     */
    public function invoke(
        int $shopId,
        array $inputs
    ) {
        DB::beginTransaction();

        try {
            $shopMenu = $this->_createShopMenuRepository->invoke($shopId, $inputs);

            DB::commit();
            Cache::flush();

            return $shopMenu;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
