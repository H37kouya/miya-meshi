<?php

namespace App\Usecases;

use App\Models\SelectionPost;
use Illuminate\Support\Arr;

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

        $firebaseAreaIds = $selectionPost->selectionPostAreas->map(
            fn ($selectionPostArea) => $selectionPostArea->firebase_area_id
        );
        // いらないkeyの削除
        Arr::forget($selectionPost, 'selectionPostAreas');
        Arr::set($selectionPost, 'firebase_area_ids', $firebaseAreaIds);

        return $selectionPost->toArray();
    }
}
