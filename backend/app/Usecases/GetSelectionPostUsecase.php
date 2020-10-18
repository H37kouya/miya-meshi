<?php

namespace App\Usecases;

use App\Models\SelectionPost;

class GetSelectionPostUsecase
{
    private SelectionPost $_selectionPost;

    public function __construct(SelectionPost $selectionPost)
    {
        $this->_selectionPost = $selectionPost;
    }

    /**
     * SelectionPostの取得
     *
     * @param integer $selectionPostId
     * @param boolean $onlyRelease 公開中のみを取得する
     * @return array
     */
    public function invoke(
        int $selectionPostId,
        bool $onlyRelease = true
    ): array {
        $selectionPostQuery = $this->_selectionPost->with('selectionPostAreas');
        /** @var SelectionPost $selectionPost */
        $selectionPost = $onlyRelease
            ? $selectionPostQuery->whereRelease(true)->findOrFail($selectionPostId)
            : $selectionPostQuery->findOrFail($selectionPostId);

        return [
            'selectionPost'   => $selectionPost->toArray(),
            'firebaseAreaIds' => $selectionPost->selectionPostAreas->map(
                fn ($selectionPostArea) => $selectionPostArea->firebase_area_id
            )
        ];
    }
}
