<?php

namespace App\Usecases;

use App\Repositories\CreateSelectionPostAreaRepository;
use App\Repositories\CreateSelectionPostRepository;
use Illuminate\Support\Arr;

class CreateSelectionPostUsecase
{
    private CreateSelectionPostRepository $_createSelectionPostRepository;

    private CreateSelectionPostAreaRepository $_createSelectionPostAreaRepository;

    public function __construct(
        CreateSelectionPostRepository $createSelectionPostRepository,
        CreateSelectionPostAreaRepository $createSelectionPostAreaRepository
    ) {
        $this->_createSelectionPostRepository = $createSelectionPostRepository;
        $this->_createSelectionPostAreaRepository = $createSelectionPostAreaRepository;
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
        $selectionPost = $this->_createSelectionPostRepository->invoke($inputs);

        $firebaseAreaIds = $this->_createSelectionPostAreaRepository->invoke(
            $selectionPost["id"],
            $this->getFirebaseAreaIds($inputs)
        );

        Arr::set($selectionPost, 'firebase_area_ids', $firebaseAreaIds);

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
}
