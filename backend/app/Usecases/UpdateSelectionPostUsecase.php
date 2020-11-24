<?php

namespace App\Usecases;

use App\Repositories\UpdateSelectionPostAreaRepository;
use App\Repositories\UpdateSelectionPostRepository;
use App\Repositories\UpdateSelectionPostShopRepository;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateSelectionPostUsecase
{
    private UpdateSelectionPostRepository $_updateSelectionPostRepository;

    private UpdateSelectionPostAreaRepository $_updateSelectionPostAreaRepository;

    private UpdateSelectionPostShopRepository $_updateSelectionPostShopRepository;

    public function __construct(
        UpdateSelectionPostRepository $updateSelectionPostRepository,
        UpdateSelectionPostAreaRepository $updateSelectionPostAreaRepository,
        UpdateSelectionPostShopRepository $updateSelectionPostShopRepository
    ) {
        $this->_updateSelectionPostRepository = $updateSelectionPostRepository;
        $this->_updateSelectionPostAreaRepository = $updateSelectionPostAreaRepository;
        $this->_updateSelectionPostShopRepository = $updateSelectionPostShopRepository;
    }

    /**
     * SelctionPostを新規作成する
     *
     * @param integer $selectionPostId
     * @param array $inputs
     * @return array
     */
    public function invoke(
        int $selectionPostId,
        array $inputs
    ): array {
        DB::beginTransaction();

        try {
            $selectionPost = $this->_updateSelectionPostRepository->invoke($selectionPostId, $inputs);

            $firebaseAreaIds = $this->_updateSelectionPostAreaRepository->invoke(
                $selectionPostId,
                $this->getFirebaseAreaIds($inputs)
            );

            $firebaseShopIds = $this->_updateSelectionPostShopRepository->invoke(
                $selectionPostId,
                $this->getFirebaseShopIds($inputs)
            );

            DB::commit();
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
