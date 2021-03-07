<?php

namespace App\Usecases;

use App\Repositories\DeleteShopMenuRepository;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DeleteShopMenuUsecase
{
    private DeleteShopMenuRepository $_deleteShopMenuRepository;

    /**
     * Create a new usecase instance.
     *
     * @return void
     */
    public function __construct(DeleteShopMenuRepository $deleteShopMenuRepository)
    {
        $this->_deleteShopMenuRepository = $deleteShopMenuRepository;
    }

    /**
     * invoke
     *
     * @return void
     */
    public function invoke(int $shopMenuId)
    {
        DB::beginTransaction();

        try {
            $this->_deleteShopMenuRepository->invoke($shopMenuId);

            DB::commit();
            Cache::flush();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
