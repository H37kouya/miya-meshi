<?php

namespace App\Repositories;

use App\Models\SelectionPostArea;

class DeleteSelectionPostAreaRepository
{
    private SelectionPostArea $_selectionPostArea;
    public function __construct(SelectionPostArea $selectionPostArea)
    {
        $this->_selectionPostArea = $selectionPostArea;
    }

    /**
     * selectionPostIdに紐づいているSelectionPostAreaを削除する
     *
     * @param integer $selectionPostId
     * @return void
     */
    public function invoke(int $selectionPostId)
    {
        $this->_selectionPostArea->whereSelectionPostId($selectionPostId)->delete();
    }
}
