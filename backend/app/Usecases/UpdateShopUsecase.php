<?php

namespace App\Usecases;

use App\Repositories\UpdateShopRepository;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UpdateShopUsecase
{
    private UpdateShopRepository $_updateShopRepository;

    /**
     * Create a new usecase instance.
     *
     * @return void
     */
    public function __construct(UpdateShopRepository $updateShopRepository)
    {
        $this->_updateShopRepository = $updateShopRepository;
    }

    /**
     * invoke
     *
     * @return void
     */
    public function invoke(
        int $id,
        array $inputs
    ): array {
        DB::beginTransaction();

        try {
            $shop = $this->_updateShopRepository->invoke($id, $inputs);

            DB::commit();
            Cache::flush();
            return $shop;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
