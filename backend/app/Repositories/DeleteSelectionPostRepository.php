<?php

namespace App\Repositories;

use App\Models\SelectionPost;

class DeleteSelectionPostRepository
{
    /**
     * invoke
     *
     * @return void
     */
    public function invoke(int $id)
    {
        SelectionPost::whereId($id)->delete();
    }
}
