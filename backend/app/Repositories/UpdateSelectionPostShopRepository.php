<?php

namespace App\Repositories;

class UpdateSelectionPostShopRepository
{
    private CreateSelectionPostShopRepository $_createSelectionPostShopRepository;

    private DeleteSelectionPostShopRepository $_deleteSelectionPostShopRepository;

    public function __construct(
        CreateSelectionPostShopRepository $createSelectionPostShopRepository,
        DeleteSelectionPostShopRepository $deleteSelectionPostShopRepository
    ) {
        $this->_createSelectionPostShopRepository = $createSelectionPostShopRepository;
        $this->_deleteSelectionPostShopRepository = $deleteSelectionPostShopRepository;
    }

    /**
     * SelectionPostAreaの更新
     *
     * @param integer $selectionPostId
     * @param string[] $firebaseAreaIds
     * @return array
     */
    public function invoke(
        int $selectionPostId,
        array $firebaseShopIds
    ): array {
        // 以前登録した、Selection Post Areaを削除する
        $this->_deleteSelectionPostShopRepository->invoke($selectionPostId);

        // Selection Post Areaを追加する
        $this->_createSelectionPostShopRepository->invoke(
            $selectionPostId,
            $firebaseShopIds
        );

        return $firebaseShopIds;
    }
}
