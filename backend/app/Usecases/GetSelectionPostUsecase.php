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

    public function invoke(int $selectionPostId)
    {
        /** @var SelectionPost $selectionPost */
        $selectionPost = $this->_selectionPost->findOrFail($selectionPostId);

        return [
            'selectionPost'   => $selectionPost->toArray(),
            'firebaseAreaIds' => $selectionPost->selectionPostAreas->map(
                fn ($selectionPostArea) => $selectionPostArea->firebase_area_id
            )
        ];
    }
}
