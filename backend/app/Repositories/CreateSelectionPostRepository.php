<?php

namespace App\Repositories;

use App\Models\SelectionPost;
use Illuminate\Support\Arr;

class CreateSelectionPostRepository
{
    /**
     * SelectionPost Model
     */
    private SelectionPost $_selectionPost;

    public function __construct(SelectionPost $selectionPost)
    {
        $this->_selectionPost = $selectionPost;
    }

    /**
     * SelectionPostを追加する
     *
     * @param array $inputs
     * @return array
     * @throws Exception
     */
    public function invoke(
        array $inputs
    ): array {
        /** @var SelectionPost $selectionPost */
        $selectionPost = $this->_selectionPost->create([
            'title'       => $inputs['title'],
            'contents'    => Arr::get($inputs, 'contents', null),
            'image'       => Arr::get($inputs, 'image', null),
            'description' => Arr::get($inputs, 'description', null),
            'release'     => Arr::get($inputs, 'release', false),
        ]);

        return $selectionPost->toArray();
    }
}
