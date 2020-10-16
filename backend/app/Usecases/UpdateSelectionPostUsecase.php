<?php

namespace App\Usecases;

use App\Repositories\UpdateSelectionPostAreaRepository;
use App\Repositories\UpdateSelectionPostRepository;
use Illuminate\Support\Arr;

class UpdateSelectionPostUsecase
{
    private UpdateSelectionPostRepository $_updateSelectionPostRepository;

    private UpdateSelectionPostAreaRepository $_updateSelectionPostAreaRepository;

    public function __construct(
        UpdateSelectionPostRepository $updateSelectionPostRepository,
        UpdateSelectionPostAreaRepository $updateSelectionPostAreaRepository
    ) {
        $this->_updateSelectionPostRepository = $updateSelectionPostRepository;
        $this->_updateSelectionPostAreaRepository = $updateSelectionPostAreaRepository;
    }

    /**
     * SelctionPostを新規作成する
     *
     * @param array $inputs
     * @return array
     */
    public function invoke(
        int $selectionPostId,
        array $inputs
    ): array {
        $selectionPost = $this->_updateSelectionPostRepository->invoke($selectionPostId, $inputs);

        $firebaseAreaIds = $this->_updateSelectionPostAreaRepository->invoke(
            $selectionPostId,
            $this->getFirebaseAreaIds($inputs)
        );

        return [
            'selectionPost'   => $selectionPost,
            'firebaseAreaIds' => $firebaseAreaIds,
        ];
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
}
