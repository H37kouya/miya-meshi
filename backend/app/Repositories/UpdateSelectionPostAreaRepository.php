<?php

namespace App\Repositories;

class UpdateSelectionPostAreaRepository
{
    private CreateSelectionPostAreaRepository $_createSelectionPostAreaRepository;

    private DeleteSelectionPostAreaRepository $_deleteSelectionPostAreaRepository;

    public function __construct(
        CreateSelectionPostAreaRepository $createSelectionPostAreaRepository,
        DeleteSelectionPostAreaRepository $deleteSelectionPostAreaRepository
    ) {
        $this->_createSelectionPostAreaRepository = $createSelectionPostAreaRepository;
        $this->_deleteSelectionPostAreaRepository = $deleteSelectionPostAreaRepository;
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
        array $firebaseAreaIds
    ): array {
        // 以前登録した、Selection Post Areaを削除する
        $this->_deleteSelectionPostAreaRepository->invoke($selectionPostId);

        // Selection Post Areaを追加する
        $this->_createSelectionPostAreaRepository->invoke(
            $selectionPostId,
            $firebaseAreaIds
        );

        return $firebaseAreaIds;
    }
}
