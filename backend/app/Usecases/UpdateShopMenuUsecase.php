<?php

namespace App\Usecases;

use App\Repositories\GetShopMenuRepository;
use App\Repositories\UpdateShopMenuRepository;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UpdateShopMenuUsecase
{
    private GetShopMenuRepository $_getShopMenuRepository;
    private UpdateShopMenuRepository $_updateShopMenuRepository;

    /**
     * Create a new usecase instance.
     *
     * @return void
     */
    public function __construct(
        GetShopMenuRepository $getShopMenuRepository,
        UpdateShopMenuRepository $updateShopMenuRepository
    ) {
        $this->_getShopMenuRepository = $getShopMenuRepository;
        $this->_updateShopMenuRepository = $updateShopMenuRepository;
    }

    /**
     * invoke
     *
     * @return void
     */
    public function invoke(int $shopMenuId, array $inputs)
    {
        DB::beginTransaction();

        \Log::debug($inputs);

        try {
            $this->_updateShopMenuRepository->invoke($shopMenuId, $inputs);

            DB::commit();
            Cache::flush();

            return $this->_getShopMenuRepository->invoke($shopMenuId, false);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
