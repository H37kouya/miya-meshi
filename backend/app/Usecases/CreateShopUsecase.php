<?php

namespace App\Usecases;

use App\Repositories\CreateShopRepository;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CreateShopUsecase
{
    private CreateShopRepository $_createShopRepository;

    /**
     * Create a new usecase instance.
     *
     * @return void
     */
    public function __construct(CreateShopRepository $createShopRepository)
    {
        $this->_createShopRepository = $createShopRepository;
    }

    /**
     * invoke
     *
     * @return void
     */
    public function invoke(
        array $inputs
    ) {
        DB::beginTransaction();

        try {
            $shop = $this->_createShopRepository->invoke($inputs);
            DB::commit();
            Cache::flush();

            return $shop;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
