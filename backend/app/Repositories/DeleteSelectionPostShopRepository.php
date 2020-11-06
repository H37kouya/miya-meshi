<?php

namespace App\Repositories;

use App\Models\SelectionPostShop;

class DeleteSelectionPostShopRepository
{
    private SelectionPostShop $_selectionPostShop;
    public function __construct(SelectionPostShop $selectionPostShop)
    {
        $this->_selectionPostShop = $selectionPostShop;
    }

    /**
     * selectionPostIdに紐づいているSelectionPostShopを削除する
     *
     * @param integer $selectionPostId
     * @return void
     */
    public function invoke(int $selectionPostId)
    {
        $this->_selectionPostShop->whereSelectionPostId($selectionPostId)->delete();
    }
}
