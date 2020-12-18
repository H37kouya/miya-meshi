<?php

namespace App\Usecases;

use App\Repositories\CreateSelectionPostAreaRepository;
use App\Repositories\CreateSelectionPostRepository;
use App\Repositories\CreateSelectionPostShopRepository;
use Exception;
use App\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateSelectionPostUsecase
{
    private CreateSelectionPostRepository $_createSelectionPostRepository;

    private CreateSelectionPostAreaRepository $_createSelectionPostAreaRepository;

    private CreateSelectionPostShopRepository $_createSelectionPostShopRepository;

    public function __construct(
        CreateSelectionPostRepository $createSelectionPostRepository,
        CreateSelectionPostAreaRepository $createSelectionPostAreaRepository,
        CreateSelectionPostShopRepository $createSelectionPostShopRepository
    ) {
        $this->_createSelectionPostRepository = $createSelectionPostRepository;
        $this->_createSelectionPostAreaRepository = $createSelectionPostAreaRepository;
        $this->_createSelectionPostShopRepository = $createSelectionPostShopRepository;
    }

    /**
     * SelctionPostを新規作成する
     *
     * @param array $inputs
     * @return array
     */
    public function invoke(
        array $inputs
    ): array {
        DB::beginTransaction();

        try {
            $selectionPost = $this->_createSelectionPostRepository->invoke($inputs);

            $firebaseAreaIds = $this->_createSelectionPostAreaRepository->invoke(
                $selectionPost["id"],
                $this->getFirebaseAreaIds($inputs)
            );

            $firebaseShopIds = $this->_createSelectionPostShopRepository->invoke(
                $selectionPost["id"],
                $this->getFirebaseShopIds($inputs)
            );

            DB::commit();
            Cache::flush();
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e);
            throw $e;
        }

        Arr::set($selectionPost, 'firebase_area_ids', $firebaseAreaIds);
        Arr::set($selectionPost, 'firebase_shop_ids', $firebaseShopIds);

        return $selectionPost;
    }

    /**
     * inputsからfirebase_area_idsを取得する
     *
     * @param array $inputs
     * @return string[]
     */
    protected function getFirebaseAreaIds(array $inputs): array
    {
        $firebaseAreaIds = Arr::get($inputs, 'firebase_area_ids', []);

        return Arr::where($firebaseAreaIds, fn ($value, $key) => is_string($value));
    }

    /**
     * inputsからfirebase_shop_idsを取得する
     *
     * @param array $inputs
     * @return string[]
     */
    protected function getFirebaseShopIds(array $inputs): array
    {
        $firebaseShopIds = Arr::get($inputs, 'firebase_shop_ids', []);

        return Arr::where($firebaseShopIds, fn ($value, $key) => is_string($value));
    }
}
